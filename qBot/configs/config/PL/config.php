<?php
$config = [];
/********************************************
*                                           *
*   Konfiguracja połączenia z bazą danych   *
*                                           *
********************************************/

$config['dtb_connection'] = [

  //IP serwera z bazą danych
  'ip' => '127.0.0.1',

  //Login do bazy danych
  'dtb_login' => 'root',

  //Hasło do bazy danych
  'dtb_passwd' => 'xxx',

  //Nazwa bazy danych
  'dtb_name' => 'qBot',

  //Port do bazy danych
  'dtb_port' => 3306,

  //Typ bazy dancyh
  'dtb_type' => 'mysql',

  //Kodowanie znaków
  'dtb_encoding' => 'utf-8',

];


/********************************************
*                                           *
*    Konfiguracja połączenia 1 instancji    *
*                                           *
********************************************/

$config['1']['connection'] = [

  //IP serwera teamspeak
  'ip' => '178.217.188.74',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => 'xxxx',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'qBot @ Warden',

  //Kanał na który bot ma przejść
  'channel_id' => 1,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
];


/********************************************
*                                           *
*    Konfiguracja połączenia 2 instancji    *
*                                           *
********************************************/

$config['2']['connection'] = [

  //IP serwera teamspeak
  'ip' => '178.217.188.74',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => 'xxxx',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'qBot @ Admin',

  //Kanał na który bot ma przejść
  'channel_id' => 1,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
];


/********************************************
*                                           *
*    Konfiguracja połączenia 3 instancji    *
*                                           *
********************************************/

$config['3']['connection'] = [

  //IP serwera teamspeak
  'ip' => '178.217.188.74',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => 'xxxx',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'qBot @ Helper',

  //Kanał na który bot ma przejść
  'channel_id' => 1,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
];


/********************************************
*                                           *
*    Konfiguracja połączenia 4 instancji    *
*                                           *
********************************************/

$config['4']['connection'] = [

  //IP serwera teamspeak
  'ip' => '178.217.188.74',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => 'xx',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'qBot @ Updater',

  //Kanał na który bot ma przejść
  'channel_id' => 1,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
];


/********************************************
*                                           *
*    Konfiguracja połączenia 5 instancji    *
*                                           *
********************************************/

$config['5']['connection'] = [

  //IP serwera teamspeak
  'ip' => '178.217.188.74',

  //Port query serwera teamspeak
  'query_port' => '10011',

  //Login query
  'query_login' => 'serveradmin',

  //Hasło query
  'query_passwd' => 'xxx',

  //Port servera
  'server_port' => '9987',

  //Nazwa bot_name
  'bot_name' => 'qBot @ Commander',

  //Kanał na który bot ma przejść
  'channel_id' => 12,

  //Czas jaki bot ma odczekac po wykonaniu wszystkich funcji
  'delay' => 1,
];

/********************************************
*                                           *
*       Konfiguracja wykrywania błędów      *
*                                           *
********************************************/

//Ta opcja wyświetla wszystkie związane z długością nazw kanałów (sprawdza przy każdym wykonaniu funkcji, zalecam włączać tylko gdy potrzebne)
$config['showErrorsLoop'] = true;

//Ta opcja wyświetla błędy związane z id kanałów (Sprawdza tylko przy starcie, zalecam pozostawić włączone)
$config['showErrorsStarts'] = true;

//Ta opcja wyświetla wszystkie błędy (sprawdza przy każdym wykonaniu funcji, zalecam włączać tylko gdy potrzebne)
$config['showDebugLog'] = false;

$config['logEnables'] = false; //Wkrótce


/********************************************
*                                           *
*          Konfiguracja Eventów (1]         *
*                                           *
********************************************/

/*
Dostępne eventy to:
  0-multiFunction
  1-serverName
  2-pokeAdmins
  3-clanGroup
  4-registerChannel
  5-botInfo
  6-adminStatusOnChannel
  7-topAfkTime
  8-topTimeSpent
  9-clientInfoBase
*/

//Lista funkcji, które mają być włączone -> wykonywane w interwałach czasowych.
$config['1']['events']['list'] = ['0-multiFunction', '1-serverName', '2-pokeAdmins', '3-clanGroup', '4-registerChannel', '5-botInfo', '6-adminStatusOnChannel', '7-topAfkTime', '8-topTimeSpent', '9-clientInfoBase'];

//Interwały wykonywania się funkcji
$config['1']['events']['interval'] = [

  0 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 40], // multiFunction -> optymalny interwał 30-40 sekund

  1 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30], // serverName -> optymalny interwał 20-30 sekund

  2 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 6], // pokeAdmins -> optymalny interwał 6-8 sekund

  3 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1], // clanGroup -> optymalny interwał 1-2 sekundy

  4 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1], // registerChannel -> optymalny interwał 1 sekunda

  5 => ['days' => 0, 'hours' => 2, 'minutes' => 0, 'seconds' => 5], // botInfo -> optymalny interwał 60-70 sekund

  6 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 3], // adminStatusOnChannel -> optymalny interwał 3-4 sekundy

  7 => ['days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 30], // topAfkTime -> optymalny interwał 60-90 sekund

  8 => ['days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 30], // topTimeSpent -> optymalny interwał 60-90 sekund

  9 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2], /* clientInfoBase -> optymalny interwał 2 sekundy (Tutal lepiej nie dawać wiecej niz 2
                                                                                                                         bo ta funkcja zapisuje ostatni kanał klienta]*/
];


