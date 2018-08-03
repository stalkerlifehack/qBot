<?php
class writePopularGroups{

  function __construct($ts, $cfge, $lang=null, $baza){
    foreach($cfge['writePopularGroups']['monitoredGroups'] as $group){
      $data = $baza->query("SELECT `groupAdded` FROM `adminStatistics`");
      $i[$group] = 0;
      while($groupAdded = $data->fetch()){
        if($groupAdded['groupAdded'] == $group){
          $i[$group]++;
        }
      }
    }
    arsort($i);
    $max = 1;
    foreach($i as $group => $count){
      $cfge['writePopularGroups']['topDesc'] .= "[list]";
      if($max <= $cfge['writePopularGroups']['maxGroups']){
        foreach($ts->getElement('data', $ts->serverGroupList()) as $info){
          if($info['sgid'] == $group){
            $cfge['writePopularGroups']['topDesc'] .= "[*][b]".$info['name']."[/b][list]";
            $cfge['writePopularGroups']['topDesc'] .= "[*][size=11]Została wybrana: ".qBot::convertStringCount($count, "raz", "razy", '[b]', '[/b]')."[/size][/list]";
          }
        }
      }
      $cfge['writePopularGroups']['topDesc'] .= "[/list]";
    }
    $cfge['writePopularGroups']['topDesc'] .= $cfge['writePopularGroups']['downDesc'];
    if(qBot::ifChannelDescriptionSame($cfge['writePopularGroups']['channelId'], $cfge['writePopularGroups']['topDesc'], $ts)){
      $t = $ts->channelEdit($cfge['writePopularGroups']['channelId'], array(
        'channel_description' => $cfge['writePopularGroups']['topDesc']
      ));
    }
  }
}
 ?>
