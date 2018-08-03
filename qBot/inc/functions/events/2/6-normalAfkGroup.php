<?php
class normalAfkGroup{

  function __construct($ts, $cfge, $lang=null, $baza, $query){
    foreach($ts->getElement('data', $ts->clientList('-groups -times -uid')) as $client){
      if(!qBot::difTwoTables($cfge['normalAfkGroup']['ignoreGroup'], explode(",", $client['client_servergroups']))){
        if($client['client_type'] == 0 && $client['client_database_id'] != $query['client_database_id']){
          if(($client['client_idle_time']/1000) > $cfge['normalAfkGroup']['timeAfk']){
            if(!in_array($cfge['normalAfkGroup']['groupAfk'], explode(",", $client['client_servergroups']))){
              $ts->serverGroupAddClient($cfge['normalAfkGroup']['groupAfk'], $client['client_database_id']);
              if($cfge['normalAfkGroup']['move']['enable']){
                if($client['cid'] != $cfge['normalAfkGroup']['move']['channelId']){
                  $ts->clientMove($client['clid'], $cfge['normalAfkGroup']['move']['channelId']);
                }
              }
            }
          }
          else{
            if(in_array($cfge['normalAfkGroup']['groupAfk'], explode(",", $client['client_servergroups']))){
              $ts->serverGroupDeleteClient($cfge['normalAfkGroup']['groupAfk'], $client['client_database_id']);
              if($cfge['normalAfkGroup']['move']['enable']){
                if($client['cid'] == $cfge['normalAfkGroup']['move']['channelId']){
                  $db = $client['client_database_id'];
                  $channel = $baza->query("SELECT `channelId` FROM `lastClientChannel` WHERE `databaseId`=$db");
                  $ch = $channel->fetch(PDO::FETCH_ASSOC);
                  $ts->clientMove($client['clid'], $ch['channelId']);
                }
              }
            }
          }
        }
      }
    }
    unset ($channel);
  }
}
 ?>
