<?php
class hostMessage{
  function __construct($ts, $cfge, $lang, $baza){
    $info = $ts->getElement('data', $ts->serverInfo());
    $data = $baza->query("SELECT `record` FROM `recordOnline`")->fetch(PDO::FETCH_ASSOC);
    $clients_online = $info['virtualserver_clientsonline'] - $info['virtualserver_queryclientsonline'];
    $replaces = array(
      1 => array(1 => '[onl]', 2 => $clients_online),
      2 => array(1 => '[max]', 2 => $info['virtualserver_maxclients']),
      3 => array(1 => '[uptime]', 2 => qBot::convertSeconds($info['virtualserver_uptime'])),
      4 => array(1 => '[ping]', 2 => round($info['virtualserver_total_ping'], 2)),
      5 => array(1 => '[packet]', 2 => round($info['virtualserver_total_packetloss_total'], 2)),
      6 => array(1 => '[record]', 2 => $data['record']
    ));
    $msg = qBot::replaceInfo($lang['hostMessage'], $replaces);
    $ts->serverEdit(array('virtualserver_hostmessage' => $msg));
  }
}
 ?>
