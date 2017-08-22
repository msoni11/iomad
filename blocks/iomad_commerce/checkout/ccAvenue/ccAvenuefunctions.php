<?php
/**
 * Created by PhpStorm.
 * User: SUNIL
 * Date: 11-07-2017
 * Time: 12:50
 */

class ccAvenuePayment {

    private $working_key;
    private $merchant_id;
    private $amount;
    private $order_id;
    private $url;
    private $cancel_url;
    private $billing_name;
    private $billing_address;
    private $billing_country;
    private $billing_state;
    private $billing_city;
    private $billing_zip;
    private $billing_tel;
    private $billing_email;
    private $delivery_name;
    private $delivery_address;
    private $delivery_country;
    private $delivery_state;
    private $delivery_city;
    private $delivery_zip;
    private $delivery_tel;
    private $billing_notes;

    public function __construct( $merchant_id, $working_key)
    {
        $this->merchant_id = $merchant_id;
        $this->working_key = $working_key;
        $this->url = ccAvenue_responseurl();
        $this->cancel_url = ccAvenue_cancelurl();
    }

    public function getWorkingKey() {
        return $this->working_key;
    }

    public function getMerchantId() {
        return $this->merchant_id;
    }

    public function setWorkingKey( $working_key ) {
        $this->working_key = $working_key;
    }

    public function setMerchantId( $merchant_id ) {
        $this->merchant_id = $merchant_id;
    }

