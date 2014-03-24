#!/bin/sh
echo "<?xml version='1.0' encoding='UTF-8'?>"
echo "<info>"
echo "<status>"
	msdlPID=$(pidof "msdl")
	if test $? -eq 0
	then
	killall -9 pidof "msdl" >/dev/null 2>&1
	echo "<movie>Movie is Stopped.</movie>"
	else
	echo "<movie>Movie is Stopped.</movie>"
	fi
echo "</status>"
echo "</info>"
