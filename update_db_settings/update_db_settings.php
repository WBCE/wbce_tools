<?php
/** Script to update the WBCE database settings table entries `wbce_version`, `wbce_tag` and
  * `rename_files_on_upload` to recommended values. You may want to use this script in case
  * you applied a security patch package instead of doing a clean installation or upgrade.
  */

// stop script if WBCE config file is missing
if (! file_exists('./config.php')) {
	die('WBCE config.php file not found. Ensure script is uploaded into your WBCE root folder.');
}

// include config file and check for ADMIN_PATH (set in config.php or framework/initialize.php)
require './config.php';
if (! (defined('ADMIN_PATH') && file_exists(ADMIN_PATH . '/interface/version.php'))) {
	die('No ADMIN_PATH defined or WBCE version.php file missing.');
}

// include WBCE version file
require ADMIN_PATH . '/interface/version.php';

// connect to WBCE DB and check for errors
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

// update DB entries of 'settings.wbce_version' and 'settings.wbce_tag'
$version = $mysqli->real_escape_string(NEW_WBCE_VERSION);
$sql1 = "UPDATE `" . TABLE_PREFIX . "settings` SET `value`='${version}' WHERE `name`='wbce_version' OR `name`='wbce_tag'";
$result1 = $mysqli->query($sql1);

// update DB entries of 'settings.rename_files_on_upload'
$extensions = 'ph.*?,cgi,pl,pm,exe,com,bat,pif,cmd,src,asp,aspx,js,lnk';
$sql2 = "UPDATE `" . TABLE_PREFIX . "settings` SET `value`='${extensions}' WHERE `name`='rename_files_on_upload'";
$result2 = $mysqli->query($sql2);

if($result1 && $result2) {
	echo '<h3 style="color: green;">Successfully updated WBCE database settings table</h3>';
	// try to remove this script
	if (unlink(__FILE__)) {
		echo '<h3 style="color: green;">Script "' . basename(__FILE__) . '" was removed from your server.</h3>';
		die;
	}
} else {
	echo '<h3 style="color: red;">Database Error : ('. $mysqli->errno .') '. $mysqli->error;
}

echo '<h3 style="color: red;">Please delete this script from your server !!!</h3>';
