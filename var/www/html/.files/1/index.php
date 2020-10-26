<?php

$file = file_get_contents('/var/www/dump/files.hostname');

echo "<h1 style=\"text-align:center;\">Hello World.</h1><br><p>Wondering what to do now? Why not upload your web files at <a href=\"http://".$file."/info.server.php\" target=\"_blank\">".$file."</a>, and read the manual. Have fun.</p>";
echo "<p>Powered by Hidden Hosting - Contact me for help (curious@null.net)</p>";

?>