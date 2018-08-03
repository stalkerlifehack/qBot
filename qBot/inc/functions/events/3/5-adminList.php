<?php
class adminList{
  function __construct($ts, $cfge, $lang=null, $baza){
    $groupName = '';
    foreach($cfge['adminList']['adminGroups'] as $group){
      foreach($ts->getElement('data', $ts->serverGroupList()) as $sgInfo){
        if($sgInfo['sgid'] == $group){
          $groupName .= "[list][*][b]".$sgInfo['name']."[/b][list]";
        }
      }
      foreach($ts->getElement('data', $ts->serverGroupClientList($group, true)) as $admin){
        foreach($ts->getElement('data', $ts->clientList('-groups -times -uid')) as $client){
          if(!empty($admin['cldbid'])){
            if($admin['cldbid'] == $client['client_database_id']){
              $a = 'a';
              if(($client['client_idle_time']/1000) > $cfge['adminList']['timeAfk']){
                $chName = $ts->getElement('data', $ts->channelInfo($client['cid']))['channel_name'];
                $groupName .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] jest ".$cfge['adminList']['awayPrefix'].qBot::convertSeconds(($client['client_idle_time']/1000))." [b]($chName)[/b]"."[/size]";
              }
              else{
                $cldbid = $client['client_database_id'];
                $dataBase = $baza->query("SELECT `onlineTime` FROM `clientLastConnected` WHERE `databaseId`=$cldbid");
                $result = $dataBase->fetch(PDO::FETCH_ASSOC);
                $chName = $ts->getElement('data', $ts->channelInfo($client['cid']))['channel_name'];
                $groupName .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] jest ".$cfge['adminList']['onlinePrefix'].qBot::convertSeconds($result['onlineTime'])." [b]($chName)[/b]"."[/size]";
              }
            }
          }
        }
      }
      if(empty($a)){
        $groupName .= "[*] [size=11][i]Brak administratorów[/i][/size]";
      }
      $groupName .= "[/list]";
      unset($a);
      $groupName .= "[/list]";
    }
    $cfge['adminList']['topDesc'] .= $groupName;
    $cfge['adminList']['topDesc'] .= $cfge['adminList']['downDesc'];
    $ts->channelEdit($cfge['adminList']['channelId'], array(
      'channel_description' => $cfge['adminList']['topDesc']
    ));
  }
}
 ?>