    public function setAmount( $amount ) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setOrderId( $order_id ) {
        $this->order_id = $order_id;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function setRedirectUrl( $url ) {
        $this->url = $url;
    }

    public function getRedirectUrl() {
        return $this->url;
    }

    public function setCancelUrl( $url ) {
        $this->cancel_url = $url;
    }

    public function getCancelUrl() {
        return $this->cancel_url;
    }

    public function setBillingName( $billing_name ) {
        $this->billing_name = $billing_name;
    }

    public function getBillingName() {
        return $this->billing_name;
    }

    public function setBillingAddress( $billing_address ) {
        $this->billing_address = $billing_address;
    }

    public function getBillingAddress() {
        return $this->billing_address;
    }

    public function setBillingCountry( $billing_country ) {
        $this->billing_country = $billing_country;
    }

    public function getBillingCountry() {
        return $this->billing_country;
    }

    public function setBillingState( $billing_state ) {
        $this->billing_state = $billing_state;
    }

    public function getBillingState() {
        return $this->billing_state;
    }

    public function setBillingCity( $billing_city ) {
        $this->billing_city = $billing_city;
    }

    public function getBillingCity() {
        return $this->billing_city;
    }

    public function setBillingZip( $billing_zip ) {
        $this->billing_zip = $billing_zip;
    }

    public function getBillingZip() {
        return $this->billing_zip;
    }

    public function setBillingTel( $billing_tel ) {
        $this->billing_tel = $billing_tel;
    }

    public function getBillingTel() {
        return $this->billing_tel;
    }

    public function setBillingEmail( $billing_email ) {
        $this->billing_email = $billing_email;
    }

    public function getBillingEmail() {
        return $this->billing_email;
    }

    public function setDeliveryName( $delivery_name ) {
        $this->delivery_name = $delivery_name;
    }

    public function getDeliveryName() {
        return $this->delivery_name;
    }

    public function setDeliveryAddress( $delivery_address ) {
        $this->delivery_address = $delivery_address;
    }

    public function getDeliveryAddress() {
        return $this->delivery_address;
    }

    public function setDeliveryCountry( $delivery_country ) {
        $this->delivery_country = $delivery_country;
    }

    public function getDeliveryCountry() {
        return $this->delivery_country;
    }

    public function setDeliveryState( $delivery_state ) {
        $this->delivery_state = $delivery_state;
    }

    public function getDeliveryState() {
        return $this->delivery_state;
    }

    public function setDeliveryCity( $delivery_city ) {
        $this->delivery_city = $delivery_city;
    }

    public function getDeliveryCity() {
        return $this->delivery_city;
    }

    public function setDeliveryZip( $delivery_zip ) {
        $this->delivery_zip = $delivery_zip;
    }

    public function getDeliveryZip() {
        return $this->delivery_zip;
    }

    public function setDeliveryTel( $delivery_tel ) {
        $this->delivery_tel = $delivery_tel;
    }

    public function getDeliveryTel() {
        return $this->delivery_tel;
    }

    public function setBillingNotes( $billing_notes ) {
        $this->billing_notes = $billing_notes;
    }

    public function getBillingNotes() {
        return $this->billing_notes;
    }

    public function billingSameAsShipping() {
        $this->delivery_name = $this->billing_name;
        $this->delivery_address = $this->billing_address;
        $this->delivery_country = $this->billing_country;
        $this->delivery_state = $this->billing_state;
        $this->delivery_city = $this->billing_city;
        $this->delivery_zip = $this->billing_zip;
        $this->delivery_tel = $this->billing_tel;
    }

    private function getMerchantData() {
        $merchant_data= 'merchant_id='.urlencode($this->getMerchantId());
        $merchant_data .= '&amount='.urlencode($this->getAmount());
        $merchant_data .= '&order_id='.urlencode($this->getOrderId());
        $merchant_data .= '&redirect_url='.urlencode($this->getRedirectUrl());
        $merchant_data .= '&currency='.urlencode('INR');
        $merchant_data .= '&language='.urlencode('en');
        $merchant_data .= '&cancel_url='.urlencode($this->getCancelUrl());
        $merchant_data .= '&billing_name='.urlencode($this->getBillingName());
        $merchant_data .= '&billing_address='.urlencode($this->getBillingAddress());
        $merchant_data .= '&billing_country='.urlencode($this->getBillingCountry());
        $merchant_data .= '&billing_state='.urlencode($this->getBillingState());
        $merchant_data .= '&billing_city='.urlencode($this->getBillingCity());
        $merchant_data .= '&billing_zip='.urlencode($this->getBillingZip());
        $merchant_data .= '&billing_tel='.urlencode($this->getBillingTel());
        $merchant_data .= '&billing_email='.urlencode($this->getBillingEmail());
        $merchant_data .= '&delivery_name='.urlencode($this->getDeliveryName());
        $merchant_data .= '&delivery_address='.urlencode($this->getDeliveryAddress());
        $merchant_data .= '&delivery_country='.urlencode($this->getDeliveryCountry());
        $merchant_data .= '&delivery_state='.urlencode($this->getDeliveryState());
        $merchant_data .= '&delivery_city='.urlencode($this->getDeliveryCity());
        $merchant_data .= '&delivery_zip='.urlencode($this->getDeliveryZip());
        $merchant_data .= '&delivery_tel='.urlencode($this->getDeliveryTel());
        $merchant_data .= '&merchant_param1='.urlencode($this->getBillingNotes());

        return $merchant_data;
    }

    public function getEncryptedData() {
        $utils = new ccAvenueUtils( $this );
        $merchant_data = $this->getMerchantData();
        return $utils->encrypt($merchant_data,$this->getWorkingKey());
    }

    public function response( $response ) {
        global $DB;
        $utils = new ccAvenueUtils( $this );
        $resonse_data = $utils->decrypt( $response, $this->getWorkingKey() );
        //$payment_data = explode('&', $resonse_data);
        $data_size = sizeof(explode('&', $resonse_data));

        $auth_desc = null;
//        for($i = 0; $i < $data_size; $i++)
//        {
//            $information = explode('=',$payment_data[$i]);
//            if($i == 3) {
//                $auth_desc = $information[1];
//            }
//        }

        $payment_data = deformatnvp($resonse_data);
        $auth_desc = strtoupper($payment_data['order_status']);

        $basket = new stdClass;
        $basket->id = get_basket_id();
        $html = "</center>";

        if($auth_desc==="SUCCESS")
        {
            //Here you need to put in the routines for a successful
            //transaction such as sending an email to customer,
            //setting database status, informing logistics etc etc

            setprop($basket, 'pp_ack',             'order_status',     $payment_data);
            setprop($basket, 'pp_transactionid',   'tracking_id',      $payment_data);
            setprop($basket, 'pp_transactiontype', 'payment_mode',     $payment_data);
            setprop($basket, 'pp_paymenttype',     'card_name',        $payment_data);
            setprop($basket, 'pp_ordertime',       'trans_date',       $payment_data);
            setprop($basket, 'pp_currencycode',    'currency',         $payment_data);
            setprop($basket, 'pp_amount',          'amount',           $payment_data);
            setprop($basket, 'pp_paymentstatus',   'status_message',   $payment_data);
            setprop($basket, 'pp_pendingreason',   'failure_message',  $payment_data);
            setprop($basket, 'pp_reason',          'status_code',      $payment_data);

            $basket->status = INVOICESTATUS_PAID;
            $DB->update_record('invoice', $basket);
            return '';
        }
        else if($auth_desc==="ABORTED")
        {
            //Here you need to put in the routines/e-mail for a  "Batch Processing" order
            //This is only if payment for this transaction has been made by an American Express Card
            //since American Express authorisation status is available only after 5-6 hours by mail from ccavenue and at the "View Pending Orders"

            $html .= "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
            $basket->status = INVOICESTATUS_UNPAID;
        }
        else if($auth_desc==="FAILURE")
        {
            //Here you need to put in the routines for a failed
            //transaction such as sending an email to customer
            //setting database status etc etc

            $html .= "<br>Thank you for shopping with us.However,the transaction has been declined.";
            $basket->status = INVOICESTATUS_UNPAID;
        }
        else
        {
            //Here you need to simply ignore this and dont need
            //to perform any operation in this condition

            $html .= "<br>Security Error. Illegal access detected";
            $basket->status = INVOICESTATUS_UNPAID;
        }
        $DB->update_record('invoice', $basket);
        $html .= "<br><br>";

        $html .= "<table cellspacing=4 cellpadding=4>";
        for($i = 0; $i < $data_size; $i++) {
            $information = explode('=',$payment_data[$i]);
            $html .= '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
        }

        $html .= "</table><br>";
        $html .= "</center>";
        return $html;

    }

}


class ccAvenueUtils {

