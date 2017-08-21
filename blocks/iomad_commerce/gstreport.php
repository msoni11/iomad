<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once(dirname(__FILE__) . '/../iomad_company_admin/lib.php');
require_once('lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/dataformatlib.php');

require_commerce_enabled();

define('DEFAULT_STATE', 'HARYANA');
define('CGST', '9%');
define('SGST', '9%');
define('IGST', '18%');

$sort         = optional_param('sort', 'name', PARAM_ALPHA);
$dir          = optional_param('dir', 'ASC', PARAM_ALPHA);
$page         = optional_param('page', 0, PARAM_INT);
$perpage      = optional_param('perpage', 30, PARAM_INT);        // How many per page.
$dataformat   = optional_param('dataformat', '', PARAM_ALPHA);

$context = context_system::instance();
require_login();

// Correct the navbar.
// Set the name for the page.
$linktext = get_string('gst', 'block_iomad_commerce');
// Set the url.
$linkurl = new moodle_url('/blocks/iomad_commerce/orderlist.php');

// Print the page header.
$PAGE->set_context($context);
$PAGE->set_url($linkurl);
$PAGE->set_pagelayout('admin');
$PAGE->set_title($linktext);

// Set the page heading.
$PAGE->set_heading(get_string('name', 'local_iomad_dashboard') . " - $linktext");

// Build the nav bar.
company_admin_fix_breadcrumb($PAGE, $linktext, $linkurl);

$baseurl = new moodle_url(basename(__FILE__), array('sort' => $sort, 'dir' => $dir, 'perpage' => $perpage));
$returnurl = $baseurl;

if ($dataformat) {
    $fields = array('buyer'    => 'buyer',
                    'state'    => 'state',
                    'course'   => 'course',
                    'quantity' => 'quantity',
                    'price'    => 'price',
                    'date'     => 'date',
                    'total'    => 'total',
                    'igst'     => 'igst',
                    'cgst'     => 'cgst',
                    'sgst'     => 'sgst',
                    );

    $filename = clean_filename('gstreport');
    $orders = $DB->get_records_sql("SELECT u.firstname as buyer, i.state, c.fullname as course, ii.quantity, ii.price, i.date FROM {invoiceitem} ii JOIN {invoice} i ON i.id = ii.invoiceid JOIN {user} u ON u.id=i.userid JOIN {course} c ON c.id = ii.invoiceableitemid WHERE i.Status != '" . INVOICESTATUS_BASKET . "'");

    foreach ($orders as $order) {
      $order->date = userdate($order->date);
      $sgst = $cgst = $igst = 0;
      if (strtoupper($order->state) == DEFAULT_STATE) {
        $sgst = calculate_gst($order->price);
        $cgst = calculate_gst($order->price);
      } else {
        $igst = calculate_igst($order->price);
      }
      $order->total = $order->quantity * $order->price;
      $order->igst = round($igst, 2);
      $order->cgst = round($cgst, 2);
      $order->sgst = round($sgst, 2);
    }

    $downloadusers = new ArrayObject($orders);
    $iterator = $downloadusers->getIterator();

    download_as_dataformat($filename, $dataformat, $fields, $iterator);

    exit;
}

echo $OUTPUT->header();

echo $OUTPUT->download_dataformat_selector(get_string('userbulkdownload', 'admin'), 'gstreport.php');

//  Check we can actually do anything on this page.
iomad::require_capability('block/iomad_commerce:admin_view', $context);

// Get the number of orders.
$objectcount = $DB->count_records_sql("SELECT COUNT(*) FROM {invoice} WHERE Status != '" . INVOICESTATUS_BASKET . "'");
echo $OUTPUT->paging_bar($objectcount, $page, $perpage, $baseurl);

flush();

if ($orders = $DB->get_recordset_sql("SELECT u.firstname, i.state, i.date, c.fullname, ii.quantity, ii.price FROM {invoiceitem} ii JOIN {invoice} i ON i.id = ii.invoiceid JOIN {user} u ON u.id=i.userid JOIN {course} c ON c.id = ii.invoiceableitemid WHERE i.Status != '" . INVOICESTATUS_BASKET . "'", null, $page, $perpage)) {
    if (count($orders)) {
        $table = new html_table();
        $table->head = array (get_string('buyer', 'block_iomad_commerce'),
                              get_string('state'),
                              get_string('course'),
                              get_string('price', 'block_iomad_commerce'),
                              get_string('quantity', 'block_iomad_commerce'),
                              get_string('total'),
                              get_string('igst', 'block_iomad_commerce'),
                              get_string('cgst', 'block_iomad_commerce'),
                              get_string('sgst', 'block_iomad_commerce'),
                              get_string('date'),
                              '');
        $table->align = array ("left", "center", "center", "center");
        $table->width = "95%";
        foreach ($orders as $order) {
                $sgst = $cgst = $igst = 0;
                if (strtoupper($order->state) == DEFAULT_STATE) {
                  $sgst = calculate_gst($order->price);
                  $cgst = calculate_gst($order->price);
                } else {
                  $igst = calculate_igst($order->price);
                }
                $table->data[] = array ($order->firstname, 
                                        $order->state,
                                        $order->fullname, 
                                        $order->price,
                                        $order->quantity, 
                                        $order->quantity * $order->price,
                                        round($igst, 2),
                                        round($cgst, 2),
                                        round($sgst,2),
                                        userdate($order->date)
                                        );
        }

        if (!empty($table)) {
            echo html_writer::table($table);
            echo $OUTPUT->paging_bar($objectcount, $page, $perpage, $baseurl);
        }
    } else {
        echo "<p>" . get_string('noinvoices', 'block_iomad_commerce') . "</p>";
    }
    $orders->close();
}

echo $OUTPUT->footer();
