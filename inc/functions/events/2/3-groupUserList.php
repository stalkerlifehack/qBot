<?php
class groupUserList{

  private static function groupUserListFromCfg($ts, $cfge, $baza){
    foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }
    foreach($cfge['groupUserList']['channels'] as $data){ //foreach z cfg
      $medDesc = '';
      foreach($ts->getElement('data', $ts->serverGroupClientList($data['groupId'], true)) as $client){
        if(in_array($client['cldbid'], $clientArrayList)){
          $cldbid = $client['cldbid'];
          $dataBase = $baza->query("SELECT `awayTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
          $result = $dataBase->fetch(PDO::FETCH_ASSOC);
          if($result['awayTime']/1000 >= $data['idleTime']){
            $medDesc .= " [URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] ".$data['awayPrefix']." ".qBot::convertSeconds($result['awayTime'])."\n"."\n";
          }
          else{
            $cldbid = $client['cldbid'];
            $dataBase = $baza->query("SELECT `onlineTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
            $result = $dataBase->fetch(PDO::FETCH_ASSOC);
            $medDesc .= " [URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] ".$data['onlinePrefix']." ".qBot::convertSeconds($result['onlineTime'])."\n"."\n";
          }
        }
        else{
          $cldbid = $client['cldbid'];
          $dataBase = $baza->query("SELECT `lastConnected` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
          $result = $dataBase->fetch(PDO::FETCH_ASSOC);
          $medDesc .= " [URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] ".$data['offlinePrefix']." ".qBot::convertSeconds(time() - $result['lastConnected'])."\n"."\n";
        }
      }
      $desc = '';
      foreach($ts->getElement('data', $ts->serverGroupList()) as $serverGroup){
        if($serverGroup['sgid'] == $data['groupId']){
          $GroupName = $serverGroup['name'];
        }
      }
      $desc .= str_replace('[clan]', $GroupName, $data['topDesc'])."\n";
      $desc .= $medDesc;
      $desc .= $data['downDesc'];
      $ts->channelEdit($data['channelId'], array(
        'channel_description' => $desc
      ));
    }
    unset($clientArrayList, $medDesc);
  }
  private static function groupUserListFromBase($ts, $cfge, $baza){
    foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }
    $dataBase = $baza->query("SELECT `channelId`, `groupId` FROM `groupUserList`");
     foreach($dataBase as $info){
       $medDesc = '';
        foreach($ts->getElement('data', $ts->serverGroupClientList($info['groupId'], true)) as $client){
          if(!empty($client['cldbid'])){
            $return = true;
           if(in_array($client['cldbid'], $clientArrayList)){
             $cldbid = $client['cldbid'];
             $dataBase = $baza->query("SELECT `awayTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
             $result = $dataBase->fetch(PDO::FETCH_ASSOC);
             if($result['awayTime']/1000 >= $cfge['groupUserList']['idleTime']){
               $medDesc .= " [URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] ".$cfge['groupUserList']['awayPrefix']." ".qBot::convertSeconds($result['awayTime'])."\n"."\n";
             }
             else{
               $cldbid = $client['cldbid'];
               $dataBase = $baza->query("SELECT `onlineTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
               $result = $dataBase->fetch(PDO::FETCH_ASSOC);
               $medDesc .= " [URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] ".$cfge['groupUserList']['onlinePrefix']." ".qBot::convertSeconds($result['onlineTime'])."\n"."\n";
             }
           }
           else{
             $cldbid = $client['cldbid'];
             $dataBase = $baza->query("SELECT `lastConnected` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
             $result = $dataBase->fetch(PDO::FETCH_ASSOC);
             $medDesc .= " [URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] ".$cfge['groupUserList']['offlinePrefix']." ".qBot::convertSeconds(time() - $result['lastConnected'])."\n"."\n";
           }
         }
         else{
           $return = false;
         }
       }
       if($return){
         $desc = '';
         foreach($ts->getElement('data', $ts->serverGroupList()) as $serverGroup){
           if($serverGroup['sgid'] == $info['groupId']){
             $GroupName = $serverGroup['name'];
           }
         }
         $desc .= str_replace('[clan]', $GroupName, $cfge['groupUserList']['topDesc'])."\n";
         $desc .= $medDesc;
         $desc .= $cfge['groupUserList']['downDesc'];
         $ts->channelEdit($info['channelId'], array(
           'channel_description' => $desc
         ));
       }
     }
     unset($clientArrayList, $medDesc);
  }
private static function checkChannelsInBase($baza, $ts){
  $channelData = $baza->query("SELECT `channelId` FROM `groupUserList`");
  $channelsOnline = $ts->getElement('data', $ts->channelList());
  foreach($channelsOnline as $index => $channelsOnlines){
    $data[$index] =  $channelsOnlines['cid'];
  }
  foreach($channelData as $channel){
    if(!in_array($channel['channelId'], $data)){
      $baza->prepare("DELETE FROM `groupUserList` WHERE `channelId`=:channelId")->execute(array(
        ':channelId' => $channel['channelId']
      ));
    }
  }
  unset($channelData, $channelsOnline);
}
  function start($ts, $cfge, $lang=NULL, $baza){
    self::groupUserListFromCfg($ts, $cfge, $baza);
    self::checkChannelsInBase($baza, $ts);
    self::groupUserListFromBase($ts, $cfge, $baza);
  }
}
 ?>
