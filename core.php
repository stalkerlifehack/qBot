<?php
date_default_timezone_set('Europe/Warsaw');
define("END", "\n");
define("version", "1.1");
define("author", "Stalker");
define("name", "Q-Bot");
define("SP", " ");
define("PREF", "\e[92m[->]\e[0m");
define("ERR", "\e[91m[ERROR]\e[0m");
define("ENDC", "\e[0m");
define("GREEN", "\e[92m");
define("RED", "\e[91m");
define("ORAN", "\e[33m");

require_once('configs/config.first.php');
require_once('configs/config/'.$language.'/config.php');
require_once('configs/config/'.$language.'/language.php');
require_once('inc/classes/printError.class.php');


echo PREF.SP.$lang['welcome'].SP.name.END;
echo PREF.SP.$lang['author'].SP.author.END;
echo PREF.SP.$lang['loading'].END.END;

require_once('inc/classes/ts3admin.class.php');
require_once('inc/classes/Q-Bot.class.php');

$instance = getopt("i:");
if($instance['i'] > 5){
  echo PREF.SP.$lang['err_inst'].SP."(".$instance['i'].")".END;
  exit;
}
$cfge = $config[$instance['i']]['events']['cfg'];
$cfgp = $config[$instance['i']]['plugins']['cfg'];
$events_count = 0;
$plugins_count =0;
foreach($config[$instance['i']]['events']['list'] as $active_functions){
include_once('inc/functions/events/'.$instance['i'].'/'.$active_functions.'.php');
$events_count++;
}
foreach($config[$instance['i']]['plugins']['list'] as $active_plugins){
include_once('inc/functions/plugins/'.$instance['i'].'/'.$active_plugins.'.php');
$plugins_count++;
}
echo PREF.SP.$lang['load_events'].SP.ORAN.$events_count.ENDC.SP.$lang['events'].SP.$lang['and'].SP.ORAN.$plugins_count.ENDC.SP.$lang['plugins'].END;
try
{
 $dsn = $config['dtb_connection']['dtb_type'] .
 ':host=' . $config['dtb_connection']['ip'] .
 ';port=' . $config['dtb_connection']['dtb_port'] .
 ';encoding=' . $config['dtb_connection']['dtb_encoding'] .
 ';dbname=' . $config['dtb_connection']['dtb_name'];
 $baza = new PDO($dsn, $config['dtb_connection']['dtb_login'], $config['dtb_connection']['dtb_passwd']);
 $baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 define('DB_CONNECTED', true);
 echo PREF.SP.$lang['dtb_suc'].END;
} catch(PDOException $e)
{
 die(ERR.SP.$lang['dtb_err'] . $e->getMessage());

}
echo PREF.SP.$lang['start_inst']['1'].SP.ORAN.$instance['i'].ENDC.SP.$lang['start_inst']['2'].END.END;
$ts = new query($config[$instance['i']]['connection']['ip'], $config[$instance['i']]['connection']['query_port']);
if($ts->getElement('success', $ts->connect())){
  echo PREF.SP.$lang['srv_conn_succ'].END;
  if($ts->getElement('success', $ts->login($config[$instance['i']]['connection']['query_login'], $config[$instance['i']]['connection']['query_passwd']))){
    echo PREF.SP.$lang['srv_conn_query'].END;
    if($ts->getElement('success', $ts->selectServer($config[$instance['i']]['connection']['server_port']))){
      echo PREF.SP.$lang['bot_sel_serv'].END;
    }
    else{
      echo PREF.SP.$lang['srv_conn_error'].END;
      exit;
    }
    if($ts->getElement('success', $ts->setName($config[$instance['i']]['connection']['bot_name']))){
      echo PREF.SP.$lang['bot_change_nick'].SP.ORAN.$config[$instance['i']]['connection']['bot_name'].ENDC.END;
    }
    else{
      echo ERR.SP.$lang['bot_change_nick_error'].END;
    }
    if($ts->getElement('success', $ts->clientMove($ts->getElement('data',$ts->whoAmI())['client_id'], $config[$instance['i']]['connection']['channel_id']))){
      echo PREF.SP.$lang['bot_change_channel'].SP.ORAN.$config[$instance['i']]['connection']['channel_id'].ENDC.END;
    }
    else{
      echo ERR.SP.$lang['bot_channel_chang_err'].SP.ORAN.'('.$config[$instance['i']]['connection']['channel_id'].')'.ENDC.END;
    }
  }
  else{
    echo ERR.SP.$lang['serv_login_quer_err'].END;
    exit;
  }
  //error::chceckChannelsId($ts, $cfge, $cfgp, $config);
  while(true){
    if($instance['i'] <= 3){
      foreach($config[$instance['i']]['plugins']['list'] as $function_plugin_name){
        foreach(explode("-", $function_plugin_name) as $number_plugin){
          if(is_numeric($number_plugin)){
            if($number_plugin <= 9){                                //to czy liczba dwucyfrowa itp.
              $function_to_do_plugin = substr($function_plugin_name, 2);
              $function_to_do_plugin::start($ts, $cfgp, $lang, $baza);
            }
            elseif($number_plugin > 9 && $number_plugin <= 99){
              $function_to_do_plugin = substr($function_plugin_name, 3);
              $function_to_do_plugin::start($ts, $cfgp, $lang, $baza);
            }
            elseif($number_plugin > 99){
              echo ERR.SP.$lang['function_number_high'].END;
              exit;
            }
          }
        }
      }
    }
    if($instance['i'] == 1){
      $data = $baza->query("SELECT `time`, `function` FROM functions_first");
    }
    if($instance['i'] == 2){
      $data = $baza->query("SELECT `time`, `function` FROM functions_second");
    }
    if($instance['i'] == 3){
      $data = $baza->query("SELECT `time`, `function` FROM functions_third");
    }
    foreach($config[$instance['i']]['events']['list'] as $function_name){ //foreachowanie listy eventow
      foreach(explode("-", $function_name) as $number){ //rozdzielanie nueru i nazwy
        if(is_numeric($number)){  //wybieranie tylko numeru
          if(qBot::can_do($number, $data, $config[$instance['i']]['events']['interval'][$number])){  //sprawdzanie czasu
            //$data->closeCursor();
            if($number <= 9){                                //to czy liczba dwucyfrowa itp.
              $function_to_do_event = substr($function_name, 2);
              $function_to_do_event::start($ts, $cfge, $lang, $baza);
            }
            elseif($number > 9 && $number <= 99){
              $function_to_do_event = substr($function_name, 3);
                $function_to_do_event::start($ts, $cfge, $lang, $baza);
            }
            elseif($number > 99){
              echo ERR.SP.$lang['function_number_high'].END;
              exit;
            }
            $time_now = time();
            if($instance['i'] == 1){
              $baza->prepare("UPDATE `functions_first` set `time`=:time_now WHERE `function`=:number")->execute(array(
                ':time_now' => $time_now,
                ':number' => $number,
              ));
            }
            if($instance['i'] == 2){
              $baza->prepare("UPDATE `functions_second` set `time`=:time_now WHERE `function`=:number")->execute(array(
                ':time_now' => $time_now,
                ':number' => $number,
              ));
            }
            if($instance['i'] == 3){
              $baza->prepare("UPDATE `functions_third` set `time`=:time_now WHERE `function`=:number")->execute(array(
                ':time_now' => $time_now,
                ':number' => $number,
              ));
            }
          }
        }
      }
    }
sleep($config[$instance['i']]['connection']['delay']);
  }
}
else{
  echo ERR.SP.$lang['end_err'].END;
}
?>
