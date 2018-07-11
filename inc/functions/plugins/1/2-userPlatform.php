<?php
class userPlatform{
  function start($ts, $cfgp){
    foreach($ts->getElement('data', $ts->clientList('-info -groups')) as $client){
      if($client['client_platform'] == 'OS X' || $client['client_platform'] == 'Linux' || $client['client_platform'] == 'Windows'){
        if(in_array($cfgp['userPlatform']['android'], explode(",", $client['client_servergroups']))){
          $ts->serverGroupDeleteClient($cfgp['userPlatform']['android'], $client['client_database_id']);
        }
        if(in_array($cfgp['userPlatform']['ios'], explode(",", $client['client_servergroups']))){
          $ts->serverGroupDeleteClient($cfgp['userPlatform']['ios'], $client['client_database_id']);
        }
      }
      if(!empty($cfgp['userPlatform']['android'])){
        if($client['client_platform'] == 'Android'){
          if(!in_array($cfgp['userPlatform']['android'], explode(",", $client['client_servergroups']))){
            $ts->serverGroupAddClient($cfgp['userPlatform']['android'], $client['client_database_id']);
          }
        }
      }
      if(!empty($cfgp['userPlatform']['ios'])){
        if($client['client_platform'] == 'iOS'){
          if(!in_array($cfgp['userPlatform']['ios'], explode(",", $client['client_servergroups']))){
            $ts->serverGroupAddClient($cfgp['userPlatform']['ios'], $client['client_database_id']);
          }
        }
      }
    }
  }
}
 ?>
