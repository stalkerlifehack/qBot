<?php
class blockRecording{

  function __construct($ts, $cfgp){
    foreach($ts->getElement('data', $ts->clientList('-groups -uid -voice')) as $client){
      if(!qBot::difTwoTables($cfgp['blockRecording']['ignoredGroups'], explode(",", $client['client_servergroups']))){
        if($client['client_unique_identifier'] != 'serveradmin'){
          if($client['client_is_recording'] == 1){
            if($cfgp['blockRecording']['mode'] == 'ignored'){
              if(!in_array($client['cid'], $cfgp['blockRecording']['channels'])){
                $ts->clientKick($client['clid'], $cfgp['blockRecording']['kickMode'], $cfgp['blockRecording']['kickMessage']);
                $ts->ClientPoke($client['clid'], $cfgp['blockRecording']['kickMessage']);
              }
            }
            elseif($cfgp['blockRecording']['mode'] == 'blocked'){
              if(in_array($client['cid'], $cfgp['blockRecording']['channels'])){
                $ts->clientKick($client['clid'], $cfgp['blockRecording']['kickMode'], $cfgp['blockRecording']['kickMessage']);
                $ts->ClientPoke($client['clid'], $cfgp['blockRecording']['kickMessage']);
              }
            }
          }
        }
      }
    }
  }
}
 ?>
