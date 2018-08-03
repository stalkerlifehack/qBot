<?php
class multiFunction{
  function __construct($ts, $cfge){
    $srvInfo = $ts->getElement('data', $ts->serverInfo());
    $clients_online = $srvInfo['virtualserver_clientsonline'] - $srvInfo['virtualserver_queryclientsonline'];
    if($cfge['multiFunction']['onlineOnChannel']['enabled']){
      $replaces = array(
        1 => array(1 => '[onl]', 2 => $clients_online),
        2 => array(1 => '[max]', 2 => $srvInfo['virtualserver_maxclients']),
      );
      $msg = qBot::replaceInfo($cfge['multiFunction']['onlineOnChannel']['channelName'], $replaces);
      if(qBot::ifChannelNameSame($cfge['multiFunction']['onlineOnChannel']['channelId'], $msg, $ts)){
        $ch_name_options['channel_name'] = $msg;
        $ts->channelEdit($cfge['multiFunction']['onlineOnChannel']['channelId'], $ch_name_options);
          errors::checkChannelName($msg, 'multiFunction -> onlineOnChannel');
      }
    }
    if($cfge['multiFunction']['pingOnChannel']['enabled']){
      $msg_ping = str_replace('[ping]', round($srvInfo['virtualserver_total_ping'], 2), $cfge['multiFunction']['pingOnChannel']['channelName']);
      if(qBot::ifChannelNameSame($cfge['multiFunction']['pingOnChannel']['channelId'], $msg_ping, $ts)){
        $ch_name_options_ping['channel_name'] = $msg_ping;
        $ts->channelEdit($cfge['multiFunction']['pingOnChannel']['channelId'], $ch_name_options_ping);
        errors::checkChannelName($msg_ping, 'multiFunction -> pingOnChannel');
      }
    }
    if($cfge['multiFunction']['packetLossOnChannel']['enabled']){
      $msg_packet = str_replace('[packet]', round($srvInfo['virtualserver_total_packetloss_total'], 2), $cfge['multiFunction']['packetLossOnChannel']['channelName']);
      if(qBot::ifChannelNameSame($cfge['multiFunction']['packetLossOnChannel']['channelId'], $msg_packet, $ts)){
        $ch_name_options_packet['channel_name'] = $msg_packet;
        $ts->channelEdit($cfge['multiFunction']['packetLossOnChannel']['channelId'], $ch_name_options_packet);
        errors::checkChannelName($msg_packet, 'multiFunction -> packetLossOnChannel');
      }
    }
    if($cfge['multiFunction']['uptimeOnChannel']['enabled']){
      $msg_uptime = str_replace('[time]', qBot::convertSeconds($srvInfo['virtualserver_uptime']), $cfge['multiFunction']['uptimeOnChannel']['channelName']);
      if(qBot::ifChannelNameSame($cfge['multiFunction']['uptimeOnChannel']['channelId'], $msg_uptime, $ts)){
        $ch_name_options_uptime['channel_name'] = $msg_uptime;
        $ts->channelEdit($cfge['multiFunction']['uptimeOnChannel']['channelId'], $ch_name_options_uptime);
        errors::checkChannelName($msg_uptime, 'multiFunction -> uptimeOnChannel');
      }
    }
    if($cfge['multiFunction']['onlineOnChannel']['enabled']){
      $msg_query = str_replace('[onl]', $srvInfo['virtualserver_queryclientsonline'], $cfge['multiFunction']['queryClientsOnline']['channelName']);
      if(qBot::ifChannelNameSame($cfge['multiFunction']['queryClientsOnline']['channelId'], $msg_uptime, $ts)){
        $ts->channelEdit($cfge['multiFunction']['queryClientsOnline']['channelId'], array(
          'channel_name' => $msg_query
        ));
          errors::checkChannelName($msg_query, 'multiFunction -> queryClientsOnline');
      }
      if($cfge['multiFunction']['queryClientsOnline']['enabled']){
        $cfge['multiFunction']['queryClientsOnline']['topDesc'] .= "[size=13][list]";
        foreach($ts->getElement('data', $ts->clientList()) as  $client){
          if($client['client_type'] == 1){
            $chName = $ts->getElement('data', $ts->channelInfo($client['cid']))['channel_name'];
            $cfge['multiFunction']['queryClientsOnline']['topDesc'] .= "[*] [URL=client://".$client['clid']."/serveradmin]".$client['client_nickname']."[/URL] jest na kanale: [i][URL=channelId://".$client['cid']."] $chName [/URL][/i]";
          }
        }
        $cfge['multiFunction']['queryClientsOnline']['topDesc'] .= "[/list][/size]".$cfge['multiFunction']['queryClientsOnline']['downDesc'];
        if(qBot::ifChannelDescriptionSame($cfge['multiFunction']['queryClientsOnline']['channelId'], $cfge['multiFunction']['queryClientsOnline']['topDesc'], $ts)){
          $ts->channelEdit($cfge['multiFunction']['queryClientsOnline']['channelId'], array(
            'channel_description' => $cfge['multiFunction']['queryClientsOnline']['topDesc']
          ));
        }
      }
      if($cfge['multiFunction']['uniqueVisitors']['enabled']){
        $msg_visits = str_replace('[visits]', $ts->getElement('data', $ts->clientDbList(0, -1, true))[0]['count'], $cfge['multiFunction']['uniqueVisitors']['channelName']);
        if(qBot::ifChannelNameSame($cfge['multiFunction']['uniqueVisitors']['channelId'], $msg_visits, $ts)){
          $ts->channelEdit($cfge['multiFunction']['uniqueVisitors']['channelId'], array(
            'channel_name' => $msg_visits
          ));
        }
      }
    }
    unset($srvInfo, $clients_online);
  }
}
