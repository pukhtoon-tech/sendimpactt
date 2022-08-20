<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SmtpServer;

class SmtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $gmail = new SmtpServer;
        $gmail->mail_name     = 'gmail';
        $gmail->mail_mailer     = null;
        $gmail->mail_host       = null;
        $gmail->mail_port       = null;
        $gmail->mail_username       = null;
        $gmail->mail_password       = null;
        $gmail->mail_encryption      = null;
        $gmail->mail_from_address       = null;
        $gmail->mail_from_name      = null;
        $gmail->save();

        $yahoo = new SmtpServer;
        $yahoo->mail_name     = 'yahoo';
        $yahoo->mail_mailer     = null;
        $yahoo->mail_host       = null;
        $yahoo->mail_port       = null;
        $yahoo->mail_username       = null;
        $yahoo->mail_password       = null;
        $yahoo->mail_encryption      = null;
        $yahoo->mail_from_address       = null;
        $yahoo->mail_from_name      = null;
        $yahoo->save();

        $webmail = new SmtpServer;
        $webmail->mail_name     = 'webmail';
        $webmail->mail_mailer     = null;
        $webmail->mail_host       = null;
        $webmail->mail_port       = null;
        $webmail->mail_username       = null;
        $webmail->mail_password       = null;
        $webmail->mail_encryption      = null;
        $webmail->mail_from_address       = null;
        $webmail->mail_from_name      = null;
        $webmail->save();

        $mailgun = new SmtpServer;
        $mailgun->mail_name     = 'mailgun';
        $mailgun->mail_mailer     = null;
        $mailgun->mail_host       = null;
        $mailgun->mail_port       = null;
        $mailgun->mail_username       = null;
        $mailgun->mail_password       = null;
        $mailgun->mail_encryption      = null;
        $mailgun->mail_from_address       = null;
        $mailgun->mail_from_name      = null;
        $mailgun->save();

        $zoho = new SmtpServer;
        $zoho->mail_name     = 'zoho';
        $zoho->mail_mailer     = null;
        $zoho->mail_host       = null;
        $zoho->mail_port       = null;
        $zoho->mail_username       = null;
        $zoho->mail_password       = null;
        $zoho->mail_encryption      = null;
        $zoho->mail_from_address       = null;
        $zoho->mail_from_name      = null;
        $zoho->save();

        $elastic = new SmtpServer;
        $elastic->mail_name     = 'elastic';
        $elastic->mail_mailer     = null;
        $elastic->mail_host       = null;
        $elastic->mail_port       = null;
        $elastic->mail_username       = null;
        $elastic->mail_password       = null;
        $elastic->mail_encryption      = null;
        $elastic->mail_from_address       = null;
        $elastic->mail_from_name      = null;
        $elastic->save();

        //END
    }
}
