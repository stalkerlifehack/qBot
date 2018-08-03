<?php
//////////////////////////////
//          config
//////////////////////////////
$functions = ['one', 'two', 'three', 'four'];
$intervals = [
  'one' => 1,
  'two' => 5,
  'three' => 20,
  'four' => 60,
];
//////////////////////////////
//         core
//////////////////////////////

foreach($functions as $function){
  $$function = $intervals[$function];
}

while(true){
  foreach($functions as $function){
    if($$function < time()){
      $$function = time() + $intervals[$function];
      echo $function.PHP_EOL;
    }
  }
  echo "_____________________".PHP_EOL;
  sleep(1);
}
 ?>
