
CXX=${CROSS_COMPILE}g++

src = $(wildcard *.cpp)
obj = $(src:.cpp=.o)

LDFLAGS = -lgps

CXXFLAGS += -std=gnu++11 -Wall -W -D_REENTRANT -fPIC

gpsdread: $(obj)
	$(CXX) $(CXXFLAGS) -o $@ $^ $(LDFLAGS)

.PHONY: clean
clean:
	rm -f $(obj) gpsdread

