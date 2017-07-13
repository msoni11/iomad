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


global $USER;

$basket = get_basket();
$paymentamount = $_SESSION["Payment_Amount"];

$ccavenue = new ccAvenuePayment( 'M_smi44769_44769', '9vixgnzn5772ev1b13bz52chdxeq0bk3', ccAvenue_responseurl());
// set details
$ccavenue->setAmount($paymentamount);
$ccavenue->setOrderId($basket->reference);
$ccavenue->setBillingName(fullname($USER));
$ccavenue->setBillingAddress($basket->address);
$ccavenue->setBillingCity($basket->city);
$ccavenue->setBillingZip($basket->postcode);
$ccavenue->setBillingState($basket->state);
$ccavenue->setBillingCountry($basket->country);
$ccavenue->setBillingEmail($basket->email);
$ccavenue->setBillingTel($basket->phone1);
$ccavenue->setBillingNotes('');

// copy all the billing details to chipping details
$ccavenue->billingSameAsShipping();

// get encrpyted data to be passed
$data = $ccavenue->getEncryptedData();

// merchant id to be passed along the param
$merchant = $ccavenue->getMerchantId();

?>

<!-- Request -->
<form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp">
    <?php
    echo '<input type=hidden name=encRequest value="'.$data.'"">';
    echo '<input type=hidden name=Merchant_Id value="'.$merchant.'">';
    ?>
</form>

<script language='javascript'>document.redirect.submit();</script>