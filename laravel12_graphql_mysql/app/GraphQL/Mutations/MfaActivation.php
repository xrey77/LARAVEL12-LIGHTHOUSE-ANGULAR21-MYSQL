<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Image;

final readonly class MfaActivation
{
    /** 
     * @param  null  $rootValue
     * @param  array  $args 
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        // \Log::info('MFA Args:', $args);
        $user = User::find($args['id']);
        if (!$user) {
            throw new Error('User ID not found.');
        }

        if ($args["twofactorenabled"] === true) {
                $issuer = config('services.issuer_service.key');
                $secretKey = Google2FA::generateSecretKey();

                // Generate otpauth:///
                $qrCodeUrl = Google2FA::getQRCodeUrl(
                    $issuer,
                    $user->email,
                    $secretKey
                );

                $renderer = new ImageRenderer(
                    new RendererStyle(400), // Set the size
                    new ImagickImageBackEnd()
                );

                $writer = new Writer($renderer);
                
                // Write the QR code as a PNG image string
                $qrcode_image_string = $writer->writeString($qrCodeUrl);
        
                // Encode the image string to base64 for embedding in the view
                $qrcode_base64 = base64_encode($qrcode_image_string);

                $qrcode = 'data:image/png;base64,' . $qrcode_base64;
                $user->update([
                    'secretkey' => encrypt($secretKey),
                    'qrcodeurl' => $qrcode
                ]);

                return [
                    'message' => 'Multi-Factor Authenticator has been enabled, please scan the QRCODE using your Mobile Google or Microsoft Authenticator',
                    'user' => $user, 
                ];
        } else {

            $user->update([
                'secretkey' => null,
                'qrcodeurl' => null
            ]);
            return [
                'message' => 'Multi-Factor Authenticator has been disabled.',
                'user' => $user,
            ];

        }

    }
}

// ==========Request=================
// mutation MfaActivation($input: MfaInput!) {
//     mfaActivation(input: $input) {
//         message
//         user {
//             id
//             qrcodeurl
//         }
//     }
// }


// =========Variables===============
// {
//     "input":  {
//         "id": 2,
//         "twofactorenabled": true
//     }
// }
