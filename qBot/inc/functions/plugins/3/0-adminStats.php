<?php
class adminStats{

  private static function checkRecords($baza, $aTime){
    $data = $baza->query("SELECT `actionTime` FROM `adminStatistics` WHERE `actionTime`='$aTime'");
    $result = $data->fetch(PDO::FETCH_ASSOC);
    if(empty($result['actionTime'])){
      return true;
    }
    else{
      return false;
    }
  }
  private static function insertAction($baza, $aTime, $adminId, $groupAdded, $clientWhereAdded){
    $baza->prepare("INSERT INTO `adminStatistics` SET `actionTime`=:actionTime, `adminId`=:adminId, `groupAdded`=:groupAdded, `clientWhereAdded`=:clientWhereAdded")->execute(array(
      ':actionTime' => $aTime,
      ':adminId' => $adminId,
      ':groupAdded' => $groupAdded,
      ':clientWhereAdded' => $clientWhereAdded
    ));
  }

  private static function convertData($data){
    $date = (preg_split('/[- :]/i', $data));
    return $date[0]."-".$date[1]."-".$date[2]." ".$date[3].":".$date[4].":".round($date[5]);
  }

  private static function adminsDatabase($ts, $cfgp){
    foreach($cfgp['adminStats']['adminGroups'] as $in => $group){
      foreach($ts->getElement('data', $ts->serverGroupClientList($group, true)) as $index => $client){
        if(!empty($client['cldbid'])){
          $admins[$in][$index] = $client['cldbid'];
        }
      }
    }
    return $admins;
  }
  function __construct($ts, $cfgp, $lnag=null, $baza){
    for($i=1; $i<=50; $i++){
      $d = ($ts->getElement('data', $ts->logView($i)));
      foreach($d[0] as $index => $k){
        if($index == 'l'){
          $info = explode("|", $k);
          $moreInfo = explode(" ", $info[4]);
          if($moreInfo[3] == 'added'){ //tylko dodanie grupy
            $a = explode("'", $info[4]);
            $groupAdded = preg_split('/[id:)]/i', $a[2]);
            $userAdded = preg_split('/[id:)]/i', $a[4]);
            $userWhereAdded = preg_split('/[id:)]/i', $a[0]);
            for($x=0; $x<(count($cfgp['adminStats']['adminGroups'])); $x++){
              if(!empty(self::adminsDatabase($ts, $cfgp)[$x])){
                if(in_array($userAdded[3], self::adminsDatabase($ts, $cfgp)[$x])){
                  if(self::checkRecords($baza, self::convertData($info[0]))){
                    if(in_array($groupAdded[3], $cfgp['adminStats']['monitoredGroups'])){
                      self::insertAction($baza, self::convertData($info[0]), $userAdded[3], $groupAdded[3], $userWhereAdded[4]);
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
 ?>
