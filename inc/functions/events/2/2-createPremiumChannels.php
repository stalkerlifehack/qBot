<?php
class createPremiumChannels{
  private static function ifClientAreOnChannel($clientChannel, $channel){
    if($clientChannel == $channel){
      return true;
    }
    else{
      return false;
    }
  }
  private static function randomNumber($chName){
    return str_replace('[num]', rand(0, 99999), $chName);
  }
  private static function saveInfoToDataBase($baza, $channelId, $invokerId, $index, $groupId){
    $baza->prepare("INSERT INTO `createPremiumChannels` SET `channelId`=:channelId, `databaseId`=:databaseId, `index`=:index, `groupId`=:groupId")->execute(array(
      ':channelId' => $channelId,
      ':databaseId' => $invokerId,
      ':index' => $index,
      ':groupId' => $groupId
    ));
  }
  private static function ifChannelExist($baza){
    $data = $baza->query("SELECT `channelId` FROM  `createPremiumChannels` ORDER BY MAX(`index`)");
    $lastChannel = $data->fetch(PDO::FETCH_ASSOC);
    if(empty($lastChannel['channelId'])){
      return false;
    }
    else{
      return true;
    }
    unset($data, $lastChannel);
  }
  private static function getInfoFromBase($baza){
    $infoFromBase = $baza->query("SELECT `index`, `channelId` FROM `createPremiumChannels` ORDER BY `index` DESC LIMIT 1");
    $indexInfo = $infoFromBase->fetch(PDO::FETCH_ASSOC);
    return $indexInfo;
    unset($infoFromBase);
  }
  private static function getArrayInfoFromBase($baza, $database){
    $arrayInfo = $baza->query("SELECT `databaseId` FROM  `createPremiumChannels` WHERE `databaseId`=$database");
    $arrayChannel = $arrayInfo->fetch(PDO::FETCH_ASSOC);
    return $arrayChannel;
    unset($arrayInfo);
  }
  private static function checkChannels($baza, $ts){
    $checkChannel = $baza->query("SELECT `channelId`, `index` FROM  `createPremiumChannels`");
    foreach($ts->getElement('data', $ts->channelList()) as $index => $channelServer){
      $channelServerCheck[$index] = $channelServer['cid'];
    }
    while ($arrayCheck = $checkChannel->fetch()){
      if(!in_array($arrayCheck['channelId'], $channelServerCheck)){
        $chId = $arrayCheck['channelId'];
        $delGroupInfo = $baza->query("SELECT `groupId` FROM `createPremiumChannels` WHERE `channelId`=$chId");
        $group = $delGroupInfo->fetch(PDO::FETCH_ASSOC);
        $ts->serverGroupDelete($group['groupId'], 1);
        $baza->query("DELETE FROM `createPremiumChannels` WHERE `channelId`=$chId");
      }
    }
    unset($checkChannel);
  }
  private static function writeFunctionChannelsIntoDb($baza, $channelToGrant, $channelToOnline, $groupId){
    $baza->prepare("INSERT INTO `clanGroup` SET `channelId`=:channelId, `groupId`=:groupId")->execute(array(
      ':channelId' => $channelToGrant,
      ':groupId' => $groupId,
    ));
    $baza->prepare("INSERT INTO `groupUserList` SET `channelId`=:channelId, `groupId`=:groupId")->execute(array(
      ':channelId' => $channelToOnline,
      ':groupId' => $groupId,
    ));
    $baza->prepare("INSERT INTO `groupOnline` SET `channelId`=:channelId, `groupId`=:groupId")->execute(array(
      ':channelId' => $channelToOnline,
      ':groupId' => $groupId,
    ));
  }
  private static function writeIntoClanGroup($groupCreate, $channelId, $baza){
    $baza->prepare("INSERT INTO `clanGroup` SET `channelId`=:channelId, `groupId`=:groupId")->execute(array(
      ':channelId' => $channelId,
      ':groupId' => $groupCreate,
    ));
  }
private static function writeInfoChanneClientInfo($channelId, $baza, $groupCreate){
  $baza->prepare("INSERT INTO `groupOnline` SET `channelId`=:channelId, `groupId`=:groupId")->execute(array(
    ':channelId' => $channelId,
    ':groupId' => $groupCreate,
  ));
  $baza->prepare("INSERT INTO `groupUserList` SET `channelId`=:channelId, `groupId`=:groupId")->execute(array(
    ':channelId' => $channelId,
    ':groupId' => $groupCreate
  ));
}
  function start($ts, $cfge, $lang, $baza){
    self::checkChannels($baza, $ts);
    $clients = $ts->getElement('data', $ts->channelClientList($cfge['createPremiumChannels']['channelId']));
    foreach($clients as $client){
      if(self::ifClientAreOnChannel($client['cid'], $cfge['createPremiumChannels']['channelId'])){
        $groupCreate = $ts->getElement('data', $ts->serverGroupCopy($cfge['createPremiumChannels']['groupToCopy'], 0, $client['client_nickname']." - Premium", 1));
        if(self::ifChannelExist($baza)){ //jeśli tablica nie jest pusta, czyli jesli są jakieś kanały
          if(empty(self::getArrayInfoFromBase($baza, $client['client_database_id']))){
            foreach($cfge['createPremiumChannels']['channels'] as $index => $channelArray){
              if($index == 0){
                if($channelArray['type'] == 'normal'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => self::getInfoFromBase($baza)['channelId'],
                  )));
                }
                elseif($channelArray['type'] == 'onlineOnChannel'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                  self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
                }
                elseif($channelArray['type'] == 'clanGroup'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                  $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                  self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
                }
                elseif($channelArray['type'] == 'addChannelGroup'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                  $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                }
                if(!empty($channelArray['sub'])){
                  foreach($channelArray['sub'] as $sub){
                    if($sub['type'] == 'normal'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'channel_order' => $channelData['cid'],
                      )));
                    }
                    elseif($sub['type'] == 'onlineOnChannel'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'channel_order' => $channelData['cid'],
                      )));
                      self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
                    }
                    elseif($sub['type'] == 'clanGroup'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'channel_order' => $channelData['cid'],
                      )));
                      $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                      self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
                    }
                    elseif($sub['type'] == 'addChannelGroup'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'channel_order' => $channelData['cid'],
                      )));
                      $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                    }
                  }
                }
              }
              else{
                if($channelArray['type'] == 'normal'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                }
                elseif($channelArray['type'] == 'onlineOnChannel'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                  self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
                }
                elseif($channelArray['type'] == 'clanGroup'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                  $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                  self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
                }
                elseif($channelArray['type'] == 'addChannelGroup'){
                  $channelData = $ts->getElement('data', $ts->channelCreate(array(
                    'channel_name' => self::randomNumber($channelArray['channelName']),
                    'channel_flag_permanent' => 1,
                    'channel_maxclients' => 0,
                    'channel_flag_maxclients_unlimited' => 0,
                    'channel_order' => $channelData['cid'],
                  )));
                  $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                }
                if(!empty($channelArray['sub'])){
                  foreach($channelArray['sub'] as $sub){
                    if($sub['type'] == 'normal'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'cpid' => $channelData['cid'],
                      )));
                    }
                    elseif($sub['type'] == 'onlineOnChannel'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'cpid' => $channelData['cid'],
                      )));
                      self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
                    }
                    elseif($sub['type'] == 'clanGroup'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'cpid' => $channelData['cid'],
                      )));
                      $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                      self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
                    }
                    elseif($sub['type'] == 'addChannelGroup'){
                      $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                        'channel_name' => $sub['channelName'],
                        'channel_flag_permanent' => 1,
                        'channel_maxclients' => 0,
                        'channel_flag_maxclients_unlimited' => 0,
                        'cpid' => $channelData['cid'],
                      )));
                      $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                    }
                  }
                }
              }
            }
            $newIndex = self::getInfoFromBase($baza)['index'] + 1;
            self::saveInfoToDataBase($baza, $channelData['cid'], $client['client_database_id'], $newIndex, $groupCreate['sgid']);
          }
          else{
          }
        }
        else{
          foreach($cfge['createPremiumChannels']['channels'] as $index => $channelArray){
            if($index == 0){
              if($channelArray['type'] == 'normal'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $cfge['createPremiumChannels']['firstChannel'],
                )));
              }
              elseif($channelArray['type'] == 'onlineOnChannel'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
                self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
              }
              elseif($channelArray['type'] == 'clanGroup'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
                $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
              }
              elseif($channelArray['type'] == 'addChannelGroup'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
                $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
              }
              if(!empty($channelArray['sub'])){
                foreach($channelArray['sub'] as $sub){
                  if($sub['type'] == 'normal'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                  }
                  elseif($sub['type'] == 'onlineOnChannel'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                    self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
                  }
                  elseif($sub['type'] == 'clanGroup'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                    $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                    self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
                  }
                  elseif($sub['type'] == 'addChannelGroup'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                    $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                  }
                }
              }
            }
            else{
              if($channelArray['type'] == 'normal'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
              }
              elseif($channelArray['type'] == 'onlineOnChannel'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
                self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
              }
              elseif($channelArray['type'] == 'clanGroup'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
                $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
              }
              elseif($channelArray['type'] == 'addChannelGroup'){
                $channelData = $ts->getElement('data', $ts->channelCreate(array(
                  'channel_name' => self::randomNumber($channelArray['channelName']),
                  'channel_flag_permanent' => 1,
                  'channel_maxclients' => 0,
                  'channel_flag_maxclients_unlimited' => 0,
                  'channel_order' => $channelData['cid'],
                )));
                $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
              }
              if(!empty($channelArray['sub'])){
                foreach($channelArray['sub'] as $sub){
                  if($sub['type'] == 'normal'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                  }
                  elseif($sub['type'] == 'onlineOnChannel'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                    self::writeInfoChanneClientInfo($channelData['cid'], $baza, $groupCreate['sgid']);
                  }
                  elseif($sub['type'] == 'clanGroup'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                    $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                    self::writeIntoClanGroup($groupCreate['sgid'], $channelData['cid'], $baza);
                  }
                  elseif($sub['type'] == 'addChannelGroup'){
                    $subChannelData = $ts->getElement('data', $ts->channelCreate(array(
                      'channel_name' => $sub['channelName'],
                      'channel_flag_permanent' => 1,
                      'channel_maxclients' => 0,
                      'channel_flag_maxclients_unlimited' => 0,
                      'cpid' => $channelData['cid'],
                    )));
                    $ts->channelGroupAddClient($cfge['createPremiumChannels']['channelAdminGroupId'], $channelData['cid'], $client['client_database_id']);
                  }
                }
              }
            }
          }
          self::saveInfoToDataBase($baza, $channelData['cid'], $client['client_database_id'], 1, $groupCreate['sgid']);
        }
      }
    }
  }
}
 ?>
