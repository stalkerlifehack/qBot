<?php
class groupUserList{

  private static function groupUserListFromCfg($ts, $cfge, $baza){
    foreach($ts->getElement('data', $ts->clientList()) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }
    if(!empty($cfge['groupUserList']['channels'])){

      foreach($cfge['groupUserList']['channels'] as $data){ //foreach z cfg
        $status['online'] = '[left][size=14]Lista użytkowników '.$data['onlinePrefix'].':[/size][/left][size=13][list]';
        $status['offline'] = '[left][size=14]Lista użytkowników '.$data['offlinePrefix'].':[/size][/left][size=13][list]';
        $status['away'] = '[left][size=14]Lista użytkowników '.$data['awayPrefix'].':[/size][/left][size=13][list]';
        foreach($ts->getElement('data', $ts->serverGroupClientList($data['groupId'], true)) as $client){
          if(!empty($client['cldbid'])){
            if(in_array($client['cldbid'], $clientArrayList)){
              $cldbid = $client['cldbid'];
              $dataBase = $baza->query("SELECT `awayTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
              $result = $dataBase->fetch(PDO::FETCH_ASSOC);

              if($result['awayTime'] >= $data['idleTime']){
                $status['away'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] od: ".qBot::convertSeconds($result['awayTime'])."[/size]";
                $a = 'a';
              }
              else{
                $cldbid = $client['cldbid'];
                $dataBase = $baza->query("SELECT `onlineTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
                $result = $dataBase->fetch(PDO::FETCH_ASSOC);
                $status['online'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] od: ".qBot::convertSeconds($result['onlineTime'])."[/size]";
                $b = 'b';
              }
            }
            else{
              $cldbid = $client['cldbid'];
              $dataBase = $baza->query("SELECT `lastConnected` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
              $result = $dataBase->fetch(PDO::FETCH_ASSOC);
              $status['offline'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] od: ".qBot::convertSeconds(time() - $result['lastConnected'])."[/size]";
              $c = 'c';
            }
          }
        }
        $desc = '';
        foreach($ts->getElement('data', $ts->serverGroupList()) as $serverGroup){
          if($serverGroup['sgid'] == $data['groupId']){
            $GroupName = $serverGroup['name'];
          }
        }
        if(empty($a)){
          $status['away'] .= "[*] [size=11][i]Brak użytkowników[/i][/size]";
        }
        if(empty($b)){
          $status['online'] .= "[*] [size=11][i]Brak użytkowników[/i][/size]";
        }
        if(empty($c)){
          $status['offline'] .= "[*] [size=11][i]Brak użytkowników[/i][/size]";
        }
        $status['online'] .= "[/list][/size]";
        $status['offline'] .= "[/list][/size]";
        $status['away'] .= "[/list][/size]";

        $desc .= str_replace('[clan]', $GroupName, $data['topDesc']);
        $desc .= $status['online'];
        $desc .= $status['away'];
        $desc .= $status['offline'];

        $desc .= $data['downDesc'];
        if(qBot::ifChannelDescriptionSame($data['channelId'], $desc, $ts)){
          $ts->channelEdit($data['channelId'], array(
            'channel_description' => $desc
          ));
        }
      }
      unset($clientArrayList, $dataBase, $desc, $status, $result);
    }
  }
  private static function groupUserListFromBase($ts, $cfge, $baza){
    foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $index => $clientList){
      $clientArrayList[$index] = $clientList['client_database_id'];
    }

    $dataBase = $baza->query("SELECT `channelId`, `groupId` FROM `groupUserList`");
     foreach($dataBase as $info){
       $status['online'] = '[left][size=14]Lista użytkowników '.$cfge['groupUserList']['onlinePrefix'].':[/size][/left][size=13][list]';
       $status['offline'] = '[left][size=14]Lista użytkowników '.$cfge['groupUserList']['offlinePrefix'].':[/size][/left][size=13][list]';
       $status['away'] = '[left][size=14]Lista użytkowników '.$cfge['groupUserList']['awayPrefix'].':[/size][/left][size=13][list]';
        foreach($ts->getElement('data', $ts->serverGroupClientList($info['groupId'], true)) as $client){
          if(!empty($client['cldbid'])){
           if(in_array($client['cldbid'], $clientArrayList)){
             $cldbid = $client['cldbid'];
             $dataBase = $baza->query("SELECT `awayTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
             $result = $dataBase->fetch(PDO::FETCH_ASSOC);
             if($result['awayTime'] >= $cfge['groupUserList']['idleTime']){
               $status['away'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] od: ".qBot::convertSeconds($result['awayTime'])."[/size]";
               $a = 'a';
             }
             else{
               $cldbid = $client['cldbid'];
               $dataBase = $baza->query("SELECT `onlineTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
               $result = $dataBase->fetch(PDO::FETCH_ASSOC);
               $status['online'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] od: ".qBot::convertSeconds($result['onlineTime'])."[/size]";
              $b = 'b';
             }
           }
           else{
             $cldbid = $client['cldbid'];
             $dataBase = $baza->query("SELECT `lastConnected` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
             $result = $dataBase->fetch(PDO::FETCH_ASSOC);
             $status['offline'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] od: ".qBot::convertSeconds(time() - $result['lastConnected'])."[/size]";
             $c = 'c';
           }
         }
       }

       $desc = '';
       foreach($ts->getElement('data', $ts->serverGroupList()) as $serverGroup){
         if($serverGroup['sgid'] == $info['groupId']){
           $GroupName = $serverGroup['name'];
         }
       }
       if(empty($a)){
         $status['away'] .= "[*] [size=11][i]Brak użytkowników[/i][/size]";
       }
       if(empty($b)){
         $status['online'] .= "[*] [size=11][i]Brak użytkowników[/i][/size]";
       }
       if(empty($c)){
         $status['offline'] .= "[*] [size=11][i]Brak użytkowników[/i][/size]";
       }

       $status['online'] .= "[/list][/size]";
       $status['offline'] .= "[/list][/size]";
       $status['away'] .= "[/list][/size]";

       $desc .= str_replace('[clan]', $GroupName, $cfge['groupUserList']['topDesc']);
       $desc .= $status['online'];
       $desc .= $status['away'];
       $desc .= $status['offline'];
       $desc .= $cfge['groupUserList']['downDesc'];
       if(qBot::ifChannelDescriptionSame($info['channelId'], $desc, $ts)){
         $ts->channelEdit($info['channelId'], array(
           'channel_description' => $desc
         ));
       }
     }
     unset($clientArrayList, $dataBase, $desc, $status, $result);
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
  function __construct($ts, $cfge, $lang=NULL, $baza){
    self::groupUserListFromCfg($ts, $cfge, $baza);
    self::checkChannelsInBase($baza, $ts);
    self::groupUserListFromBase($ts, $cfge, $baza);
  }
}
 ?>
