<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class Aider
{
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
}
