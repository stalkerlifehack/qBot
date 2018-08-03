<?php
class botInfo{
  function __construct($ts, $cfge){
    $file = file_get_contents('http://stalkersapps.pl/qBot/update/index.php');
    $info = json_decode($file, true);
    $desc = '';
    $desc .= $cfge['botInfo']['topDesc']."[list]";
    $desc .= "[*]".$info['version']."[/list]";
    $desc .= "[list][*]".$info['authorInfo']."[/list]";
    $desc .= "[list][*]".$info['downloadLink']."[/list]";
    $desc .= $info['date'];
    if(!empty($info)){
      if(qBot::ifChannelDescriptionSame($cfge['botInfo']['channelId'], $desc.$cfge['botInfo']['downDesc'], $ts)){
        $ts->channelEdit($cfge['botInfo']['channelId'], array(
          'channel_description' => $desc.$cfge['botInfo']['downDesc']
        ));
      }
    }
    else{
      $desc .= "[list][*][color=red]Bot nie mógł zaktualizować danych[/list]";
      if(qBot::ifChannelDescriptionSame($cfge['botInfo']['channelId'], $desc.$cfge['botInfo']['downDesc'], $ts)){
        $ts->channelEdit($cfge['botInfo']['channelId'], array(
          'channel_description' => $desc.$cfge['botInfo']['downDesc']
        ));
      }
    }
  }
}
 ?>
