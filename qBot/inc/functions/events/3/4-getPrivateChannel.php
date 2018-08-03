<?php
class getPrivateChannel{
  private static function saveToBase($baza, $dataBaseId, $channelId){
    $baza->prepare("INSERT INTO `getPrivateChannel` SET `channelId`=:channelId, `dataBaseId`=:dataBaseId")->execute(array(
      ':channelId' => $channelId,
      ':dataBaseId' => $dataBaseId
    ));
  }
  private static function hasClientChannel($baza, $databaseId){
    $data = $baza->query("SELECT `channelId` FROM `getPrivateChannel` WHERE `dataBaseId`=$databaseId");
    $result = $data->fetch(PDO::FETCH_ASSOC);
    return $result['channelId'];
  }
  public static function getChannelNumber($baza){
    $data = $baza->query("SELECT `channelId` FROM `getPrivateChannel`");
    foreach($data as $channelId){
      $channel[] = $channelId;
    }
    if(!empty($channel)){
      $number = count($channel);
    }
    else{
      $number = 0;
    }
    return $number;
  }

  function __construct($ts, $cfge, $lang, $baza){

    foreach($ts->getElement('data', $ts->channelClientList($cfge['getPrivateChannel']['channelId'], '-groups')) as $client){
      if($client['cid'] == $cfge['getPrivateChannel']['channelId']){
        if(empty(self::hasClientChannel($baza, $client['client_database_id']))){
          $chName = (self::getChannelNumber($baza) + 1);
          $replaces = array(
            1 => array(1 => '[num]', 2 => $chName),
            2 => array(1 => '[nick]', 2 => $client['client_nickname']),
            3 => array(1 => '[passwd]', 2 => $cfge['getPrivateChannel']['passwd']),
            4 => array(1 => '[date]', 2 => date('Y-m-d'))
          );

          $msg = qBot::replaceInfo($cfge['getPrivateChannel']['channelName'], $replaces);
          $data = $ts->getElement('data', $ts->channelCreate(array(
            'CHANNEL_NAME' => $msg,
            'CHANNEL_FLAG_PERMANENT' => 1,
            'CHANNEL_PASSWORD' => $cfge['getPrivateChannel']['passwd'],
            'CPID' => $cfge['getPrivateChannel']['zoneId'],
            'CHANNEL_TOPIC' => date('Y-m-d')
          )));
          $lang['getPrivateChannel']['channelDesc'] .= $cfge['getPrivateChannel']['downDesc'];

          $ts->channelEdit($data['cid'], array(
            'channel_description' => qBot::replaceInfo($lang['getPrivateChannel']['channelDesc'], $replaces),
          ));
          $ts->clientMove($client['clid'], $data['cid']);
          $msg_pw = qBot::replaceInfo($lang['getPrivateChannel']['msg'], $replaces);
          $ts->sendMessage(1, $client['clid'], $msg_pw);
          $ts->channelGroupAddClient($cfge['getPrivateChannel']['channelGroup'], $data['cid'], $client['client_database_id']);
          for($i=0; $i < $cfge['getPrivateChannel']['subChannels']; $i++){
            $chName = str_replace('[num]', $i + 1, $cfge['getPrivateChannel']['subChannelName']);
            $ts->channelCreate(array(
              'CHANNEL_NAME' => $chName,
              'CHANNEL_FLAG_PERMANENT' => 1,
              'CHANNEL_PASSWORD' => $cfge['getPrivateChannel']['passwd'],
              'CPID' => $data['cid']
            ));
          }
          self::saveToBase($baza, $client['client_database_id'], $data['cid']);
        }
        else{
          $ts->clientMove($client['clid'], self::hasClientChannel($baza, $client['client_database_id']));

          $ts->sendMessage(1, $client['clid'], str_replace('[nick]', $client['client_nickname'], $lang['getPrivateChannel']['hasChannel']));
        }
      }
    }
  }
}
 ?>
