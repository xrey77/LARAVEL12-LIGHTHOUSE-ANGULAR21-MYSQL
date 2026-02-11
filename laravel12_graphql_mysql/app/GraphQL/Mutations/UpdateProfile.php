<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;

final readonly class UpdateProfile
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
            'firstname' => $args['firstname'],
            'lastname'  => $args['lastname'],
            'mobile'    => $args['mobile']
        ]);

        return [
            'message' => 'Your profile has been updated successfully.',
            'user' => $user,
        ];
    }
}


// ================Request==============================
// mutation UpdateProfile($input: ProfileInput!) {
//     updateProfile(input: $input) {
//         message
//         user {
//             id
//             firstname
//             lastname
//             email
//             mobile
//             username
//             profilepic
//         }
//     }
// }

// ================Variables===========================
// {
//     "input": {
//         "id": 2,
//         "firstname": "Reynald",
//         "lastname": "Marquez-Gragasin",
//         "mobile": "+63324234"
//     }
// }
