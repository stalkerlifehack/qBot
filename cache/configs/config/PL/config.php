<?php
/*******************************************
    Konfiguracja połączenia z bazą danych
********************************************/
$config['dtb_connection'] = array(

  //IP serwera z bazą danych
  'ip' => '127.0.0.1',

  //Login do bazy danych
  'dtb_login' => 'root',

  //Hasło do bazy  danych
  'dtb_passwd' => 'Fantazja1515',

  //Nazwa bazy danych
  'dtb_name' => 'qBot',

  'dtb_port' => 3306,

  'dtb_type' => 'mysql',

  'dtb_encoding' => 'utf-8',

);


/*************************************************
    Konfiguracja połączenia pierwszej instancji
**************************************************/
$config['1']['connection'] = array(

  //IP serwera teamspeak
  'ip' => '127.0.0.1',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => '2381omXw',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'S-Bot 1',

  //Kanał na który bot ma przejść
  'channel_id' => 12,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
);


/***********************************************
    Konfiguracja połączenia drugiej instancji
************************************************/
$config['2']['connection'] = array(

  //IP serwera teamspeak
  'ip' => '127.0.0.1',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => '2381omXw',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'S-Bot 2',

  //Kanał na który bot ma przejść
  'channel_id' => 12,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
);


/************************************************
    Konfiguracja połączenia trzeciej instancji
*************************************************/
$config['3']['connection'] = array(

  //IP serwera teamspeak
  'ip' => '127.0.0.1',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => '2381omXw',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'S-Bot 3',

  //Kanał na który bot ma przejść
  'channel_id' => 12,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
);


/************************************************
    Konfiguracja połączenia czwartej instancji
*************************************************/
$config['4']['connection'] = array(

  //IP serwera teamspeak
  'ip' => '127.0.0.1',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => '2381omXw',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'S-Bot 4',

  //Kanał na który bot ma przejść
  'channel_id' => 12,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
);


/**********************************************
    Konfiguracja połączenia piątej instancji
***********************************************/
$config['5']['connection'] = array(

  //IP serwera teamspeak
  'ip' => '127.0.0.1',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => '2381omXw',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'S-Bot 5',

  //Kanał na który bot ma przejść
  'channel_id' => 12,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
);

/**********************************************
        Konfiguracja wykrywania błędów
***********************************************/

$config['showErrorsLoop'] = true; //Czy ma pokazywać błędy związane z długościa nazwy kanałów itp... (sprawdza przy kazdym wykonaniu funkcji)
$config['showErrorsStarts'] = true; //Czy ma pokazywać błędy związane z id kanałów itp... (sprawdza tylko raz, !!! lecz bez nazw kanałów !!!)
$config['logsEnabled'] = true;


/**********************************************
    Konfiguracja funkcji pierwszej instancji
***********************************************/

/*Dostępne eventy to:
0-multiFunction
1-serverName
2-pokeAdmins
3-clanGroup
4-registerChannel
5-channelNameGuard
6-adminStatusOnChannel
7-topAfkTime
8-topTimeSpent
9-clientInfoBase
*/
//Lista funkcji, które mają być włączone -> wykonywane w interwałach czasowych.
$config['1']['events']['list'] = array('0-multiFunction', '1-serverName', '2-pokeAdmins', '3-clanGroup', '4-registerChannel', '5-channelNameGuard', '6-adminStatusOnChannel', '7-topAfkTime', '8-topTimeSpent', '9-clientInfoBase');

//Interwały wykonywania się funkcji
//0 to numer funkcji, który występuje w jej nazwie
$config['1']['events']['interval'] = array(

  '0' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 40), // multiFunction -> optymalny interwał 30-40 sekund

  '1' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), // serverName -> optymalny interwał 20-30 sekund

  '2' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 6), // pokeAdmins -> optymalny interwał 6-8 sekund

  '3' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), // clanGroup -> optymalny interwał 4-5 sekund

  '4' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 4), // registerChannel -> optymalny interwał 4-5 sekund

  '5' => array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 5), // channelNameGuard -> optymalny interwał 60-70 sekund

  '6' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 8), // adminStatusOnChannel -> optymalny interwał 8-10 sekund

  '7' => array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 30), // topAfkTime -> optymalny interwał 60-90 sekund

  '8' => array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 30), // topTimeSpent -> optymalny interwał 60-90 sekund

  '9' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2), /* clientInfoBase -> optymalny interwał 2 sekundy (Tutal lepiej nie dawać wiecej niz 2
                                                                                                                         bo ta funkcja zapisuje ostatni kanał klienta)*/
);

