<?php
class registerChannel{
  function start($ts, $cfge, $lang, $baza){
    foreach($cfge['registerChannel'] as $index => $groupId){
      $tab[$index] = $groupId['groupId'];
    }
    foreach($cfge['registerChannel'] as $data){
      foreach($ts->getElement('data', $ts->channelClientList($data['channelId']), "-groups") as $client){
        $clientInfo = $ts->getElement('data', $ts->clientInfo($client['clid']));
        $clientDBID = $client['client_database_id'];
        $timeSpent = $baza->query("SELECT `totalTime` FROM topTimeSpent WHERE `databaseId`=$clientDBID");
        $result_time = $timeSpent->fetch(PDO::FETCH_ASSOC);
        if($data['moveMode']){
          $client_db = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
          $result = $client_db->fetch(PDO::FETCH_ASSOC);
        }
        if(empty($result_time['totalTime'])){
          $result_time['totalTime'] = 0;
        }

          if(!qBot::difTwoTables($tab, explode(",", $clientInfo['client_servergroups']))){
            if($clientInfo['client_totalconnections'] >= $data['requiredConnections'] && $result_time['totalTime'] >= $data['timeRequired']){
              $ts->serverGroupAddClient($data['groupId'], $client['client_database_id']);
              $ts->clientPoke($client['clid'], $lang['registerChannel']['added_successful']);
              if($data['moveMode']){
                if($client['clid'] == $result['clientId'] || !empty($result['clientId'])){
                  $ts->clientMove($client['clid'], $result['channelId']);
                  $ts->clientPoke($client['clid'], $lang['registerChannel']['moved_last_channel']);
                }
                else{
                  $ts->clientKick($client['clid'], 'channel', $lang['registerChannel']['added_successful']);
                  $ts->clientPoke($client['clid'], $lang['registerChannel']['move_last_channel_error']);
                }
              }
              else{
                $ts->clientKick($client['clid'], 'channel', $lang['registerChannel']['added_successful']);
                $ts->clientPoke($client['clid'], $lang['registerChannel']['added_successful']);
              }
            }
            else{
              $ts->clientPoke($client['clid'], $lang['registerChannel']['error_require']);
              if($data['moveMode']){
                if($client['clid'] == $result['clientId'] || !empty($result['clientId'])){
                  $ts->clientMove($result['clientId'], $result['channelId']);
                  $ts->clientPoke($client['clid'], $lang['registerChannel']['moved_last_channel']);
                }
                else{
                  $ts->clientPoke($client['clid'], $lang['registerChannel']['move_last_channel_error']);
                  $ts->clientKick($client['clid'], 'channel', $lang['registerChannel']['error_require']);
                }
              }
              else{
                $ts->clientKick($client['clid'], 'channel', $lang['registerChannel']['error_require']);
              }
            }
          }
          else{
            $ts->clientPoke($client['clid'], $lang['registerChannel']['client_have_group']);
            if($data['moveMode']){
              if($client['clid'] == $result['clientId'] || !empty($result['clientId'])){
                $ts->clientMove($client['clid'], $result['channelId']);
                $ts->clientPoke($client['clid'], $lang['registerChannel']['moved_last_channel']);
              }
              else{
                $ts->clientKick($client['clid'], 'channel', $lang['registerChannel']['move_last_channel_error']);
              }
            }
            else{
              $ts->clientKick($client['clid'], 'channel', $lang['registerChannel']['client_have_group']);
            }
          }

      }
    }
  }
}
 ?>
