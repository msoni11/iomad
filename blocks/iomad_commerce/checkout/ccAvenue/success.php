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


$response=$_POST["encResponse"];
$ccavenue = new ccAvenuePayment( 'M_smi44769_44769', '9vixgnzn5772ev1b13bz52chdxeq0bk3', '');
// Check if the transaction was successfull.
echo $ccavenue->response( $response );

$basket = get_basket();
$pp = get_payment_provider_instance($basket->checkout_method);

$error = $pp->confirm();

// Note : we need some code here. Reference paypal->confirm() method.

if (!$error) {
    redirect('confirm.php?u=' . $basket->reference);
}