/*********
  Eventy
**********/
$config['1']['events']['cfg'] = array(

  'multiFunction' => array(
    //Online użytkowników w nazwie kanału
    'onlineOnChannel' => array(
      'enabled' => true,
      'channelId' => 2,
      'channelName' => 'Aktualnie online: [onl]/[max]',
    ),
    //Ping serwera w nazwie kanału
    'pingOnChannel' => array(
      'enabled' => true,
      'channelId' => 3,
      'channelName' => 'Średni ping na serwerze: [ping] ms',
    ),
    //PacketLoss serwera w nazwie kanału
    'packetLossOnChannel' => array(
      'enabled' => true,
      'channelId' => 5,
      'channelName' => 'Średnia utrata pakietów: [packet] %',
    ),
    //Uptime serwera w nazwie kanału
    'uptimeOnChannel' => array(
      'enabled' => true,
      'channelId' => 34,
      'channelName' => 'Serwer działa od [time]',
    ),
  ),
  /*Nazwa serwera, dostępne parametry to:
  [onl] -> użytkowników onlineOnChannel
  [max] -> ilość slotów serwera
  [proc] -> procentowe zajęcie slotów serwera
  */
  'serverName' => array(
    'serverName' => 'Q-Bot.pl [Aktualnie online [onl]/[max] czyli [proc]%]'  //Dostępne parametry [onl], [max], [proc]
  ),
  //Rozbudowane centrum pomocy
  'pokeAdmins' => array(
    0 => array(
      'channelId' => 44,  //Id kanału centrum pomocy
      'adminGroups' => array(6), //Wszystkie grupy administracji
      'neededGroups' => array(7, 8), //Grupy wymagane, aby korzystać z centrum pomocy, jeśli damy 0 to wyłączymy tą opcje
      'blockedGroups' => array(10), //Grupy, tkóre nie mogą korzystać z centrum pomocy, jeśli damy 0 to wyłączymy tą opcje
      'afkAdminGroup' => array(9),  //Jeśli admin będzie miał te grupy nie otrzyma poke/pw
      'pokeORpw' => 1, // 1-poke / 2-pw
      'moveMode' => true, //Opcja przenosząca użytkownika na jego ostatni kanał / UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ),
    1 => array(
      'channelId' => 43,
      'adminGroups' => array(6),
      'neededGroups' => array(7, 8),
      'blockedGroups' => array(10),
      'afkAdminGroup' => array(9),
      'pokeORpw' => 1,
      'moveMode' => false,
    ),
  ),
  //Nadawanie i odbieranie rangi
  'clanGroup' => array(
    0 => array(
      'channelId' => 52, //Id kanału
      'groupGrant' => 11, // Grupa, która ma nadawać/odbierać
      'moveMode' => true, //Opcja przenosząca użytkownika na jego ostatni kanał (po nadaniu/odebraniu rangi) UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ),
    1 => array(
      'channelId' => 53,
      'groupGrant' => 12,
      'moveMode' => false,
    ),
  ),
  //Nadawanie rangi rejestracyjnej po wejściu na dany kanał
  'registerChannel' => array(
    0 => array(
      'channelId' => 45, //Id kanału
      'groupId' => 13, //Id grupy
      'requiredConnections' => 20, //Wymagana ilość połączeń / 0 oznacza brak wymaganych połączeń
      'timeRequired' => 3600 * 1, //Ile czasu trzeba spędzić na serwerze aby bot nam dał range UWAGA! Trzeba mieć włączoną funckje "topTimeSpent" można ewentulanie wyłączyć edycję kanału
      'moveMode' => true, ///Opcja przenosząca użytkownika na jego ostatni kanał (po nadaniu rangi) UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ),
    1 => array(
      'channelId' => 46,
      'groupId' => 14,
      'requiredConnections' => 20,
      'timeRequired' => 3600 * 1,
      'moveMode' => true,
    ),
  ),
  //Sprawdzanie nazw kanałów
  'channelNameGuard' => array(
    'channelsException' => array(), //Kanały, których ma nie sprawdzać / puste oznacza, że wszystkie będą sprawdzane
    'phrasesToGuard' => array('kurwa','KURWA', 'Kurwa', 'k u r w a', 'HUJ', 'huj', 'Huj', 'h u j', 'CIPA', 'Cipa', 'cipa', 'c i p a', 'admin', 'ADMIN', 'Admin', 'a d m i n', 'dziwka', 'DZIWKA',
                              'JEBAC', 'jebac', 'Jebac', 'JEBAĆ', 'jebać', 'Jebać', 'przyjeb', 'wlasciciel', 'CEO', 'ceo', '.pl', '. pl', '. p l', '.PL', '.Pl', '.net', '.NET', '.Net', '.eu',
                              '.EU', '.Eu', 'pedał', 'pedal', 'PEDAL', 'ZJEB', 'zjeb', 'Zjeb', 'A D M I N'),
    'channelNameSecond' => 'Zła nazwa kanału!' //Nazwa kanału
  ),
  //Status administracji na kanale
  'adminStatusOnChannel' => array(
    0 => array(
      'channelId' => 59, //Id kanału
      'databaseId' => 2, //DatabaseId admina
      'channelNameIfOnline' => '[lspacer][->] [nick] jest ON', //Nazwa kanału jeśli admin jest ONLINE
      'channelNameIfOffline' => '[lspacer][->] [nick] jest OFF',  //Nazwa kanału jeśli admin jest OFFLINE
      'channelNameIfAway' => '[lspacer][->] [nick] jest AWAY',  //Nazwa kanału jeśli admin jest AWAY
      'time' => 60, //Czas po którym status zmieni się na AWAY
      'groupId' => 9, //Jeśli admin bedzie miał tą grupę, status zmieni sie na AWAY
    ),
  ),
  /*Generowanie TOP najdłuższego czasu AFK, dostępne parametry to:
  [count] -> ilość rekordów
  UWAGA!
  Zaawansowanej edycji można dokonać w pliku /inc/functions/events/1/7-topAfkTime.php
  */

  'topAfkTime' => array(
    'channelId' => 62, //Id kanału
    'recordsCount' => 10, //Ilość rekordów
    'groupsIgnore' => array(11),  //Grupy, które będą ignorowane
    'topDesc' => '[center][size=16]Top [count] najdłuższego czasu AFK[/size][/center]', //Górny opis kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]',  //Dolny opis kanału
  ),
  /*Generowanie TOP spędzonego czasu na serwerze, dostępne parametry to:
  [count] -> ilośc rekordówarning
  UWAGA!
  Zaawansowanej edycji można dokonać w pliku /inc/functions/events/1/7-topAfkTime.php
  */
  'topTimeSpent' => array(
    'channelId' => 63,  //Id kanału
    'recordsCount' => 10, //Ilość rekordów
    'groupsIgnore' => array(11),  //Grupy ignorowane
    'topDesc' => '[center][size=16]Top [count] spędzonego czasu[/size][/center]', //Górny opis kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]',  //Dolny opis kanału
    'enableChannelDesc' => true, //Włączenie opisu kanału / wyłączamy go jeśli nie chcemy TOPki, ale inna funkcja jej potrzebuje
  ),
);


/*************
    Pluginy
*************/
/*Lista funkcji, które mają być włączone -> wykonywane cały czas.
Dostępne funkcje to:
0-serverGroupProtection
1-moveWhenJoinChannel
2-userPlatform
*/
$config['1']['plugins']['list'] = array('1-moveWhenJoinChannel', '0-serverGroupProtection', '2-userPlatform');

$config['1']['plugins']['cfg'] = array(
  //Przenoszenie użytkownika na dany kanał po wejściu na kanał z wymaganą grupą
  'moveWhenJoinChannel' => array(
    0 => array(
      'channelId' => 54,  //Id kanału, po wejściu na niego bot nas przeniesie
      'groupToMove' => 6, //Id rang wymaganych do przeniesienia, jeśli zostawimy puste każdy będzie mógł korzystać
      'channelToMove' => 1, //Kanał na który ma prznieść
      'moveMode' => true, ////Opcja przenosząca użytkownika na jego ostatni kanał UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ),
  ),
  //Ochrona grup serwerowych
  'serverGroupProtection' => array(
    'ban' => true, //false=kick / true=ban
    'time' => 60 * 60 * 24, //Czas bana w sekundach
    'data' => array(  //Database ID = Grupie
      2 => 6,
    ),
  ),
  //Nadanie grupy jeśli klient połączy się mobilnie
  'userPlatform' => array(
    'android' => 15, //Grupa, która nada jeśli bedzi Andriod / jeśli będzie puste to omijamy tą platforme
    'ios' => 15,  //Grupa, która nada jeśli bedzi IOS / jeśli będzie puste to omijamy tą platforme
  ),
);














/**********************************************
    Konfiguracja funkcji pierwszej instancji
***********************************************/
/*Dostępne eventy to:
0-countDownTime
*/
//Lista funkcji, które mają być włączone -> wykonywane w interwałach czasowych.
$config['2']['events']['list'] = array('0-countDownTime', '1-ddosAlert', '2-createPremiumChannels',);

//Interwały wykonywania się funkcji
//0 to numer funkcji, który występuje w jej nazwie
$config['2']['events']['interval'] = array(

  '0' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 60), //countDownTime -> optymalny interwał 60 sekund
  '1' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 25), //ddosAlert -> optymalny interwał 20-30 sekund
  '2' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),
  '3' => array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),
);

