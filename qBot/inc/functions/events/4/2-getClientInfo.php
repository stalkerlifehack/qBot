<?php
class getClientInfo{
  private static function writeClientConnectInfo($ts, $baza, $query){
    foreach($ts->getElement('data', $ts->clientList('-times -uid')) as $client){
      if($client['client_type'] == 0 && $client['client_database_id'] != $query['client_database_id']){
        $clId = $client['client_database_id'];
        $data = $baza->query("SELECT `databaseId` FROM `clientLastConnected` WHERE `databaseId`=$clId");
        $result = $data->fetch(PDO::FETCH_ASSOC);
        if(empty($result['databaseId'])){
          $baza->prepare("INSERT INTO `clientLastConnected` SET `databaseId`=:databaseId, `onlineTime`=:onlineTime, `awayTime`=:awayTime, `lastConnected`=:lastConnected")->execute(array(
            ':databaseId' => $client['client_database_id'],
            ':awayTime' => $client['client_idle_time']/1000,
            ':lastConnected' => time(),
            ':onlineTime' => $ts->getElement('data', $ts->clientInfo($client['clid']))['connection_connected_time']/1000
          ));
        }
        else{
          $baza->prepare("UPDATE `clientLastConnected` SET `databaseId`=:databaseId, `awayTime`=:awayTime, `onlineTime`=:onlineTime, `lastConnected`=:lastConnected WHERE `databaseId`=$clId")->execute(array(
            ':databaseId' => $client['client_database_id'],
            ':awayTime' => $client['client_idle_time']/1000,
            ':lastConnected' => time(),
            ':onlineTime' => $ts->getElement('data', $ts->clientInfo($client['clid']))['connection_connected_time']/1000
          ));
        }
      }
    }
  }
  function __construct($ts, $cfge=null, $lang=null, $baza, $query){
    self::writeClientConnectInfo($ts, $baza, $query);
  }
}
 ?>
