#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

const char* ssid = "WIFI-ADI";// Enter SSID here
const char* password = "WIFI-SIFRE"; //Enter Password here

ESP8266WebServer server(80);

const int analog_ip = A0;
int ledy=13;
int ledk=12;
int webKontrol = 0;

void setup() {
  
  Serial.begin(115200);
  delay(100);
  pinMode(analog_ip, INPUT); 
  pinMode(ledy, OUTPUT);
  pinMode(ledk, OUTPUT);
  digitalWrite(ledy, LOW);
  digitalWrite(ledk, LOW);
  Serial.println("Connecting to ");
  Serial.println(ssid);

  //connect to your local wi-fi network
  WiFi.begin(ssid, password);

  //check wi-fi is connected to wi-fi network
  while (WiFi.status() != WL_CONNECTED) {
  delay(1000);
  Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected..!");
  Serial.print("Got IP: ");  Serial.println(WiFi.localIP());

  server.on("/", handle_OnConnect);
  server.on("/read", handle_read);
  server.on("/kapi_ac", kapi_ac);
  server.on("/kapi_kapat", kapi_kapat);

  server.on("/cikis", handle_cikis);
  server.onNotFound(handle_NotFound);

  server.begin();
  Serial.println("HTTP server started");
  
}
void loop() {
  delay(500);
  server.handleClient();
  
}

void handle_OnConnect() {
  webKontrol = 1;
  server.sendHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  server.send(200, "text/plain", ""); 
}

// GÖNDERME
void handle_read() {
  server.sendHeader("Access-Control-Max-Age", "10000");
  server.sendHeader("Access-Control-Allow-Methods", "POST,GET,OPTIONS");
  server.sendHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  String ADCData="????";
  if (Serial.available() > 0) { // Serial Porta girdi değerinin olup olmadığını kontrol et
     ADCData = Serial.readString(); // Serial Porttaki girdi değerini oku ve string e ata.
     Serial.println(ADCData); // okunan değeri ekrana yazdır.  
  } 
  server.send(200, "text/plain", SendHTML(ADCData + "|" ));
  ADCData="";
}

void handle_NotFound(){
  server.send(404, "text/plain", "Not found");
}

void kapi_ac(){
  server.sendHeader("Access-Control-Max-Age", "10000");
  server.sendHeader("Access-Control-Allow-Methods", "POST,GET,OPTIONS");
  server.sendHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  webKontrol = 1;
  // kapıyı açma
  digitalWrite(ledy, HIGH);
  delay(2000);
  digitalWrite(ledy, LOW);
  String value = "kapi açıldı";
  server.send(200, "text/html", "");
  Serial.println("kapi açık");
    digitalWrite(ledy, HIGH);
  delay(1000);
  digitalWrite(ledy, LOW);
}

void kapi_kapat(){
  server.sendHeader("Access-Control-Max-Age", "10000");
  server.sendHeader("Access-Control-Allow-Methods", "POST,GET,OPTIONS");
  server.sendHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  webKontrol = 1;
  // kapıyı kapatma
  digitalWrite(ledk, HIGH);
  delay(2000);
  digitalWrite(ledk, LOW);
  String value = "<p>kapı kapat komutu gonderildi</p>";
  server.send(200, "text/html", "");
  Serial.println("kapi kapalı");
}

String sendMotorHTML(String value) {
  String ptr = value +"<p><a href=\"/kapi_ac\"><button class=\"button\">kapi aç</button></a></p><p><a href=\"/kapi_kapat\"><button class=\"button\">kapikapat</button></a></p><p><a href=\"/cikis\"><button class=\"button\">Cikis</button></a></p>\n";
  return ptr;
}
void handle_cikis(){
  webKontrol = 0;
  server.send(200, "text/html", "<p>cikis yapildi. NodeMCU otomatik kontrole geciyor...</p><p><a href=\"/Sistem_kapat\"><button class=\"button\">Giris Yap</button></a></p>");
}

String SendHTML(String value){
  String ptr = value +"\n";
  return ptr;
}
