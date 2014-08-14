#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/wget --tries=3 "https://r7---sn-4g57kn66.googlevideo.com/videoplayback?sver=3&sparams=id%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire&requiressl=yes&upn=oU6vbTFS27I&ip=78.96.189.71&ms=au&itag=18&mws=yes&mv=m&source=youtube&key=yt5&signature=35CD01545F7FB563F3A333BFD0A19979416EB71E.B05F017FEC5916F25E49A4A47B2C8C2A5AFA86C4&id=o-APDH5p4j15Dtmf9OpwvPN-aNm0qKbEV2gvCpQkWE8Vlz&fexp=902408%2C908587%2C912325%2C914081%2C927622%2C931983%2C934024%2C934030%2C935660%2C938672%2C946022&nh=IgpwcjAyLmZyYTAzKgkxMjcuMC4wLjE&ipbits=0&mm=31&initcwndbps=2333000&mt=1407851999&ratebypass=yes&expire=1407873704"
