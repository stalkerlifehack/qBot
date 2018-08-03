<?php
class errorsFirst{
  function check($ts, $cfge, $cfgp, $config){
    if($config['showErrorsStarts']){
      $channels = $ts->getElement('data', $ts->channelList());
      foreach($channels as $index => $channel){
        $ch[$index] = $channel['cid'];
      }

      self::multiFunction($cfge, $config, $ch);
      self::pokeAdmins($cfge, $config, $ch);
      self::clanGroup($cfge, $config, $ch);
      self::registerChannel($cfge, $config, $ch);
      self::adminStatusOnChannel($cfge, $config, $ch);
      self::topAfkTime($cfge, $config, $ch);
      self::topTimeSpent($cfge, $config, $ch);
      self::moveWhenJoinChannel($cfgp, $config, $ch);
    }
  }
  //eventy
  private static function multiFunction($cfge, $config, $ch){
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
    if($cfge['multiFunction']['queryClientsOnline']['enabled']){
      if(!in_array($cfge['multiFunction']['queryClientsOnline']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."multiFunction".ENDC." -> ".ORAN."queryClientsOnline".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
    if($cfge['multiFunction']['uniqueVisitors']['enabled']){
      if(!in_array($cfge['multiFunction']['uniqueVisitors']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."multiFunction".ENDC." -> ".ORAN."uniqueVisitors".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }

  }
  private static function pokeAdmins($cfge, $config, $ch){
    if(in_array('2-pokeAdmins', $config['1']['events']['list'])){
      foreach($cfge['pokeAdmins'] as $data){
        $channelId[] = $data['channelId'];
      }
      if(!qBot::difTwoTables($channelId, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."pokeAdmins".ENDC.END;
        if($config['logsEnabled']){

        }
      }

    }
  }
  private static function clanGroup($cfge, $config, $ch){
    if(in_array('3-clanGroup', $config['1']['events']['list'])){
      if(!empty($cfge['clanGroup']['channels'])){
        foreach($cfge['clanGroup']['channels'] as $data){
          $channelId[] = $data['channelId'];
        }
        if(!qBot::difTwoTables($channelId, $ch)){
          echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."clanGroup".ENDC.END;
          if($config['logsEnabled']){

          }
        }
      }
    }
  }
  private static function registerChannel($cfge, $config, $ch){
    if(in_array('4-registerChannel', $config['1']['events']['list'])){
      foreach($cfge['registerChannel'] as $data){
        $channelId[] = $data['channelId'];
      }
      if(!qBot::difTwoTables($channelId, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."registerChannel".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function adminStatusOnChannel($cfge, $config, $ch){
    if(in_array('6-adminStatusOnChannel', $config['1']['events']['list'])){
      foreach($cfge['adminStatusOnChannel'] as $data){
        $channelId[] = $data['channelId'];
      }
      if(!qBot::difTwoTables($channelId, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."adminStatusOnChannel".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function topAfkTime($cfge, $config, $ch){
    if(in_array('7-topAfkTime', $config['1']['events']['list'])){
      if(!in_array($cfge['topAfkTime']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."topAfkTime".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function topTimeSpent($cfge, $config, $ch){
    if(in_array('8-topTimeSpent', $config['1']['events']['list'])){
      if(!in_array($cfge['topTimeSpent']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."topTimeSpent".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }




  }
  //pluginy
  private static function moveWhenJoinChannel($cfgp, $config, $ch){
    if(in_array('1-moveWhenJoinChannel', $config['1']['plugins']['list'])){
      foreach($cfgp['moveWhenJoinChannel'] as $data){
        $channelId[] = $data['channelId'];
      }
      if(!qBot::difTwoTables($channelId, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."moveWhenJoinChannel


        ".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
}

class errorsSecond{
  function check($ts, $cfge, $cfgp, $config){
    if($config['showErrorsStarts']){
      $channels = $ts->getElement('data', $ts->channelList());
      foreach($channels as $index => $channel){
        $ch[$index] = $channel['cid'];
      }
      self::countDownTime($cfge, $config, $ch);
      self::createPremiumChannels($cfge, $config, $ch);
      self::closeHelpChannels($cfge, $config, $ch);
      self::musicBotChecker($cfge, $config, $ch);
      self::afkGroup($cfge, $config, $ch);
      self::normalAfkGroup($cfge, $config, $ch);
      self::topSpentAfk($cfge, $config, $ch);
      self::banList($cfge, $config, $ch);
    }
  }
  private static function countDownTime($cfge, $config, $ch){
    if(in_array('0-countDownTime', $config['2']['events']['list'])){
      if(!in_array($cfge['countDownTime']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."countDownTime".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function createPremiumChannels($cfge, $config, $ch){
    if(in_array('2-createPremiumChannels', $config['2']['events']['list'])){
      if(!in_array($cfge['createPremiumChannels']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."createPremiumChannels".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function closeHelpChannels($cfge, $config, $ch){
    if(in_array('3-closeHelpChannels', $config['2']['events']['list'])){
      foreach($cfge['closeHelpChannels'] as $info){
        $channels[] = $info['channelId'];
      }
      if(!qBot::difTwoTables($channels, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."closeHelpChannels".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function musicBotChecker($cfge, $config, $ch){
    if(in_array('4-musicBotChecker', $config['2']['events']['list'])){
      if(!in_array($cfge['musicBotChecker']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."musicBotChecker".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function afkGroup($cfge, $config, $ch){
    if(in_array('5-afkGroup', $config['2']['events']['list'])){
      if(!in_array($cfge['afkGroup']['move']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."afkGroup".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function normalAfkGroup($cfge, $config, $ch){
    if(in_array('6-normalAfkGroup', $config['2']['events']['list'])){
      if(!in_array($cfge['normalAfkGroup']['move']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."normalAfkGroup".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function topSpentAfk($cfge, $config, $ch){
    if(in_array('7-topAfkSpent', $config['2']['events']['list'])){
      if(!in_array($cfge['topAfkSpent']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."topAfkSpent".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function banList($cfge, $config, $ch){
    if(in_array('8-banList', $config['2']['events']['list'])){
      if(!in_array($cfge['banList']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."banList".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  //pluginy
  private static function blockRecording($cfgp, $config, $ch){
    if(in_array('0-blockRecording', $config['2']['plugins']['list'])){
      if(!qBot::difTwoTables($cfgp['blockRecording']['channels'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."blockRecording".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
}

class errorsThird{
  function check($ts, $cfge, $cfgp, $config){
    if($config['showErrorsStarts']){
      $channels = $ts->getElement('data', $ts->channelList());
      foreach($channels as $index => $channel){
        $ch[$index] = $channel['cid'];
      }
      self::groupCountOnChannel($cfge, $config, $ch);
      self::adminCountOnChannel($cfge, $config, $ch);
      self::checkPublicChannels($cfge, $config, $ch);
      self::adminMeeting($cfge, $config, $ch);
      self::getPrivateChannel($cfge, $config, $ch);
      self::adminList($cfge, $config, $ch);
      self::recordOnline($cfge, $config, $ch);
      self::newUsersToday($cfge, $config, $ch);
    }
  }
  private static function groupCountOnChannel($cfge, $config, $ch){
    if(in_array('0-groupCountOnChannel', $config['3']['events']['list'])){
      if(!empty($cfge['groupCountOnChannel']['channels'])){
        foreach($cfge['groupCountOnChannel']['channels'] as $info){
          $channels[] = $info['channelId'];
        }
        if(!qBot::difTwoTables($channels, $ch)){
          echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."groupCountOnChannel".ENDC.END;
          if($config['logsEnabled']){

          }
        }
      }
    }
  }
  private static function adminCountOnChannel($cfge, $config, $ch){
    if(in_array('1-adminCountOnChannel', $config['3']['events']['list'])){
      if(!in_array($cfge['adminCountOnChannel']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."adminCountOnChannel".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function checkPublicChannels($cfge, $config, $ch){
    if(in_array('2-checkPublicChannels', $config['3']['events']['list'])){
      foreach($cfge['checkPublicChannels'] as $info){
        $channels[] = $info['channelId'];
      }
      if(!qBot::difTwoTables($channels, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."checkPublicChannels".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function adminMeeting($cfge, $config, $ch){
    if(in_array('3-adminMeeting', $config['3']['events']['list'])){
      if(!in_array($cfge['adminMeeting']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."adminMeeting".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function getPrivateChannel($cfge, $config, $ch){
    if(in_array('4-getPrivateChannel', $config['3']['events']['list'])){
      if(!in_array($cfge['getPrivateChannel']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."getPrivateChannel".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function adminList($cfge, $config, $ch){
    if(in_array('6-adminList', $config['3']['events']['list'])){
      if(!in_array($cfge['adminList']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."adminList".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function recordOnline($cfge, $config, $ch){
    if(in_array('7-recordOnline', $config['3']['events']['list'])){
      if(!in_array($cfge['recordOnline']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."recordOnline".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }

  private static function newUsersToday($cfge, $config, $ch){
    if(in_array('8-newUsersToday', $config['3']['events']['list'])){
      if(!in_array($cfge['newUsersToday']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."newUsersToday".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
}

class errorsFourth{
  function check($ts, $cfge, $cfgp, $config){
    if($config['showErrorsStarts']){
      $channels = $ts->getElement('data', $ts->channelList());
      foreach($channels as $index => $channel){
        $ch[$index] = $channel['cid'];
      }
      self::groupUserList($cfge, $config, $ch);
      self::writeAdminStats($cfge, $config, $ch);
      self::writePopularGroups($cfge, $config, $ch);
      self::clientLevels($cfge, $config, $ch);
    }
  }
  private static function groupUserList($cfge, $config, $ch){
    if(in_array('1-groupUserList', $config['4']['events']['list'])){
      foreach($cfge['groupUserList']['channels'] as $info){
        $channels[] = $info['channelId'];
      }
      if(!qBot::difTwoTables($channels, $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."groupUserList".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function writeAdminStats($cfge, $config, $ch){
    if(in_array('3-writeAdminStats', $config['3']['events']['list'])){
      if(!in_array($cfge['writeAdminStats']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."writeAdminStats".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function writePopularGroups($cfge, $config, $ch){
    if(in_array('4-writePopularGroups', $config['3']['events']['list'])){
      if(!in_array($cfge['writePopularGroups']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."writePopularGroups".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
  private static function clientLevels($cfge, $config, $ch){
    if(in_array('8-clientLevels', $config['4']['events']['list'])){
      if(!in_array($cfge['clientLevels']['channelId'], $ch)){
        echo ERR.SP."Nieprawidłowe ID kanału w funkcji ".ORAN."clientLevels".ENDC.END;
        if($config['logsEnabled']){

        }
      }
    }
  }
}

class func{

}


//Tutaj są już loop
class errors{
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
}

 ?>
