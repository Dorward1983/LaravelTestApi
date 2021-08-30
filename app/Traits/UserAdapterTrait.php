<?php

namespace App\Traits;

use Laravel\Passport\PersonalAccessTokenResult;
use App\Models\User;

trait UserAdapterTrait
{
    /**
     * Adapts the client_secret key.
     *
     * @param array $data
     * @return void
     */
    public function clientsSecretToPassword(&$data)
    {
        $data['password'] = $data['client_secret'];
        unset($data['client_secret']);
    }

    /**
     * Generates an authorization response.
     *
     * @param PersonalAccessTokenResult $token
     * @param User $user
     * @return array
     */
    public function getAuthResponse(PersonalAccessTokenResult $token, User $user)
    {
        return [
            'token_type' => 'Bearer',
            'expires_in' => $this->tokenExpiresToSeconds($token->token->created_at, $token->token->expires_at),
            'access_token' => $token->accessToken,
            'changePassword' => $user->changePassword,
            'sellerId' => $user->sellerId
        ];
    }


    public function tokenExpiresToSeconds($created_at, $expires_at)
    {
        return strtotime($expires_at) - strtotime($created_at);
    }
}
