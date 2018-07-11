<?php
class serverName{
  function start($ts, $cfge){
    $srvInfo = $ts->getElement('data', $ts->serverInfo());
    $replaces = array(
      1 => array(1 => '[onl]', 2 => $srvInfo['virtualserver_clientsonline'] - $srvInfo['virtualserver_queryclientsonline']),
      2 => array(1 => '[max]', 2 => $srvInfo['virtualserver_maxclients']),
      3 => array(1 => '[proc]', 2 => round((($srvInfo['virtualserver_clientsonline'] / $srvInfo['virtualserver_maxclients']) * 100), 1)),
    );
    $msg = qBot::replaceInfo($cfge['serverName']['serverName'], $replaces);
    if(qBot::ifChannelNameSame($cfge['serverName']['serverName'], $msg, $ts)){
      $srvName['virtualserver_name'] = $msg;
      $ts->serverEdit($srvName);
      errors::checkServerName($msg, 'serverName');
      unset($srvName, $srvInfo, $replaces);
    }
  }
}
 ?>
