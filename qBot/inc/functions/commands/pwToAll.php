<?php
class pwToAll{
  function __construct($ts, $cfgc, $command){
    if(strstr($command['msg'], '!pwToAll') !== false){
      if(in_array($command['invokeruid'], self::getAllowedClients($ts, $cfgc))){
        $msg = preg_split('/!pwToAll/', $command['msg']);
        foreach($ts->getElement('data', $ts->clientList()) as $client){
          if($client['clid'] != $command['invokerid'] && $client['client_type'] == 0){
            $ts->sendMessage(1, $client['clid'], $msg['1']);
          }
        }  
      }
      else{
        $ts->sendMessage(1, $command['onvokerid'], $cfgc['pwToAll']['notAllowed']);
      }
    }
  }
  private static function getAllowedClients($ts, $cfgc){
    foreach($cfgc['pwToAll']['allowedGroups'] as $group){
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
