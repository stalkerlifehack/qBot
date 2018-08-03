<?php
class clientInfoBase{
  private static function clanGroupChannels($cfge){
    foreach($cfge['clanGroup']['channels'] as $index => $channel){
      $channels[$index] = $channel['channelId'];
    }
    if(empty($channels)){
      $channels[] = 0;
    }
    return $channels;
  }
  private static function pokeAdminChannels($cfge){
    foreach($cfge['pokeAdmins'] as $index => $channel){
      $channels[$index] = $channel['channelId'];
    }
    if(empty($channels)){
      $channels[] = 0;
    }
    return $channels;
  }
  private static function moveWhenJoinChannel($cfgp){
    foreach($cfgp['moveWhenJoinChannel'] as $index => $channel){
      $channels[$index] = $channel['channelId'];
    }
    if(empty($channels)){
      $channels[] = 0;
    }
    return $channels;
  }
  private static function registerChannel($cfge){
    foreach($cfge['registerChannel'] as $index => $channel){
      $channels[$index] = $channel['channelId'];
    }
    if(empty($channels)){
      $channels[] = 0;
    }
    return $channels;
  }
  private static function clanGroupFromBaseChannels($baza){
    $data = $baza->query("SELECT `channelId` FROM  `clanGroup`");
    foreach($data as $index => $channel){
      $channels[$index] = $channel['channelId'];
    }
    if(empty($channels)){
      $channels[] = 0;
    }
    return $channel;
  }
  private static function afkGroupChannel($cfge){
    if(!empty($cfge['afkGroup']['move']['channelId'])){
      $channel[] = $cfge['afkGroup']['move']['channelId'];
      return $channel;
    }
    else{
      $channel[] = '0';
      return $channel;
    }
  }
  private static function createPremiumChannelsChannel($cfge){
    if(!empty($config['2']['events']['cfg']['createPremiumChannels']['channelId'])){
      $channel[] = $config['2']['events']['cfg']['createPremiumChannels']['channelId'];
      return $channel;
    }
    else{
      $channel[] = '0';
      return $channel;
    }

  }
  private static function getPrivateChannelChannel($cfge){
    if(!empty($cfge['getPrivateChannel']['channelId'])){
      $channel[] = $cfge['getPrivateChannel']['channelId'];
      return $channel;
    }
    else{
      $channel[] = '0';
      return $channel;
    }

  }
  private static function afkChannel($cfge){
    if(!empty($cfge['afkGroup']['move']['channelId'])){
      $channel[] = $cfge['afkGroup']['move']['channelId'];
      return $channel;
    }
    else{
      $channel[] = '0';
      return $channel;
    }
  }


  function __construct($ts, $cfge=NULL, $lang=NULL, $baza, $query){
    global $config;
    $cfge1 = $config['1']['events']['cfg'];
    $cfge2 = $config['2']['events']['cfg'];
    $cfge3 = $config['3']['events']['cfg'];
    $cfgp1 = $config['1']['plugins']['cfg'];

    $a = self::clanGroupChannels($cfge1);
    $b = self::pokeAdminChannels($cfge1);
    $c = self::moveWhenJoinChannel($cfgp1);
    $d = self::registerChannel($cfge1);
    $e = self::clanGroupFromBaseChannels($baza);
    $f = self::afkGroupChannel($cfge2);
    $g = self::createPremiumChannelsChannel($cfge2);
    $h = self::getPrivateChannelChannel($cfge3);
    $i = self::afkChannel($cfge2);
    $allChannels = array_merge($a, $b, $c, $d, $e, $f, $g, $h, $i);

    qBot::clientDataChannel($allChannels, $ts, $cfge);
    unset($config);
  }
}
 ?>
