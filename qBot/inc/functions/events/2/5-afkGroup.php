<?php
class afkGroup{
  private static function saveToBaseIfIdle($baza, $ts, $cfge, $query){
    foreach($ts->getElement('data', $ts->clientList('-times -groups -uid')) as $client){
      if($client['client_type'] == 0 && $client['client_database_id'] != $query['client_database_id']){
        if(!qBot::difTwoTables($cfge['afkGroup']['ignoredGroups'], explode(",", $client['client_servergroups']))){
          $db = $client['client_database_id'];
          $data = $baza->query("SELECT `dataBaseId` FROM `afkGroup` WHERE `dataBaseId`=$db");
          $result = $data->fetch(PDO::FETCH_ASSOC);
          if(empty($result['dataBaseId'])){
            if(($client['client_idle_time']/1000) > $cfge['afkGroup']['timeAfk']){
              $id = $ts->serverGroupCopy($cfge['afkGroup']['groupCopy'], 0, "AFK od: ".qBot::convertSeconds($client['client_idle_time']/1000), 2);
              $ts->serverGroupAddClient($ts->getElement('data', $id)['sgid'], $db);
              if(!empty($ts->getElement('data', $id)['sgid'])){
                $baza->prepare("INSERT INTO `afkGroup` SET `dataBaseId`=:dataBaseId, `afkTime`=:afkTime, `groupId`=:groupId")->execute(array(
                  ':dataBaseId' => $client['client_database_id'],
                  ':afkTime' => ($client['client_idle_time']/1000),
                  ':groupId' => $ts->getElement('data', $id)['sgid']
                ));
                if($cfge['afkGroup']['move']['enable']){
                  $ts->clientMove($client['clid'], $cfge['afkGroup']['move']['channelId']);
                }
              }
            }
          }
          else{
            if(($client['client_idle_time']/1000) > $cfge['afkGroup']['timeAfk']){
              $data = $baza->query("SELECT `groupId` FROM `afkGroup` WHERE `dataBaseId`=$db");
              $result = $data->fetch(PDO::FETCH_ASSOC);
              foreach($ts->getElement('data', $ts->serverGroupList()) as $sg){
                if($sg['sgid'] == $result['groupId']){
                  if($sg['name'] != "AFK od: ".qBot::convertSeconds($client['client_idle_time']/1000)){
                    $ts->serverGroupRename($result['groupId'], "AFK od: ".qBot::convertSeconds($client['client_idle_time']/1000));
                  }
                }
              }
              $baza->prepare("UPDATE `afkGroup` SET `dataBaseId`=:dataBaseId, `afkTime`=:afkTime WHERE `dataBaseId`=$db")->execute(array(
                ':dataBaseId' => $client['client_database_id'],
                ':afkTime' => ($client['client_idle_time']/1000)
              ));
              if($cfge['afkGroup']['move']['enable']){
                if($client['cid'] != $cfge['afkGroup']['move']['channelId']){
                  $ts->clientMove($client['clid'], $cfge['afkGroup']['move']['channelId']);
                }
              }
            }
            else{
              $data = $baza->query("SELECT `groupId` FROM `afkGroup` WHERE `dataBaseId`=$db");
              $result = $data->fetch(PDO::FETCH_ASSOC);
              $ts->serverGroupDelete($result['groupId']);
              $baza->prepare("DELETE FROM `afkGroup` WHERE `dataBaseId`=:dataBaseId")->execute(array(
                ':dataBaseId' => $db
              ));
              if($cfge['afkGroup']['move']['enable']){
                if($client['cid'] == $cfge['afkGroup']['move']['channelId']){
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
  }

private static function deleteWhenOffline($baza, $ts, $cfge){
  foreach($ts->getElement('data', $ts->clientList()) as $client){
    $clientList[] = $client['client_database_id'];
  }
  $data = $baza->query("SELECT `dataBaseId` FROM `afkGroup`");
  foreach($data as $dbid){
    if(!in_array($dbid['dataBaseId'], $clientList)){
      $db = $dbid['dataBaseId'];
      $group = $baza->query("SELECT `groupId` FROM `afkGroup` WHERE `dataBaseId`=$db");
      $result_group = $group->fetch(PDO::FETCH_ASSOC);
      $ts->serverGroupDelete($result_group['groupId']);
      $baza->prepare("DELETE FROM `afkGroup` WHERE `dataBaseId`=:dataBaseId")->execute(array(
        ':dataBaseId' => $dbid['dataBaseId']
      ));
    }
  }
}


  function __construct($ts, $cfge, $lang, $baza, $query){
    self::saveToBaseIfIdle($baza, $ts, $cfge, $query);
    self::deleteWhenOffline($baza, $ts, $cfge);
  }
}
 ?>
