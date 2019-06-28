<?php
/*
============================================================
= If you can read these lines in your web browser, you     =
= have to rename this file to unblock_source_ip.php first. =
============================================================

1. Upload the script to the root of your server.
2. Run it once by calling the url http://yourserver/unblock_source_ip.php from the client that has been blocked.
3. !!!Do not forget to delete the file from the server!!!

The client IP should not be blocked anymore and you should 
be able to see the login mask again.

*/

include ('config.php');

    function get_client_ip()
    {
        $ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))           $ipaddress = $this->get_server('HTTP_CLIENT_IP');
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ipaddress = $this->get_server('HTTP_X_FORWARDED_FOR');
	else if(isset($_SERVER['HTTP_X_FORWARDED']))     $ipaddress = $this->get_server('HTTP_X_FORWARDED');
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))   $ipaddress = $this->get_server('HTTP_FORWARDED_FOR');
	else if(isset($_SERVER['HTTP_FORWARDED']))       $ipaddress = $this->get_server('HTTP_FORWARDED');
	else if(isset($_SERVER['REMOTE_ADDR']))          $ipaddress = $this->get_server('REMOTE_ADDR');
	else if(getenv('HTTP_CLIENT_IP'))                $ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))              $ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))            $ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))                $ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))                   $ipaddress = getenv('REMOTE_ADDR');
	else                                             $ipaddress = 'UNKNOWN';

	return $ipaddress;
    }
 
     
$client_ip = get_client_ip();
$sql = "DELETE FROM `".TABLE_PREFIX."blocking` WHERE `source_ip`='".md5($client_ip)."'";
$database->query($sql);


if($database->is_error()) {
	echo "Error: ".$database->get_error();
} else {
	echo "Successfully unblocked the client IP $client_ip. Please do not forget to delete unblock_source_ip.php from the server!";
}

