<?php
class clientInfoBase{
  private static function writeClientConnectInfo($ts, $baza){
    foreach($ts->getElement('data', $ts->clientList('-times')) as $client){
      if($client['client_type'] == 0){
        $clId = $client['client_database_id'];
        $data = $baza->query("SELECT `databaseId` FROM `clientLastConnected` WHERE `databaseId`=$clId");
        $result = $data->fetch(PDO::FETCH_ASSOC);
        if(empty($result['databaseId'])){
          $baza->prepare("INSERT INTO `clientLastConnected` SET `databaseId`=:databaseId, `onlineTime`=:onlineTime, `awayTime`=:awayTime, `lastConnected`=:lastConnected")->execute(array(
            ':databaseId' => $client['client_database_id'],
            ':awayTime' => $client['client_idle_time']/1000,
            ':lastConnected' => time(),
            ':onlineTime' => $ts->getElement('data', $ts->clientInfo($client['clid']))['connection_connected_time']/1000
          ));
        }
        else{
          $baza->prepare("UPDATE `clientLastConnected` SET `databaseId`=:databaseId, `awayTime`=:awayTime, `onlineTime`=:onlineTime, `lastConnected`=:lastConnected WHERE `databaseId`=$clId")->execute(array(
            ':databaseId' => $client['client_database_id'],
            ':awayTime' => $client['client_idle_time']/1000,
            ':lastConnected' => time(),
            ':onlineTime' => $ts->getElement('data', $ts->clientInfo($client['clid']))['connection_connected_time']/1000
          ));
        }
      }
    }
  }
  function start($ts, $cfge, $lang=NULL, $baza){
    global $cfgp, $config;
    foreach($cfge['clanGroup']['channels'] as $index_clan => $channel_clan){
      $channels_clan[$index_clan] = $channel_clan['channelId'];
    }
    foreach($cfge['pokeAdmins'] as $index_pa => $channel_pa){
      $channels_pa[$index_pa] = $channel_pa['channelId'];
    }
    foreach($cfgp['moveWhenJoinChannel'] as $index_move => $channel_move){
      $channels_move[$index_move] = $channel_move['channelId'];
    }
    foreach($cfge['registerChannel'] as $index_register => $channel_register){
      $channels_register[$index_register] = $channel_register['channelId'];
    }
    $channels_base_clan = $baza->query("SELECT `channelId` FROM  `clanGroup`");
    foreach($channels_base_clan as $index_base_clan => $channel_base_clan){
      $channels_base[$index_base_clan] = $channel_base_clan['channelId'];
    }
    if(empty($channels_base)){
      $channels_base[] = 0;
    }
    $channel_create_premium[] = $config['2']['events']['cfg']['createPremiumChannels']['channelId'];


    $channels_all = array_merge($channels_move, $channels_pa, $channels_clan, $channels_register, $channels_base, $channel_create_premium);

    //tutaj trzeba podac kazdy kanał ignorowany
    qBot::clientDataChannel($channels_all, $ts, $cfge);
    unset($cfgp, $config);


    self::writeClientConnectInfo($ts, $baza);
  }
}
 ?>
