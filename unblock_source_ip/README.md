# WBCE - Unblock Source IP
If a user has forgotten his password and tried to many times with a wrong one, his source ip address is blocked. Up to WBCE 1.3.x closing the browser and reopening it did already unblock the client. Starting with WBCE 1.4 this does not help anymore, but just waiting for some time, depending on the number of failed attempts, will "unblock" the client. If you are in a hurry and you can not wait, you can speed this up as follows:

## Usage
  1. Upload the script to the root of your server.
  2. Run it once by calling the url http://yourserver/unblock_source_ip.php from the client that has been blocked.
  3. !!!Do not forget to delete the file from the server!!!

The client IP should not be blocked anymore and you should 
be able to see the login mask again.
