<?php
  class writeAdminStats{

    private static function groups($ts, $groupId){
      foreach($ts->getElement('data', $ts->serverGroupList()) as $group){
        if($group['sgid'] == $groupId){
          return $group['name'];
        }
      }
    }

    function __construct($ts, $cfge, $lang=null, $baza){
      foreach($cfge['writeAdminStats']['adminGroups'] as $group){
        $cfge['writeAdminStats']['topDesc'] .= "[list][*]".self::groups($ts, $group)."[list]";
        foreach($ts->getElement('data', $ts->serverGroupClientList($group, true)) as $client){
          if(!empty($client['cldbid'])){
            $db = $client['cldbid'];
            $data = $baza->query("SELECT `adminId` FROM `adminStatistics` WHERE `adminId`=$db");
            $i = 0;
            foreach($data as $g){
              $i++;
            }
            $cfge['writeAdminStats']['topDesc'] .= "[*] [size=11][URL=client://0/".$client['client_unique_identifier']."]".$client['client_nickname']."[/URL] nadane grupy: [b] $i [/b][/size]";
          }
          else{
            $cfge['writeAdminStats']['topDesc'] .= "[*] [size=11][i]Brak administratorów[/i][/size]";
          }
        }
        $cfge['writeAdminStats']['topDesc'] .= '[/list][/list]';
      }
      $cfge['writeAdminStats']['topDesc'] .= $cfge['writeAdminStats']['downDesc'];
      if(qBot::ifChannelDescriptionSame($cfge['writeAdminStats']['channelId'], $cfge['writeAdminStats']['topDesc'], $ts)){
        $ts->channelEdit($cfge['writeAdminStats']['channelId'], array(
          'channel_description' => $cfge['writeAdminStats']['topDesc']
        ));
      }
    }
  }
 ?>
