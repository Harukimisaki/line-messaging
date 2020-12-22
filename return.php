<?php
require('vendor/autoload.php');

use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

//先ほど取得したチャネルシークレットとチャネルアクセストークンを以下の変数にセット
$channel_access_token = '594788b90da99c9adc4256cb9ef9fa5a';
$channel_secret = 'Rg0h9TK7mxOWbj+5QtpaVetwpOab+9UsK+CLSTrTxTSicWnrEY8OdcwYxa
Z0lDuH7ak7oxlO3uyCSFF6ozYj3Hanh0GrzrITQvtynLeioZgRKwf08xv2FbxidNn5GSjoQOR7jZe+7+tvbmUROQrePAdB04t89/1O/w1cDnyilFU=';

$http_client = new CurlHTTPClient($channel_access_token);
$bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);
$signature = $_SERVER['HTTP_' . HTTPHeader::LINE_SIGNATURE];
$http_request_body = file_get_contents('php://input');
$events = $bot->parseEventRequest($http_request_body, $signature);
$event = $events[0];

$reply_token = $event->getReplyToken();
$reply_text = $event->getText();
$bot->replyText($reply_token, $reply_text);
