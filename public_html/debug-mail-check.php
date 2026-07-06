<?php
header('Content-Type: text/plain');
echo "mail function exists: " . (function_exists('mail') ? 'YES' : 'NO') . "\n";
echo "disable_functions: [" . ini_get('disable_functions') . "]\n";
echo "sendmail_path: [" . ini_get('sendmail_path') . "]\n";
$r = @mail('test@example.com', 'test', 'test body');
echo "mail() call returned: " . var_export($r, true) . "\n";
