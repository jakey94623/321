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

require_once('./LINEBotTiny.php');



$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            
            
            
            
            
            $mySheetId='18F-3yVbPZzYCcAH5-hSxNMwDjKRcyAjoKJEoVaGzU2A';


//程式啟動後會去讀取試算表內的問題
getQuestions();


//這是讀取問題的函式
function getQuestions() {
  $sheets = google.sheets('v4');
  $sheets['spreadsheets']['values']['get']({
     auth: oauth2Client,
     spreadsheetId: $mySheetId,
     range:encodeURI('問題'),
  }
            
           /* switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];
                    $source=$event['source'];
                    $type = $source['type']; 
                    $id=$source['userId'];
                    $roomid=$source['roomId'];
                    $groupid=$source['groupId'];
                	if($m_message!="")
                	{
                		$client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $m_message ."\n" . $roomid."\n". date('Y-m-d h:i:sa') . "\n" . $id . "\n" . $groupid
                            )
                        )
                    	));
                	}
                    break;
                */
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
