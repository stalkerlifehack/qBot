<?php
class groupCountOnChannel{
  private static function countFromCfg($ts, $cfge){
    foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }
    if(!empty($cfge['groupCountOnChannel']['channels'])){
      foreach($cfge['groupCountOnChannel']['channels'] as $data){
        $online = 0;
        $all = 0;
        foreach($ts->getElement('data', $ts->serverGroupClientList($data['groupId'], true)) as $client){
          if(!empty($client['cldbid'])){
            $return = true;
            if(in_array($client['cldbid'], $clientArrayList)){
              $online++;
              $all++;
            }
            else{
              $all++;
            }
          }
          else{
            $return = false;
          }
          if($return){
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
        }
        if(qBot::ifChannelNameSame($data['channelId'], qBot::replaceInfo($data['channelName'], $replaces), $ts)){
          $ts->channelEdit($data['channelId'], array(
            'channel_name' => qBot::replaceInfo($data['channelName'], $replaces)
          ));
          errors::checkChannelName(qBot::replaceInfo($data['channelName'], $replaces), 'groupCountOnChannel');
        }
      }
      unset($online, $all, $replaces, $clientArrayList);
    }
  }
  private static function checkChannelsInBase($baza, $ts){
    $dataBase = $baza->query("SELECT `channelId` FROM `groupOnline` ");
    $channelsOnline = $ts->getElement('data', $ts->channelList());
    foreach($channelsOnline as $index => $channelsOnlines){
      $data[$index] =  $channelsOnlines['cid'];
    }
    foreach($dataBase as $channel){
      if(!in_array($channel['channelId'], $data)){
        $baza->prepare("DELETE FROM `groupOnline` WHERE `channelId`=:channelId")->execute(array(
          ':channelId' => $channel['channelId']
        ));
      }
    }
    unset($dataBase, $data);
  }
  private static function countFromBase($ts, $cfge, $baza){
    foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }
    $dataBase = $baza->query("SELECT `channelId`, `groupId` FROM `groupOnline`");
    foreach($dataBase as $info){
      $online = 0;
      $all = 0;
      foreach($ts->getElement('data', $ts->serverGroupClientList($info['groupId'], true)) as $client){
        if(!empty($client['cldbid'])){
          $return = true;
          if(in_array($client['cldbid'], $clientArrayList)){
            $online++;
            $all++;
          }
          else{
            $all++;
          }
        }
        else{
          $return = false;
        }
        if($return){
          $replaces = array(
            1 => array(1 => '[onl]', 2 => $online),
            2 => array(1 => '[all]', 2 => $all),
            3 => array(1=> '[id]', 2 => $info['channelId'])
          );
        }
        else{
          $replaces = array(
            1 => array(1 => '[onl]', 2 => 0),
            2 => array(1 => '[all]', 2 => 0),
            3 => array(1=> '[id]', 2 => $info['channelId'])
          );
        }
      }
      if(qBot::ifChannelNameSame($info['channelId'], qBot::replaceInfo($cfge['groupCountOnChannel']['channelName'], $replaces), $ts)){
        $ts->channelEdit($info['channelId'], array(
          'channel_name' => qBot::replaceInfo($cfge['groupCountOnChannel']['channelName'], $replaces)
        ));
        errors::checkChannelName(qBot::replaceInfo($cfge['groupCountOnChannel']['channelName'], $replaces), 'groupCountOnChannel');
      }
    }
    unset($clientArrayList, $dataBase, $online, $all, $replaces);
  }
  function __construct($ts, $cfge, $lang=NULL, $baza){
    self::countFromCfg($ts, $cfge);
    self::checkChannelsInBase($baza, $ts);
    self::countFromBase($ts, $cfge, $baza);
  }
}
 ?>
