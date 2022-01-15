<?php

// namespace App\Repository;
namespace App\Services;
use DB;

class FileService{

    public static function fileAttachments($folder = ''){
        $files = request()->file('attachment');
        $file_path = [];
        // return $files;
        if(request()->has('attachment') && $files)
        {
            foreach($files as $image)
            {
                $filename = $image->getClientOriginalName();
                // $ext = $image->getClientOriginalExtension();


                if(\Storage::disk('local')->exists('public/'.$folder.'/'.$filename)){
                    \Storage::delete('public/'.$folder.'/'.$filename);
                    $path = $image->storeAs('public/'.$folder, $filename);

                    // $file_path[] = ['pdf_loc' => $path, 'empID_' => pathinfo($filename, PATHINFO_FILENAME)];
                }else{
                    $path = $image->storeAs('public/'.$folder, $filename);
                    $file_path[] = ['pdf_loc' => $path, 'empID_' => pathinfo($filename, PATHINFO_FILENAME)];
                }
            }
        }
        return $file_path;

    // 	if(request('file') != 'null' ){
	//         $avatar_path = request()->file('file')->store('public/'.$folder);
	//      }
    //    return $avatar_path;
    }



    public static function saveAttachment($name, $path = ''){
        $files = request()->file($name);
        $file_path = [];
        // return $files;

        if(request()->hasFile($name) && $files)
        {
            // \File::deleteDirectory('storage/app/public/'.$path);
            foreach($files as $image)
            {

                // use laravel random name
                // $path = $image->store('public/'.$path);

                // define filename
                // $filename = $image->getClientOriginalName();
                // if(\Storage::disk('local')->exists('public/'.$path.'/'.$filename)){
                //     \Storage::delete('public/'.$path.'/'.$filename);
                //     $path = $image->storeAs('public/'.$path, $filename);
                // }else{
                //     $path = $image->storeAs('public/'.$path, $filename);

                // }

                $path = $image->store('public/'.$path);
                $file_path[] = $path;

            }
        }
        return $file_path;
    }

    public static function moveAttachment($files){
        
        // return $files;
        $file_path = [];
        if($files)
        {
            
            foreach($files as $image)
            {
                \File::deleteDirectory('storage/app/public/'.$path);
                $path = $image->store('public/'.$path);
                $file_path[] = $path;

            }
        }
        return $file_path;
    }



}
