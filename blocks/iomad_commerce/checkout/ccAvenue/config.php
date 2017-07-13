<?php

require_once(dirname(__FILE__) . '/../../../../config.php');

function ccAvenue_reviewurl() {
    return new moodle_url("/blocks/iomad_commerce/review.php");
}

function ccAvenue_cancelurl() {
    return new moodle_url("/blocks/iomad_commerce/checkout/ccAvenue/cancel.php");
}

function ccAvenue_payurl() {
    return new moodle_url("/blocks/iomad_commerce/checkout/ccAvenue/pay.php");
}

function ccAvenue_responseurl() {
    global $CFG;
    return $CFG->wwwroot."/blocks/iomad_commerce/checkout/ccAvenue/success.php";
}

function ccAvenue_confirmurl($u) {
    return new moodle_url("/blocks/iomad_commerce/confirm.php?u=$u");
}
