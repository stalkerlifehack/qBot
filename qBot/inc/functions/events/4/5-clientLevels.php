<?php
class clientLevels{
  private static function getId($ts, $db){
    foreach($ts->getElement('data', $ts->clientList()) as $client){
      if($client['client_database_id'] == $db){
        return $client['clid'];
      }
    }
  }
  private static function updateLevel($ts, $baza, $level, $db, $group, $cfge){
    $data = $baza->query("SELECT `actualLevel` FROM `clientLevels` WHERE `databaseId`=$db")->fetch(PDO::FETCH_ASSOC);
    if(empty($data['actualLevel'])){
      $ts->serverGroupAddClient($group, $db);
      $baza->prepare("INSERT INTO `clientLevels` SET `databaseId`=:databaseId, `actualLevel`=:actualLevel, `groupId`=:groupId")->execute(array(
        ':databaseId' => $db,
        ':actualLevel' => 1,
        ':groupId' => $group
      ));
      $replaces = array(
        1 => array(1 => '[nick]', 2 => $ts->getElement('data', $ts->clientGetNameFromDbid($db))['name']),
        2 => array(1 => '[old]', 2 => 0),
        3 => array(1 => '[new]', 2 => $level + 1)
      );
      $msg = qBot::replaceInfo($cfge['clientLevels']['msg'], $replaces);
      $ts->sendMessage(1, self::getId($ts, $db), $msg);
    }
    else{

      $gr = $baza->query("SELECT `groupId` FROM `clientLevels` WHERE `databaseId`=$db")->fetch(PDO::FETCH_ASSOC);
      $ts->serverGroupDeleteClient($gr['groupId'], $db);
      $ts->serverGroupAddClient($group, $db);
      $replaces = array(
        1 => array(1 => '[nick]', 2 => $ts->getElement('data', $ts->clientGetNameFromDbid($db))['name']),
        2 => array(1 => '[old]', 2 => $level),
        3 => array(1 => '[new]', 2 => $level + 1)
      );
      $baza->prepare("UPDATE `clientLevels` SET `actualLevel`=:actualLevel, `groupId`=:groupId WHERE `databaseId`=:databaseId")->execute(array(
        ':actualLevel' => $level + 1,
        ':databaseId' => $db,
        ':groupId' => $group
      ));
      $msg = qBot::replaceInfo($cfge['clientLevels']['msg'], $replaces);
      $ts->sendMessage(1, self::getId($ts, $db), $msg);
    }
  }
  private static function getClientLevel($baza, $db){
    $data = $baza->query("SELECT `actualLevel` FROM `clientLevels` WHERE `databaseId`=$db")->fetch(PDO::FETCH_ASSOC);
    return $data['actualLevel'];
  }
  private static function saveLevelsIntoChannel($ts, $baza, $cfge){
    $limit = $cfge['clientLevels']['recordsCount'];
    $data = $baza->query("SELECT `actualLevel`, `databaseId` FROM `clientLevels` ORDER BY `actualLevel` DESC LIMIT $limit");
    $cfge['clientLevels']['topDesc'] .= "[list=1]";
    foreach($data as $info){
      $cl = $ts->getElement('data', $ts->clientGetNameFromDbid($info['databaseId']));
      $cfge['clientLevels']['topDesc'] .= "[*] [size=13][URL=client://0/".$cl['cluid']."]".$cl['name']."[/URL] [size=11]Aktualny level: [b]".$info['actualLevel']."[/b] następny za: ".qBot::convertSecondsSecond_3(self::getNextLevel($baza, $info['databaseId'], $cfge, $info['actualLevel']))."[/size][/size]";
    }
    $cfge['clientLevels']['topDesc'] .= "[/list]".$cfge['clientLevels']['downDesc'];
    if(qBot::ifChannelDescriptionSame($cfge['clientLevels']['channelId'], str_replace('[count]', $cfge['clientLevels']['recordsCount'], $cfge['clientLevels']['topDesc']), $ts)){
      $ts->channelEdit($cfge['clientLevels']['channelId'], array(
        'channel_description' => str_replace('[count]', $cfge['clientLevels']['recordsCount'], $cfge['clientLevels']['topDesc'])
      ));
    }
  }
  private static function getNextLevel($baza, $db, $cfge, $clientLevel){
    $data = $baza->query("SELECT `actualLevel` FROM `clientLevels` WHERE `databaseId`=$db")->fetch(PDO::FETCH_ASSOC);
    foreach($cfge['clientLevels']['levels'] as $level => $groups){
      foreach($groups as $group => $time){
        if(($clientLevel + 1) == $level){
          $totalTime = $baza->query("SELECT `databaseId`, `totalTime` FROM `topTimeSpent` WHERE `databaseId`=$db")->fetch(PDO::FETCH_ASSOC);
          return ($time - $totalTime['totalTime']);
        }
      }
    }
  }
  function __construct($ts, $cfge, $lang=null, $baza){
    $data = $baza->query("SELECT `databaseId`, `totalTime` FROM `topTimeSpent`");
    foreach($data as $info){
      foreach($cfge['clientLevels']['levels'] as $level => $groups){
        foreach($groups as $group => $time){
          if($info['totalTime'] > $time){
            $actLevel = self::getClientLevel($baza, $info['databaseId']);
            if(empty($actLevel) || $actLevel < $level){
              self::updateLevel($ts, $baza, $actLevel, $info['databaseId'], $group, $cfge);
            }
          }
        }
      }
    }
    self::saveLevelsIntoChannel($ts, $baza, $cfge);
  }
}
 ?>
