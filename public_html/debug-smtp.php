<?php
header('Content-Type: text/plain');
$config = @include __DIR__ . '/includes/smtp-config.php';
echo "config loaded: " . (is_array($config) ? 'yes' : 'no') . "\n";

$host = $config['host'];
$port = (int) $config['port'];
$username = $config['username'];
$password = $config['password'];
$from = $config['from'] ?? $username;
$to = 'mail@alierenyaman.com';

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

fwrite($fp, "MAIL FROM: <$from>\r\n");
echo "MAIL FROM: " . readAll($fp);

fwrite($fp, "RCPT TO: <$to>\r\n");
echo "RCPT TO: " . readAll($fp);

fwrite($fp, "DATA\r\n");
echo "DATA: " . readAll($fp);

$headers = "From: $from\r\nTo: $to\r\nSubject: Test debug\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$body = "Bu bir debug test mailidir.";
$message = $headers . "\r\n" . $body . "\r\n.";
fwrite($fp, $message . "\r\n");
echo "SEND BODY: " . readAll($fp);

fwrite($fp, "QUIT\r\n");
echo "QUIT: " . readAll($fp);
fclose($fp);
