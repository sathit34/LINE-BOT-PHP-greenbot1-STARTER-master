&lt;?php
&nbsp; require("pub.php");
 
 
&nbsp; 
&nbsp; $channelId = "--LINE Channel ID--";
&nbsp; $channelSecret = "--LINE Channel Secret--"; 
&nbsp; $mid = "--LINE BOT MID--"; 
 
&nbsp; 
&nbsp; $requestBodyString = file_get_contents('php://input');
&nbsp; $requestBodyObject = json_decode($requestBodyString);
&nbsp; $requestContent = $requestBodyObject-&gt;result{0}-&gt;content;
&nbsp; $requestText = $requestContent-&gt;text; 
&nbsp; $requestFrom = $requestContent-&gt;from; 
&nbsp; $contentType = $requestContent-&gt;contentType; 
 
&nbsp; getMqttfromlineMsg($requestText);
&nbsp; 
&nbsp; $headers = array(
&nbsp;&nbsp;&nbsp; "Content-Type: application/json; charset=UTF-8",
&nbsp;&nbsp;&nbsp; "X-Line-ChannelID: {$channelId}", // Channel ID
&nbsp;&nbsp;&nbsp; "X-Line-ChannelSecret: {$channelSecret}", // Channel Secret
&nbsp;&nbsp;&nbsp; "X-Line-Trusted-User-With-ACL: {$mid}", // MID
&nbsp; );
 
&nbsp; 
&nbsp; $responseText = &lt;&lt;&lt; EOM
「{$requestText}」 this is msg echo from Line Bot API。http://binahead.com
EOM;
 
&nbsp; 
&nbsp; $responseMessage = &lt;&lt;&lt; EOM
&nbsp;&nbsp;&nbsp; {
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "to":["{$requestFrom}"],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "toChannel":1383378250,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "eventType":"138311608800106203",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "content":{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "contentType":1,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "toType":1,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "text":"{$responseText}"
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }
&nbsp;&nbsp;&nbsp; }
EOM;
&nbsp; 
&nbsp; 
&nbsp;
&nbsp; $curl = curl_init('https://trialbot-api.line.me/v1/events');
&nbsp; curl_setopt($curl, CURLOPT_POST, true);
&nbsp; curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
&nbsp; curl_setopt($curl, CURLOPT_POSTFIELDS, $responseMessage);
&nbsp; curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
&nbsp; curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
&nbsp; curl_setopt($curl, CURLOPT_PROXY, getenv('FIXIE_URL'));
&nbsp; $output = curl_exec($curl);
 
?&gt;