#!/bin/bash
#Skrypt stworzony przez Stalker
#Zakaz kopiowania
#Ts: Jutuby.Net


function greenMessage {
    echo -e "\\033[32;1m${@}\033[0m"
}

function redMessage {
    echo -e "\\033[31;1m${@}\033[0m"
}

function yellowMessage {
    echo -e "\\033[33;1m${@}\033[0m"
}

function blueMessage {
    echo -e "\\033[34;1m${@}\033[0m"
}

if [ "$1" == "start" ];
	then
		greenMessage 'Wybrałeś opcje start. Włączam bota!'
		if screen -ls | grep -q core1;
		then
			redMessage 'Screen jest już aktywny'
			exit
		else
			screen -AdmS core1 php core.php -i 1
		fi
		blueMessage 'Gotowe!'
    ############################
    if screen -ls | grep -q core2;
		then
			redMessage 'Screen jest już aktywny'
			exit
		else
			screen -AdmS core2 php core.php -i 2
		fi
		blueMessage 'Gotowe!'
    ############################
    if screen -ls | grep -q core3;
		then
			redMessage 'Screen jest już aktywny'
			exit
		else
			screen -AdmS core3 php core.php -i 3
		fi
		blueMessage 'Gotowe!'


elif [ "$1" == "stop" ];
	then
		greenMessage 'Wybrałeś opcje stop. Wyłączam bota!'
		if screen -ls | grep -q core1;
		then
			screen -X -S core1 quit
		else
			redMessage 'Screen jest już wyłączony'
			exit
		fi
		blueMessage 'Gotowe!'




    if screen -ls | grep -q core2;
		then
			screen -X -S core2 quit
		else
			redMessage 'Screen jest już wyłączony'
			exit
		fi
		blueMessage 'Gotowe!'



    if screen -ls | grep -q core3;
		then
			screen -X -S core3 quit
		else
			redMessage 'Screen jest już wyłączony'
			exit
		fi
		blueMessage 'Gotowe!'

elif [ "$1" == "restart" ];
	then
		greenMessage 'Wybrałeś opcje restart. Restartuję bota!'
		if screen -ls | grep -q core1;
		then
			screen -X -S core1 quit
			sleep 1
			screen -AdmS core1 php core.php -i 1
		else
			redMessage 'Screen jest wyłączony! Włączam go.'
			screen -AdmS core1 php core.php -i 1
		fi
		blueMessage 'Gotowe!'



    if screen -ls | grep -q core2;
		then
			screen -X -S core2 quit
			sleep 1
			screen -AdmS core2 php core.php -i 2
		else
			redMessage 'Screen jest wyłączony! Włączam go.'
			screen -AdmS core2 php core.php -i 2
		fi
		blueMessage 'Gotowe!'



    if screen -ls | grep -q core3;
		then
			screen -X -S core3 quit
			sleep 1
			screen -AdmS core3 php core.php -i 3
		else
			redMessage 'Screen jest wyłączony! Włączam go.'
			screen -AdmS core3 php core.php -i 3
		fi
		blueMessage 'Gotowe!'

else
redMessage 'Użyj starter.sh start/stop/restart'
fi
#Skrypt stworzony przez Stalker
#Zakaz kopiowania
#Ts: Jutuby.Net
