# odrysian
GPS TIME SERVER

#### I used a Nano-Π Neo with OLED hat for this


![Nano Pi Neo Hat](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odr_1.png)

##### Then a USB to UART adapeter

![Nano Pi Neo Hat](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odr_2.png)

##### Wired to any UART GPS module

![Nano Pi Neo Hat](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odr_3.png)


#### I am using libSSD1306 with some changes for oled hat to get around python. 

    - cd libSSD1306/build and cmake . and make to get the tempprint  binary 
    - cd gpsread and make gpsdread (I wrote this)
    - there is a service in /etc.init.d/ folder. Tweak it and install it to run the files from dot.run
    - Theak also the dot.run  scripts to run the temprint and gpsread from where you put them.
        - install gpsd and ntp
        - make the /etc/ntp.conf to match the one in this git
    - install lighttpd web server of any other server
        - add php support
        - copy the /var.www.html to /var/www/html folder
        - add following to visudo
        


```bash
www-data ALL=(ALL) NOPASSWD:/sbin/iwconfig
www-data ALL=(ALL) NOPASSWD:/sbin/ifdown
www-data ALL=(ALL) NOPASSWD:/sbin/ifconfig
www-data ALL=(ALL) NOPASSWD:/sbin/ifup
www-data ALL=(ALL) NOPASSWD:/bin/cat
www-data ALL=(ALL) NOPASSWD:/bin/cp
www-data ALL=(ALL) NOPASSWD:/sbin/wpa_cli
www-data ALL=(ALL) NOPASSWD:/sbin/shutdown
www-data ALL=(ALL) NOPASSWD:/sbin/reboot
www-data ALL=(ALL) NOPASSWD:/sbin/ip
www-data ALL=(ALL) NOPASSWD:/usr/bin/nmap

www-data ALL=(ALL) NOPASSWD:/usr/sbin/service
www-data ALL=(ALL) NOPASSWD:/usr/bin/wpa_passphrase
www-data ALL=(ALL) NOPASSWD:/sbin/dhclient
www-data ALL=(ALL) NOPASSWD:/sbin/wpa_cli
www-data ALL=(ALL) NOPASSWD:/sbin/ip
www-data ALL=(ALL) NOPASSWD:/sbin/iwlist
www-data ALL=(ALL) NOPASSWD:/sbin/iw
```
    - For web interface I used https://github.com/billz/raspap-webgui
    - There were chnages to it.
    - I configured ntp on all machine in the net to use the Nano-PI Neo IP as one of the NTP servers.
    - Time is in sync.
    

![Time drift](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odry_7.png)
    
    
### The satelites map

![Nano Pi Neo Hat](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odry_4.png)

### The ntp status

![Nano Pi Neo Hat](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odry_5.png)

### The local network IP's

![Nano Pi Neo Hat](https://raw.githubusercontent.com/circinusX1/odrysian/master/docs/odry_6.png)
    
    
    - Web interface: last 3 options are non-functional


Published during covid19 days.


#### You can buy a ready SD card from [HERE](https://www.redypis.org/?pd=18)

    * Web interface: last 3 options are non-functional




###  You can check my reverse ssh online service and online key value database at 

[reverse ssh as a service](http://www.mylinuz.com)

[key value database as a service](https://www.meeiot.org)

