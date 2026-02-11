<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Error\Error;


final readonly class GetUserById
{
    /** 
     * @param  null  $_
     * @param  array{id: string|int}  $args 
     */
    public function __invoke($_, array $args): ?User
    {
        $user = User::find($args['id']);
        if (!$user) {
            throw new Error('User ID not found.');
        }
        return $user;
    }
}

#Request
// query getUserById($id: Int!) {
//     getUserById(id: $id) {
//         id
//         firstname
//         lastname
//         email
//         mobile
//         username
//         profilepic
//         qrcodeurl
//     }
// }

#Query Variables
// {
//   "id": 1
// }