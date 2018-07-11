<?php
class qBot{

  //function_number=numer funkcji bez tablicy!!! (z configu biore)
  //function_first_time=czas pobierany z bazy danych  (z bazy danych)
  //functions_interval=interwał kazdej funccji Bez tablicy!!!! (z configu)

  //can_do ma zwracac false lub true czy moge wykonac funcje czy nie (time())

//number data interval
  function can_do($function_number, $function_first_time, $functions_interval){
    foreach($function_first_time as $dtb_data){
      if($function_number == $dtb_data['function']){
        $time_now = time();
        $difference = $time_now - $dtb_data['time'];
        $interval = (($functions_interval['days'] * 86400) + ($functions_interval['hours'] * 3600) + ($functions_interval['minutes'] * 60) + $functions_interval['seconds']);
        if($difference > $interval){
          return true;
        }
        else{
          return false;
        }
      }
    }
  }

  //cid=nazwa kanalu pobierana
  //nazwa kanalu nowa
  function ifChannelNameSame($cid, $cname, $ts){
    $channelInfo = $ts->getElement('data', $ts->channelInfo($cid));
    if($channelInfo['channel_name'] === $cname){
      return false;
    }
    else{
      return true;
    }
  }

  function ifChannelDescriptionSame($cid, $cname, $ts){
    $channelInfo = $ts->getElement('data', $ts->channelInfo($cid));
    if($channelInfo['channel_description'] === $cname){
      return false;
    }
    else{
      return true;
    }
  }

  //Params '-groups -voice -away -times -uid -country -info -ip'
  function getClInfo($params, $ts){
    $clients = $ts->getElement('data', $ts->clientList($params));
   }

  //msg wiadomosc   replaces tablica z danymi
  function replaceInfo($msg, $replaces){
    foreach($replaces as $replace){
      $msg = str_replace($replace[1], $replace[2], $msg);
    }
    return $msg;
  }

  function convertSeconds($seconds){
    $time = array();
    if($seconds < 60){
      return 'mniej niż minuty';
    }
    if($seconds >= 60 && $seconds < 86400){
      $time['hours'] = floor($seconds / 3600);
      $time['minutes'] = floor(($seconds - ($time['hours'] * 3600)) / 60);
      if($time['hours'] == 1){
        $time['hours'] .= ' godziny';
      }
      if($time['hours'] > 1){
        $time['hours'] .= ' godzin';
      }
      if($time['minutes'] == 1){
        $time['minutes'] .= ' minuty';
      }
      if($time['minutes'] > 1 || $time['minutes'] == 0){
        $time['minutes'] .= ' minut';
      }
      if(!$time['hours'] == 0){
        if($time['minutes'] == 0){
          return ($time['hours']);
        }
        else{
          return ($time['hours'].' '.$time['minutes']);
        }
      }
      else{
        return ($time['minutes']);
      }

    }
    if($seconds >= 86400){
      $time['days'] = floor($seconds / 86400);
      $time['hours'] = floor(($seconds - ($time['days'] * 86400)) / 3600);
      if($time['days'] == 1){
        $time['days'] .= ' dnia';
      }
      if($time['days'] > 1){
        $time['days'] .= ' dni';
      }
      if($time['hours'] == 1){
        $time['hours'] .= ' godziny';
      }
      if($time['hours'] > 1 || $time['hours'] == 0){
        $time['hours'] .= ' godzin';
      }
      if(!$time['days'] == 0){
        if($time['hours'] == 0){
          return $time['days'];
        }
        else{
          return $time['days'].' '.$time['hours'];
        }
      }
      else{
        return $time['hours'];
      }
    }
  }
  function convertSecondsSecond($seconds){
    $time = array();
    if($seconds < 60){
      return 'mniej niż minuta';
    }
    if($seconds >= 60 && $seconds < 86400){
      $time['hours'] = floor($seconds / 3600);
      $time['minutes'] = floor(($seconds - ($time['hours'] * 3600)) / 60);
      if($time['hours'] == 1){
        $time['hours'] .= ' godzina';
      }
      elseif(substr($time['hours'], -1) > 1 && substr($time['hours'], -1) < 5){
        $time['hours'] .= ' godziny';
      }
      else{
        $time['hours'] .= ' godzin';
      }
      if($time['minutes'] == 1){
        $time['minutes'] .= ' minuta';
      }
      elseif(substr($time['minutes'], -1) > 1 &&  substr($time['minutes'], -1) < 5){
        $time['minutes'] .= ' minuty';
      }
      else{
        $time['minutes'] .= ' minut';
      }
      if($time['hours'] == 0){
        return ($time['minutes']);
      }
      else{
        if($time['minutes'] == 0){
          return ($time['hours']);
        }
        else{
          return ($time['hours'].' '.$time['minutes']);
        }
      }

    }
    if($seconds >= 86400){
      $time['days'] = floor($seconds / 86400);
      $time['hours'] = floor(($seconds - ($time['days'] * 86400)) / 3600);
      if($time['days'] == 1){
        $time['days'] .= ' dzień';
      }
      else{
        $time['days'] .= ' dni';
      }
      if($time['hours'] == 1){
        $time['hours'] .= ' godzina';
      }
      elseif(substr($time['hours'], -1) > 1 && substr($time['hours'], -1) < 5){
        $time['hours'] .= ' godziny';
      }
      else{
        $time['hours'] .= ' godzin';
      }
      if($time['days'] == 0){
        return $$time['hours'];
      }
      else{
        if($time['hours'] == 0){
          return $time['days'];
        }
        else{
          return $time['days'].' '.$time['hours'];
        }
      }
    }
  }
                      //grupy ktore ma,   grupy do sprawdzenie czy w nich jest
  function difTwoTables($table1, $table2){
    if(array_intersect($table1, $table2)){
      return true;
    }
    else{
      return false;
    }
  }

