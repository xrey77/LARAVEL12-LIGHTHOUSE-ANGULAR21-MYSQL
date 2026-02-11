<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;

final readonly class UploadPicture
{
     /**
     * @param  null  $root
     * @param  array{image: \Illuminate\Http\UploadedFile} $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        $user = User::find($args['id']);
        if (!$user) {
            throw new Error('User ID not found.');
        }

        $file = $args['profilepic'];
        
        $newfile = '00' . $user->id . '.' . $file->extension();

        $user->update([
            'profilepic' => $newfile,
        ]);
        
        $file->move(public_path('users'), $newfile);
        return [
            'message' => 'You have changes your profile picture successfully.',
            'user' => $user,
        ];
    }
}

#Request
// mutation UploadPicture($id: Int!, $file: Upload!) {
//     uploadPicture(id: $id, profilepic: $file) {
//     message
//     user {
//         id
//         profilepic
//     }
//     }
// }


