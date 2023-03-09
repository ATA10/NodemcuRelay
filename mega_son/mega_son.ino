#include <SoftwareSerial.h>
#include <SPI.h>
#include <MFRC522.h>
#include <EEPROM.h>
#include <Keypad.h>
#include  <LiquidCrystal.h>
#include <Wire.h>

#define RST_PIN 49
#define SS_PIN 53

#define buzzer 41

int ledk=42;
int ledy=43;

LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

#define  LED_OFF  0
#define  LED_ON  1

/*
 * RİFD İLK DEGERLER VE SPİ PİNLERİNİN BELİRLENMESİ
 */
    MFRC522 mfrc522(SS_PIN, RST_PIN);
    
    String lastRfid = "";
    String kart1 = "";
    
    MFRC522::MIFARE_Key key;
/*
 * KEYPAD PİNLERİN BELİRLENMESİ 
 */
    int okunan=0;
    const byte satir = 4; //4 satir
    const byte sutun = 4; //4 sutun
    char password[5]; 
    int i= 0;
    
    char rakamlar[satir][sutun] = {
    {'1','2','3','A'},
    {'4','5','6','B'},
    {'7','8','9','C'},
    {'*','0','#','D'}
    };
    byte satirpin[satir] = { 24, 25, 26, 27 };
    byte sutunpin[sutun] = { 28, 29, 30, 31 };
    
    Keypad butonlar = Keypad(makeKeymap(rakamlar), satirpin, sutunpin, satir, sutun); 
   
void tussesi()
  {
   digitalWrite(buzzer, HIGH);
   delay(30);
   digitalWrite(buzzer, LOW);
  }
    
void rfidfonk()
{
 //yeni kart okununmadıkça devam etme
  if ( ! mfrc522.PICC_IsNewCardPresent())
  {
   return;
  }
  if ( ! mfrc522.PICC_ReadCardSerial())
  {
    return;
  }
  //kartın UID'sini oku, rfid isimli string'e kaydet
  String rfid = "";
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
    rfid += mfrc522.uid.uidByte[i] < 0x10 ? "0" : "";
    rfid += String(mfrc522.uid.uidByte[i], HEX);
  }
  //string'in boyutunu ayarla ve tamamını büyük harfe çevir
  rfid.trim();
  rfid.toUpperCase();

  Serial.print(rfid);
  Serial.print("");
  lcd.setCursor(0,1);
  lcd.print(rfid);
  delay(500);
  Serial.setTimeout(5000);
  kontrol();
   }
  
 void pin()
   {
   okunan = butonlar.getKey();
   if (okunan)
     {
     password[i++]=okunan;
     tussesi();
     lcd.setCursor(0,1);
     lcd.print(password);
     }
   if(i==4)
     {
     Serial.print(password);
     Serial.print("");
     Serial.setTimeout(500);
      
     lcd.clear();
     lcd.print("Bekleyin...");
     delay(2000);
     lcd.clear();
     i=0;
     kontrol();        
     }
  }

void kontrol()
  {
    while(Serial.available())
      {
      if(Serial.find("mokoko"))
        {
          lcd.print("TANIMLI KULLANICI");
          digitalWrite(ledy, HIGH);
          delay(300);
          digitalWrite(ledy, LOW);
          lcd.clear();          
        }
      }
     lcd.print("--KAPI KILIT SISTEMI--");
     lcd.setCursor(0,1);
     lcd.print("-lab-1--");
     delay(2000);
     lcd.clear();
     lcd.print("Sifreyi Girin: ");
  }
 
 void setup()
   {    
     Serial.begin(115200);
     SPI.begin();
     mfrc522.PCD_Init();
 
     lcd.begin(16,2);
     pinMode(ledk, OUTPUT);
     pinMode(ledy, OUTPUT);
     pinMode(buzzer, OUTPUT);
     lcd.print("KAPI KILIT SISTEMI");
     lcd.setCursor(0,1);
     lcd.print("-lab-1--");
     delay(2000);
     lcd.clear();
     lcd.print("Sifreyi Girin: ");
   }

void loop()
  {    
  rfidfonk();
  pin();
   
  }
