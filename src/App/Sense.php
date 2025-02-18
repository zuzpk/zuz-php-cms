<?php

namespace App;

use \Zuz\Config;
use \Zuz\Core;
use \Zuz\User;
use \Zuz\DB;
use \Zuz\Email;

class Sense
{

    public static function createPayment($uid = 0, $type = 'unknown', $trx = '0@@unknown')
    {
        if ($uid == 0 || $type == 'unknown')
            return 0;
        $save = DB::INSERT(
            "INSERT INTO payments (uid,type,transaction,detail,stamp,pdate) VALUES (?,?,?,?,?,?)",
            array($uid, $type, $trx, 'none', time(), date(Config::DATE_FORMAT))
        );
        if ($save->saved) {
            return $save->ID;
        }
        return 0;
    }

    public static function Checkout()
    {

        $you = User::Session();
        $post = Core::withPost();

        $uid = Core::fromHash($you->id);
        $ids = explode(',', $post->ids);
        $pmt = $post->pmt;

        $appids = array();
        foreach ($ids as $id):
            $id = Core::fromHash($id);
            array_push($appids, $id);
        endforeach;

        $get = DB::SELECT("SELECT * FROM apps WHERE ID IN (" . implode(',', $appids) . ") AND status=?", array(1));
        $price = 0;
        $labels = "";
        for ($n = 0; $n < count($get->fetch); $n++):
            $app = $get->fetch[$n];
            $price += $app->price;
            if ($labels != "") {
                $labels .= "\n";
            }
            $labels .= stripslashes($app->title);
        endfor;

        $trx = self::createPayment(
            $uid,
            $pmt,
            implode(',', $appids) . Config::SEPERATOR . $price . Config::SEPERATOR . $pmt
        );

        if ($trx <= 0) {
            Core::Respond(array(
                'error' => true,
                'message' => 'We are unable to process your request.'
            ));
        }


        $trxid = Core::Encode($uid . Config::SEPERATOR . $trx);

        if ($pmt == 'cc') {
            $stripe = new \Stripe\StripeClient([
                'api_key' => Core::GetCog('stripe_secret_key', 'none'),
                'stripe_version' => '2022-11-15'
            ]);
            $intent = $stripe->checkout->sessions->create([
                'success_url' => Config::BASEURL . 'cart/processed?with=cc',
                'cancel_url' => Config::BASEURL . 'cart?with=cc',
                'line_items' => [
                    [
                        'price_data' => [
                            'unit_amount' => $price * 100,
                            'currency' => Config::CURRENCY_CODE,
                            'product_data' => [
                                'name' => Config::APP_NAME . ' Pro (' . $labels . ')'
                            ]
                        ],
                        'quantity' => 1
                    ]
                ],
                'metadata' => [
                    'order_id' => $trx,
                    'wx' => null,
                    'token' => null,
                    'vu' => null,
                    'ru' => null
                ],
                'payment_intent_data' => [
                    'metadata' => [
                        'trxid' => $trxid,
                        'wx' => null,
                        'token' => null,
                        'vu' => null,
                        'ru' => null
                    ]
                ],
                'mode' => 'payment'
            ]);
            $next = $intent->url;
        } else if ($pmt == 'pp') {
            $trxid = Core::Encode($uid . Config::SEPERATOR . $trx);
            $sandbox = Config::PAYPAL_MODE == 'sandbox' ? 'sandbox.' : '';
            $next = '<form action="https://www.' . $sandbox . 'paypal.com/cgi-bin/webscr" method="post" name="_xclick" id="go_with_paypal">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="lc" value="AU">
    		<input type="hidden" name="bn" value="PP-BuyNowBF">                        
			<input type="hidden" name="business" value="' . Config::PAYPAL_BUSINESS . '">
			<input type="hidden" name="item_name" value="' . $labels . '">
			<input type="hidden" name="item_number" value="' . count($ids) . '">
			<input type="hidden" name="custom" value="' . $trxid . '">
			<input type="hidden" name="amount" value="' . $price . '">
			<input type="hidden" name="return" value="' . Config::BASEURL . 'cart/processed?with=pp">
			<input type="hidden" name="cancel_return" value="' . Config::BASEURL . 'cart?with=pp">
			<input type="hidden" name="notify_url" value="' . Config::BASEURL . 'with/app/sense/process_paypal">
			<input type="hidden" name="no_shipping" value="1">
            <input type="hidden" name="currency_code" value="' . Config::CURRENCY_CODE . '">
            <input type="hidden" name="handling" value="0"></form>';
        }

        Core::Respond(array(
            'kind' => 'pps',
            'next' => $next
        ));

    }

