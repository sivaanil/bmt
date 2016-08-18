<?php 
/*Production:
ssl://gateway.push.apple.com:2195

Development:
ssl://gateway.sandbox.push.apple.com:2195
    */
 $deviceToken = 'b5d7043e4bfca88f58dcbb09779abc8b325fea46533d64b16c89c7a1fa5dd7e5';
     $passphrase = 'taya@123';
     $message = 'Welcome to Book My Toll. This testing Message';

     ////////////////////////////////////////////////////////////////////////////////
 $cert = realpath('PushNotificationAppCertificateKey.pem');
     $ctx = stream_context_create();
     stream_context_set_option($ctx, 'ssl', 'local_cert', $cert);
     stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

     //xdebug_break();
     // Open a connection to the APNS server
     $fp = stream_socket_client(
          'ssl://gateway.sandbox.push.apple.com:2195', $err,
          $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

     if (!$fp)
          exit("Failed to connect: $err $errstr" . PHP_EOL);

     echo 'Connected to APNS' . PHP_EOL;

     // Create the payload body
     $body['aps'] = array(
          'alert' => $message,
          'sound' => 'default'
          );

     // Encode the payload as JSON
     $payload = json_encode($body);

     // Build the binary notification
     $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

     // Send it to the server
     $result = fwrite($fp, $msg, strlen($msg));

     if (!$result)
          echo 'Message not delivered' . PHP_EOL;
     else
          echo 'Message successfully delivered' . PHP_EOL;

     // Close the connection to the server
     fclose($fp);

?>
