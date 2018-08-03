<?php
class addRankByIp{

  function __construct($ts, $cfgp){
    foreach($ts->getElement('data', $ts->clientList('-groups -ip')) as $client){
      if(in_array($client['connection_client_ip'], $cfgp['addRankByIp']['ip'])){
        if(!qBot::difTwoTables($cfgp['addRankByIp']['ranksAdd'], explode(",", $client['client_servergroups']))){
          foreach($cfgp['addRankByIp']['ranksAdd'] as $group){
            $ts->serverGroupAddClient($group, $client['client_database_id']);
          }
        }
      }
    }
  }
}
 ?>
