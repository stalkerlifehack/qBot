<?php
class pokeToAll{
  function __construct($ts, $cfgc, $command){
    if(strstr($command['msg'], '!pokeToAll') !== false){
      if(in_array($command['invokeruid'], self::getAllowedClients($ts, $cfgc))){
        $msg = preg_split('/!pokeToAll/', $command['msg']);
        if(strlen($msg[1]) < 100){
          foreach($ts->getElement('data', $ts->clientList()) as $client){
            if($client['clid'] != $command['invokerid'] && $client['client_type'] == 0){
              $ts->clientPoke($client['clid'], $msg['1']);
            }
          }
        }
        else{
          $ts->sendMessage(1, $command['invokerid'], $cfgc['pokeToAll']['errorLong']);
        }
      }
      else{
        $ts->sendMessage(1, $command['invokerid'], $cfgc['pokeToAll']['notAllowed']);
      }
    }
  }
  private static function getAllowedClients($ts, $cfgc){
    foreach($cfgc['pokeToAll']['allowedGroups'] as $group){
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
