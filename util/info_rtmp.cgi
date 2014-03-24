#!/bin/sh
rtmpPID=$(pidof "rtmpdump")
if test $? -eq 0
 then
  killall -9 pidof "rtmpdump" >/dev/null 2>&1
  echo "Stop"
fi
