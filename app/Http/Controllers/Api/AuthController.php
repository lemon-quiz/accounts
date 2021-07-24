<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Models\OauthClient;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function register(Register $request)
    {
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),

        ]);
        $user->save();

        return ['ok'];
    }

    public function login(Login $request)
    {
        $http = new Client();
        $response = $http->post('http://web/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'MCYCtcU85efcRJZgu72JEvnwk6hSTvbFHizpf7Un',
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'scope' => 'profile cms',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function profile(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        if ($user) {
            $user->load('roles');

            return response()->json($user)
                ->header('X_OAUTH_CLIENT_ID', $request->get('X_OAUTH_CLIENT_ID'))
                ->header('X_OAUTH_USER_ID', $request->get('X_OAUTH_USER_ID'));
        }

        $client = OauthClient::findOrFail($request->get('X_OAUTH_CLIENT_ID'))->makeHidden(['secret']);

        return response()->json($client)
            ->header('X_OAUTH_CLIENT_ID', $request->get('X_OAUTH_CLIENT_ID'))
            ->header('X_OAUTH_USER_ID', $request->get('X_OAUTH_USER_ID'));
    }
}
