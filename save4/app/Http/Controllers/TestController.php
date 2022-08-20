<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceSell;
use File;
use Illuminate\Http\Request;
use Mail;

class TestController extends Controller
{
    public function index()
    {
        return view('test.csv');
    }

    public function upload_csv_records(Request $request)
    {

        // Big file upload
        // fileUpload($request->csv,'marketplace/csv/email');

        // CSV Spliter

        $country_code = 'usa'; // country code
        $amount = 20000; // email amount
        $csv_file = marketplace_email_csv_path(); // csv file path

        $generated_name = $country_code.'-emails-'.rand(1000, 10000);
        $outputFile = base_path('public/output/').$generated_name; // csv file name
        $splitSize = $amount + 1; // query amount records in a one file
        $in = fopen($csv_file, 'r'); // csv file directory

        $rows = 0;
        $fileCount = 0;
        $out = null;

        while (! feof($in)) {
            if (($rows % $splitSize) == 0) {
                if ($rows > 0) {
                    fclose($out);
                }

                $fileCount++;

                $fileCounterDisplay = sprintf('%04d', $fileCount); // for filenames like indiacountry-part-0001.csv, indiacountry-part-0002.csv etc

                $fileName = "$outputFile$fileCounterDisplay.csv"; // file name

                $out = fopen($fileName, 'w');

                // skip other empty csv files
                if ($fileCounterDisplay != '0001') {
                    FIle::delete($fileName);
                }
            }

            $data = fgetcsv($in);

            if ($rows < $splitSize) {
                fputcsv($out, $data); // update csv file
            }

            $rows++;
        }

        fclose($out);

        $file_url = $outputFile.'0001.csv'; // csv file name

        // Store to database
        $marketplace = new MarketplaceSell;
        $marketplace->name = 'Mohammad Prince';
        $marketplace->email = 'mprince2k16@gmail.com';
        $marketplace->email_amount = $amount; // email amount
        $marketplace->sms_amount = null;
        $marketplace->country = $country_code;
        $marketplace->price = 1000;
        $marketplace->type = 'email';
        $marketplace->status = 'paid';
        $marketplace->file_path = $file_url;
        $marketplace->save();

        //sending email with attachment
        $data['email'] = $marketplace->email;
        $data['title'] = 'CSV Attachment';

        Mail::send('marketplace.csv_mail_file', ['data' => $data], function ($message) use ($data, $file_url) {
            $message->to($data['email'], $data['email'])
                    ->subject($data['title']);

            $message->attach($file_url);
        });

        return back();
    }
}
