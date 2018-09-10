<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('LINEBotTiny.php');
require('pub.php');

$channelAccessToken = 'b4N/4Y9wSq61fZJa2wBuMSkwibdZqpnEJGZ9bW6MUB0hOmTmAUJpl2XlHu1j/tGf4bRKTm0INDqmH3OFRPLYE6Y7xT1LtsP3wvfwkDZaL7basepWOWclWY1S/oldUXMI3t7GhWIxUVHHHbR4gIBPdgdB04t89/1O/w1cDnyilFU=
';
$channelSecret = '4e33db92e13337af7bbe66e4d057fe33
';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':

                    getMqttfromlineMsg($message['text']);
                    $mixmsg = '[BOT] > '. $message['text'];

                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $mixmsg
                            )
                        )
                    ));
                    break;
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
?>