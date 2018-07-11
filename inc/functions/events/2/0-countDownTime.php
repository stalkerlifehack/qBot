<?php
class countDownTime{
  function start($ts, $cfge){
    $countDown = mktime($cfge['countDownTime']['data']['hour'], $cfge['countDownTime']['data']['minute'], $cfge['countDownTime']['data']['second'], $cfge['countDownTime']['data']['month'], $cfge['countDownTime']['data']['day'], $cfge['countDownTime']['data']['year']) - time();
    $converted = qBot::convertSecondsSecond($countDown);
    $channel_name['channel_name'] = str_replace('[time]', $converted, $cfge['countDownTime']['channelName']);
      if(qBot::ifChannelNameSame($cfge['countDownTime']['channelId'], $channel_name['channel_name'], $ts)){
        $ts->channelEdit($cfge['countDownTime']['channelId'], $channel_name);
      }
      errors::checkChannelName($channel_name['channel_name'], 'countDownTime');
  }
}
 ?>
