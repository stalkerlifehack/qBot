<?php
class ddosAlert{
  private static function checkStatus(){
    $fp = fopen("cache/ddosAlert.txt", "r");
    $status = fread($fp, filesize("cache/ddosAlert.txt"));
    fclose($fp);
    return $status;
  }
  private static function writeZero(){
    $fp = fopen("cache/ddosAlert.txt", "w");
    fputs($fp, '0');
    fclose($fp);
  }
  private static function writeOne(){
    $fp = fopen("cache/ddosAlert.txt", "w");
    fputs($fp, '1');
    fclose($fp);
  }
  function __construct($ts, $cfge, $lang){
  if(round($ts->getElement('data', $ts->serverInfo())['virtualserver_total_packetloss_total'], 2) >= $cfge['ddosAlert']['packetLoss']){
      if(self::checkStatus() == 0){
        foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
          if(qBot::difTwoTables($cfge['ddosAlert']['groups'], explode(",", $client['client_servergroups']))){
            $ts->clientPoke($client['clid'], $cfge['ddosAlert']['message']);
          }
        }
      }
      self::writeOne();
    }
    else{//mniejszy
      if(self::checkStatus() == 1 || empty(self::checkStatus())){
        self::writeZero();
      }
    }
  }
}
 ?>
