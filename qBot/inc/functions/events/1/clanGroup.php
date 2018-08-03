<?php
class clanGroup{
  private static function checkChannelsInBase($baza, $ts){
    $channels_base_clan = $baza->query("SELECT `channelId` FROM  `clanGroup`");
    $channelsOnline = $ts->getElement('data', $ts->channelList());
    foreach($channelsOnline as $index => $channelsOnlines){
      $data[$index] =  $channelsOnlines['cid'];
    }
    foreach($channels_base_clan as $channel){
      if(!in_array($channel['channelId'], $data)){
        $baza->prepare("DELETE FROM `clanGroup` WHERE `channelId`=:channelId")->execute(array(
          ':channelId' => $channel['channelId']
        ));
      }
    }
    unset($channels_base_clan, $data);
  }
  private static function clanGroupFromCfg($ts, $cfge, $lang, $baza){
    if(!empty($cfge['clanGroup']['channels'])){
      foreach($cfge['clanGroup']['channels'] as $data){
        foreach($ts->getElement('data', $ts->channelClientList($data['channelId'], '-groups')) as $clid){
          if($clid['cid'] == $data['channelId']){
            if(!in_array($data['groupGrant'], explode(",", $clid['client_servergroups']))){
              $clientDBID = $clid['client_database_id'];
              $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
              $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
              if($clid['clid'] == $result['clientId'] || !empty($result['clientId'])){
                $ts->serverGroupAddClient($data['groupGrant'], $clid['client_database_id']);
                if($data['moveMode']){
                  $ts->clientMove($clid['clid'], $result['channelId']);
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_and_last_channel']);
                }
                else{
                  $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_added_rank']);
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_added_rank']);
                }
              }
              else{
                $ts->serverGroupAddClient($data['groupGrant'], $clid['client_database_id']);
                $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_added_rank']);
                if($data['moveMode']){
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_and_error_last_channel']);
                }
                else{
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_added_rank']);
                }
              }
            }
            if(in_array($data['groupGrant'], explode(",", $clid['client_servergroups']))){
              $clientDBID = $clid['client_database_id'];
              $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
              $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
              if($clid['clid'] == $result['clientId'] || !empty($result['clientId'])){
                $ts->serverGroupDeleteClient($data['groupGrant'], $clid['client_database_id']);
                if($data['moveMode']){
                  $ts->clientMove($clid['clid'], $result['channelId']);
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_removed_and_last_channel']);
                }
                else{
                  $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_removed_rank']);
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_removed_rank']);
                }
              }
              else{
                $ts->serverGroupDeleteClient($data['groupGrant'], $clid['client_database_id']);
                $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_removed_rank']);
                if($data['moveMode']){
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_and_error_last_channel']);
                }
                else{
                  $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_removed_rank']);
                }
              }
            }
          }
        }
      }
      unset($clientInfo);
    }
  }
  private static function clanGroupFromBase($ts, $cfge, $lang, $baza){
    $infos = $baza->query("SELECT `channelId`, `groupId` FROM  `clanGroup`");
    foreach($infos as $data){
      foreach($ts->getElement('data', $ts->channelClientList($data['channelId'], '-groups')) as $clid){
        if($clid['cid'] == $data['channelId']){
          if(!in_array($data['groupId'], explode(",", $clid['client_servergroups']))){
            $clientDBID = $clid['client_database_id'];
            $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
            $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
            if($clid['clid'] == $result['clientId'] || !empty($result['clientId'])){
              $ts->serverGroupAddClient($data['groupId'], $clid['client_database_id']);
              if($cfge['clanGroup']['baseMoveMode']){
                $ts->clientMove($clid['clid'], $result['channelId']);
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_and_last_channel']);
              }
              else{
                $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_added_rank']);
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_added_rank']);
              }
            }
            else{
              $ts->serverGroupAddClient($data['groupId'], $clid['client_database_id']);
              $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_added_rank']);
              if($cfge['clanGroup']['baseMoveMode']){
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_and_error_last_channel']);
              }
              else{
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_added_rank']);
              }
            }
          }
          if(in_array($data['groupId'], explode(",", $clid['client_servergroups']))){
            $clientDBID = $clid['client_database_id'];
            $clientInfo = $baza->query("SELECT `clientId`, `channelId` FROM lastClientChannel WHERE `databaseId`=$clientDBID");
            $result = $clientInfo->fetch(PDO::FETCH_ASSOC);
            if($clid['clid'] == $result['clientId'] || !empty($result['clientId'])){
              $ts->serverGroupDeleteClient($data['groupId'], $clid['client_database_id']);
              if($cfge['clanGroup']['baseMoveMode']){
                $ts->clientMove($clid['clid'], $result['channelId']);
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_removed_and_last_channel']);
              }
              else{
                $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_removed_rank']);
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_removed_rank']);
              }
            }
            else{
              $ts->serverGroupDeleteClient($data['groupId'], $clid['client_database_id']);
              $ts->clientKick($clid['clid'], 'channel', $lang['clanGroup']['success_removed_rank']);
              if($cfge['clanGroup']['baseMoveMode']){
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_and_error_last_channel']);
              }
              else{
                $ts->clientPoke($clid['clid'], $lang['clanGroup']['success_removed_rank']);
              }
            }
          }
        }
      }
    }
    unset($clientInfo);
  }
  function __construct($ts, $cfge, $lang, $baza){
    self::clanGroupFromCfg($ts, $cfge, $lang, $baza);
    if($cfge['clanGroup']['baseClanGroupEnabled']){
      self::checkChannelsInBase($baza, $ts);
      self::clanGroupFromBase($ts, $cfge, $lang, $baza);
    }
  }
}
?>
