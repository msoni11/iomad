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

$response=$_POST["encResp"];
$ccavenue = new ccAvenuePayment($merchant_id, $working_key);
// Check if the transaction was successfull.
$error = $ccavenue->response($_POST);

$basket = get_basket();
if (!$error) {
    redirect('confirm.php?u=' . $basket->reference);
}

echo $OUTPUT->header();

echo $error;

echo $OUTPUT->footer();

