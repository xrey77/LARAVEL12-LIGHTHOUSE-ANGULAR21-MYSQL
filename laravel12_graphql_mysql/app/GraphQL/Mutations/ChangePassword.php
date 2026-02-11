<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;

final readonly class ChangePassword
{
    /** 
     * @param  null  $rootValue
     * @param  array  $args 
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        $user = User::find($args['id']);
        if (!$user) {
            throw new Error('User ID not found.');
        }

        $user->update([
            'password' => Hash::make($args['password']),
        ]);

        return [
            'message' => 'Your password has been changed successfully.',
            'user' => $user,
        ];
    }
}

// ============Request================
// mutation ChangePassword($input: PasswordInput!) {
//     changePassword(input: $input) {
//         message
//         user {
//             id
//         }
//     }
// }

// ===========Variables==============
// {
//     "input": {
//         "id": 2,
//         "password": "nald"
//     }
// }
