<?php
class checkPrivateChannels{
  private static function updateDate($baza, $ts){
    $data = $baza->query("SELECT `channelId`, `dataBaseId` FROM `getPrivateChannel`");
    foreach($data as $channelId){
      $chInfo = $ts->getElement('data', $ts->channelInfo($channelId['channelId']));
      $clients = $ts->getElement('data', $ts->clientList('-groups'));
      foreach($clients as $client){
        $clientChInfo = $ts->getElement('data', $ts->channelInfo($client['cid']));
        if($client['cid'] == $channelId['channelId'] || $clientChInfo['pid'] == $channelId['channelId']){
          if($chInfo['channel_topic'] != date('Y-m-d')){
            $channel = $ts->getElement('data', $ts->channelInfo($channelId['channelId']));
            $ts->channelEdit($channelId['channelId'], array(
              'channel_topic' => date('Y-m-d'),
              'channel_flag_maxclients_unlimited' => 1,
              'channel_name' => explode(".", $channel['channel_name'])[0].". ".$ts->getElement('data', $ts->clientGetNameFromDbid($channelId['dataBaseId']))['name']
            ));
          }
        }
      }
    }
  }
  private static function removeOldChannels($baza, $ts, $cfge){
    $data = $baza->query("SELECT `channelId` FROM `getPrivateChannel`");
    foreach($data as $channelId){
      $chTopic = $ts->getElement('data', $ts->channelInfo($channelId['channelId']))['channel_topic'];
      $dates = explode("-", $chTopic);
      foreach($dates as $index => $date){
        $x[$index] = $date;
      }
      $channelTime = mktime(0, 0, 0, $x[1], $x[2], $x[0]);
      $nowTime = time();
      if(($nowTime -$channelTime) > $cfge['checkPrivateChannels']['channelDelete']){
        $ts->channelDelete($channelId['channelId']);
        $baza->prepare("DELETE FROM `getPrivateChannel` WHERE `channelId`=:channelId")->execute(array(
          ':channelId' => $channelId['channelId'],
        ));
        $data = $baza->query("SELECT `channelId` FROM `getPrivateChannel` ORDER BY `channelId`");
        foreach($data as $index => $channelId){
          $index++;
          $oldName = $ts->getElement('data', $ts->channelInfo($channelId['channelId']))['channel_name'];
          foreach(explode(".", $oldName) as $index_1 => $newName){
            if($index_1 == 1){
              $name = $newName;
            }
          }
          if(empty($name)){
            $name = 'brak nazwy';
          }
          $reg = str_replace('[num]', $index, $cfge['checkPrivateChannels']['channelRegular']);
          if(!preg_match($reg, $oldName)){
            if(qBot::ifChannelNameSame($channelId['channelId'], $index.". ".$name, $ts)){
              $ts->channelEdit($channelId['channelId'], array(
                'channel_name' => $index.". ".$name
              ));
            }
          }
        }
      }
      elseif(($nowTime -$channelTime) > $cfge['checkPrivateChannels']['channelWarn']){
        $chName = $ts->getElement('data', $ts->channelInfo($channelId['channelId']))['channel_name'];
        $chNumber = explode(".", $chName);
        foreach($chNumber as $index => $num){
          if($index == 0){
            if(qBot::ifChannelNameSame($channelId['channelId'], $num.". ".$cfge['checkPrivateChannels']['channelNameWarn'], $ts)){
              $ts->channelEdit($channelId['channelId'], array(
                'channel_name' => $num.". ".$cfge['checkPrivateChannels']['channelNameWarn'],
                'CHANNEL_MAXCLIENTS' => 0,
                'channel_flag_maxclients_unlimited' => 0
              ));
            }
          }
        }
      }

    }
  }
  private static function channelChecker($baza, $ts, $cfge){
    $data = $baza->query("SELECT `channelId` FROM `getPrivateChannel` ORDER BY `channelId`");
    foreach($data as $index => $channelId){
      $index++;
      $chInfo = $ts->getElement('data', $ts->channelInfo($channelId['channelId']));
      $reg = str_replace('[num]', $index, $cfge['checkPrivateChannels']['channelRegular']);

      if(!preg_match($reg, $chInfo['channel_name'])){
        if(qBot::ifChannelNameSame($channelId['channelId'], $index.". ".$cfge['checkPrivateChannels']['channelBadName'], $ts)){
          $ts->channelEdit($channelId['channelId'], array(
            'channel_name' => $index.". ".$cfge['checkPrivateChannels']['channelBadName']
          ));
        }
      }
    }
  }
  function __construct($ts, $cfge, $lang=null, $baza){
    self::updateDate($baza, $ts);
    self::removeOldChannels($baza, $ts, $cfge);
    self::channelChecker($baza, $ts, $cfge);
  }
}
 ?>