$config['1']['events']['cfg'] = [

/*
'botInfo'
  Funkcja pobiera informacje ze strony autora i wpisuje je w opis kanału.
  Znajdziemy tu informacje na temat autualizacji, linków do pobrania czy nowych aplikacjach
  Zalecam aby ta funkcja zawsze była włączona, będziecie wtedy na bierząco ze wszystkimi informacjami :)
*/
  'botInfo' => [
    'topDesc' => '[center][size=15]Informacje od Autora[/size][/center][hr]',
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]',
    'channelId' => 235,
  ],

/*
'multiFunction'
  Zbiór mniejszych funkcji
*/
  'multiFunction' => [

/*  Ilosc w nazwie kanalu unikalnych odwiedzin lub jak kto woli ilosc userów w bazie serwera
    Dostępne parametry:
      [onl] - online
      [max] - ilosc slotów
*/
    'onlineOnChannel' => [
      'enabled' => true,
      'channelId' => 192,
      'channelName' => '» Aktualnie online: [onl]/[max]',
    ],

/*  Ilosc w nazwie kanalu unikalnych odwiedzin lub jak kto woli ilosc userów w bazie serwera
    Dostępne parametry:
      [ping] - ping
*/
    'pingOnChannel' => [
      'enabled' => true,
      'channelId' => 43,
      'channelName' => '» Średni ping na serwerze: [ping] ms',
    ],

/*  Ilosc w nazwie kanalu unikalnych odwiedzin lub jak kto woli ilosc userów w bazie serwera
    Dostępne parametry:
      [packet] - packetloss
*/
    'packetLossOnChannel' => [
      'enabled' => true,
      'channelId' => 135,
      'channelName' => '» Średnia utrata pakietów: [packet] %',
    ],

/*  Ilosc w nazwie kanalu unikalnych odwiedzin lub jak kto woli ilosc userów w bazie serwera
    Dostępne parametry:
      [time] - umptime
*/
    'uptimeOnChannel' => [
      'enabled' => true,
      'channelId' => 130,
      'channelName' => '» Serwer działa od [time]',
    ],

/*  Ilosc w nazwie kanalu unikalnych odwiedzin lub jak kto woli ilosc userów w bazie serwera
    Dostępne parametry:
      [onl] - online query
*/
    'queryClientsOnline' => [
      'enabled' => true,
      'channelId' => 191,
      'channelName' => '» Klientów query: [onl]',
      'topDesc' => '[center][size=15]Lista klientów query[/size][/center][hr]',
      'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]',
    ],

/*  Ilosc w nazwie kanalu unikalnych odwiedzin lub jak kto woli ilosc userów w bazie serwera
    Dostępne parametry:
      [visits] - odwiedzin
*/
    'uniqueVisitors' => [
      'enabled' => true,
      'channelId' => 236,
      'channelName' => '» Unikalnych odwiedzin: [visits]',
    ],
  ],

/*
'serverName'
  Nazwa serwera
  Dostępne parametry to:
  [onl] - liczba osób online
  [max] - maksymalna ilość slotów
  [proc] - wartość procentowa zajęcia serwera
*/
  'serverName' => [
    'serverName' => 'KillGaming.pl [Aktualnie online [onl]/[max] czyli [proc]%]'
  ],

