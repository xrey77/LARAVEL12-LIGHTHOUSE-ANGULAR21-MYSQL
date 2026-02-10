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
        return User::find($args['id']);
    }
}

#Request
// query { 
//   getUserById {
//     id
//     firstname
//     lastname
//     email
//     mobile
//     username
//   }
// }

#Query Variables
// {
//   id: 1
// }