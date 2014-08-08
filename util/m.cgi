#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/wget -q -tries=3 "http://r9---sn-4g57knz6.googlevideo.com/videoplayback?itag=18&initcwndbps=2131000&ipbits=0&ms=au&fexp=902408%2C914070%2C916625%2C917000%2C927622%2C934024%2C934030%2C936118%2C936929%2C946012&mws=yes&mv=m&upn=rpYrmwrUSns&source=youtube&ip=78.96.189.71&sver=3&ratebypass=yes&mt=1407073439&nh=IgpwcjAyLmZyYTA1KgkxMjcuMC4wLjE&signature=5500A8C9EABC5839FBC780931776983A5C39434B.479799C35A74390E1F66078C0540436E97FE964D&key=yt5&expire=1407095145&mm=31&sparams=id%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Cratebypass%2Csource%2Cupn%2Cexpire&id=o-AKmv8LAWGlMSi9YwHUbjrOP4LaOOlGFOg4rCoG8E_zgq" -O -