/*
'pokeAdmins'
  Funkcja, która powiadamia administracje kiedy użytkownik wejdzie na dany kanał
*/
  'pokeAdmins' => [
    0 => [
      'channelId' => 181,  //Id kanału centrum pomocy
      'adminGroups' => [105, 104, 114, 11, 13, 14], //Wszystkie grupy administracji
      'neededGroups' => [0], //Grupy wymagane, aby korzystać z centrum pomocy, jeśli damy 0 to wyłączymy tą opcje
      'blockedGroups' => [0], //Grupy, tkóre nie mogą korzystać z centrum pomocy, jeśli damy 0 to wyłączymy tą opcje
      'afkAdminGroup' => [0],  //Jeśli admin będzie miał te grupy nie otrzyma poke/pw
      'pokeORpw' => 1, // 1-poke / 2-pw
      'moveMode' => true, //Opcja przenosząca użytkownika na jego ostatni kanał / UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ],
  ],

/*
'clanGroup'
  Funckja nadaje/odbiera daną rangę po wejściu na dany kanał
*/
  'clanGroup' => [
    'baseMoveMode' => true, //Czy po nadaniu rangi ma przenosić na ostatni kanał (dla funckji 'createPremiumChannels') UWAGA!! Ta opcja wymaga włączonej funkcji 'clientInfoBase'
    'baseClanGroupEnabled' => true, //Ta opcja musi być włączona jesli chcemy używac funkcji 'createpremiumchannels'
    'channels' => [
      0 => [
        'channelId' => 88, //Id kanału
        'groupGrant' => 34, // Grupa, która ma nadawać/odbierać
        'moveMode' => true, //Opcja przenosząca użytkownika na jego ostatni kanał (po nadaniu/odebraniu rangi) UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
      ],
      1 => [
        'channelId' => 51,
        'groupGrant' => 33,
        'moveMode' => false,
      ],
      2 => [
        'channelId' => 95,
        'groupGrant' => 36,
        'moveMode' => false,
      ],
    ],
  ],

/*
'registerChannel'
  Funkcja nadaje rangę rejestracyjną po wejściu na dany kanał
*/

  'registerChannel' => [
    0 => [
      'channelId' => 21, //Id kanału
      'groupId' => 7, //Id grupy, która ma nadać
      'requiredConnections' => 0, //Wymagana ilość połączeń / 0 oznacza brak wymaganych połączeń
      'timeRequired' => 60 * 30, //Ile czasu trzeba spędzić na serwerze aby bot nam dał range UWAGA! Ta funkcja wymagawłączonej funkcji "topTimeSpent"
      'moveMode' => true, ///Opcja przenosząca użytkownika na jego ostatni kanał (po nadaniu rangi] UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ],
    1 => [
      'channelId' => 22,
      'groupId' => 18,
      'requiredConnections' => 0,
      'timeRequired' => 60 * 30,
      'moveMode' => true,
    ],
  ],

/*
'adminStatusOnChannel'
  Funkcja ustawia status administracji w nazwę kanału
  Dostępne parametry:
  [nick] - nick admina
*/
  'adminStatusOnChannel' => [
    0 => [
      'channelId' => 20, //Id kanału
      'databaseId' => 2, //DatabaseId admina
      'channelNameIfOnline' => '[nick] jest ON', //Nazwa kanału jeśli admin jest ONLINE
      'channelNameIfOffline' => '[nick] jest OFF',  //Nazwa kanału jeśli admin jest OFFLINE
      'channelNameIfAway' => '[nick] jest AWAY',  //Nazwa kanału jeśli admin jest AWAY
      'time' => 60, //Czas po którym status zmieni się na AWAY
      'groupId' => 0, //Jeśli admin bedzie miał tą grupę, status zmieni sie na AWAY / 0 oznacza brak grupy
    ],
  ],

  /*
'topAfkTime'
  Funckja wypisuje rekord czasu afk użytkowników
  Dostępne parametry:
  [count] - Ilośc rekordów
  */
  'topAfkTime' => [
    'channelId' => 185, //Id kanału
    'recordsCount' => 10, //Ilość rekordów
    'groupsIgnore' => [16, 17],  //Grupy, które będą ignorowane / 0 oznacza brak grupy
    'topDesc' => '[center][size=16]Top [count] najdłuższego czasu AFK[/size][/center][hr]', //Górny opis kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]',  //Dolny opis kanału
  ],

  /*
'topTimeSpent'
  Funckja wypisuje najwieksze czasy spedzone na serwerze
  Dostępne parametry:
  [count] - Ilośc rekordów
  */
  'topTimeSpent' => [
    'channelId' => 186,  //Id kanału
    'recordsCount' => 10, //Ilość rekordów
    'groupsIgnore' => [16, 17],  //Grupy ignorowane
    'topDesc' => '[center][size=16]Top [count] spędzonego czasu[/size][/center][hr]', //Górny opis kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]',  //Dolny opis kanału
    'enableChannelDesc' => true, //Włączenie opisu kanału / wyłączamy go jeśli nie chcemy TOPki, ale inna funkcja jej potrzebuje
  ],
];



/*
Dostępne funkcje to:
0-serverGroupProtection
1-moveWhenJoinChannel
2-userPlatform
*/
//Lista funkcji, które mają być włączone -> wykonywane cały czas.
$config['1']['plugins']['list'] = [];

$config['1']['plugins']['cfg'] = [

/*
'moveWhenJoinChannel'
  Funkcja przenosi użytkownika na dany kanał po wwejściu na kanał.
*/
  'moveWhenJoinChannel' => [
    0 => [
      'channelId' => 67,  //Id kanału, po wejściu na niego bot nas przeniesie
      'groupToMove' => [], //Id rang wymaganych do przeniesienia, jeśli zostawimy puste każdy będzie mógł korzystać
      'channelToMove' => 44, //Kanał na który ma prznieść
      'moveMode' => true, ////Opcja przenosząca użytkownika na jego ostatni kanał UWAGA!!! Ta opcja wymaga włączonej funkcji "clientInfoBase" !!!
    ],
  ],

/*
'serverGroupProtection'
  Funkcja zabiera i banuje/kickuje użytkownika, który posiada niedozwoloną grupę serwera
*/
  'serverGroupProtection' => [
    'ban' => false, //false = kick / true = ban
    'time' => 60 * 60 * 24, //Czas bana w sekundach
    'data' => [  //Database ID = Grupie
      2 => 6,
    ],
  ],

/*
'userPlatform'
  Funkcja nadaje range jeśli klient połączy sie z urządzenia mobilnego
*/
  'userPlatform' => [
    'android' => 20, //Grupa, która nada jeśli bedzi Andriod / jeśli będzie puste to omijamy tą platforme
    'ios' => 19,  //Grupa, która nada jeśli bedzi IOS / jeśli będzie puste to omijamy tą platforme
  ],
];


/********************************************
*                                           *
*          Konfiguracja Eventów (2)         *
*                                           *
********************************************/

/*
Dostępne eventy to:
0-countDownTime
1-ddosAlert
2-createPremiumChannels
3-closeHelpChannels
4-musicBotCheccker
5-afkGroup
6-normalAfkGroup
7-topTimeSpent
8-banList
9-advertMessage
*/

//Lista funkcji, które mają być włączone -> wykonywane w interwałach czasowych.
$config['2']['events']['list'] = ['3-closeHelpChannels', '4-musicBotChecker', '7-topSpentAfk', '8-banList'];

//Interwały wykonywania się funkcji
//0 to numer funkcji, który występuje w jej nazwie
$config['2']['events']['interval'] = [

  0 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 60], //countDownTime -> optymalny interwał 60 sekund

  1 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 25], //ddosAlert -> optymalny interwał 20-30 sekund

  2 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1],  //createPremiumChannels- > optymalny interwał 1 sekunda

  3 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10],  //closeHelpChannels -> optymalny interwał 10 sekund

  4 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30],  //musicBotChecker -> optymalny interwał 30 sekund

  5 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2],  //afkGroup -> optymalny interwał 2 sekundy

  6 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2],  //normalAfkGroup -> optymalny interwał 2 sekundy

  7 => ['days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 10],  //topSpentAfk -> optymalny interwał 70 sekundy

  8 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1], //banList -> optymalny interwał 120 sekund

  9 => ['days' => 0, 'hours' => 0, 'minutes' => 30, 'seconds' => 0], //advertMessage -> tu samemu :)
];


