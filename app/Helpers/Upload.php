<?php

/**
 * Upload helper
 *
 */

if(!function_exists('upload')){
    function upload($request, $dir)
    {
        if(valid_file($request))
        {
            $extension = $request->image->extension();
            $title = set_filename_random();
            $nameFile = "{$title}.{$extension}";

            $upload = $request->image->storeAs($dir, $nameFile);

            if($upload){
                return $nameFile;
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('valid_file'))
{
    function valid_file($request)
    {
        if($request != null)
        {
            return ($request->hasFile('image') && $request->file('image')->isValid());
        }
    }
}