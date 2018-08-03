<?php
class adminCountOnChannel{
  function __construct($ts, $cfge){
    $online = 0;
    $all = 0;
    foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }
    foreach($cfge['adminCountOnChannel']['adminGroups'] as $groups){
      foreach($ts->getElement('data', $ts->serverGroupClientList($groups, true)) as $client){
        if(!empty($client['cldbid'])){
          if(in_array($client['cldbid'], $clientArrayList)){
            $online++;
            $all++;
          }
          else{
            $all++;
          }
        }
      }
    }
    if(!empty($client['cldbid'])){
      $replaces = array(
        1 => array(1 => '[onl]', 2 => $online),
        2 => array(1 => '[all]', 2 => $all),
      );
    }
    else{
      $replaces = array(
        1 => array(1 => '[onl]', 2 => 0),
        2 => array(1 => '[all]', 2 => 0),
      );
    }
    if(qBot::ifChannelNameSame($cfge['adminCountOnChannel']['channelId'], qBot::replaceInfo($cfge['adminCountOnChannel']['channelName'], $replaces), $ts)){
      $ts->channelEdit($cfge['adminCountOnChannel']['channelId'], array(
        'channel_name' => qBot::replaceInfo($cfge['adminCountOnChannel']['channelName'], $replaces)
      ));
      errors::checkChannelName(qBot::replaceInfo($cfge['adminCountOnChannel']['channelName'], $replaces), 'adminCountOnChannel');
    }
  }
}
 ?>