$config['2']['events']['cfg'] = [

/*
'countDownTime'
  Funkcja odlicza do danej daty
  Dostępne parametry:
  [time] - czas pozostały
*/
  'countDownTime' => [
    'channelId' => 68, //Id kanału
    'channelName' => 'Następny sylwester za: [time]', //Nazwa kanału
    'data' => [
      'year' => 2019, //rok
      'month' => 1, //miesiąc
      'day' => 1, //dzień
      'hour' => 12, //godzina
      'minute' => 30, //minuta
      'second' => 0, //sekunda
    ],
  ],

/*
'ddosAlert'
  Funkcja informująca administratora o podwyższonym packetLoss
*/
  'ddosAlert' => [
    'groups' => [6], //grupy do powiadomienia
    'message' => 'PacketLoss serwera podwyższył się! Możliwe, że jest to atak DDOS!', //Wiadomość
    'packetLoss' => 35, //Powyżej tylu % powiadomi administracje
  ],

  /*
'createpremiumchannels'
  Tworzenie kanałów premium po wejściu na dany kanał
  Dostępne parametry:
    [num] - losowa liczba potrzebne, aby nazwy kanałów się nie powielały
  Dostępne typy kanałów:
    'normal' -> Zwykły kanał
    'addChannelGroup' -> Na ten kanał zostaje nam nadany channelAdmin
    'clanGroup' -> Kanał ten będzie służył jako nadawanie/odbieranie rangi
    'onlineOnChannel' -> Na tym kanale będzie wyświetlane online osób z klanu w nazwie oraz lista osób w opisie
  WAŻNE!
    Przy typie 'clanGroup' też jest nadawana ranga kanałowa ChannelAdmin
    Jeśli użyjemy typu 'clanGroup' oraz 'onlineOnChannel' trzeba włączyć funckje 'clanGroup', 'groupUserList',  'groupCoundOnChannel' i 'clientInfoBase'
  */
  'createPremiumChannels' => [
    'channelId' => 35, //Id kanału, po wejściu na niego tworzy nam kanał premium
    'firstChannel' => 58, //Id kanału pod którym ma utworzyć pierwszy kanał
    'channelAdminGroupId' => 5, //Id grupy kanałowej, którą ma nadać
    'groupToCopy' => 12, //Id grupy serwerowej, która ma kopiować
    'channels' => [
      0 => [
        'channelName' => '[cspacer[num]]> ------------------- <',
        'type' => 'normal',
      ],
      1 => [
        'channelName' => '[cspacer[num]]Aktualnie online:',
        'type' => 'onlineOnChannel',
      ],
      2 => [
        'channelName' => '[cspacer[num]] Nadaj/Odbierz range',
        'type' => 'clanGroup',
      ],
      3 => [
        'channelName' => '[cspacer[num]]> ------------------- <',
        'type' => 'normal',
      ],
      4 => [
        'channelName' => '[cspacer[num]]',
        'type' => 'normal',
      ],
      5 => [
        'channelName' => '[cspacer[num]]Liderówka',
        'type' => 'addChannelGroup',
        'sub' => [
          0 => [
            'channelName' => 'Kanał 1',
            'type' => 'normal',
          ],
        ],
      ],
      6 => [
        'channelName' => '[cspacer[num]]Kanały',
        'type' => 'addChannelGroup',
        'sub' => [
          0 => [
            'channelName' => 'Kanał 1',
            'type' => 'normal',
          ],
          1 => [
            'channelName' => 'Kanał 2',
            'type' => 'normal',
          ],
          2 => [
            'channelName' => 'Kanał 3',
            'type' => 'normal',
          ],
          3 => [
            'channelName' => 'Kanał 4',
            'type' => 'normal',
          ],
          4 => [
            'channelName' => 'Kanał 5',
            'type' => 'normal',
          ],
        ],
      ],
      7 => [
        'channelName' => '[cspacer[num]]Rekrutacja',
        'type' => 'normal',
        'sub' => [
          0 => [
            'channelName' => 'Kanał 1',
            'type' => 'normal',
          ],
        ],
      ],
    ],
  ],

  /*
'closeHelpChannels'
  Funkcja otwierająca/zamykająca centrum pomocy
  Przy wpisywaniu godziny wpisujemy bez zer!!!
  np.
   09:20 - źle
   9:20 - Dobrze
   20:20 - Dobrze
   10:00 - Dobrze
  */
  'closeHelpChannels' => [
    0 => [
      'closeChannels' => '22:00', //O której godzinie ma zamykać CP
      'openChannels' => '10:00', //O której godzinie ma otwierać CP
      'channelNameOpen' => 'Kanał AutoPoke [ON]', //Nazwa kanału kiedy jest otwarty
      'channelNameClose' => 'Kanał AutoPoke [OFF]', //Nazwa kanału kiedy jest zamkniety
      'channelId' => 181, //Id kanału
      'channelDesc' => [
        'enabled' => true, //Czy włączyć opis
        'topDesc' => '[center][size=16]Centrum Pomocy[/size][/center][hr]', //Górny opis
        'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
      ],
    ],
  ],

/*
'musicBotChecker'
  Funkcja generuje liste botów muzycznych, które grają, nie grają i są offline
*/
  'musicBotChecker' => [
    'channelId' => 237, //Id kanału
    'groups' => [16, 17], //Id grup botów muzycznych
    'topDesc' => '[center][size=16]Lista MusicBotów[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
  ],

/*
'afkGroup'
  Funkcja nadaje range afk użytkownikowi oraz w jej nazwie wpisuje czas afk użytkownika
  np. stalker [AFK od: 2 godzin 23 minut]
*/
  'afkGroup' => [
    'ignoredGroups' => [18], //Ignorowane grupy, jesli damy 0 wyłączymy tą opcje
    'timeAfk' => 10 * 60, //Czas po którym nadaje range afk/przenosi na kanał.
    'groupCopy' => 38, //Id grupy do skopiowania, w nazwie tej grupy będzie czas afk klienta
    'move' => [
      'enable' => true, //Czy ma przenosić na kanał AFK
      'channelId' => 375, //Id kanału do przeniesienia
    ],
  ],

/*
'normalAfkGroup'
  Funkcja nadaje range afk użytkownikowi lecz w jej nazwie bez czasu afk
*/
  'normalAfkGroup' => [
    'ignoreGroup' => [18], //Ignorowane grupy, jesli damy 0 wyłączymy tą opcje
    'timeAfk' => 10 * 60, //Czas po którym nadaje range afk/przenosi na kanał.
    'groupAfk' => 17, //Grupe, która ma nadać
    'move' => [
      'enable' => true, //Czy ma przenosić na kanał AFK
      'channelId' => 375, //Id kanału do przeniesienia
    ],
  ],

/*
'topTimeSpent'
  Funkcja wypisuje użytkowników z największym czasem afk spedzonym na serwerze
  Dostępne parametry:
  [count] - ilośc rekordów
*/
  'topSpentAfk' => [
    'channelId' => 235, //Id kanału
    'ignoreGroups' => [16, 17], //Ignorowane grupy, jeśli damy 0 wyłączymy tą opcje
    'timeAfk' => 10, //Od jakiego czasu ma liczyć czas afk
    'recordsCount' => 10 * 60, //Od jakiego czasu afk ma liczyć czas
    'channelDescEnable' => true, //Czy włączyc opis kanału
    'topDesc' => '[center][size=16]Top [count] spędzonego czasu AFK[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
  ],

/*
'banList'
  Funkcja wypisuje liste banów w opis kanału
  Dostępne parametry:
  [count] - ilośc banów
*/
  'banList' => [
    'channelId' => 189, //Id kanału
    'banCount' => 30, //Ilośc banów
    'topDesc' => '[center][size=16]Lista [count] banów[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
  ],

/*
'advertMessage'
  Cykliczna wiadomośc
  Działanie:
    Każda z poniższych wiadomości zostanie wysłana w określonych interwałach
*/
  'advertMessage' => [
    0 => 'Witaj na serwerze Ts.StalkersApps.pl',
    1 => 'Strona już wkrótce!',
    2 => 'Jeśli macie jakieś pytania, możecie pisać'
  ],
];

