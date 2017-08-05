<?php


$settings->add(new admin_setting_configtext('ccAvenue_merchant_id',
    get_string('pp_ccAvenue_merchant_id', 'block_iomad_commerce'),
    '',
    '',
    PARAM_NOTAGS));

$settings->add(new admin_setting_configtext('ccAvenue_working_key',
    get_string('pp_ccAvenue_working_key', 'block_iomad_commerce'),
    '',
    '',
    PARAM_NOTAGS));

$settings->add(new admin_setting_configtext('ccAvenue_access_code',
    get_string('pp_ccAvenue_access_code', 'block_iomad_commerce'),
    '',
    '',
    PARAM_NOTAGS));
