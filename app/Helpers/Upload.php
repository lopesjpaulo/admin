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

if(!function_exists('upload_file')){
    function upload_file($request, $dir)
    {
        if(valid_file($request))
        {
            $extension = $request->file->extension();
            $title = set_filename_random();
            $nameFile = "{$title}.{$extension}";

            $upload = $request->file->storeAs($dir, $nameFile);

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
            return ($request->hasFile('file') && $request->file('file')->isValid());
        }
    }
}