/*
Dostępne pluginy to:
0-blockRecording
1-addRankByI
2-checkMultipleIp
*/
$config['2']['plugins']['list'] = [];
$config['2']['plugins']['cfg'] = [

/*
'blockRecording'
  Funckja blokuje nagrywanie na serwerze
  ignored - kanały Ignorowane
  blocked - kanały na których będzie sprawdzać
*/
  'blockRecording' => [
    'ignoredGroups' => [6], //Grupy, które mogą nagrywać, jeśli damy 0 wyłączamy tą op
    'mode' => 'blocked', //Do wyboru ignored / blocked
    'channels' => [11], //Lista id kanałów
    'kickMessage' => 'Nie wolno ci nagrywać na tym kanale!', //Wiadomość kick'a
    'kickMode' => 'server' //Do wyboru 'server' lub 'channel'
  ],

/*
'addRankByIp'
  Funkcja nadaje range jeśli np. bot połączy sie z podanych adresów IP
*/
  'addRankByIp' => [
    'ip' => ['127.0.0.1', '77.55.219.92'], //Jeśli np. bot połączy się z tych ip to nada mu range np. musicbot
    'ranksAdd' => [18], //Rangi, które ma nadać
  ],

/*
'checkMultipleIp'
  FUnkcja sprawdza podwójne (lub więcej) połączenia z serwerem. Jeśli np. klient połączy się z dwóch UID zostanie wykopany z serwera
*/
  'checkMultipleIp' => [
    'groupsIgnore' => [23, 24, 18], //ignorowane grupy
    'maxMultipleIp' => 1, //Ile może mieć klient jednoczesnych połączeń z serwerem
    'kickMessage' => "Nie możesz mieć więcej niż jedno połączenie z serwerem!", //Wiadomość kick'a
  ],

];


/********************************************
*                                           *
*          Konfiguracja Eventów (3)        *
*                                           *
********************************************/

/*Dostępne eventy to:
0-groupCountOnChannel
1-adminCountOnChannel
2-checkPublicChannels
3-adminMeeting
4-getPrivateChannels
5-generatingBanner
6-adminList
7-recordOnline
8-hostMessage
*/

//Lista funkcji, które mają być włączone -> wykonywane w interwałach czasowych.
$config['3']['events']['list'] = ['0-groupCountOnChannel', '1-adminCountOnChannel', '4-getPrivateChannel', '5-adminList', '6-recordOnline', '8-hostMessage'];

