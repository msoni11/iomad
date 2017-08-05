<?php
/**
 * Created by PhpStorm.
 * User: SUNIL
 * Date: 10-07-2017
 * Time: 23:49
 */


require_once(dirname(__FILE__) . '/../paymentprovider.php');
require_once(dirname(__FILE__) . '/ccAvenuefunctions.php');
require_once(dirname(__FILE__) . '/config.php');


class ccAvenue extends payment_provider {
    protected $pre_order_review_processing_html = '';

    public function get_basketpage_html() {
        return '';
    }

    public function init() {
        parent::init();
        $_SESSION['Payment_Amount'] = get_basket_total();
        redirect(ccAvenue_reviewurl());
    }

    public function pre_order_review_processing() {
        $html = '';
        $this->pre_order_review_processing_html = $html;
    }

    public function get_order_review_html() {

        $html = '';

        $html .= '<p>' . get_string('pp_ccAvenue_review_instructions', 'block_iomad_commerce') . '</p>';

        $this->pre_order_review_processing_html;

        return $html;
    }

    public function confirm() {
        global $DB;

        redirect(ccAvenue_payurl());
    }

    public function get_confirmation_html($invoice) {
        return '<p>' . get_string('pp_paypal_confirmation', 'block_iomad_commerce', $invoice) . '</p>';
    }
}