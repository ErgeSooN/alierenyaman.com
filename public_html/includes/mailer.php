<?php
/**
 * Basit SMTP istemcisi.
 * Bu sunucuda mail() fonksiyonu disable_functions ile kapatildigi icin
 * dogrudan SMTP protokolu ile e-posta gonderiyoruz.
 */

function smtp_send_mail(array $config, string $to, string $subject, string $body, string $replyTo = ''): bool
{
    $host = $config['host'] ?? '';
    $port = (int) ($config['port'] ?? 465);
    $username = $config['username'] ?? '';
    $password = $config['password'] ?? '';
    $from = $config['from'] ?? $username;

    if ($host === '' || $username === '' || $password === '') {
        return false;
    }

    $target = ($port === 465) ? 'ssl://' . $host : $host;
    $fp = @stream_socket_client($target . ':' . $port, $errno, $errstr, 15);
    if (!$fp) {
        return false;
    }
    stream_set_timeout($fp, 15);

    $expect = function (string $prefix) use ($fp): bool {
        $line = '';
        while (($chunk = fgets($fp, 515)) !== false) {
            $line = $chunk;
            if (isset($chunk[3]) && $chunk[3] === ' ') {
                break;
            }
        }
        return strpos($line, $prefix) === 0;
    };
    $send = function (string $line) use ($fp) {
        fwrite($fp, $line . "\r\n");
    };

    if (!$expect('220')) {
        fclose($fp);
        return false;
    }

    $send('EHLO ' . ($_SERVER['SERVER_NAME'] ?? 'localhost'));
    if (!$expect('250')) {
        fclose($fp);
        return false;
    }

    if ($port === 587) {
        $send('STARTTLS');
        if (!$expect('220')) {
            fclose($fp);
            return false;
        }
        stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        $send('EHLO ' . ($_SERVER['SERVER_NAME'] ?? 'localhost'));
        if (!$expect('250')) {
            fclose($fp);
            return false;
        }
    }

    $send('AUTH LOGIN');
    if (!$expect('334')) {
        fclose($fp);
        return false;
    }
    $send(base64_encode($username));
    if (!$expect('334')) {
        fclose($fp);
        return false;
    }
    $send(base64_encode($password));
    if (!$expect('235')) {
        fclose($fp);
        return false;
    }

    $send('MAIL FROM: <' . $from . '>');
    if (!$expect('250')) {
        fclose($fp);
        return false;
    }
    $send('RCPT TO: <' . $to . '>');
    if (!$expect('250')) {
        fclose($fp);
        return false;
    }
    $send('DATA');
    if (!$expect('354')) {
        fclose($fp);
        return false;
    }

    $headers = [];
    $headers[] = 'From: ' . $from;
    $headers[] = 'To: ' . $to;
    if ($replyTo !== '') {
        $headers[] = 'Reply-To: ' . $replyTo;
    }
    $headers[] = 'Subject: ' . $subject;
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/plain; charset=UTF-8';

    $normalizedBody = str_replace("\r\n", "\n", $body);
    $normalizedBody = str_replace("\n", "\r\n", $normalizedBody);
    $message = implode("\r\n", $headers) . "\r\n\r\n" . $normalizedBody . "\r\n.";
    $send($message);
    $ok = $expect('250');

    $send('QUIT');
    fclose($fp);

    return $ok;
}