  function ifAdminIsInChannel($channelId, $adminGroups, $ts){
    foreach($ts->getElement('data', $ts->channelClientList($channelId, '-groups')) as $adminInfo){
      $adminChInfo = explode(",", $adminInfo['client_servergroups']);
      if(array_intersect($adminChInfo, $adminGroups)){
        return true;
      }
      else{
        return false;
      }

    }
  }
  function pokeAdmin($admId, $message, $ts){
    foreach($admId as $xx){
      $ts->clientPoke($xx, $message);
    }
  }
  //Channel to kanały które ma omijać oczywiscie w tablicy zapisane
  //tutaj bedzie trzeba dodawac kanały
  function clientDataChannel($channel, $ts, $cfge){
    global $baza;
    foreach($ts->getElement('data', $ts->clientList()) as $client){
      if(!in_array($client['cid'], $channel) && $client['client_type'] == 0){
        $dtbinfo = $client['client_database_id'];
        $info = $baza->query("SELECT `clientId` FROM `lastClientChannel` WHERE `databaseId`=$dtbinfo");//->execute(array(':databaseId' => $dtbinfo));
        $result = $info->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
          $baza->prepare("INSERT INTO `lastClientChannel` SET `clientId`=:clid, `databaseId`=:clientdbInfo, `channelId`=:cid")->execute(array(
            ':clid' => $client['clid'],
            ':clientdbInfo' => $client['client_database_id'],
            ':cid' => $client['cid'],
          ));
        }
        else{
          $baza->prepare("UPDATE `lastClientChannel` SET `clientId`=:clid, `databaseId`=:clientdbInfo, `channelId`=:cid WHERE `databaseId`=:clientdbInfo")->execute(array(
            ':clid' => $client['clid'],
            ':clientdbInfo' => $client['client_database_id'],
            ':cid' => $client['cid'],
          ));
        }
      }
    }
    unset($baza);
  }







}
?>
