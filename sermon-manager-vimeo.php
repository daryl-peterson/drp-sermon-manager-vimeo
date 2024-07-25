<?php

namespace DRPSMVimeo;

/*
 * ----------------------------------------------------------------------------
 * @wordpress-plugin
 * Plugin Name:         Sermon Manager Vimeo
 * Plugin URI:
 * Description:         Update Sermon Manager video link when sermon is published to Vimeo. Works great when sermons are scheduled to publish !
 * Version:             1.0.0
 * Author:              Daryl Peterson
 * Author URI:
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         drp_smvimeo
 * Domain Path:         /languages
 * Requires PHP:        8.1
 * Requires at least:   6.4
 *
 * ----------------------------------------------------------------------------
 * Sermon Manager Vimeo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 */

defined('ABSPATH') or exit;

if (!defined('WPINC')) {
    exit;
}

if (file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

const NAME = 'Sermon Manager Vimeo';
const FILE = __FILE__;
const KEY_PREFIX = 'drp_smvimeo';
const DOMAIN = 'drp_smvimeo';
const NS = __NAMESPACE__;
const LOG_FILE = 'sm-vimeo.log';
const PLUGIN_SM = 'sermon-manager-for-wordpress/sermons.php';
const PLUGIN_SM_SERMON = 'wpfc_sermon';
const PLUGIN_MIN_PHP = '8.1.0';
const PLUGIN_MIN_WP = '6.4.0';

try {
    App::getInstance()->init();
    App::getPluginInt()->init();
} catch (\Throwable $th) {
    $trace = $th->getTraceAsString();
    error_log($th->getMessage());
    error_log($trace);
}
