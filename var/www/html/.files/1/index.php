<?php

$file = file_get_contents('/var/www/dump/files.hostname');

echo '<!DOCTYPE html><html><head><link rel="shortcut icon" type="image/png" href="http://'.$file.'/host.png" id="favicon" /></head><body>';
echo "<h1 style=\"text-align:center;\">Hello World.</h1><br><p>Wondering what to do now? Go to <a href=\"http://".$file."/info.server.php\" target=\"_blank\">".$file."</a>, and read the server info page. Have fun.</p>";
echo "<p>Powered by Hidden Hosting - Contact me for help (curious@null.net)</p></body></html>";

?>