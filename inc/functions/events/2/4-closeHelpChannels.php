<?php
class closeHelpChannels{

  function start($ts, $cfge){
    foreach($cfge['closeHelpChannels'] as $data){
      $now = split("[-]", date('Y-m-d-H-i'));
      $nowTime = mktime($now[3], $now[4], 0, $now[1], $now[2], $now[0]);
      $timeClose = mktime($data['closeChannels']['hour'], $data['closeChannels']['minute'], 0, $now[1], $now[2], $now[0]);
      $timeOpen = mktime($data['openChannels']['hour'], $data['openChannels']['minute'], 0, $now[1], $now[2], $now[0]);
      if(($timeOpen - $nowTime) > 0){
        echo 'close'.PHP_EOL;
      }
      else{
        if(($timeClose - $nowTime) > 0){
          echo 'open'.PHP_EOL;
        }
        else{
          echo 'close'.PHP_EOL;
        }
      }
    }
  }
}
 ?>
