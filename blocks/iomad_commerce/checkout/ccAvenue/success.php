<?php
/**
 * Created by PhpStorm.
 * User: SUNIL
 * Date: 11-07-2017
 * Time: 16:44
 */

require_once(dirname(__FILE__) . '/../paymentprovider.php');
require_once(dirname(__FILE__) . '/ccAvenuefunctions.php');
require_once(dirname(__FILE__) . '/config.php');

global $CFG;
$merchant_id = $CFG->ccAvenue_merchant_id;
$working_key = $CFG->ccAvenue_working_key;
$access_code = $CFG->ccAvenue_access_code;


$response=$_POST["encResp"];
$ccavenue = new ccAvenuePayment($merchant_id, $working_key);
// Check if the transaction was successfull.
$ccavenue->response($_POST);

$basket = get_basket();
$pp = get_payment_provider_instance($basket->checkout_method);

//$error = $pp->confirm();

// Note : we need some code here. Reference paypal->confirm() method.

