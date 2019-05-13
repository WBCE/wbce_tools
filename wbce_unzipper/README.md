# WBCE-Unzipper
When setting up WBCE CMS, you can rush up the installation progress by creating a zipfile with the needed files and unpacking it on the server instead of FTP'ing each file on its own. 

## Usage
  1. Download the lates WBCE version from Github
  2. Unpack it on your local machine
  3. Create a new zip with the contents of the folder "wbce" (only the contents, not the folder itself) and name it wbce.zip
  4. Copy wbce.zip and wbceunzip.php into the directory of the server where WBCE CMS should be installed using the FTP tool of your choice
  5. Point your browser to wbceunzip.php
  6. Proceed with installation/update. wbce.zip and wbceunzip.php are removed automatically.
