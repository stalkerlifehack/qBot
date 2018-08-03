<?php
$lang = [];
$lang = [
  //core
  'welcome' => 'Witaj w aplikacji',
  'author' => 'Author:',
  'loading' => 'Ładowanie potrzebnych plików...',
  'err_inst' => 'Nie ma takiej instancji',
  'dtb_err' => 'Błąd podczas łączenia z bazą danych:',
  'dtb_suc' => 'Pomyślnie połączono z bazą danych!',
  'start_inst' => [
    '1' => 'Instancja NR',
    '2' => 'wystartowała'
  ],
  'srv_conn_succ' => 'Bot prawidłowo połączył sie z serwerem!',
  'srv_conn_query' => 'Bot prawidłowo zalogował się na query!',
  'bot_sel_serv' => 'Bot wybrał serwer!',
  'srv_conn_error' => 'Bot nie mógł połączyć się z serwerem. Prawdopodobnie jest on wyłączony!',
  'bot_change_nick' => 'Bot zmienił nazwę na:',
  'bot_change_nick_error' => 'Bot nie mógł zmienić nazwy. Prawdopodobnie już jest bot o tej samej nazwie!',
  'bot_change_channel' => 'Bot zmienił kanał na:',
  'bot_channel_chang_err' => 'Bot nie mógł zmienić kanału!',
  'serv_login_quer_err' => 'Bot nie mógł zalogować się na query. Sprawdź plik konfiguracyjny! A może bot dostał flood bana?',
  'end_err' => 'Bot nie mógł połączyć się z serwerem. Czy serwer jest online? Sprawdź plik konfiguracyjny. A może bot ma bana?',
  'load_events' => 'Załadowano',
  'events' => 'eventów',
  'commands' => 'komend',
  'and' => 'i',
  'plugins' => 'pluginów',
  'function_number_high' => "Nie możesz dodać tylu funkcji do jednej instancji!",

  //pokeAdmins (Część jest do skonfigurowania w pliku funckji pokeAdmins)
  'pokeAdmins' => [
    'blocked_group_error' => 'Korzystanie z Centrum Pomocy zostało ci zabronione!',
    'last_channel_error' => 'System nie mógł zweryfikować twojego ostatniego kanału!',
    'needed_group_error' => 'Nie posiadasz wymaganej grupy!',
    'zero_admins' => 'Aktualnie nie ma żadnych administratorów online.',
  ],
  //clanGroup
  'clanGroup' => [
    'success_and_last_channel' => 'Ranga nadana pomyślnie. Zostałeś przeniesiony na twój ostatni kanał!',
    'success_added_rank' => 'Ranga nadana pomyślnie!',
    'success_and_error_last_channel' => 'Ranga nadana pomyślnie. System nie mógł zweryfikować twojego ostatniego kanału!',
    'success_removed_rank' => 'Ranga odebrana pomyślnie!',
    'success_removed_and_last_channel' => 'Ranga odebrana pomyślnie. Zostałeś przeniesiony na twój ostatni kanał!',
    'success_and_error_last_channel' => 'Ranga odebrana pomyślnie. System nie mógł zweryfikować twojego ostatniego kanału!',
  ],
  //registerChannel
  'registerChannel' => [
    'added_successful' => 'Zostałeś/aś zarejestrowany/a pomyślnie!',
    'moved_last_channel' => 'Zostałeś/aś przeniesiony/a na twój ostatni kanał!',
    'move_last_channel_error' => 'System nie mógł zweryfikować twojego ostatniego kanału!',
    'error_require' => 'Nie spełniasz wymagań.',
    'client_have_group' => 'Posiadasz już range rejestracyjną!',
    'moved_last_channel' => 'Zostałeś/aś przeniesiony/a na twój ostatni kanał!',
  ],
  //serverGroupProtection
  'serverGroupProtection' => [
    'group_protected' => 'Posiadasz grupe do której nie masz uprawnień. Czyszczenie....',
  ],
  //moveWhenJoinChannel
  'moveWhenJoinChannel' => [
    'error' => 'Nie wolno ci korzystać z tego kanału!',
    'error_last_channel' => 'System nie mógł zweryfikować twojego ostatniego kanału!',
    'last_channel' => 'Zostałeś przeniesiony na twój ostatni kanał!',
  ],

  'getPrivateChannel' => [
    'msg' => "\n Witaj [b][nick][/b]
              Został stworzony dla ciebie kanał o numerze [b][num][/b]
               Hasło do twojego kanału to: [b][passwd][/b]",
    'hasChannel' => "\nWitaj [b][nick][/b]
              Nasz system wykrył, że posiadasz już u nas kanał prywatny, zostałeś na niego przeniesiony!",
    'channelDesc' => "[center][size=15]Kanał prywatny[/size][/center][hr]
                      [left][size=13][b]•[/b] Właściciel: [nick][/size][/left]
                      [left][size=13][b]•[/b] Utworzony: [date][/size][/left]
                      ",
  ],

  'hostMessage' => "Witaj,\n Aktualnie jest: [b][onl]/[max][/b]\n Uptime serwera to: [b][uptime][/b]\n Aktualnu rekord to: [b][record]"

];


?>
