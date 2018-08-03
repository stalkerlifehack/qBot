<?php
class musicBotChecker{

  function __construct($ts, $cfge){
    $status['online']  = '[left][size=14]Lista botów aktywnych:[/size][/left][size=13][list]';
    $status['offline'] = '[left][size=14]Lista botów offline:[/size][/left][size=13][list]';
    $status['away'] = '[left][size=14]Lista botów nieaktywnych:[/size][/left][size=13][list]';
    foreach($cfge['musicBotChecker']['groups'] as $group){
      foreach($ts->getElement('data', $ts->serverGroupClientList($group, true)) as $data){
        $return = true;
        foreach($ts->getElement('data', $ts->clientList()) as $index => $client_dbid){
          $info[$index] = $client_dbid['client_database_id'];
        }
        foreach($ts->getElement('data', $ts->clientList('-times')) as $client){
          $chName = $ts->getElement('data', $ts->channelInfo($client['cid']))['channel_name'];
          $clInfo = $ts->getElement('data', $ts->clientInfo($client['clid']));
          if($clInfo['client_database_id'] == $data['cldbid'] && in_array($data['cldbid'], $info)){
            if($client['client_idle_time']/1000 > 1 && in_array($group, explode(",", $clInfo['client_servergroups']))){
              $c = 'c';
              $status['away'] .= "[*] [size=11][URL=client://0/".$data['client_unique_identifier']."]".$data['client_nickname']."[/URL] jest na kanale: [URL=channelid://".$client['cid']."] $chName [/URL][/size]";
            }
            else{
              $b = 'b';
              $status['online'] .= "[*] [size=11][URL=client://0/".$data['client_unique_identifier']."]".$data['client_nickname']."[/URL] jest na kanale: [URL=channelid://".$client['cid']."] $chName [/URL][/size]";
            }
              $return = false;
            }
          }
          if($return){
            $a = 'a';
            $status['offline'] .= "[*] [size=11][URL=client://0/".$data['client_unique_identifier']."]".$data['client_nickname']."[/URL] [/size]";
            unset($channelNameOff);
          }
        }
      }
      if(empty($a)){
        $status['offline'] .= "[*] [size=11][i]Brak botów[/i][/size]";
      }
      if(empty($b)){
        $status['online'] .= "[*] [size=11][i]Brak botów[/i][/size]";
      }
      if(empty($c)){
        $status['away'] .= "[*] [size=11][i]Brak botów[/i][/size]";
      }
      $status['online'] .= "[/list][/size]";
      $status['offline'] .= "[/list][/size]";
      $status['away'] .= "[/list][/size]";
      $cfge['musicBotChecker']['topDesc'] .= $status['online'];
      $cfge['musicBotChecker']['topDesc'] .= $status['away'];
      $cfge['musicBotChecker']['topDesc'] .= $status['offline'];
      $cfge['musicBotChecker']['topDesc'] .= $cfge['musicBotChecker']['downDesc'];
      if(qBot::ifChannelDescriptionSame($cfge['musicBotChecker']['channelId'], $cfge['musicBotChecker']['topDesc'], $ts)){
        $test = $ts->channelEdit($cfge['musicBotChecker']['channelId'], array(
          'channel_description' => $cfge['musicBotChecker']['topDesc']
        ));
      }
    unset($return, $info);
  }
}
 ?>
