<?php
class adminMeeting{
  private static function convertChannelnameAndCheckIfCanDo($ts, $cfge){
    $channelName = $ts->getElement('data', $ts->channelInfo($cfge['adminMeeting']['channelId']))['channel_name'];
    if(strstr($channelName, $cfge['adminMeeting']['meetingOff']) !== false){
      return false;
    }
    else{
      foreach(split("[ .:]", $channelName) as $data){
        if(is_numeric($data)){
          $date[] = $data;
        }
      }
      if(mktime($date[3], $date[4], 0, $date[1], $date[2], $date[0]) < time()){
        return true;
      }
    }
  }
  function __construct($ts, $cfge){
    if(self::convertChannelnameAndCheckIfCanDo($ts, $cfge)){
      foreach($cfge['adminMeeting']['adminGroups'] as $adminGroup){
        foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
          if(in_array($adminGroup, explode(",", $client['client_servergroups'])) && !qBot::difTwoTables($cfge['adminMeeting']['ignoreGroups'], explode(",", $client['client_servergroups']))){
            $ts->clientMove($client['clid'], $cfge['adminMeeting']['channelId']);
            $ts->channelEdit($cfge['adminMeeting']['channelId'], array(
              'channel_name' => str_replace('[off]', $cfge['adminMeeting']['meetingOff'], $cfge['adminMeeting']['channelNameWhenMoved'])
            ));
            errors::checkChannelName(str_replace('[off]', $cfge['adminMeeting']['meetingOff'], $cfge['adminMeeting']['channelNameWhenMoved']), 'adminMeeting');
            $ts->clientPoke($client['clid'], str_replace('[nick]', $client['client_nickname'], $cfge['adminMeeting']['message']));
          }
        }
      }
    }
  }
}
 ?>
