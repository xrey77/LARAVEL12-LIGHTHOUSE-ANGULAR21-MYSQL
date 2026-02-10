<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GraphQL\Error\Error;

final readonly class UserLogin
{
    public function __invoke($_, array $args): array
    {
        $user = User::where('username', $args['username'])->first();
        if (!$user) {
            throw new Error('Username not found.');
        }

        if (!$user || !Hash::check($args['password'], $user->password)) {
            throw new Error('Invalid password provided.');
        }

        $secret = config('services.api_service.key');
        // $issuer = config('services.issuer_service.key');        
        $credentials = ['username' => $args['username'], 'password' => $args['password']];                
        if (Auth::attempt($credentials)) {
            
            $user->tokens()->delete();
            $token = $user->createToken($secret)->plainTextToken;    
            return [
                'token' => $token,
                'message' => 'Login successful. please wait.',
                'user' => $user,
            ];
        }
        throw new Error('Authentication failed.');

    }
}

// ==================Request========================
// mutation LoginUser($input: LoginInput!) {
//     signIn(input: $input) {
//         token
//         message
//         user {
//             id
//             firstname
//             lastname
//             email
//             mobile
//             username
//             isactivated
//             isblocked
//             mailtoken
//             profilepic
//             qrcodeurl
//         }
//     }
// }


// ========================= Variables =============
// {
//     "input": {
//         "username": "Rey",
//         "password": "rey"
//     }
// }