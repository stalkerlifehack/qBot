<?php
class pokeAdmins{
  function start($ts, $cfge, $lang, $baza){
    foreach($cfge['pokeAdmins'] as $data){
        $a = 0;
        $w = 0;
      foreach($ts->getElement('data', $ts->clientList('-groups -uid')) as $clients){
        $clientDBID = $clients['client_database_id'];
        if($clients['cid'] == $data['channelId']){
            if(!in_array(0, $data['blockedGroups'])){
              if(qBot::difTwoTables(explode(",", $clients['client_servergroups']), $data['blockedGroups'])){
                if(!qBot::difTwoTables(explode(",", $clients['client_servergroups']), $data['adminGroups'])){
                    $ts->clientPoke($clients['clid'], $lang['pokeAdmins']['blocked_group_error']);
                    if($data['moveMode']){
                      $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
                      $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
                      if($clid['clid'] == $result['clientId'] || !empty($result['clientId'])){
                        $ts->clientMove($clients['clid'], $result['channelId']);
                      }
                      else{
                        $ts->clientKick($clients['clid'], 'channel', $lang['pokeAdmins']['blocked_group_error']);
                        $ts->clientPoke($clients['clid'], $lang['pokeAdmins']['last_channel_error']);
                      }
                    }
                    else{
                      $ts->clientKick($clients['clid'], 'channel', $lang['pokeAdmins']['blocked_group_error']);
                    }
                  unset($clients['clid']);
                }
              }
            }
            if(!in_array(0, $data['neededGroups'])){
              if(!qBot::difTwoTables(explode(",", $clients['client_servergroups']), $data['neededGroups'])){
               if(!qBot::difTwoTables(explode(",", $clients['client_servergroups']), $data['adminGroups'])){
                 if(!empty($clients['clid'])){
                   $ts->clientPoke($clients['clid'], $lang['pokeAdmins']['needed_group_error']);
                   if($data['moveMode']){
                     $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
                     $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
                     if($clid['clid'] == $result['clientId'] || !empty($result['clientId'])){
                       $ts->clientMove($clients['clid'], $result['channelId']);
                     }
                     else{
                       $ts->clientKick($clients['clid'], 'channel', $lang['pokeAdmins']['needed_group_error']);
                       $ts->clientPoke($clients['clid'], $lang['pokeAdmins']['last_channel_error']);
                     }
                   }
                   else{
                    $ts->clientKick($clients['clid'], 'channel', $lang['pokeAdmins']['needed_group_error']);
                  }
                 }
                unset($clients['clid']);
                }
              }
            }
            if(qBot::difTwoTables(explode(",", $clients['client_servergroups']), $data['adminGroups'])){
              unset($clients['clid']);
              unset($clients['client_database_id']);
              unset($clients['client_nickname']);
            }
            if(!empty($clients['clid']) && !empty($clients['client_database_id']) && !empty($clients['client_nickname'])){
              $nick[] = array();
              $nick[$w] = $clients['client_nickname'];
              $uid[] = array();
              $uid[$w] = $clients['client_unique_identifier'];
              $clid[] = array();
              $clid[$w] = $clients['clid'];
              $dbid[] = array();
              $dbid[$w] = $clients['client_database_id'];
              $w++;
            }
          }
        }
            $w--;
            if(isset($data['afkAdminGroup'])){
              foreach($ts->getElement('data', $ts->clientList('-groups')) as $admin_clients){
                $admin_client_groups = explode(",", $admin_clients['client_servergroups']);
                if(qBot::difTwoTables($data['adminGroups'], $admin_client_groups)){ //wylapywanie adminow
                  if(!qBot::difTwoTables($data['afkAdminGroup'], $admin_client_groups)){ //wylapywanie tych co maja czas czyli bez rang afk
                    if(!empty($admin_clients['clid'])){
                      $adminID[] = array();
                      $adminID[$a] = $admin_clients['clid'];
                      $adminChID[] = array();
                      $adminChID[$a] = $admin_clients['cid'];
                      $adminNicks[] = array();
                      $adminNicks[$a] = $admin_clients['client_nickname'];
                    }
                    $a++;
                  }
                }
              }
            }
            $a--;
            if(!empty($adminChID)){
              if(!in_array($data['channelId'], $adminChID)){
                $adminOn = implode(",", $adminNicks);
                $adminCount = $a + 1;
                while($w >= 0){
                  $ts->sendMessage(1, $clid[$w], "\nWitaj [b]".$nick[$w]."[/b]\n Aktualna ilość dostępnych administratorów: [b]".$adminCount."[/b]\n(".$adminOn.")\n Zaraz ktoś udzieli ci pomocy :)");
                  if($data['pokeORpw'] == 1){
                    qBot::pokeAdmin($adminID, "[URL=client://0/".$uid[$w]."]".$nick[$w]."[/URL] - oczekuje pomocy!", $ts);
                  }
                  else{
                    $ts->sendMessage(1, $adminID, '[URL=client://0/".$uid[$w]."]".$nick[$w]."[/URL] - oczekuje pomocy!');
                  }
                  $w--;
                }
              }
            }
            else{
              while($w >= 0){
                $ts->clientPoke($clid[$w], $lang['pokeAdmins']['zero_admins']);
                if($data['moveMode']){
                  $clientDb = $dbid[$w];
                  $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDb");
                  $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
                  if($clid[$w] == $result['clientId'] || !empty($result['clientId'])){
                    $ts->clientMove($clid[$w], $result['channelId']);
                  }
                  else{
                    $ts->clientPoke($clid[$w], $lang['pokeAdmins']['last_channel_error']);
                    $ts->clientKick($clid[$w], 'channel', $lang['pokeAdmins']['zero_admins']);
                  }
                }
                else{
                  $ts->clientKick($clid[$w], 'channel', $lang['pokeAdmins']['zero_admins']);
                }
                $w--;
              }
            }
            unset($adminNicks, $adminChID, $adminID);
          }
          unset($nick, $uid, $clid, $a, $w, $clientInfo, $result);
  }
}
?>
