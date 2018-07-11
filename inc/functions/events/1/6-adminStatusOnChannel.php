<?php
class adminStatusOnChannel{
  function start($ts, $cfge){
    foreach($cfge['adminStatusOnChannel'] as $data){
      $return = true;
      foreach($ts->getElement('data', $ts->clientList()) as $index => $client_dbid){
        $info[$index] = $client_dbid['client_database_id'];
      }
      foreach($ts->getElement('data', $ts->clientList('-times')) as $client){
        $clInfo = $ts->getElement('data', $ts->clientInfo($client['clid']));
        if($clInfo['client_database_id'] == $data['databaseId'] && in_array($data['databaseId'], $info)){
          if($client['client_idle_time']/1000 > $data['time'] || in_array($data['groupId'], explode(",", $clInfo['client_servergroups'])) || $clInfo['client_away'] == 1){
            $channelNameOff['channel_name'] = str_replace('[nick]', $ts->getElement('data', $ts->clientGetNameFromDbid($data['databaseId']))['name'], $data['channelNameIfAway']);
            if(qBot::ifChannelNameSame($data['channelId'], $channelNameOff['channel_name'], $ts)){
              $ts->channelEdit($data['channelId'], $channelNameOff);
              errors::checkChannelName($channelNameOff['channel_name'], 'adminStatusOnChannel (admin AWAY)');
            }
          }
          else{
            $channelNameOff['channel_name'] = str_replace('[nick]', $ts->getElement('data', $ts->clientGetNameFromDbid($data['databaseId']))['name'], $data['channelNameIfOnline']);
            if(qBot::ifChannelNameSame($data['channelId'], $channelNameOff['channel_name'], $ts)){
              $ts->channelEdit($data['channelId'], $channelNameOff);
              errors::checkChannelName($channelNameOff['channel_name'], 'adminStatusOnChannel (admin ON)');
            }
          }
          $return = false;
        }
      }
      if($return){
        $channelNameOff['channel_name'] = str_replace('[nick]', $ts->getElement('data', $ts->clientGetNameFromDbid($data['databaseId']))['name'], $data['channelNameIfOffline']);
        if(qBot::ifChannelNameSame($data['channelId'], $channelNameOff['channel_name'], $ts)){
          $ts->channelEdit($data['channelId'], $channelNameOff);
          errors::checkChannelName($channelNameOff['channel_name'], 'adminStatusOnChannel (admin OFF)');
        }
        unset($channelNameOff);
      }
    }
    unset($return, $info);
  }
}
 ?>
