<?php
class recordOnline{

  function __construct($ts, $cfge, $lang=null, $baza){
    $data = $baza->query("SELECT `record`, `date` FROM `recordOnline`")->fetch(PDO::FETCH_ASSOC);
    $onlineNow = ($ts->getElement('data', $ts->serverInfo())['virtualserver_clientsonline'] - $ts->getElement('data', $ts->serverInfo())['virtualserver_queryclientsonline']);
    if($data['record'] < $onlineNow || empty($data['record'])){
      $baza->prepare("UPDATE `recordOnline` SET `record`=:record, `date`=:data")->execute(array(
        ':record' => $onlineNow,
        ':data' => date("Y-m-d H:i:s")
      ));
      $chName = str_replace('[rec]', $onlineNow, $cfge['recordOnline']['channelName']);
      $cfge['recordOnline']['topDesc'] .= "[size=11][list][*]Aktualny rekord to: [b]".$onlineNow."[/b][*]Ustanowiony został: [b]".$data['date']."[/b][/list][/size]";
      $cfge['recordOnline']['topDesc'] .= $cfge['recordOnline']['downDesc'];
      if(qBot::ifChannelNameSame($cfge['recordOnline']['channelId'], $chName, $ts)){
        $ts->channelEdit($cfge['recordOnline']['channelId'], array(
          'channel_name' => $chName,
          'channel_description' => $cfge['recordOnline']['topDesc']
        ));
        errors::checkChannelName($chName, 'recordOnline');
      }
    }
  }
}
 ?>