    private $payment;

    public function __construct(ccAvenuePayment $payment)
    {
        $this->payment = $payment;
    }

    public function encrypt($plainText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = $this->pkcs5_pad($plainText, $blockSize);

        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1)
        {
            $encryptedText = mcrypt_generic($openMode, $plainPad);
            mcrypt_generic_deinit($openMode);
        }

        return bin2hex($encryptedText);
    }

    public function decrypt($encryptedText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText=$this->hextobin($encryptedText);

        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');

        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);

        $decryptedText = rtrim($decryptedText, "\0");

        mcrypt_generic_deinit($openMode);

        return $decryptedText;

    }
    //*********** Padding Function *********************

    private function pkcs5_pad ($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    private function hextobin($hexString)
    {
        $length = strlen($hexString);
        $binString="";
        $count=0;
        while($count<$length)
        {
            $subString =substr($hexString,$count,2);
            $packedString = pack("H*",$subString);
            if ($count==0)
            {
                $binString=$packedString;
            }

            else
            {
                $binString.=$packedString;
            }

            $count+=2;
        }
        return $binString;
    }

}


function setprop($basket, $propname, $arrayindex, $array, $default = null) {
    if (array_key_exists($arrayindex, $array)) {
        $basket->$propname = $array[$arrayindex];
    } else if ($default) {
        $basket->$propname = $default;
    }
}

/*
* This function will take NVPString and convert it to an Associative Array and it will decode the response.
* It is usefull to search for a particular key and displaying arrays.
* @nvpstr is NVPString.
* @nvparray is Associative Array.
*/
function deformatnvp($nvpstr) {
    $intial = 0;
    $nvparray = array();

    while (strlen($nvpstr)) {
        // Postion of Key.
        $keypos = strpos($nvpstr, '=');
        // Position of value.
        $valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&'): strlen($nvpstr);

        /* Getting the Key and Value values and storing in a Associative Array. */
        $keyval = substr($nvpstr, $intial, $keypos);
        $valval = substr($nvpstr, $keypos + 1, $valuepos-$keypos - 1);
        // Decoding the respose.
        $nvparray[urldecode($keyval)] = urldecode($valval);
        $nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
    }
    return $nvparray;
}
