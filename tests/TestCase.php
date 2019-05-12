<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
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

    protected $user;

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
            $randomUser = User::orderByRaw('RAND()')->client()->first();
            $email = $randomUser->email;
        }
        $this->user = User::where('email', $email)->first();
    }

    /**
     * Login client user
     *
     * @author goper
     * @return void
     */
    public function loggedUserClient()
    {
        $user = User::orderByRaw('RAND()')->client()->first();
        $this->loggedUser($user->email);
    }

    /**
     * Login user admin
     */
    public function loggedUserAsAdmin()
    {
        $user = User::orderByRaw('RAND()')->admin()->first();
        $this->loggedUser($user->email);
    }

    /**
     * Fetch random data base on `table` data given
     *
     * @param  string $tableName
     * @return object
     */
    public function findRandomData($tableName, $where = [])
    {
        $query = DB::table($tableName);

        if (!empty($where)) {
            $query->where($where);
        }

        return $query->orderByRaw('RAND()')->first();
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

    /**
     * Test response data if pagination or not
     *
     * @author goper
     * @param  object $data
     * @return void
     */
    public function paginationTest($data)
    {
        $this->assertObjectHasAttribute('current_page', $data);
        $this->assertObjectHasAttribute('first_page_url', $data);
        $this->assertObjectHasAttribute('total', $data);
        $this->assertTrue(is_array($data->data));

    }

    /**
     * Generate unique random data on table
     *
     * @author goper
     * @param  string $table - table name
     * @param  string $column - column name to be compared
     * @param  string $type - faker type data
     * @return string
     */
    public function getRandomUniqueData($table, $column, $type)
    {
        do {
            $string = $this->faker->$type;
            $count = DB::table($table)->where($column, $string)->count();
        } while ($count > 0);

        return $string;
    }

    /**
     * Logged user as admin
     *
     * @author goper
     * @return void
     */
    public function asAdmin()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);
    }

    /**
     * Logged user as client
     * @return [type] [description]
     */
    public function asClient()
    {
        $this->loggedUserClient();
        Passport::actingAs($this->user);
    }
}
