#!/bin/bash

pushd /sys/class/gpio
echo 0 > export
echo 2 > export
echo 3 > export
echo in  > ./gpio0/direction
echo in  > ./gpio2/direction
echo in  > ./gpio3/direction
popd

