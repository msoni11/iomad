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

require_commerce_enabled();

define('DEFAULT_STATE', 'HARYANA');
define('CGST', '9%');
define('SGST', '9%');
define('IGST', '18%');

$sort         = optional_param('sort', 'name', PARAM_ALPHA);
$dir          = optional_param('dir', 'ASC', PARAM_ALPHA);
$page         = optional_param('page', 0, PARAM_INT);
$perpage      = optional_param('perpage', 30, PARAM_INT);        // How many per page.

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

echo $OUTPUT->header();

//  Check we can actually do anything on this page.
iomad::require_capability('block/iomad_commerce:admin_view', $context);

// Get the number of orders.
$objectcount = $DB->count_records_sql("SELECT COUNT(*) FROM {invoice} WHERE Status != '" . INVOICESTATUS_BASKET . "'");
echo $OUTPUT->paging_bar($objectcount, $page, $perpage, $baseurl);

flush();

if ($orders = $DB->get_recordset_sql("SELECT u.firstname, i.state, c.fullname, ii.quantity, ii.price FROM {invoiceitem} ii JOIN {invoice} i ON i.id = ii.invoiceid JOIN {user} u ON u.id=i.userid JOIN {course} c ON c.id = ii.invoiceableitemid WHERE i.Status != '" . INVOICESTATUS_BASKET . "'", null, $page, $perpage)) {
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
                                        round($sgst,2)
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
