<?php
class topTimeSpent{
  function start($ts, $cfge, $null=NULL, $baza){
    foreach($ts->getElement('data', $ts->clientList('-groups')) as $client){
      $clInfo = $ts->getElement('data', $ts->clientInfo($client['clid']));
      if($client['client_type'] == 0 && !qBot::difTwoTables($cfge['topTimeSpent']['groupsIgnore'], explode(",", $client['client_servergroups']))){
        $clientdbinfo = $client['client_database_id'];
        $data = $baza->query("SELECT `totalTime`, `lastTime` FROM topTimeSpent WHERE `databaseId`=$clientdbinfo");
        $result = $data->fetch(PDO::FETCH_ASSOC);
        if(!empty($result['totalTime'])){
          if(round($clInfo['connection_connected_time'] / 1000) >= $result['totalTime']){
            $baza->prepare("UPDATE `topTimeSpent` SET `totalTime`=:clientNewTime,  `lastTime`=0 WHERE `databaseId`=:databaseId")->execute(array(
            ':clientNewTime' => round($clInfo['connection_connected_time'] / 1000),
              ':databaseId' => $client['client_database_id']
            ));
          }
          else{
            if(round($clInfo['connection_connected_time'] / 1000) < $result['lastTime']){
              $baza->prepare("UPDATE `topTimeSpent` SET `lastTime`=0 WHERE `databaseId`=:databaseId")->execute(array(
              ':databaseId' => $client['client_database_id']
              ));
            }
            $dataSecond = $baza->query("SELECT `totalTime`, `lastTime` FROM topTimeSpent WHERE `databaseId`=$clientdbinfo");
            $resultSecond = $dataSecond->fetch(PDO::FETCH_ASSOC);
            $baza->prepare("UPDATE `topTimeSpent` SET `totalTime`=:newTotalTime, `lastTime`=:newLastTime WHERE `databaseId`=:databaseId")->execute(array(
            ':newTotalTime' => ($resultSecond['totalTime'] - $resultSecond['lastTime']) + round($clInfo['connection_connected_time'] / 1000),
              ':newLastTime' => round($clInfo['connection_connected_time'] / 1000),
              ':databaseId' => $client['client_database_id']
            ));
          }
        }
        else{
          $baza->prepare("INSERT INTO `topTimeSpent` SET `totalTime`=:insertTotalTime, `databaseId`=:databaseId, `lastTime`=0")->execute(array(
            ':insertTotalTime' => round($clInfo['connection_connected_time'] / 1000),
            ':databaseId' => $client['client_database_id']
          ));
        }
      }
    }
    if($cfge['topTimeSpent']['enableChannelDesc']){
      $limit = $cfge['topTimeSpent']['recordsCount'];
      $newdata = $baza->query("SELECT `totalTime`, `databaseId` FROM topTimeSpent ORDER BY `totalTime` DESC LIMIT $limit");
      $desc = '';
      $medDesc = '';
      while ($newdbTime = $newdata->fetch()){
        $nick = $ts->getElement('data', $ts->clientGetNameFromDbid($newdbTime['databaseId']))['name'];
        $uid = $ts->getElement('data', $ts->clientGetNameFromDbid($newdbTime['databaseId']))['cluid'];
        $medDesc .= '[*] [URL=client://0/'.$uid.']'.$nick.'[/URL] '.qBot::convertSecondsSecond($newdbTime['totalTime']);
      }
      $replaces = array(
        1 => array(1 => '[count]', 2 => $limit)
      );
      $desc .= $cfge['topTimeSpent']['topDesc'];
      $desc .= '[list=1]'.$medDesc.'[/list]';
      $desc .= $cfge['topTimeSpent']['downDesc'];
      $desc_final = qBot::replaceInfo($desc, $replaces);
      $msg['channel_description'] = $desc_final;
      if(qBot::ifChannelDescriptionSame($cfge['topTimeSpent']['channelId'], $desc_final, $ts)){
        $ts->channelEdit($cfge['topTimeSpent']['channelId'], $msg);
      }
    }
  unset($data, $dataSecond, $newdata, $desc_final);
  }
}
 ?>
