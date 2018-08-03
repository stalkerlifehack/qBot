<?php
class meeting{
  function __construct($ts, $cfgc, $command){
    if(strstr($command['msg'], '!meeting') !== false){
      if(in_array($command['invokeruid'], self::getAllowedClients($ts, $cfgc))){
        $msg = preg_split('/[( )]/', $command['msg']);
        foreach(explode(",", $msg[2]) as $group){
          foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
            if(in_array($group, explode(",", $client['client_servergroups']))){
              $ts->clientMove($client['clid'], $msg[4]);
              $ts->sendMessage(1, $client['clid'], $cfgc['meeting']['msg']);
            }
          }
        }
      }
      else{
        $ts->sendMessage(1, $command['invokerid'], $cfgc['meeting']['notAllowed']);
      }
    }
  }
  private static function getAllowedClients($ts, $cfgc){
    foreach($cfgc['meeting']['allowedGroups'] as $group){
      foreach($ts->getElement('data', $ts->serverGroupClientList($group, true)) as $client){
        if(!empty($client)){
          $allowedClients[] = $client['client_unique_identifier'];
        }
        else{
          $allowedClients[] = 0;
        }
      }
    }
    return $allowedClients;
  }
}
 ?>
