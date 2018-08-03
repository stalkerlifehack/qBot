<?php
class serverGroupProtection{
  function __construct($ts, $cfgp, $lang){
    foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
      foreach($cfgp['serverGroupProtection']['data'] as $a => $b){
        if(in_array($b, explode(",", $client['client_servergroups'])) && $client['client_database_id'] != $a){
          $ts->serverGroupDeleteClient($b, $client['client_database_id']);
          if($cfgp['serverGroupProtection']['ban']){
            $ts->clientKick($client['clid'], 'server', $lang['serverGroupProtection']['group_protected']);
          }
          else{
            $ts->banClient($client['clid'], $cfgp['serverGroupProtection']['time'], $lang['serverGroupProtection']['group_protected']);
          }
        }
      }
    }
  }
}
 ?>
