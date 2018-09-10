 <?php
  

function send_LINE($msg){
 $access_token = 'CpI4EKUsixzUQqyXxNK7lAA3KVV6sncOX6HjP37k7s09MLpds+7/94TEOaHg/TzeD0H+xtRUxeP6qp3jtCXa/zkyPjU5vyV4+B9/AU9MALwP4QvsSqWSOWmYNGF2v0UM5Eepmhj3YRoqWVTvEu/L7AdB04t89/1O/w1cDnyilFU='; 

  $messages = [
        'type' => 'text',
        'text' => $msg
        'text' => $ON
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/push';
      $data = [

        'to' => 'Udbe103b91e9b0e90dc37a1a0b668f81a',
        'messages' => [$messages],
      ];
      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n"; 
}

?>
