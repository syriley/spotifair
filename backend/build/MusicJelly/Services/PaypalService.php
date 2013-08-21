<?php

namespace MusicJelly\Services;

use Symfony\Component\HttpFoundation\Request;

class PaypalService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->post('/payment-received', array($this, 'paymentReceived'));

    }
    
    public function paymentReceived(Request $request){
        $this->debug('paymentReceived');
        $req = 'cmd=_notify-validate';

        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }

        $this->debug('req is:'.$req);

        // post back to PayPal system to validate
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

        // assign posted variables to local variables
        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];

        $this->debug($receiver_email);

        if (!$fp) {
            // HTTP ERROR
        } else {
            fputs ($fp, $header . $req);
            while (!feof($fp)) {
                $res = fgets ($fp, 1024);
                if (strcmp ($res, "VERIFIED") == 0) {
                    $this->debug('verified');
                    $this->unlockPaypal($payer_email);
                }
                else if (strcmp ($res, "INVALID") == 0) {
                // log for manual investigation
                }
            }
            fclose ($fp);
        }
    }

    public function unlockPaypal($email){
        $userRepository = $this->entityManager->getRepository('MusicJelly\Entities\User');
        $user = $userRepository->getByEmail($email);
        
        $user = $userRepository->unlock($user->id, 'paypal');

        return $this->app->json($user->toDto());
    }

}
