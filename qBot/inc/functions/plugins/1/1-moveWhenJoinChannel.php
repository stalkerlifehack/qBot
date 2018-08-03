<?php
class moveWhenJoinChannel{
  function __construct($ts, $cfgp, $null=NULL, $baza){
    foreach($cfgp['moveWhenJoinChannel'] as $data){
      foreach($ts->getElement('data', $ts->channelClientList($data['channelId'], '-groups')) as $client){
        $clientDBID = $client['client_database_id'];
        if($client['cid'] == $data['channelId']){
          if(!empty($data['groupToMove'])){
            if(in_array($data['groupToMove'], explode(",", $client['client_servergroups']))){
              $ts->clientMove($client['clid'], $data['channelToMove']);
            }
            else{
              $ts->clientPoke($client['clid'], $lang['moveWhenJoinChannel']['error']);
              if($data['moveMode']){
                $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
                $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
                if($client['clid'] == $result['clientId'] || !empty($result['clientId'])){
                  $ts->clientMove($client['clid'], $result['channelId']);
                  $ts->clientPoke($clients['clid'], $lang['moveWhenJoinChannel']['last_channel']);
                }
                else{
                  $ts->clientPoke($clients['clid'], $lang['moveWhenJoinChannel']['error_last_channel']);
                }
                unset($clientInfo, $result);
              }
              else{
                $ts->clientKick($client['clid'], 'channel', $lang['moveWhenJoinChannel']['error']);
              }
            }
          }
          else{
            $ts->clientMove($client['clid'], $data['channelToMove']);
          }
        }
      }
    }
  }
}
 ?>
