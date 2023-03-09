# NodemcuRelay

Relay control via wifi, rfid and keypad

All the inputs for the relay are displayed on the web page and recorded in the database.
By defining the user from the admin panel and communicating via the hardware nodemcu, it is ensured that the relays are controlled.

1- ADD ESPPOST SQL DATABASE TO MYSQL...

2- INPUT YOUR OWN WIFI NAME AND PASSWORD, SSID AND PASSORD FROM NODEMCU
const char* ssid = "aaa";
const char* password = "ata112..";

3- REPLACE NODEMC's IP ADDRESS WITH $ip VARIABLE IN .PHP FILES IN Admin FOLDER
admin.php: ''$ip = "http://192.168.1.3/"; '' in its place
login.php: ''$ip = "http://192.168.43.121/"; '' in its place
save.php: ''$ip = "http://192.168.43.121/"; '' in its place

4- Copy the admin folder to the server file you are using.

5-ADD ADDITIONAL LIBRARIES TO YOUR ARDUINO IDE PROGRAM..

6- THE SYSTEM IS READY TO USE..

NOTE: TO DOWNLOAD HARDWARE, REMOVE RX AND TX PINS AND PLUG AGAIN AFTER DOWNLOAD....
RX<--->RX
TX<---->TX

NOTE: YOUR ARDUINO VERSION 1.8.5 AND HIGHER DOES NOT HAVE A PROBLEM WITH ESP8266 INSTALLATION AND WORKS WITH A HEALTHY INSTALLATION.
