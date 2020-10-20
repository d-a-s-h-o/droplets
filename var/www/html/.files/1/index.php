<?php

$file = file_get_contents('/var/www/dump/files.hostname');

echo "<h1 style=\"text-align:center;\">Hello World.</h1><br><p>Wondering what to do now? Why not upload your web files at <a href=\"http://".$file."\" target=\"_blank\">".$file."</a>, your own self-hosted file manager where you can edit your web directory, create new files with a web-based styled text editor, and much more?<br>
<strong>You must enable javascript for this manager. As it is on your own server space you can trust it. Do not alter the torrc record for this site or it could break.</strong><br>
Your default username is <code>jack</code> and your password is <code>minnty</code>.<br>
For security reasons, keep the URL private. You can change your username or password in the config.php file in the /var/www/html/.files directory.</p>";
echo "<p>Powered by Curious Hosting - Contact me for help (curious@null.net)</p>";

?>