    public static function ProcessPaypal()
    {

        $post = Core::withPost();

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval):
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2) {
                $myPost[$keyval[0]] = urldecode($keyval[1]);
            }
        endforeach;

        $get_magic_quotes_exists = false;
        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value):
            if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        endforeach;

        error_log('req => ' . $req);

        $sandbox = Config::PAYPAL_MODE == 'sandbox' ? 'sandbox.' : '';
        $ch = curl_init('https://www.' . $sandbox . 'paypal.com/cgi-bin/webscr?cmd=_notify-validate');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_3);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: PHP-IPN-Verification-Script',
            'Connection: Close',
        ));

        if (!($res = curl_exec($ch))) {
            curl_close($ch);
            exit;
        }
        curl_close($ch);

        // inspect IPN validation result and act accordingly
        if (strcmp($res, "VERIFIED") == 0 && strtolower($_POST["payment_status"]) == "completed") {

            // The IPN is verified, process it

            try {
                @list($uid, $trxid) = explode("@@", Core::Decode($_POST['custom']));

                $details = array(
                    'mc_gross' => $_POST['mc_gross'],
                    'mc_fee' => $_POST['mc_fee'],
                    'payer_email' => $_POST['payer_email'],
                    'txn_id' => $_POST['txn_id'],
                    'mc_currency' => $_POST['mc_currency'],
                    'ipn_track_id' => $_POST['ipn_track_id']
                );
                $detail = implode(Config::SEPERATOR, $details);

                $save = DB::UPDATE(
                    "UPDATE payments SET detail=?, pdate=?, step=? WHERE ID=? AND uid=? AND step=? LIMIT 1",
                    array($detail, date(Config::DATE_FORMAT), 'done', $trxid, $uid, 'pending')
                );

                if ($save->updated) {

                    $td = DB::SELECT("SELECT transaction FROM payments WHERE ID=?", array($trxid), "i")->row->transaction;
                    @list($ids, $amt) = explode(Config::SEPERATOR, $td);

                    //Add items to user
                    $ids = explode(",", $ids);
                    foreach ($ids as $id):
                        DB::INSERT(
                            "INSERT INTO myapps (uid,aid,trxid) VALUES (?,?,?)",
                            array($uid, $id, $trxid),
                            "iii"
                        );
                    endforeach;

                }
            } catch (Exception $e) {
                // IPN invalid, log for manual investigation
                @file_put_contents(Router::getBase() . 'temp.txt', 'WithTryFailed: ' . $e);
            }
        } else if (strcmp($res, "INVALID") == 0) {
            // IPN invalid, log for manual investigation
            @file_put_contents(Router::getBase() . 'temp.txt', 'WithFailed: ' . $res);
        }

        header("HTTP/1.1 200 OK");

    }

    public static function ProcessStripe()
    {
        header("Content-Type: application/json");
        $input = file_get_contents('php://input');
        $body = json_decode($input);
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $input,
                $_SERVER['HTTP_STRIPE_SIGNATURE'],
                Core::GetCog('stripe_webhook_secret', 'none')
            );
        } catch (Exception $e) {
            error_log(json_encode($_SERVER));
            error_log($e->getMessage());
            http_response_code(403);
            echo Core::JSON(array(
                'error' => $e->getMessage()
            ));
            exit;
        }

        if ($event->type == 'payment_intent.succeeded') {
            $data = $event->data->object;
            $paidPrice = $data->amount_received / 100;
            @list($uid, $trxid, $wgtrx) = explode(Config::SEPERATOR, Core::Decode($data->metadata->trxid));

            // if($data->metadata->wx != 'none' && $data->metadata->token != 'none'){
            //     // error_log(json_encode($data));
            //     //We got kpay request
            //     $rept = CURL_POST(
            //         decode( $data->metadata->ru ),
            //         array(
            //             'id' => $data->id,
            //             'wx' => $data->metadata->wx,
            //             'token' => $data->metadata->token,
            //         ),
            //         true
            //     );
            //     $trxid = $wgtrx;

            //     $get = DB::SELECT("SELECT * FROM payments WHERE ID=? AND uid=? AND step=?", array($trxid, $uid, 'pending'), "iis");
            //     if($get->hasRows){
            //         @list($mode, $plan, $amount) = explode( SEPERATOR , $get->row->transaction );
            //         @list($uplan, $uexpiry) = explode( SEPERATOR , U::GetInfo( $uid, 'premium' ) );

            //         $plabel = match($plan){
            //             '1' => 'person',
            //             '3' => 'pro',
            //             '6' => 'team',
            //             '12' => 'business'
            //         };

            //         $expiry = $uexpiry > time() ? $uexpiry : time();
            //         $expiry = strtotime( '+1 Months', time() );
            //         // U::Update($uid, array(
            //         //     'premium' => $plabel . SEPERATOR . $expiry . SEPERATOR . $trxid
            //         // ));
            //         DB::UPDATE("UPDATE payments SET detail=?, step=? WHERE ID=? AND uid=?", 
            //         array($data->id . SEPERATOR . $data->amount_received, 'completed', $trxid, $uid), "ssii");
            //     }else{
            //         error_log( 'Get Failed' );
            //     }

            //     echo JSON(array( 'status' => 'success' ));
            //     exit;
            // }
            //HandleKustom END

            $get = DB::SELECT("SELECT * FROM payments WHERE ID=? AND uid=? AND step=?", array($trxid, $uid, 'pending'), "iis");

            if ($get->hasRows) {
                @list($mode, $plan, $amount) = explode(Config::SEPERATOR, $get->row->transaction);
                DB::UPDATE(
                    "UPDATE payments SET detail=?, step=? WHERE ID=? AND uid=?",
                    array($data->id . Config::SEPERATOR . $data->amount_received, 'completed', $trxid, $uid),
                    "ssii"
                );
            } else {
                error_log('Get Failed');
            }
        }

        echo Core::JSON(array('status' => 'success', 'next' => 'same'));

    }

    public static function SubmitFeedback()
    {

        $you = User::Session(false);
        $post = Core::withPost();

        if (!isset($post->name) || empty($post->name) || !isset($post->email) || empty($post->email) || !isset($post->subject) || empty($post->subject) || !isset($post->message) || empty($post->message)) {
            Core::Respond(array(
                'error' => true,
                'reason' => 'InvalidPostData',
                'message' => 'Fill out all fields.'
            ));
        }

        if (!Core::isEmail(trim($post->email))) {
            Core::Respond(array(
                'error' => true,
                'reason' => 'InvalidPostData',
                'message' => 'Enter valid email address.'
            ));
        }

        $message = str_replace(PHP_EOL, "<br />", $post->message);
        $detail = '<div style="margin: 5px 0px;">'
            . '<div style="display: inline-block;font-weight: normal;font-size: 15px;">Name: </div>'
            . '<div style="display: inline-block;font-weight: bold;font-size: 15px;margin-left: 7px;">' . $post->name . '</div>'
            . '</div>';
        $detail .= '<div style="margin: 5px 0px;">'
            . '<div style="display: inline-block;font-weight: normal;font-size: 15px;">Email: </div>'
            . '<div style="display: inline-block;font-weight: bold;font-size: 15px;margin-left: 7px;">' . $post->email . '</div>'
            . '</div>';
        $detail .= '<div style="margin: 5px 0px;">'
            . '<div style="display: inline-block;font-weight: normal;font-size: 15px;">Subject: </div>'
            . '<div style="display: inline-block;font-weight: bold;font-size: 15px;margin-left: 7px;">' . $post->subject . '</div>'
            . '</div>';
        $detail .= '<div style="margin: 5px 0px;">'
            . '<div style="display: inline-block;font-weight: normal;font-size: 15px;vertical-align: top;">Message: </div>'
            . '<div style="display: inline-block;font-weight: bold;font-size: 15px;margin-left: 7px;vertical-align: top;">' . $message . '</div>'
            . '</div>';

        $status = "Guest";
        if ($you->sess) {
            $fname = $you->nm;
            $status = "on " . Config::APP_NAME;
        }

        Email::Send(
            array('mail' => Config::EMAIL_ACCOUNT, 'name' => Config::APP_NAME),
            "Feedback recieved",
            $message
        );

        Core::Respond(array(
            'kind' => 'feedReceived',
            'message' => 'We have received your message and will get back to you asap!'
        ));


    }


}

?>