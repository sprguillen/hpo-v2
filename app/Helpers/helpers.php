<?php

if (!function_exists('appHelper'))
{
    function appHelper()
    {
        return app('app.aider');
    }
}

if (!function_exists('jsonify'))
{
    function jsonify($success, $data = [])
    {
        return appHelper()->jsonify($success, $data);
    }
}

if (!function_exists('successify'))
{
    function successify($message = '', $extra = [])
    {
        return appHelper()->successify($message, $extra);
    }
}

if (!function_exists('successful'))
{
    function successful($message, $extra = [], $status = 200)
    {
        return appHelper()->successful($message, $extra, $status);
    }
}

if (!function_exists('errorify'))
{
    function errorify($message, $extra = [])
    {
        return appHelper()->errorify($message, $extra);
    }
}

if (!function_exists('erroneous'))
{
    function erroneous($message, $extra = [], $status = 422)
    {
        return appHelper()->erroneous($message, $extra, $status);
    }
}

if (!function_exists('success_data'))
{
    function success_data($message = '', $extra = [], $status = 200)
    {
        return appHelper()->successData($message, $extra, $status);
    }
}

if (!function_exists('passport_client_credentials'))
{
    function passport_client_credentials()
    {
        return appHelper()->passportClientCredentials();
    }
}

if (!function_exists('int_to_code'))
{
    function int_to_code($num)
    {
        return appHelper()->intToCode($num);
    }
}

if (!function_exists('code_to_int'))
{
    function code_to_int($code)
    {
        return appHelper()->codeToInt($code);
    }
}
