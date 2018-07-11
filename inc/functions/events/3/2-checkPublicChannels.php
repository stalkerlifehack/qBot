<?php
class checkPublicChannels{

  private static function createAndRemoveChannels($ts, $a, $b, $maxClients, $minChannels, $minFreeChannels, $cfge_channelName, $pid, $lastChannel, $maxChannels){
    $c = $b - $a;
    while($c >= $minChannels && $c != $b){
      $c--;
      $ts->channelDelete($lastChannel, 1);
    }
    while($c < $minFreeChannels && $b < $maxChannels){
      $c++;
      $d = $b;
      $d++;
      $ts->channelCreate(array(
        'channel_name' => str_replace('[num]', $d, $cfge_channelName),
        'cpid' => $pid,
        'channel_flag_permanent' => 1,
        'channel_maxclients' => $maxClients,
        'channel_flag_maxclients_unlimited' => 0,
      ));
    }
    while($b < $minChannels){
      $b++;
      $ts->channelCreate(array(
        'channel_name' => str_replace('[num]', $b, $cfge_channelName),
        'cpid' => $pid,
        'channel_flag_permanent' => 1,
        'channel_maxclients' => $maxClients,
        'channel_flag_maxclients_unlimited' => 0,
      ));
    }
    while($b > $maxChannels){
      $b--;
      $ts->channelDelete($lastChannel, 1);
    }
  }
  function start($ts, $cfge){
    foreach($cfge['checkPublicChannels'] as $data){
      $a = 0;
      $b = 0;
      foreach($ts->getElement('data', $ts->channelList()) as $channel){
        if($data['channelId'] == $channel['pid']){
          $i = 0;
          foreach($ts->getElement('data', $ts->clientList()) as $client){
            if($client['cid'] == $channel['cid']){
              $i++;
            }
          }
          if($data['maxClients'] <= $i){
            $a++;
          }
          $lastChannel = $channel['cid'];
          $b++;
        }
      }
      self::createAndRemoveChannels($ts, $a, $b, $data['maxClients'], $data['minChannels'], $data['minFreeChannels'], $data['channelNames'], $data['channelId'], $lastChannel, $data['maxChannels']);
    }
  }
}
 ?>
