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

    public function __construct( $merchant_id, $working_key, $url )
    {
        $this->merchant_id = $merchant_id;
        $this->working_key = $working_key;
        $this->url = $url;
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

    private function getMerchantData( $checksum ) {
        $merchant_data= 'Merchant_Id='.$this->getMerchantId();
        $merchant_data .= '&Amount='.$this->getAmount();
        $merchant_data .= '&Order_Id='.$this->getOrderId();
        $merchant_data .= '&Redirect_Url='.$this->getRedirectUrl();
        $merchant_data .= '&billing_cust_name='.$this->getBillingName();
        $merchant_data .= '&billing_cust_address='.$this->getBillingAddress();
        $merchant_data .= '&billing_cust_country='.$this->getBillingCountry();
        $merchant_data .= '&billing_cust_state='.$this->getBillingState();
        $merchant_data .= '&billing_cust_city='.$this->getBillingCity();
        $merchant_data .= '&billing_zip_code='.$this->getBillingZip();
        $merchant_data .= '&billing_cust_tel='.$this->getBillingTel();
        $merchant_data .= '&billing_cust_email='.$this->getBillingEmail();
        $merchant_data .= '&delivery_cust_name='.$this->getDeliveryName();
        $merchant_data .= '&delivery_cust_address='.$this->getDeliveryAddress();
        $merchant_data .= '&delivery_cust_country='.$this->getDeliveryCountry();
        $merchant_data .= '&delivery_cust_state='.$this->getDeliveryState();
        $merchant_data .= '&delivery_cust_city='.$this->getDeliveryCity();
        $merchant_data .= '&delivery_zip_code='.$this->getDeliveryZip();
        $merchant_data .= '&delivery_cust_tel='.$this->getDeliveryTel();
        $merchant_data .= '&billing_cust_notes='.$this->getBillingNotes();
        $merchant_data .= '&Checksum='.$checksum  ;

        return $merchant_data;
    }

    public function getEncryptedData() {
        $utils = new ccAvenueUtils( $this );
        $merchant_data = $this->getMerchantData( $utils->getChecksum() );
        return $utils->encrypt($merchant_data,$this->getWorkingKey());
    }

    public function response( $response ) {
        $utils = new ccAvenueUtils( $this );
        $resonse_data = $utils->decrypt( $response, $this->getWorkingKey() );
        $payment_data=explode('&', $resonse_data);
        $data_size=sizeof($payment_data);

        $auth_desc = null;
        $checksum = null;

        for($i = 0; $i < $data_size; $i++)
        {
            $information = explode('=',$payment_data[$i]);
            if( $i==0 )
                $this->setMerchantId( $information[1] );
            if($i==1)
                $this->setOrderId( $information[1] );
            if($i==2)
                $this->setAmount( $information[1] );
            if($i==3)
                $auth_desc = $information[1];
            if($i==4)
                $checksum = $information[1];
        }

        $payment_data_string = $this->getMerchantId().'|'.$this->getOrderId().'|'.$this->getAmount().'|'.$auth_desc.'|'.$this->getWorkingKey();
        $verify_checksum = $utils->verifyChecksum( $utils->genchecksum( $payment_data_string ), $checksum );


        if($verify_checksum==TRUE && $auth_desc==="Y")
        {
            return "success";
        }
        else if($verify_checksum==TRUE && $auth_desc==="B")
        {
            return "pending";
        }
        else if($verify_checksum==TRUE && $auth_desc==="N")
        {
            return "declined";
        }
        else
        {
            return "error";
        }

    }

}


class ccAvenueUtils {

    private $payment;

    public function __construct(ccAvenuePayment $payment)
    {
        $this->payment = $payment;
    }

    public function getChecksum()
    {
        $str = $this->payment->getMerchantId();
        $str .= "|". $this->payment->getOrderId();
        $str .= "|". $this->payment->getAmount();
        $str .= "|". $this->payment->getRedirectUrl();
        $str .= "|". $this->payment->getWorkingKey();
        $adler = 1;
        $adler = $this->adler32($adler,$str);
        return $adler;
    }

    public function genChecksum($str)
    {
        $adler = 1;
        $adler = $this->adler32($adler,$str);
        return $adler;
    }

    public function verifyChecksum($getCheck, $avnChecksum)
    {
        $verify=false;
        if($getCheck==$avnChecksum) $verify=true;
        return $verify;
    }

    private function adler32($adler , $str)
    {
        $BASE =  65521 ;
        $s1 = $adler & 0xffff ;
        $s2 = ($adler >> 16) & 0xffff;
        for($i = 0 ; $i < strlen($str) ; $i++)
        {
            $s1 = ($s1 + Ord($str[$i])) % $BASE ;
            $s2 = ($s2 + $s1) % $BASE ;
        }
        return $this->leftshift($s2 , 16) + $s1;
    }

    private function leftshift($str , $num)
    {

        $str = DecBin($str);

        for( $i = 0 ; $i < (64 - strlen($str)) ; $i++)
            $str = "0".$str ;

        for($i = 0 ; $i < $num ; $i++)
        {
            $str = $str."0";
            $str = substr($str , 1 ) ;
            //echo "str : $str <BR>";
        }
        return $this->cdec($str) ;
    }

    private function cdec($num)
    {
        $dec=0;
        for ($n = 0 ; $n < strlen($num) ; $n++)
        {
            $temp = $num[$n] ;
            $dec =  $dec + $temp*pow(2 , strlen($num) - $n - 1);
        }

        return $dec;
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

    private function pkcs5_pad ($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

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
