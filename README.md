# odrysian
GPS TIME SERVER

I used a nano po neo with OLED hat for this


[![Nano Pi Neo Hat](https://raw.githubusercontent.com/comarius/odrysian/master/docs/odr_1.png)]

Then a USB to UART adapeter I had around

[![Nano Pi Neo Hat](https://raw.githubusercontent.com/comarius/odrysian/master/docs/odr_2.png)]

Wired to any UART GPS module. I has this hanging over.

[![Nano Pi Neo Hat](https://raw.githubusercontent.com/comarius/odrysian/master/docs/odr_3.png)]


I am using libSSD1306 with some changes. 

    - cd libSSD1306/build and cmake . and make to get the tempprint  binary 
    - cd gpsread and make gpsdread
    - 

