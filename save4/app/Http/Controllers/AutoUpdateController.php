<?php

namespace App\Http\Controllers;

use ZipArchive;

class AutoUpdateController extends Controller
{
    public function index()
    {
        return view('auto_update.index');
    }

    public function lets_update_the_monster()
    {
        if (env('DEMO_MODE') === 'YES') {
            return back()->with('message', 'This is demo purpose only');
        }

        // The process
        // ===========

        // *   I have a directory called patches. Inside that directory I have a bunch of zip files.
        // *   I want to extract them to a directory called `/patchs/extracted`
        // *   I want to clear the cache.
        // *   I want to echo a message.

        // The variables
        // =============

        // *   I have a variable called `$path`
        // *   I have a variable called `$files`
        // *   I have a variable called `$version`
        // *   I have a variable called `$athely`
        // *   I have a variable called `$fileNameWithoutExtension`
        // *   I have a variable called `$replaceUnderScore`
        // *   I have a variable called `$target\_path`
        // *   I have a variable called `$file`
        // *   I have a variable called `$zip`
        // *   I have a variable called `$res`

        // The Patchs
        // =============

        // * The underscore defines the folder directory `resources%views%frontend means` ⇢ `resources/views/frontend`

        try {
            $path = base_path('patchs/'); // path to your patch directory
            $version = file_get_contents(base_path('patchs/.version')); // get the version from the .version file
            $files = scandir($path); // scan the update patch directory

            // check if the patch directory is empty
            if (count($files) <= 2 || $version === env('VERSION')) {
                return back()->with('message', 'Your Application is already up to date');
            }

            $message = '';

            foreach ($files as $athely) {
                if ($athely == '.' || $athely == '..') {
                    continue;
                } // remove . and ..

                $extension = pathinfo($athely, PATHINFO_EXTENSION); // get only zip files

                if ($extension == 'zip') {
                    $fileNameWithoutExtension = preg_replace('/\\.[^.\\s]{3,4}$/', '', $athely); // remove extension
                        $replaceUnderScore = str_replace('%', '/', $fileNameWithoutExtension); // replace underscore with slash

                        $target_path = base_path($replaceUnderScore); // target path to move the file
                        $file = $path.$athely; // path to the file

                        $zip = new ZipArchive; // create a new zip archive object
                        $res = $zip->open($file); // open the zip file

                        if ($res > 0) { // if the zip file is opened successfully
                            $zip->extractTo($target_path); //   extract the zip file to the target path
                            $zip->close(); //   close the zip file
                            $message .= "WOOT! $file extracted to $target_path"; //  echo a message
                        } else {
                            \Artisan::call('optimize:clear'); //   clear the cache
                            $message .= "Doh! I couldn't open $athely"; //   echo a message
                        }
                }
            }

            \Artisan::call('migrate'); // update database columns or values
            overWriteEnvFile('VERSION', $version); // update the version in the env('VERSION') file
            \Artisan::call('optimize:clear'); //   clear the cache

            return back()->with('message', $message); //  echo a message
        } catch (\Throwable $th) {
            return back()->with('message', 'Doh! Something went wrong. Please try again later.'); // echo a message
        }
    }

    //ENDS
}
