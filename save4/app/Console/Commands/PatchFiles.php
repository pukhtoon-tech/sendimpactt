<?php

namespace App\Console\Commands;

use App\Models\Patch;
use File;
use Illuminate\Console\Command;
use Str;
use ZipArchive;

class PatchFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patch:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push modified files to patchs folder and make it zip';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command..
     *
     * @return int
     */
    public function handle()
    {
        echo "(  _ \(  _ \(_  _)( \( ) / __)( ___)\n";
        echo " )___/ )   / _)(_  )  ( ( (__  )__) \n";
        echo "(__)  (_)\_)(____)(_)\_) \___)(____)\n";

        echo "\e[1;33mHi I am Prince. This your patch update program v1.0.2 thanks \n";
        echo "\e[1;32mstarting patching files...\n";

        if (maildoll_config('patch') == true) { // if patch is true

            $str_path = base_path(); // get the path of the current directory

            echo "\e[1;32mthis is your base path $str_path \n";

            // get the list of files in the current directory
            $cls_rii = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($str_path),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            $ary_files = []; // create an array to store the files

            foreach ($cls_rii as $str_fullfilename => $cls_spl) {
                if ($cls_spl->isFile()) {
                    $ary_files[] = $str_fullfilename;
                }
            }

            echo "\e[1;32mcombining files... \n";

            // ary_files is an array of all the files in the directory
            $ary_files = array_combine(
                $ary_files,
                array_map('filemtime', $ary_files) // get the file modification time
            );

            arsort($ary_files); // sort by date, newest first

            // get $ary_files after date time of maildoll_config(last_patch_at)

            $last_patch_at = maildoll_config('last_patch_at');

            echo "\e[1;32mlast patch time was $last_patch_at \n";

            $patch_strtotime = strtotime($last_patch_at);
            $patch_date = date('D/M/Y H:i:s', $patch_strtotime);

            echo "\e[1;32mfiltering patch time \n";

            // show only files after $patch_date
            $ary_files = array_filter(
                $ary_files,
                function ($value) use ($patch_strtotime) {
                    return $value > $patch_strtotime; // if the file modification time is greater than $patch_strtotime
                }
            );

            echo "\e[1;32mobserving the latest files... \n";

            $str_latest_file = key($ary_files); // str_latest_file

            $main_file_path = str_replace($str_path, '', $str_latest_file); // main_file_path

            $file_name = basename($main_file_path); // file_name

            $modified_date = date('Y-m-d H:i:s', $ary_files[$str_latest_file]); // modified_date

            $only_path = dirname(str_replace($str_path, '', $str_latest_file)); // only_path

            $renamed_path = substr(str_replace('\\', '%', dirname(str_replace($str_path, '', $str_latest_file))), 1); // renamed_path

            echo "\e[1;32mrenaming the path into $renamed_path \n";

            // copy modified file to patchs folder
            $new_file_path = 'patchs/'; // new_file_path

            $file_from = substr($main_file_path, 1); // file from

            $file_to = $new_file_path.$renamed_path.'\\'.$file_name; //  file to

            echo "\e[1;32mskipping unnecessary folders... \n";

            $check_file_contains = Str::contains($file_from, [
                '.git',
                '.env',
                '.env.example',
                '.env_prodcution',
                '.idea',
                '.htaccess',
                'artisan',
                '.styleci.yml',
                '.editorconfig',
                '.gitignore',
                '.gitattributes',
                '.gitmodules',
                '.composer.json',
                '.composer.lock',
                'env.txt',
                'index.php',
                'package-lock.json',
                'package.json',
                'phpunit.xml',
                'README.md',
                'server.php',
                'tailwind.config.js',
                'webpack.mix.js',
                'storage',
                'patchs',
            ]); // check_file_contains

            if ($check_file_contains == false) {
                $check_patch = Patch::where('file_from', $file_from)->first();

                if ($check_patch) {
                    $check_patch->delete();
                }

                $patch_store = new Patch;
                $patch_store->file_from = $file_from;
                $patch_store->file_to = $file_to;
                $patch_store->modified_date = $modified_date;
                $patch_store->renamed_path = $renamed_path;
                $patch_store->save();

                echo "\e[1;32msaving to database.. \n";
            }

            // Get all patchs
            $patchs = Patch::get();

            $base_domain = base_path().'/'; // base_domain

            echo "\e[1;32mextracting folders... \n";

            foreach ($patchs as $patch) {

                // create folder if not exists
                if (! File::exists($base_domain.$new_file_path.$patch->renamed_path)) {
                    File::makeDirectory($base_domain.$new_file_path.$patch->renamed_path, 0777, true); // create folder
                }

                $exact_file_name = basename($patch->file_from); // exact_file_name

                // copy file
                copy($base_domain.$patch->file_from, $base_domain.$patch->file_to);

                // create zip
                $zip = new ZipArchive();
                $zip_name = $patch->renamed_path;
                $zip_path = base_path('patchs/');
                $zip_file = $zip_path.$zip_name.'.zip';
                if ($zip->open($zip_file, ZipArchive::CREATE) === true) {
                    $zip->addFile($patch->file_to, $exact_file_name); // copy file dir, rename file name
                    $zip->close();
                } else {
                    return false;
                }

                // delete folder
                File::deleteDirectory($base_domain.$new_file_path.$patch->renamed_path);
                echo "\e[1;32m✓\e[0m "."\e[1;36m".$patch->file_from." \e[1;93m⟶\e[0m  "."\e[1;35m".$patch->file_to.PHP_EOL;
            }

            echo "\e[1;32mupdating database.. \n";

            echo "\e[1;32mDONE.. \n";
        } else { // if patch is false
            echo 'Patch is disabled';
        }
    }
}
