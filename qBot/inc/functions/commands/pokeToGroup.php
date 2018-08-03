<?php
class pokeToGroup{
  function __construct($ts, $cfgc, $command){
    if(strstr($command['msg'], '!pokeToGroup') !== false){
      if(in_array($command['invokeruid'], self::getAllowedClients($ts, $cfgc))){
      $msg = preg_split('/[()]/', $command['msg']);
        if(strlen($msg[1]) < 100){
          $i = 0;
          foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
            if(in_array($msg[1], explode(",", $client['client_servergroups']))){
            $i++;
              $ts->clientPoke($client['clid'], $msg[2]);
            }
          }
          if($i == 0){
            $ts->sendMessage(1, $command['invokerid'], $cfgc['pokeToGroup']['errorClient']);
          }
          else{
            $ts->sendMessage(1, $command['invokerid'], str_replace('[count]', $i, $cfgc['pokeToGroup']['successPoke']));
          }
        }
        else{
          $ts->sendMessage(1, $command['invokerid'], $cfgc['pokeToGroup']['errorLong']);
        }  
      }
      else{
        $ts->sendMessage(1, $command['invokerid'], $cfgc['pokeToGroup']['notAllowed']);
      }
    }
  }
  private static function getAllowedClients($ts, $cfgc){
    foreach($cfgc['pokeToGroup']['allowedGroups'] as $group){
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
