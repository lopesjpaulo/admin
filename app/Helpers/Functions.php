<?php

/**
 *
 *  General functions
 *
 */

use Carbon\Carbon;

if(!function_exists('set_filename_random'))
{
    function set_filename_random($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if(!function_exists('convertdata_todb'))
{
    function convertdata_todb($data)
    {
        return (Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d'));
    }
}

if(!function_exists('convertdata_tosite'))
{
    function convertdata_tosite($data)
    {
        return (Carbon::parse($data)->format('d/m/Y'));
    }
}