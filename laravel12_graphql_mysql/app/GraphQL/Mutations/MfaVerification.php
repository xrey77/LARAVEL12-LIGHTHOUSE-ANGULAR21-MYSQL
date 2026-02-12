<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Google2FA;

final readonly class MfaVerification
{
    /**
     * @param  null  $rootValue
     * @param  array{id: int, otp: string}  $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        // \Log::info('MFA Args:', $args);

        $user = User::find($args['id']);
        if (!$user) {
            throw new Error('User ID not found.');
        }

        if (is_null($user->qrcodeurl)) {
            throw new Error('Multi-Factor Authenticator is not yet.');
        }

        $otp = $args['otp'];
        $secret = decrypt($user->secretkey);

        if (Google2FA::verifyKey($secret, $otp)) {
            return [
                'message' => 'OTP code has been validated successfully.',
                'user' => $user,
            ];
        } else {
            throw new Error('Invalid OTP code, please try again.'); 
        }

        throw new Error('Failed to validate OTP code.');
        
    }
}

// =============Request================
// mutation MfaVerification($input: VerificationInput!) {
//     mfaVerification(input: $input) {
//         message
//         user {
//             id
//             username
//         }
//     }
// }

// ============Variables==============
// {
//     "input": {
//         "id": 2,
//         "otp": "343433"
//     }
// }