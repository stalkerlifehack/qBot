<?php
class banGroups{

  function __construct($ts, $cfgp){
    foreach($cfgp['banGroups']['groups'] as $group => $time){
      foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
        if(in_array($group, explode(",", $client['client_servergroups']))){
          $ts->banClient($client['clid'], $time, $cfgp['banGroups']['banReason']);
        }
      }
    }
  }
}
?>
