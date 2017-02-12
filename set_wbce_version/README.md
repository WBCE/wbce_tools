# WBCE - Set WBCE Version
Simple PHP script to update the WBCE database setting table entries `wbce_version` and `wbce_tag` with values from admin/interface/version.php.
You may want to use this script in case you applied a security patch package instead of doing a clean installation or upgrade.

## Usage
  1. Copy script into your WBCE root folder using the FTP tool of your choice
  2. Browse http://domain.tld/set_wbce_version.php to upgrade WBCE DB entries
  3. Delete script from your server in case script has no permission to do it for you
