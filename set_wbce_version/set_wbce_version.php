<?php
/** Script to update the WBCE database setting table entries `wbce_version` and `wbce_tag` with
  * values read from admin/interface/version.php. You may want to use this script in case you
  * applied a security patch package instead of doing a clean installation or upgrade.
  */

// stop script if basic WBCE files are missing
if (! (file_exists('./config.php') and file_exists('./admin/interface/version.php'))) {
	die;
}

// include WBCE files with DB and version
require './config.php';
require './admin/interface/version.php';

// connect to WBCE DB and check for errors
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

// update DB entries of 'settings.wbce_version' and 'settings.wbce_tag'
$version = $mysqli->real_escape_string(NEW_WBCE_VERSION);
$sql = "UPDATE `" . TABLE_PREFIX . "settings` SET `value`='${version}' WHERE `name`='wbce_version' OR `name`='wbce_tag'";

$result = $mysqli->query($sql);
if($result) {
	echo '<h3 style="color: green;">Updated settings table values for `wbce_version`, `wbce_tag` to ' . htmlentities(NEW_WBCE_VERSION) . '</h3>';
	// try to remove this script
	if (unlink(__FILE__)) {
		echo '<h3 style="color: green;">Automatically removed script "' . basename(__FILE__) . '" from your server.</h3>';
		die;
	}
} else {
	echo '<h3 style="color: red;">Database Error : ('. $mysqli->errno .') '. $mysqli->error;
}

echo '<h3 style="color: red;">Please delete this script from your server !!!</h3>';
