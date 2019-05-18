<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use DB;

/**
 * Trait for user accesor, to logged in as user, as admin etc...
 *
 * @author goper
 */
trait Accessor {

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
