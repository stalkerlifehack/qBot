<?php
class channelNameGuard{
  function start($ts, $cfge){
    foreach($ts->getElement('data', $ts->channelList()) as $channel){
      if(!in_array($channel['cid'], $cfge['channelNameGuard']['channelsException'])){
        foreach($cfge['channelNameGuard']['phrasesToGuard'] as $name){
          if(strstr($channel['channel_name'], $name)){
            $los = rand(0, 9999999);
            $newChName['channel_name'] = "[lspacer".$los."]Zła nazwa kanału!";
              $ts->channelEdit($channel['cid'], $newChName);
          }
        }
      }
    }
  }
}
 ?>