//Interwały wykonywania się funkcji
$config['3']['events']['interval'] = [

  0 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30], //groupCountOnChannel -> optymalny interwał 30 sekund

  1 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30], //adminCountOnChannel -> optymalny interwał 30 sekund

  2 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 14], //checkPublicChannels -> optymalny interwał 14 sekund

  3 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 6], //adminMeeting -> optymalny interwał 6 sekund

  4 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1], //getPrivateChannel -> optymalny interwał 1 sekunda

  5 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 45], //adminList -> optymalny interwał 45 sekund

  6 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 8], //recordOnline -> optymalny interwał 8 sekund

  7 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 45], //newUsersToday -> optymalny interwał 45 sekund

  8 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 60], //hostMessage -> optymalny interwał 45 sekund

];

$config['3']['events']['cfg'] = [

/*
'groupCountOnChannel'
  Funkcja wpisuje w nazwe kanału ilośc osób online z danej grupy
  Dostępne parametry:
    [onl] - uzytkowników onlineTime
    [all] - wszystkich użytkowników w grupie
*/
  'groupCountOnChannel' => [
    'channelName' => '[cspacer[id]]Online: [onl]/[all]', //Nazwa kanału dla funkcji 'createpremiumchannels'
    'channels' => [ //To poniżej tyczy się ręcznego ustawienia
      0 => [
        'groupId' => 50, //Id grupy serwera
        'channelId' => 33, //Id kanału
        'channelName' => 'Online: [onl]/[all]', //Nazwa kanału
      ],
      1 => [
        'groupId' => 57, //Id grupy serwera
        'channelId' => 36, //Id kanału
        'channelName' => 'Online: [onl]/[all]', //Nazwa kanału
      ],
      2 => [
        'groupId' => 55, //Id grupy serwera
        'channelId' => 34, //Id kanału
        'channelName' => 'Online: [onl]/[all]', //Nazwa kanału
      ],
    ],
  ],

/*
'adminCountOnChannel'
Funckja wpisuje w nazwę kanału ilość dostępnej Administracji
  Dostępne parametry:
    [onl] -> Ilośc administracji onlineTime
    [all] -> Ilość wszystkich administratorów
*/
  'adminCountOnChannel' => [
    'channelId' => 182, //Id kanału
    'adminGroups' => [105, 104, 114, 11, 13, 14], //Id grup administracji
    'channelName' => '[cspacer]Adminów online: [onl]/[all]', //Nazwa kanału
  ],

/*
'checkPublicChannels'
  Funkcja, która dorabia kanały publiczne jeśli ich braknie
*/
  'checkPublicChannels' => [
    0 => [
      'maxClients' => 2, //Maksymalna ilośc użytkowników na kanale w tym przypadku (2)
      'maxChannels' => 5, //Maksymalna ilość kanałów (Liczba kanałów nie przekroczy tej liczby)
      'minChannels' => 3, //Minimalna ilośc kanałów (Domyślna wartośc)
      'minFreeChannels' => 2, //Minimalna ilość wolnych kanałów
      'channelNames' => 'Kanał #[num]', //Nazwa kanału
      'channelId' => 43, //Id głównego kanału
     ],
    1 => [
      'maxClients' => 3,
      'maxChannels' => 5,
      'minChannels' => 3,
      'minFreeChannels' => 2,
      'channelNames' => 'Kanał #[num]',
      'channelId' => 42,
    ],
    2 => [
      'maxClients' => 5,
      'maxChannels' => 5,
      'minChannels' => 3,
      'minFreeChannels' => 2,
      'channelNames' => 'Kanał #[num]',
      'channelId' => 41,
    ],
  ],
/*
'adminMeeting'
  Przenoszenie administracji na kanał o danej godzinie
  UWAGA!
   Nazwa kanału musi mieć date w następującym formacie:
   RRRR.MM.DD HH:MM
   np.
   2018.07.01 15:45
   Dostępne parametry:
   [nick] -> nick administratora
   [off] -> jest to fraza ustawiona w cfg poniżej
   np.
    'meetingOff' => 'OFF'
    [off] przymie wartość 'OFF'
*/
  'adminMeeting' => [
    'adminGroups' => [6], //Grupy do przeniesienia
    'ignoreGroups' => [], //Grupy ignorowane / Zostaw puste jeśli nie ma takiej grupy
    'channelId' => 66, //Kanał na, który ma przenieść
    'message' => 'Witaj [nick]! Zostałeś/aś przeniesiony/a na zebranie!', //Wiadomość
    'meetingOff' => 'OFF', //Jeśli kanał będzie zawierał tą frazę, to zebranie będzie off
    'channelNameWhenMoved' => 'Zebranie administracji [off]', //Nazwa kanału na jaką bot ma zmienić jeśli przeniesie adminów na spotkanie
                                                              //Nazwa kanału musi zawierać [off]
  ],

/*
'getPrivateChannel'
  Funkcja nadaje kanał prywatny po wejściu na kanał
  Dostępne parametry:
  [num] - numer kanału
*/
  'getPrivateChannel' => [
    'channelId' => 20, //Id kanału, po wejściu którego nada nam range
    'zoneId' => 105, //Id kanału głównego, tworzyć będzie pod nim podkanały
    'subChannels' => 3, //Ilosć pod kanałów
    'channelGroup' => 5, //Id grupy kanałowej, która ma nadać
    'channelName' => '[num]. [nick] - kanał', //[num]. Musi być na początku chyba, że wiecie o co chodzi z 'channelRegular' w funkcji 'checkPrivateChannels'
    'subChannelName' => '[num]. podkanał', //Nazwa pod kanału
    'neededGroups' => [], //puste = nie ma wymaganej grupy
    'passwd' => 12345, //Hasło do kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]' //Dolny opis
  ],

/*
'adminList'
  Funkcja generuje liste Administracji
*/
  'adminList' => [
    'channelId' => 182, //Id kanału
    'adminGroups' => [105, 104, 114, 11, 13, 14], //Grupy administracji
    'timeAfk' => 10 * 60, //po tym czasie będzie status afk
    'topDesc' => '[center][size=16]Lista Administracji[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
    'onlinePrefix' => '[color=#006600]online[/color] od: ', //Prefix online
    'awayPrefix' => '[color=#FF9900]away[/color] od: ', //Prefix away

  ],

/*
'recordOnline'
  Funkcja wpisuje w opis kanału oraz nazwe rekord użytkowników online
  Dostępne parametry:
    [rec] - rekord online
*/
  'recordOnline' => [
    'channelId' => 193, //Id kanału
    'channelName' => 'Rekord online to: [rec]', //Nazwa kanału
    'topDesc' => '[center][size=16]Rekord Online[/size][/center][hr]', //Górny opis kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis kanału
  ],

/*
'newUsersToday'
  Funkcja wpisuje w opis kanału liste nowych użytkowników (dziennie)
  UWAGA!!!
    Ta funkcja wymaga do działania funckji 'clientInfoBase'
  Dostępne parametry:
    [user] - nowi użytkownicy
*/
  'newUsersToday' => [
    'channelId' => 461, //Id kanału
    'channelName' => '[cspacer]Nowi użytkownicy dziś: [users]', //Nazwa kanału
    'topDesc' => '[center][size=16]Nowi użytkownicy - dziś[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis

  ],

/*
'hostMessage'
  Dostępne parametry:
  [onl] - online użytkowników
  [max] - ilość slotów
  [uptime] - uptime serwera
  [ping] - ping serwera
  [packet] - packetLoss serwera
UWAGA!!!
  Wiadomość konfigurujemy w pliku /configs/config/PL/language.php
*/


];

