<?php
class topAfkTime{
  function start($ts, $cfge, $null=NULL, $baza){
    global $baza;
    foreach($ts->getElement('data', $ts->clientList('-times -groups')) as $client){
      if(!qBot::difTwoTables($cfge['topAfkTime']['groupsIgnore'], explode(",", $client['client_servergroups']))){
        if($client['client_type'] == 0){
          $clientdbinfo = $client['client_database_id'];
          $data = $baza->query("SELECT `afkTime` FROM topAfkTime WHERE `databaseId`=$clientdbinfo");
          $dtbTime = $data->fetch(PDO::FETCH_ASSOC);
          if(!empty($dtbTime['afkTime'])){ //jesli jest jakis czas klieta
            if($client['client_idle_time'] > $dtbTime['afkTime']){
              $baza->prepare("UPDATE `topAfkTime` SET `afkTime`=:afkTime WHERE `databaseId`=:databaseId")->execute(array(
                ':afkTime' => $client['client_idle_time'],
                ':databaseId' => $clientdbinfo
              ));
            }
          }
          elseif(empty($dtbTime['afkTime'])){ //jesli nie ma klienta
            $baza->prepare("INSERT INTO `topAfkTime` SET `afkTime`=:afkTime, `databaseId`=:databaseId")->execute(array(
              ':afkTime' => $client['client_idle_time'],
              ':databaseId' => $clientdbinfo
            ));
          }
        }
      }
    }
    $limit = $cfge['topAfkTime']['recordsCount'];
    $newdata = $baza->query("SELECT `afkTime`, `databaseId` FROM topAfkTime ORDER BY `afkTime` DESC LIMIT $limit");
    $desc = '';
    $medDesc = '';
    while ($newdbTime = $newdata->fetch()) {
      $nick = $ts->getElement('data', $ts->clientGetNameFromDbid($newdbTime['databaseId']))['name'];
      $uid = $ts->getElement('data', $ts->clientGetNameFromDbid($newdbTime['databaseId']))['cluid'];
      $medDesc .= '[*] [URL=client://0/'.$uid.']'.$nick.'[/URL] '.qBot::convertSecondsSecond($newdbTime['afkTime'] / 1000);
    }
    $replaces = array(
      1 => array(1 => '[count]', 2 => $limit)
    );
    $desc .= $cfge['topAfkTime']['topDesc'];
    $desc .= '[list=1]'.$medDesc.'[/list]';
    $desc .= $cfge['topAfkTime']['downDesc'];
    $desc_final = qBot::replaceInfo($desc, $replaces);
    $msg['channel_description'] = $desc_final;
    if(qBot::ifChannelDescriptionSame($cfge['topAfkTime']['channelId'], $desc_final, $ts)){
      $ts->channelEdit($cfge['topAfkTime']['channelId'], $msg);
    }
  unset($dtbTime, $data, $newdata, $desc);
  }
}
 ?>
