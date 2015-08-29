<?php
/*
===========================================================
= If you can read these lines in your web browser, you    =
= have to rename this file to reset_admin_pass.php first. =
===========================================================

1. Upload the script to the root of your server.
2. Run it once by calling the url http://yourserver/reset_admin_pass.php
3. !!!Delete the file IMMEDIATELY from the server!!!

Your admin password should now be reset to "reset123", 
please change this password IMMEDIATELY after login.

*/




include ('config.php');
$database->query( "UPDATE `".TABLE_PREFIX."users` SET `password`=MD5('reset123') WHERE `user_id`=1");
if($database->is_error()) {
	echo "Error: ".$database->get_error();
} else {
	echo "Succesfully reset default Admin Password to 'reset123', please delete <strong>immediately</strong> reset_admin_pass.php from the server and change this password <strong>immediately</strong>!";
}


