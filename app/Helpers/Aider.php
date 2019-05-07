<?php

namespace App\Helpers;

use App\Helpers\ShortCodeGenerator;
use Illuminate\Http\JsonResponse;
use DB;

class Aider
{

    use ShortCodeGenerator;
    
    /**
    * Return json response
    *
    * @param  Boolean $success                                 if response is a success or not
    * @param  array  $data                                     extra data to include
    * @param  integer  $status                                 response status code
    * @return Illuminate\Http\JsonResponse
    * @author goper
    */
    public function jsonify($success, $data = [], $status = 200)
    {
        return new JsonResponse(array_merge([
            'success' => $success
        ], $data), $status);
    }

    /**
    * Return a successful json response
    *
    * @param  String $message                                  message of the response
    * @param  array  $data                                     extra data to include
    * @return Illuminate\Http\JsonResponse
    * @author goper
    */
    public function successify($message, $extra = [])
    {
        return $this->jsonify(true, array_merge([
            'message' => $message
        ], $extra));
    }

    /**
    * Return a successful with data response
    *
    * @author goper
    * @param  string $message
    * @param  array  $extra
    * @return Illuminate\Http\JsonResponse
    */
    public function successData($data = [])
    {
        return $this->jsonify(true, array_merge([
            'message' => '',
        ], $data));
    }

    /**
    * Successfull json response
    *
    * @param  string  $message                                 the message
    * @param  array   $extra                                   the extra data to attach
    * @param  integer $status                                  the status of the response
    * @return Illuminate\Http\JsonResponse
    * @author goper
    */
    public function successful($message, $extra = [], $status = 200)
    {
        return $this->jsonify(true, array_merge([
            'message' => $message
        ], $extra), $status);
    }

    /**
    * Return an unsuccessful json response
    *
    * @param  String $message                                  message of the response
    * @param  array  $data                                     extra data to include
    * @return Illuminate\Http\JsonResponse
    * @author goper
    */
    public function errorify($message, $extra = [])
    {
        return $this->jsonify(false, array_merge([
            'message' => $message
        ], $extra), 422);
    }

    /**
    * Erroneous json response
    *
    * @param  string  $message                                 the message
    * @param  array   $extra                                   the extra data to attach
    * @param  integer $status                                  the response status
    * @return Illuminate\Http\JsonResponse
    * @author goper
    */
    public function erroneous($message, $extra = [], $status = 422)
    {
        return $this->jsonify(false, array_merge([
            'message' => $message
        ], $extra), $status);
    }

    /**
     * Get passport client credentials
     *
     * @return array
     */
    public function passportClientCredentials()
    {
        return DB::table('oauth_clients')->where('password_client', 1)->first();
    }
}
