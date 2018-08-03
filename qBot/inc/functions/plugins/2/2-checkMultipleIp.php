<?php
class checkMultipleIp{

  function __construct($ts, $cfgp, $lang=null, $baza=null, $query){
    foreach($ts->getElement('data', $ts->clientList('-groups -ip')) as $client){
      if(!qBot::difTwoTables(explode(",", $client['client_servergroups']), $cfgp['checkMultipleIp']['groupsIgnore'])){
        $clientInfo[] = $client['connection_client_ip'];
      }
    }
    if(empty($clientInfo)){
      $clientInfo[] = 0;
    }
    foreach(array_count_values($clientInfo) as $ip => $connections){
      if($connections > ($cfgp['checkMultipleIp']['maxMultipleIp'])){ ////
        foreach($ts->getElement('data', $ts->clientList('-groups -ip -uid')) as $client){
          if($client['client_type'] == 0 && $client['client_database_id'] != $query['client_database_id']){
            if(!qBot::difTwoTables(explode(",", $client['client_servergroups']), $cfgp['checkMultipleIp']['groupsIgnore'])){
              if($ip == $client['connection_client_ip']){
                $connections -= ($cfgp['checkMultipleIp']['maxMultipleIp']);////
                if($connections >= 1){
                  $ts->clientKick($client['clid'], 'server', $cfgp['checkMultipleIp']['kickMessage']);
                }
              }
            }
          }
        }
      }
    }
  }
}
 ?>
