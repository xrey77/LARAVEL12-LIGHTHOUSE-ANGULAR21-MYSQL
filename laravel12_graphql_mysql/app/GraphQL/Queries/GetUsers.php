<?php declare(strict_types=1);

namespace App\GraphQL\Queries;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final readonly class GetUsers
{
        /**
     * @param  null  $_
     * @param  array{}  $args
     * @return Collection<int, User>
     */
    public function __invoke(null $_, array $args): Collection
    {
        // Fetches all user records from the database
        return User::all();
    }
}


#Query
// query {
//   getUsers {
//     id
//     firstname
//     lastname
//     email
//     username
//     password
//     profilepic
//     secret
//     qrcodeurl
//   }
// }
