<?php
header('Content-Type: text/plain');
$config = @include __DIR__ . '/includes/smtp-config.php';
echo "config loaded: " . (is_array($config) ? 'yes' : 'no') . "\n";
if (is_array($config)) {
    echo "host: " . $config['host'] . "\n";
    echo "port: " . $config['port'] . "\n";
    echo "username: " . $config['username'] . "\n";
    echo "password length: " . strlen($config['password']) . "\n";
}

$host = $config['host'];
$port = (int) $config['port'];
$username = $config['username'];
$password = $config['password'];

$target = ($port === 465) ? 'ssl://' . $host : $host;
$fp = @stream_socket_client($target . ':' . $port, $errno, $errstr, 15);
if (!$fp) {
    echo "connection failed: $errno $errstr\n";
    exit;
}
stream_set_timeout($fp, 15);

function readAll($fp) {
    $data = '';
    while ($line = fgets($fp, 515)) {
        $data .= $line;
        if (isset($line[3]) && $line[3] === ' ') break;
    }
    return $data;
}

echo "GREETING: " . readAll($fp);
fwrite($fp, "EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost') . "\r\n");
echo "EHLO: " . readAll($fp);

fwrite($fp, "AUTH LOGIN\r\n");
echo "AUTH LOGIN: " . readAll($fp);

fwrite($fp, base64_encode($username) . "\r\n");
echo "USERNAME STEP: " . readAll($fp);

fwrite($fp, base64_encode($password) . "\r\n");
echo "PASSWORD STEP: " . readAll($fp);

fwrite($fp, "QUIT\r\n");
fclose($fp);
