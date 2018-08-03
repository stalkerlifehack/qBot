<?php
class closeHelpChannels{

  function __construct($ts, $cfge){
    foreach($cfge['closeHelpChannels'] as $data)
      $open = mktime(explode(":", $data['openChannels'])[0], explode(":", $data['openChannels'])[1], 0, date('m'), date('d'), date('Y'));
			$close = mktime(explode(":", $data['closeChannels'])[0], explode(":", $data['closeChannels'])[1], 0, date('m'), date('d'), date('Y'));

      if(time() >= $open && time() < $close){
        if($data['channelDesc']['enabled']){
          $data['channelDesc']['topDesc'] .= "[size=13]Centrum pomocy zostanie zamknięte za: [b]".qBot::convertSecondsSecond_2($close - time())."[/b][/size]";
          $data['channelDesc']['topDesc'] .= $data['channelDesc']['downDesc'];
          if(qBot::ifChannelDescriptionSame($data['channelId'], $data['channelDesc']['topDesc'], $ts)){
            $ts->channelEdit($data['channelId'], array(
              'channel_flag_maxclients_unlimited' => 1,
              'channel_description' => $data['channelDesc']['topDesc']));
            if(qBot::IfChannelNameSame($data['channelId'], $data['channelNameOpen'], $ts)){
              $ts->channelEdit($data['channelId'], array(
                  'channel_flag_maxclients_unlimited' => 1,
                  'channel_description' => $data['channelDesc']['topDesc'],
                  'channel_name' => $data['channelNameOpen']));
            }
          }
        }
        else{
          if(qBot::IfChannelNameSame($data['channelId'], $data['channelNameOpen'], $ts)){
            $ts->channelEdit($data['channelId'], array(
              'channel_name' => $data['channelNameOpen'],
              'channel_flag_maxclients_unlimited' => 1));
              errors::checkChannelName($data['channelNameOpen'], 'closeHelpChannels (open)');
          }
        }

      }
      else{ //close

        if($data['channelDesc']['enabled']){
          if(($open - time()) < 0){
            $data['channelDesc']['topDesc'] .= "[size=13]Centrum pomocy zostanie otwarte za: [b]".qBot::convertSecondsSecond_2(86400 - abs($open - time()))."[/b][/size]";
          }
          else{
            $data['channelDesc']['topDesc'] .= "[size=13]Centrum pomocy zostanie otwarte za: [b]".qBot::convertSecondsSecond_2($open - time())."[/b][/size]";
          }
          $data['channelDesc']['topDesc'] .= $data['channelDesc']['downDesc'];
          if(qBot::ifChannelDescriptionSame($data['channelId'], $data['channelDesc']['topDesc'], $ts)){
            $ts->channelEdit($data['channelId'], array(
                'channel_flag_maxclients_unlimited' => 0,
                'CHANNEL_MAXCLIENTS' => 0,
                'channel_description' => $data['channelDesc']['topDesc']));
            if(qBot::IfChannelNameSame($data['channelId'], $data['channelNameClose'], $ts)){
              $ts->channelEdit($data['channelId'], array(
                  'channel_flag_maxclients_unlimited' => 0,
                  'CHANNEL_MAXCLIENTS' => 0,
                  'channel_name' => $data['channelNameClose']));
            }
          }
        }
        else{
          if(qBot::IfChannelNameSame($data['channelId'], $data['channelNameClose'], $ts)){
            $ts->channelEdit($data['channelId'], array(
              'channel_name' => $data['channelNameClose'],
              'CHANNEL_MAXCLIENTS' => 0,
              'channel_flag_maxclients_unlimited' => 0));
              errors::checkChannelName($data['channelNameClose'], 'closeHelpChannels (close)');
          }
        }
      }

  }
}
 ?>
