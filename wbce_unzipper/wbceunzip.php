<!doctype html>
<head>
<title>WBCE CMS UnZip</title>

<style type="text/css">

body {
	background-color:#eee;
}

.main {
	background-color:#fff;
	color:#909090;
	padding:1em;
	max-width:50em;
	margin:3em auto;
	font-family:"Open Sans",Arial,sans-serif;
	border-radius:5px;
	text-align:center;
}

h1 {
	font-weight:normal;
}

a:link, a:visited {
	color:#000;
}

</style>

</head>


<body>
<div class="main">
	<h1>WBCE CMS UnZipper</h1>	


<?php
// assuming file.zip is in the same directory as the executing script.
$file = 'wbce.zip';

// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
  // extract it to the path we determined above
  $zip->extractTo($path);
  $zip->close();
  echo "<p>$file nach $path entpackt. <br /><a href=\"index.php\">Installer aufrufen</a></p>";
  unlink(__FILE__);
  unlink($file);
} else {
  echo "<p style=\"color:firebrick\"> FEHLER: $file nicht gefunden!</p>";
}
?>
</div>
</body>
</html>