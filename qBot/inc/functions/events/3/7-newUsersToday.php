<?php
class newUsersToday{
  function __construct($ts, $cfge, $lang, $baza){
    $data = $baza->query("SELECT `date`, `databaseId` FROM `lastClientChannel`");
    $cfge['newUsersToday']['topDesc'] .= "[list]";
    $i = 0;
    foreach($data as $info){
      $baseT = preg_split("/[- :]/", $info['date']);
      $nowT = preg_split("/[- :]/", date('Y-m-d H:i:s'));
      if($baseT[0] == $nowT[0] && $baseT[1] == $nowT[1] &&$baseT[2] == $nowT[2]){
        $i++;
        $client = $ts->getElement('data', $ts->clientGetNameFromDbid($info['databaseId']));
        $cfge['newUsersToday']['topDesc'] .= "[*] [size=13][URL=client://0/".$client['cluid']."]".$client['name']."[/URL][/size]";
      }
    }
    $cfge['newUsersToday']['topDesc'] .= "[/list]".$cfge['newUsersToday']['downDesc'];
    $msg = str_replace('[users]', $i, $cfge['newUsersToday']['channelName']);
    errors::checkChannelName($msg, 'newUsersToday');
    if(qBot::ifChannelNameSame($cfge['newUsersToday']['channelId'], $msg, $ts)){
      $ts->channelEdit($cfge['newUsersToday']['channelId'], array(
        'channel_name' => $msg,
        'channel_description' => $cfge['newUsersToday']['topDesc']
      ));
    }
  }
}
 ?>
