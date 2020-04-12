
#include <iostream>
#include <fstream>
#include <iomanip>
#include <ctime>
#include <sstream>


#include <stdio.h>
#include <unistd.h>
#include <libgpsmm.h> //sudo apt-get istall libgps-dev
#include "singleton.h"

struct gps_data_t *gpsd_data=0;
static bool par;

void gpios();

void oled()
{
    char stmd[128];
    char stmt[128];

    timestamp_t ts { gpsd_data->fix.time };

    time_t seconds { (time_t)ts };
    auto   tm = *std::localtime(&seconds);
    std::cout << seconds << "\n";

    strftime(stmt, sizeof(stmt)-1, "%H:%M:%S", &tm);
    strftime(stmd, sizeof(stmd)-1, "%d/%m/%Y", &tm);

    std::ofstream foutputt("/tmp/oled");

    if(foutputt.is_open())
    {
        if((par=!par)==false)
        {
            foutputt << "T,3,2, 10,"; foutputt << stmd << "\n";
            foutputt << "T,3,20,10,"; foutputt << stmt << "\n";
            foutputt << "T,3,40,10,"; foutputt <<  gpsd_data->satellites_used<< " satelittes\n";
        }
        else if(gpsd_data)
        {
            foutputt << "T,3,8, 12,"; foutputt << stmd << "\n";
            foutputt << "T,3,26,12,"; foutputt  << stmt << "\n";
            foutputt << "T,3,46,12,"; foutputt <<  gpsd_data->satellites_used<< "satellites\n";
        }
        foutputt.close();
    }
}


int main()
{
    int tm=0;
    SingleProc p(26789);
    gpsmm* gps_rec;// = new gpsmm"127.0.0.1", DEFAULT_GPSD_PORT);

    if(!p())                // second instance
    {
        std::cout << "already running\n";
        return -1;
    }
    std::cout << "{\"mgs\":\"GPSD starting\"}\n";

RESTART:
    gps_rec = new gpsmm("127.0.0.1", DEFAULT_GPSD_PORT);

    if (gps_rec->stream(WATCH_ENABLE | WATCH_JSON) == NULL) 
   {
        std::cerr << "{\"mgs\":\"GPSD not running\"}\n";
        return 1;
    }
    while (!gps_rec->waiting(1000000)){::usleep(10000);};
    if ((gpsd_data = gps_rec->read()) == NULL) {
        std::cerr << "{\"mgs\":\"GPSD read error\"}\n";
        return 1;
    } 
    else 
    {
	oled();
        std::cout << "{\"mgs\":\"GPSD starting\"}\n";
        int counter=0;
        while(1)
        {
	    gpios();

            if(counter++<25)
	    {
		   usleep(100000);
		   continue;
	    }

	    if (((gpsd_data = gps_rec->read()) == NULL) ||
                   (gpsd_data->fix.mode < MODE_2D)) 
	    {
		   std::cout << time(0) << " fixing \n";
		   sleep(3);
                  if(tm++>8)
		  {
                        tm = 0;
			delete gps_rec;
			goto RESTART;
		  } 
		   continue;
            }
            tm=0;
	    counter=0;
            oled();

            timestamp_t ts { gpsd_data->fix.time };
            auto latitude  { gpsd_data->fix.latitude };
            auto longitude { gpsd_data->fix.longitude };

            // convert GPSD's timestamp_t into time_t
            time_t seconds { (time_t)ts };
            auto   tm = *std::localtime(&seconds);

            std::ostringstream oss;
            oss << std::put_time(&tm, "%d-%m-%Y %H:%M:%S");
            auto time_str { oss.str() };


            std::ofstream foutput("/tmp/gps.json");
            if(foutput.is_open()) {
                // set decimal precision
                foutput.precision(6);
                foutput.setf(std::ios::fixed, std::ios::floatfield);
                foutput << "{\"latitude\":";
                foutput <<  latitude;
                foutput << ",\"longitude\":";
                foutput <<  longitude;
                foutput << ",\"track\":";
                foutput <<  gpsd_data->fix.track;
                foutput << ",\"mode\":";
                foutput <<  gpsd_data->fix.mode;
                foutput << ",\"epy\":\"";
                foutput <<  gpsd_data->fix.epy;
                foutput <<  "\"";
                foutput << ",\"epx\":\"";
                foutput <<  gpsd_data->fix.epx;
                foutput <<  "\"";
                foutput << ",\"epv\":\"";
                foutput <<  gpsd_data->fix.epv;
                foutput <<  "\"";
                foutput << ",\"epv\":\"";
                foutput <<  gpsd_data->fix.epv;
                foutput <<  "\"";
                foutput << ",\"epd\":\"";
                foutput <<  gpsd_data->fix.epd;
                foutput <<  "\"";
                foutput << ",\"eps\":\"";
                foutput <<  gpsd_data->fix.eps;
                foutput <<  "\"";
                foutput << ",\"epc\":\"";
                foutput <<  gpsd_data->fix.epc;
                foutput <<  "\"";
                foutput << ",\"speed\":";
                foutput <<  gpsd_data->fix.speed;
                foutput << ",\"climb\":";
                foutput <<  gpsd_data->fix.climb;
                foutput << ",\"status\":";
                foutput <<  gpsd_data->status;
                foutput << ",\"satelites_visible\":";
                foutput <<  gpsd_data->satellites_visible;
                foutput << ",\"satelites_used\":[";

                bool has=false;
                for(size_t i=0;i<sizeof(gpsd_data->skyview)/sizeof(gpsd_data->skyview[0]);i++)
                {
                    struct satellite_t * ps = &gpsd_data->skyview[i];
                    if(ps->used)
                    {
                        if(has){
                            foutput  << ",";
                        }
                        foutput  << "{\"PRN\":" ;
                        foutput  << ps->PRN;
                        foutput  << ",\"ss\":";
                        foutput  << ps->ss;
                        foutput  << ",\"azimuth\":";
                        foutput  << ps->azimuth;
                        foutput  << ",\"elevation\":" ;
                        foutput  << ps->elevation;
                        foutput  << "}";

                        has=true;
                    }
                }
                foutput << "]}\n";
            }
            foutput.close();
            ::usleep(100000);


        }
    }
    return 0;
}

void gpios()
{
		std::string path="/sys/class/gpio/";
		std::string gpios[] = {"gpio0", "gpio2", "gpio3"};
		std::ifstream inFile;
		for (int g=0;g<3;g++)
		{
			if(::access((path+gpios[g]+"/value").c_str(),0)==0){
				inFile.open((path+gpios[g]+"/value").c_str()); 
    				std::stringstream strStream;
	    			strStream << inFile.rdbuf();
    				std::string str = strStream.str();
				inFile.close();
//				std::cout << gpios[g] << " = " << str << "\n";
				if(str.find("1")!=std::string::npos){
					std::ofstream f("/tmp/gpio.val");
            				if(f.is_open()) {
						f << gpios[g] << "\n";
						f.close();
//						std::cout << gpios[g] << "\n";
					}
				}
			}
		}
}
