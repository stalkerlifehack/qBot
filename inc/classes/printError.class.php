<?php
class errors{
  /*function chceckChannelsId($ts, $cfge, $cfgp, $config){
    if($config['showErrorsStarts']){
      $channels = $ts->getElement('data', $ts->channelList());
      foreach($channels as $index => $channel){
        $ch[$index] = $channel['cid'];
      }
      if($cfge['multiFunction']['onlineOnChannel']['enabled']){
        if(!in_array($cfge['multiFunction']['onlineOnChannel']['channelId'], $ch)){
          echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."multiFunction".ENDC." -> ".ORAN."onlineOnChannel".ENDC.END;
          if($config['logsEnabled']){

          }
        }
      }
      if($cfge['multiFunction']['pingOnChannel']['enabled']){
        if(!in_array($cfge['multiFunction']['pingOnChannel']['channelId'], $ch)){
          echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."multiFunction".ENDC." -> ".ORAN."pingOnChannel".ENDC.END;
          if($config['logsEnabled']){

          }
        }
      }
      if($cfge['multiFunction']['packetLossOnChannel']['enabled']){
        if(!in_array($cfge['multiFunction']['packetLossOnChannel']['channelId'], $ch)){
          echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."multiFunction".ENDC." -> ".ORAN."packetLossOnChannel".ENDC.END;
          if($config['logsEnabled']){

          }
        }
      }
      if($cfge['multiFunction']['uptimeOnChannel']['enabled']){
        if(!in_array($cfge['multiFunction']['uptimeOnChannel']['channelId'], $ch)){
          echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."multiFunction".ENDC." -> ".ORAN."uptimeOnChannel".ENDC.END;
          if($config['logsEnabled']){

          }
        }
      }
    }
    unset ($config);

    //

    //   tu trzeba zamiast cfge zrobic $config !!!!

    //
  }*/
  public function checkChannelName($msg, $f_name){
    global $config;
    if($config['showErrorsLoop']){
      if(strlen($msg) > 60){
        echo ERR.SP."Nazwa kanału jest za długa, w funckji ".ORAN.$f_name.ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
    unset ($config);
  }
  public function checkServerName($msg, $f_name){
    global $config;
    if($config['showErrorsLoop']){
      if(strlen($msg) > 60){
         echo ERR.SP."Nazwa serwera jest za długa, w funckji ".ORAN.$f_name.ENDC.END;
         if($config['logsEnabled']){

         }
      }
    }
    unset($config);
  }
  public function checkPokeMessage($msg, $f_name){
    global $config;
    if($config['showErrorsLoop']){
      if(strlen($msg) > 100){
         echo ERR.SP."Wiadomość do poke jest za długa w funckji ".ORAN.$f_name.ENDC.END;
         if($config['logsEnabled']){

         }
      }
    }
    unset($config);
  }
}
 ?>
