<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Error\Error;

final readonly class CreateUser
{   
    /** 
     * @param  null  $rootValue
     * @param  array{id: string|int}  $args 
     * @param  GraphQLContext  $context
     * @param  ResolveInfo  $resolveInfo
     * @return User|null
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): ?User
    {
        $email = User::where('email', $args['email'])->first();
        if ($email) {
            throw new Error('Email Address is already taken.');
        }

        $username = User::where('username', $args['username'])->first();
        if($username) {
            throw new Error('Username is already taken.');
        }

        $user = User::create([
            'firstname' => $args['firstname'],
            'lastname'  => $args['lastname'],
            'email'     => $args['email'],            
            'mobile'    => $args['mobile'],
            'username'  => $args['username'],
            'password'  => Hash::make($args['password'])
        ]);

        return [
            'message' => 'You have registered successfully, please login now.',
            'user' => $user,
        ];
    }
}

//===============Request==================
// mutation CreateUser($input: SignupInput!) {
//   registerUser(input: $input) { 
//     message 
//     user {            
//         id
//         firstname
//         lastname
//         email
//         mobile
//         username
//     }
//   }
// }

#//==============Variables================
// {
//     "input": {
//         "firstname": "Rey",
//         "lastname": "Gragasin",
//         "email": "rey@yahoo.com",
//         "mobile": "3242342",
//         "username": "Rey",
//         "password": "rey"
//     }
// }

