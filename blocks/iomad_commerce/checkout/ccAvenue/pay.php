<?php
/**
 * Created by PhpStorm.
 * User: SUNIL
 * Date: 11-07-2017
 * Time: 17:09
 */

require_once(dirname(__FILE__) . '/../paymentprovider.php');
require_once(dirname(__FILE__) . '/ccAvenuefunctions.php');
require_once(dirname(__FILE__) . '/config.php');


global $USER, $CFG;

$basket = get_basket();
$paymentamount = $_SESSION["Payment_Amount"];

$merchant_id = $CFG->ccAvenue_merchant_id;
$working_key = $CFG->ccAvenue_working_key;
$access_code = $CFG->ccAvenue_access_code;

$ccavenue = new ccAvenuePayment($merchant_id, $working_key);
// set details
$ccavenue->setAmount($paymentamount);
$ccavenue->setOrderId($basket->reference);
$ccavenue->setBillingName(fullname($USER));
$ccavenue->setBillingAddress($basket->address);
$ccavenue->setBillingCity($basket->city);
$ccavenue->setBillingZip($basket->postcode);
$ccavenue->setBillingState($basket->state);
$countryChoices = get_string_manager()->get_list_of_countries();
$country = $countryChoices["$basket->country"];
$ccavenue->setBillingCountry($country);
$ccavenue->setBillingEmail($basket->email);
$ccavenue->setBillingTel($basket->phone1);
$ccavenue->setBillingNotes('');

// copy all the billing details to chipping details
$ccavenue->billingSameAsShipping();

// get encrpyted data to be passed
$encrypted_data = $ccavenue->getEncryptedData();

?>

<!-- Request -->
<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
    <?php
    echo "<input type=hidden name=encRequest value=$encrypted_data>";
    echo "<input type=hidden name=access_code value=$access_code>";
    ?>
</form>

<script language='javascript'>document.redirect.submit();</script>