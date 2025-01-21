<?php
$message = urlencode('Session expired! Silakan ulangi login untuk melanjutkan.');
header('Location: /login?message=' . $message);
exit();
