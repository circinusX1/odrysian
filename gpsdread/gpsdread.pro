QT -= gui

CONFIG += c++11 console
CONFIG -= app_bundle

# The following define makes your compiler emit warnings if you use
# any feature of Qt which as been marked deprecated (the exact warnings
# depend on your compiler). Please consult the documentation of the
# deprecated API in order to know how to port your code away from it.
DEFINES += QT_DEPRECATED_WARNINGS

# You can also make your code fail to compile if you use deprecated APIs.
# In order to do so, uncomment the following line.
# You can also select to disable deprecated APIs only up to a certain version of Qt.
#DEFINES += QT_DISABLE_DEPRECATED_BEFORE=0x060000    # disables all the APIs deprecated before Qt 6.0.0

SOURCES += main.cpp \
    singleton.cpp




unix|win32: LIBS += -lgps

DISTFILES += \
    ../../../var/www/html/_gpsd.php \
    ../../../var/www/html/index.php \
    ../../../var/www/html/_ntp.php \
    ../../../var/www/html/_gpsdcss.css \
    ../web/index.php \
    ../web/scss/_bootstrap-overrides.scss \
    ../web/scss/_global.scss \
    ../web/scss/_mixins.scss \
    ../web/scss/_nav.scss \
    ../web/scss/_variables.scss \
    ../web/scss/_odrysian-item.scss \
    ../web/scss/odrisyan.scss \
    ../web/js/odrisyan.js \
    ../web/js/odrisyan.min.js \
    ../web/css/odrisyan.css \
    ../web/css/odrisyan.min.css \
    ../web/_gps.php \
    ../web/js/_js.js \
    ../web/_gps.php \
    ../web/_gpsd.php \
    ../web/_ntp.php \
    ../web/_nmap.php \
    ../web/gpsd.php \
    ../web/includes/_gps.php \
    ../web/includes/_gpsd.php \
    ../web/includes/_nmap.php \
    ../web/includes/_ntp.php \
    ../web/includes/gpsd.php \
    ../web/gulpfile.js \
    ../web/index.php \
    ../web/raspap.php \
    ../web/bower.json \
    ../web/package.json \
    ../web/_config.yml \
    ../web/_body.php \
    ../web/CONTRIBUTING.md \
    ../web/ISSUE_TEMPLATE.md \
    ../web/README.md \
    ../web/CNAME \
    ../web/gpsd_config.inc \
    ../web/index.php-new \
    ../web/LICENSE \
    ../web/js/gpsd.js \
    ../web/ajax/networking/gen_int_config.php \
    ../web/ajax/networking/get_all_interfaces.php \
    ../web/ajax/networking/get_int_config.php \
    ../web/ajax/networking/get_ip_summary.php \
    ../web/ajax/networking/save_int_config.php \
    ../web/includes/networking.php \
    ../web/includes/admin.php \
    ../web/includes/about.php \
    ../web/includes/admin.php \
    ../web/includes/authenticate.php \
    ../web/includes/config.php \
    ../web/includes/configure_client.php \
    ../../../../../etc/raspap/raspap.php \
    ../web/includes/functions.php \
    ../web/includes/system.php \
    ../web/includes/webconsole.php \
    ../web/includes/config.php \
    ../../../../../etc/raspap/networking/interfaces \
    ../../../../../etc/raspap/networking/eno1.ini \
    ../../../../../etc/raspap/networking/wlo1.ini

HEADERS += \
    ../../../var/www/html/_gpsdcss.h \
    singleton.h


