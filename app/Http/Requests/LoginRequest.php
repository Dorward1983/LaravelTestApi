<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\UserAdapterTrait;

/**
 * Class LoginRequest
 */
class LoginRequest extends FormRequest
{

    use UserAdapterTrait;

    /**
     * LoginRequest constructor
     * @param null $content
     */
    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Authorizes the user
     *
     * @return bool|\Laravel\Passport\PersonalAccessTokenResult
     */
    public function authorizeUser()
    {
        $credentials = $this->only(['client_id', 'client_secret']);

        $this->clientsSecretToPassword($credentials);

        if (!Auth::attempt($credentials)) {
            return false;
        }

        $user = $this->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return $tokenResult;
    }

    /**
     * @return array
     */
    public function login()
    {
        $token = $this->authorizeUser();

        return response()->json($this->getAuthResponse($token, $this->user()));
    }
}
