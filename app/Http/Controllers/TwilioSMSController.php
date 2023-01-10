<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use App\ModelsPhoneNumber;
use Twilio\TwiML\MessagingResponse;

{
    class TwilioSMSController extends Controller
    {
        /**
         * Write code on Method
         *
         * @return response()
         */
        public function index()
        {
            $receiverNumber = "18313341553";
            $message = "All About Laravel";

            try {

                $account_sid = getenv("TWILIO_SMS_SERVICE_SID");
                $auth_token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_number = getenv("TWILIO_FROM");
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($receiverNumber, [
                    'from' => $twilio_number,
                    'body' => $message]);

                dd('SMS Sent Successfully.');

            } catch (Exception $e) {
                dd("Error: " . $e->getMessage());
            }
        }

        public function import()
        {
            Excel::import(new PhoneNumberImport, 'users.xlsx');

            return redirect('/')->with('success', 'All good!');
        }

        public function receive_messages()
        {
            /**
             *
             * receive messages
             */


            $response = new MessagingResponse();
            $response->message("The Robots are coming! Head for the hills!");
            print $response;

/*            $request = request();
            $from = $request->input('From');
            $body = $request->input('Body');

            dd($from . ":" . $body);*/

        }
        public function send_mass_sms(){
            $sid = config('services.twilio.sid');
            $token = config('services.twilio.token');
            $twilioNumber = config('services.twilio.number');

            $client = new Client($sid, $token);

            $number = '+15555555555';

            $phoneNumber = PhoneNumber::firstOrCreate(['number' => $number]);

            try {
                $message = $client->messages->create(
                    $number,
                    array(
                        'from' => $twilioNumber,
                        'body' => 'Hello from Laravel!'
                    )
                );
                $phoneNumber->success = true;
                $phoneNumber->sent_at = now();
            } catch (Exception $e) {
                $phoneNumber->success = false;
                $phoneNumber->sent_at = now();
            }

            $phoneNumber->save();

        }
    }
}