/*********
  Eventy
**********/
$config['2']['events']['cfg'] = array(
  /*Odliczanie do jakiejś daty
  Dostępne parametry:
  [time] -> czas pozostały do wydarzenia/daty
  */
  'countDownTime' => array(
    'channelId' => 64, //Id kanału
    'channelName' => 'Następny sylwester za: [time]', //Nazwa kanału
    'data' => array(
      'year' => 2019, //rok
      'month' => 1, //miesiąc
      'day' => 1, //dzień
      'hour' => 12, //godzina
      'minute' => 30, //minuta
      'second' => 0, //sekunda
    ),
  ),
  'ddosAlert' => array(
    'groups' => array(6), //grupy do powiadomienia
    'message' => 'PacketLoss serwera podwyższył się! Możliwe, że jest to atak DDOS!', //Wiadomość
    'packetLoss' => 35, //Powyżej tylu % powiadomi administracje
  ),
  //addChannelGroup = normal (z tym ze add.. tam daje nam grupe kanalu)
  //onlineOnChannel = kanal z licznikiem
  //clanGroup tez daje range kanalowa
  'createPremiumChannels' => array(
    'channelId' => 2,
    'firstChannel' => 2, //Id kanału pod którym ma utworzyć pierwszy kanał
    'channelAdminGroupId' => 5,
    'groupToCopy' => 7,
    'channels' => array(
      0 => array(
        'channelName' => '[cspacer[num]]> ------------------- <',
        'type' => 'normal',
      ),
      1 => array(
        'channelName' => '[cspacer[num]]Aktualnie online:[onl]',
        'type' => 'onlineOnChannel',
      ),
      2 => array(
        'channelName' => '[cspacer[num]] Nadaj/Odbierz range',
        'type' => 'clanGroup',
      ),
      3 => array(
        'channelName' => '[cspacer[num]]> ------------------- <',
        'type' => 'normal',
      ),
      4 => array(
        'channelName' => '[cspacer[num]]',
        'type' => 'normal',
      ),
      5 => array(
        'channelName' => '[cspacer[num]]Liderówka',
        'type' => 'addChannelGroup',
        'sub' => array(
          0 => array(
            'channelName' => 'Kanał 1',
            'type' => 'normal',
          ),
        ),
      ),
      6 => array(
        'channelName' => '[cspacer[num]]Kanały',
        'type' => 'addChannelGroup',
        'sub' => array(
          0 => array(
            'channelName' => 'Kanał 1',
            'type' => 'normal',
          ),
          1 => array(
            'channelName' => 'Kanał 2',
            'type' => 'normal',
          ),
          2 => array(
            'channelName' => 'Kanał 3',
            'type' => 'normal',
          ),
          3 => array(
            'channelName' => 'Kanał 4',
            'type' => 'normal',
          ),
          4 => array(
            'channelName' => 'Kanał 5',
            'type' => 'normal',
          ),
        ),
      ),
    ),
  ),
);


$config['2']['plugins']['list'] = array();
$config['2']['plugins']['cfg'] = array();






$config['3']['events']['list'] = array();

$config['3']['events']['interval'] = array();

$config['3']['events']['cfg'] = array();

$config['3']['plugins']['list'] = array();
$config['3s']['plugins']['cfg'] = array();







$config['4']['events']['list'] = array();

$config['4']['events']['interval'] = array();





$config['5']['events']['list'] = array();

$config['5']['events']['interval'] = array();



?>
