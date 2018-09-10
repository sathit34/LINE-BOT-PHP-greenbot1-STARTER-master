&nbsp;&lt;?php
 
&nbsp;&nbsp; function pubMqtt($topic,$msg){
&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; put("https://api.netpie.io/topic/binahead/$topic?retain",$msg);
 
&nbsp; }
&nbsp; function getMqttfromlineMsg($lineMsg){
 
&nbsp;&nbsp;&nbsp; $pos = strpos($lineMsg, ":");
&nbsp;&nbsp;&nbsp; if($pos){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $splitMsg = explode(":", $lineMsg);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $topic = $splitMsg[0];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $msg = $splitMsg[1];
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; pubMqtt($topic,$msg);
&nbsp;&nbsp;&nbsp; }else{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $topic = "raw";
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $msg = $lineMsg;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; pubMqtt($topic,$msg);
&nbsp;&nbsp;&nbsp; }
&nbsp; }
 
&nbsp; function put($url,$tmsg)
{
&nbsp;&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; $ch = curl_init($url);
 
&nbsp;&nbsp;&nbsp; curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; curl_setopt($ch, CURLOPT_POSTFIELDS, $tmsg);
 
&nbsp;&nbsp;&nbsp; curl_setopt($ch, CURLOPT_USERPWD, "{xmWFLfDAfKodr95}:{b6jcXoUmKtyO0gkHyKLsyH6bb}");
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; $response = curl_exec($ch);
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; curl_close ($ch);
&nbsp;&nbsp; &nbsp;
&nbsp;&nbsp;&nbsp; return $response;
}
 
?&gt;