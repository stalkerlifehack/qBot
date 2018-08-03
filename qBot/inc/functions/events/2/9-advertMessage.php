<?php
class advertMessage{
  function __construct($ts, $cfge, $lang=null, $baza){
    $count = count($cfge['advertMessage']);
    $data = $baza->query("SELECT `msg` FROM `advertMessage`")->fetch(PDO::FETCH_ASSOC);
    $ts->gm($cfge['advertMessage'][$data['msg']]);
    if($data['msg'] != ($count - 1)){
      $baza->prepare("UPDATE `advertMessage` SET `msg`=:msg")->execute(array(
        ':msg' => ($data['msg'] + 1)
      ));
    }
    else{
      $baza->prepare("UPDATE `advertMessage` SET `msg`=:msg")->execute(array(
        ':msg' => 0
      ));
    }
  }
}
 ?>