/*
Lista pluginów:
  0-adminStats
  1-banGroups
*/
$config['3']['plugins']['list'] = ['0-adminStats', '1-banGroups'];
$config['3']['plugins']['cfg'] = [

/*
'adminStats'
  Funkcja zmiera informacje o nadanych grupach oraz administracji
*/
  'adminStats' => [
    'monitoredGroups' => [23, 24], //Grupy, które ma brać po uwagę w "Nadane grupy administracji" oraz "Najczęsciej wybierana grupa"
    'adminGroups' => [6, 10], //Grupy administracji
  ],

/*
'banGroups'
  Funkcja banuje użytkownika po nadaniu mu danej rangi
  Działanie:
    174 => 10,
    gdzie:
    173 - id rangi
    10 - czas bana w sekundach
*/
  'banGroups' => [
    'groups' => [
      174 => 10,
      175 => 60 * 60 * 24,
      // IdGrupy => czas bana w sekundach
    ],
    'banReason' => 'Ban nadany z grupy.', //Powód bana
  ],
];

/********************************************
*                                           *
*          Konfiguracja Eventów (3)        *
*                                           *
********************************************/

/*
Dostępne eventy to:
  0-checkPrivateChannels
  1-groupUserList
  2-getClientInfo
  3-writeAdminStats
  4-writePopularGroups
  5-clientLevels
*/

//Lista funkcji, które mają być włączone -> wykonywane w interwałach czasowych.
$config['4']['events']['list'] = ['0-checkPrivateChannels', '1-groupUserList', '2-getClientInfo'];
$config['4']['events']['interval'] = [

  0 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 60], //checkPrivateChannels -> optymalny interwał 60 sekund

  1 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10], //groupUserList -> optymalny interwał 70 sekund

  2 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 20], //getClientInfo -> optymalny interwał 20 sekund

  3 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 50], //writeAdminStats -> optymalny interwał 50 sekund

  4 => ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 45], //writePopularGroups -> optymalny interwał 45 sekund

  5 => ['days' => 0, 'hours' => 0, 'minutes' => 2, 'seconds' => 0], //clientLevels -> optymalny interwał 2 minuty sekund

];

