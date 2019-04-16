<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * HTTP response constants
     * @var integer
     */
    const RESPONSE_SUCCESS = 200;
    const RESPONSE_REDIRECTION = 302;
    const RESPONSE_CLIENT_ERROR = 422;
    const RESPONSE_UNAUTHORIZED = 401;
    const RESPONSE_FORBIDDEN = 403;
    const RESPONSE_INTERNAL_ERROR = 500;
    const RESPONSE_NOT_FOUND = 404;

    /**
     * Login user
     *
     * @author goper
     * @param  string $email
     * @return void
     */
    public function loggedUser($email)
    {
        if ($email == 'random') {
            $randomUser = User::orderByRaw('RAND()')->whitelisted()->first();
            $email = $randomUser->email;
        }
        $this->user = User::where('email', $email)->first();
        auth()->login($this->user);
    }

    /**
     * Login user admin
     */
    public function loggedUserAsAdmin()
    {
        $this->loggedUser('admin@etrs.com');
    }

    /**
     * Get response body on `GET` request
     *
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function getResponseData($response)
    {
        return $response->getOriginalContent()->getData();
    }

    /**
     * Get reponse on POST request
     *
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function getPostResponse($response)
    {
        return json_decode($response->getContent());
    }
}
