
#include <array>
#include <chrono>
#include <cmath>
#include <csignal>
#include <cstring>
#include <string>
#include <exception>
#include <iostream>
#include <sstream>
#include <fstream>
#include <memory>
#include <thread>
#include <system_error>
#include <vector>

#include <sys/types.h>
#include <time.h>
#include <unistd.h>


#include "OledFont8x16.h"
#include "OledFont8x12.h"
#include "OledFont8x8.h"
#include "OledBitmap.h"
#include "OledGraphics.h"

#include "OledI2C.h"
#include "cimg.h"


using namespace cimg_library;
//-------------------------------------------------------------------------

namespace 
{
	volatile static std::sig_atomic_t run = 1;
}


//-------------------------------------------------------------------------

static void
signalHandler(
    int signalNumber)
{
    switch (signalNumber)
    {
    case SIGINT:
    case SIGTERM:

        run = 0;
        break;
    };
}

int split(const std::string& s, const char* delim, std::vector<std::string>& a)
{
    const char* pdelim=delim;
    std::string st;
    std::istringstream ss(s);
    a.clear();
    while(*pdelim)
    {
        if(s.find(*pdelim)!=std::string::npos)
        {
            while (getline(ss, st, *pdelim))
            {
                a.push_back(st);
            }
            return a.size();
        }
        ++pdelim;
    }
    return 0;
}

//-------------------------------------------------------------------------
//CImg
void scanTemp( SSD1306::OledI2C& oled)
{
	static std::string prev;
	std::string current;
	std::vector<std::string> lines;
	std::ifstream s;
	std::string ss;

	s.open( "/tmp/oled", std::ios::in);
	if(s.is_open())
	{
		while(!s.eof())
		{
		    std::getline(s,ss);
		    current.append(ss);
		    lines.push_back(ss);
		    ss.clear();
		}
		s.close();
	}

	if(prev != current)
	{
		std::vector<std::string> tokens;
		prev = current;
		oled.clear();
		for(const auto& l : lines)
		{
			//1,2,3,l,c,string
			split(l, ",", tokens);
			if(tokens.size()==5 && tokens[0]=="T") // T|1|4|4|text
			{
				int font = ::atoi(tokens[1].c_str());
				int line = ::atoi(tokens[3].c_str());
				int row  = ::atoi(tokens[2].c_str());

				if(font<=1)
					drawString8x8(SSD1306::OledPoint{line, row},
		            	               tokens[4].c_str(),
		            	               SSD1306::PixelStyle::Set,
		            	               oled);
				else if(font==2)
					drawString8x12(SSD1306::OledPoint{line, row},
		            	               tokens[4].c_str(),
		            	               SSD1306::PixelStyle::Set,
		            	               oled);
				else if(font==3)
					drawString8x16(SSD1306::OledPoint{line, row},
		            	               tokens[4].c_str(),
		            	               SSD1306::PixelStyle::Set,
		            	               oled);
			}
			else if(tokens.size() == 6 && tokens[0]=="I") //I,X,Y,W,H,file.png
			{
/*
				int line = ::atoi(tokens[1].c_str());
				int row  = ::atoi(tokens[2].c_str());
				int w = ::atoi(tokens[3].c_str());
				int h  = ::atoi(tokens[4].c_str());
			        CImg<unsigned char> image(tokens[5].c_str()),
         			     gray(image.width(), image.height(), 1, 1, 0),
			             grayWeight(image.width(), image.height(), 1, 1, 0),
        			     imgR(image.width(), image.height(), 1, 3, 0),
			             imgG(image.width(), image.height(), 1, 3, 0),
        			     imgB(image.width(), image.height(), 1, 3, 0);
				
				cimg_forXY(image,x,y)
				{
					std::cout << x << y << "\n";
				        int R = (int)image(x,y,0,0);
    					int G = (int)image(x,y,0,1);
    					int B = (int)image(x,y,0,2);
					int grayValueWeight = (int)(0.299*R + 0.587*G + 0.114*B);
				}
*/
			}
		}
		oled.displayUpdate();
	}
}

//-------------------------------------------------------------------------

int main()
{
    try
    {
        constexpr std::array<int, 2> signals{SIGINT, SIGTERM};

        for (auto signal : signals)
        {
            if (std::signal(signal, signalHandler) == SIG_ERR)
            {
                std::string what{"installing "};
                what += strsignal(signal);
                what += " signal handler";

                throw std::system_error(errno,
                                        std::system_category(),
                                        what);
            }
        }

        SSD1306::OledI2C oled{"/dev/i2c-0", 0x3C};

        while (run)
        {
            scanTemp(oled);
            ::usleep(128000);
        }

        oled.clear();
        oled.displayUpdate();
    }
    catch (std::exception& e)
    {
        std::cerr << e.what() << "\n";
    }

    return 0;
}