$config['4']['events']['cfg'] = [

/*
'checkPrivateChannels'
  Funkcja sprawdza kanały prywatne tj. datę, numerację
*/
  'checkPrivateChannels' => [
    'channelRegular' => '^[num][.][ ]^', //Jeśli nie wiecie o co chodzi nie zmieniajcie tego
    'channelDelete' => 3600 * 24 * 7, //po ilu dniach ma usunąc kanał (w sekundach)
    'channelWarn' => 3600 * 24 * 5, //Po ilu dniach ma sie zmienic nazwa kanalu (w sekundach)
    'channelNameWarn' => '[ZMIEŃ DATĘ]', //Nazwa kanału jeśli zła data
    'channelBadName' => '[ZŁA NAZWA KANAŁU]', //Nazwa kanału jeśli zła nazwa
  ],

/*
'writePopularGroups'
  Funkcja wypisuje w opis kanału najchętniej wybieraną grupę przez użytkowników
  UWAGA!!!
    Ta funkcja wymaga do działania funkcji 'adminStats'
*/
  'writePopularGroups' => [
    'topDesc' => '[center][size=16]Lista najczęściej nadawanych grup[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
    'monitoredGroups' => [23, 24], //Grupy brane pod uwagę
    'maxGroups' => 15, //Ile ma wyświetlić grup
    'channelId' => 457, //Id kanału
  ],

/*
'groupUserList'
  Funkcja wypisuje w opis kanału listę użytkowników online, away, offline
    Dostępne parametry:
      [clan] - Nazwa grupy serwera
*/
  'groupUserList' => [
    'idleTime' => 60 * 10, //Czas po jakim uzytkownik jest AWAY, dla funckji createPremiumChannels
    'onlinePrefix' => '[color=#006600]online[/color] ', //Jeśli użytkonik jest ONLINE, dla funckji createPremiumChannels
    'offlinePrefix' => '[color=#990033]offline[/color] ',//Jeśli użytkonik jest OFFLINE, dla funckji createPremiumChannels
    'awayPrefix' => '[color=#FF9900]away[/color] ',//Jeśli użytkonik jest AWAY, dla funckji createPremiumChannels
    'topDesc' => '[center][size=16]Lista graczy z klanu: [clan][/size][/center][hr]', //Górny opis kanału
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolnyopis kanału
    'channels' => [ //Poniżej konfiguracja ręczna
      0 => [
        'channelId' => 55,
        'groupId' => 34,
        'idleTime' => 60 * 10,
        'onlinePrefix' => '[color=#006600]online[/color]',
        'offlinePrefix' => '[color=#990033]offline[/color] ',
        'awayPrefix' => '[color=#FF9900]away[/color] ',
        'topDesc' => '[center][size=16]Lista graczy z klanu: [clan][/size][/center][hr]',
        'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]'
      ],
      1 => [
        'channelId' => 50,
        'groupId' => 33,
        'idleTime' => 60 * 10,
        'onlinePrefix' => '[color=#006600]online[/color]',
        'offlinePrefix' => '[color=#990033]offline[/color] ',
        'awayPrefix' => '[color=#FF9900]away[/color] ',
        'topDesc' => '[center][size=16]Lista graczy z klanu: [clan][/size][/center][hr]',
        'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]'
      ],
      2 => [
        'channelId' => 57,
        'groupId' => 36,
        'idleTime' => 60 * 10,
        'onlinePrefix' => '[color=#006600]online[/color]',
        'offlinePrefix' => '[color=#990033]offline[/color] ',
        'awayPrefix' => '[color=#FF9900]away[/color] ',
        'topDesc' => '[center][size=16]Lista graczy z klanu: [clan][/size][/center][hr]',
        'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]'
      ],
    ],
  ],

/*
'writeAdminStats'
  Funkcja wpisuje w opis kanału statystyki administracji tj. ilość nadanych rang
*/
  'writeAdminStats' => [ //ta funkcja wymaga funkcji adminStats
    'channelId' => 431, //Id kanału
    'adminGroups' => [6, 10], //Id rang administracyjnych
    'topDesc' => '[center][size=16]Statystyki administracji - Nadane grupy[/size][/center][hr]', //Górny opis
    'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
  ],

  /*
  'clientLevels'
    Funkcja nadaje klientom levele
    UWAGA!!!
      Ta funkcja wymaga włączonej funkcji 'topTimeSpent'
    Wyjaśnienie:
        1 => [192 => 60 * 60],
        gdzie:
        1 - level
        192 - id rangi levelu 1
        60 * 60 - czas po którym tą grupę nada
    Parametry:
      [nick] - Po prostu nick
      [old] - starty poziom
      [new] - nowy poziom
  */
    'clientLevels' => [
      'channelId' => 460, //Id kanału
      'recordsCount' => 10, //Ilość rekordów
      'levels' => [
        1 => [191 => 60 * 60], //LvL 1
        2 => [192 => 2 * 60 * 60], //LvL 2
        3 => [193 => 8 * 60 * 60],
        4 => [194 => 24 * 60 * 60],
        5 => [195 => 2 * 24 * 60 * 60],
        6 => [196 => 4 * 24 * 60 * 60],
      ],
      'topDesc' => '[center][size=16]Top [count] spędzonego czasu AFK[/size][/center][hr]', //Górny opis
      'downDesc' => '[hr][right]Wygenerowane przez - qBot v1.1[/right]', //Dolny opis
      'msg' => 'Witaj [nick], właśnie awansowałeś z poziomu [old] na [new]! Gratulacje! Sprawdź w naszym rankingu, które miejsce zająłeś/aś!' //Wiadomość
    ],
];


$config['4']['plugins']['list'] = [];
$config['4']['plugins']['cfg'] = [];

$config['5']['commands']['cfg'] = [

  'pwToAll' => [
    'enabled' => true,
    'allowedGroups' => [105, 104, 114, 11, 13, 14],
    'notAllowed' => 'Nie jesteś uprawniony!'
  ],

  'pokeToAll' => [
    'enabled' => true,
    'allowedGroups' => [105, 104, 114, 11, 13, 14],
    'errorLong' => 'Błąd, podałeś za długą wiadomość. Maksymalna ilość znaków to [b]100[/b]',
    'notAllowed' => 'Nie jesteś uprawniony!'
  ],

  'pokeToGroup' => [
    'enabled' => true,
    'allowedGroups' => [105, 104, 114, 11, 13, 14],
    'errorLong' => 'Błąd, podałeś za długą wiadomość. Maksymalna ilość znaków to [b]100[/b]',
    'errorClient' => 'Błąd, brak użytkowników w podanej grupie!',
    'successPoke' => 'Zaczepiłem [b][count][/b] klientów!',
    'notAllowed' => 'Nie jesteś uprawniony!'
  ],

  'pwToGroup' => [
    'enabled' => true,
    'allowedGroups' => [105, 104, 114, 11, 13, 14],
    'errorClient' => 'Błąd, brak użytkowników w podanej grupie!',
    'successPoke' => 'Napisałem do [b][count][/b] klientów!',
    'notAllowed' => 'Nie jesteś uprawniony!'
  ],

  'meeting' => [
    'enabled' => true,
    'allowedGroups' => [105, 104, 114, 11, 13, 14],
    'adminGroups' => [105, 104, 114, 11, 13, 14],
    'notAllowed' => 'Nie jesteś uprawniony!',
    'msg' => 'Jesteś na zebraniu!'
  ],


];


?>
