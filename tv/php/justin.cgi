#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -b 60000 -q -v -p http://justin.tv -r "rtmp://199.9.254.243/app/jtv_26b2IFVd91S3ep5m" --jtv "d28e0bc5500c41d78a49e6aafc6bb31104011125:{\"swfDomains\": [\"justin.tv\", \"jtvx.com\", \"xarth.com\", \"twitchtv.com\", \"twitch.tv\", \"newjtv.com\", \"wdtinc.com\", \"imapweather.com\", \"facebook.com\", \"starcrafting.com\"], \"streamName\": \"jtv_26b2IFVd91S3ep5m\", \"expiration\": 1326118548.547224, \"geo_ip\": \"78.96.189.71\", \"server\": \"fra01-video15-2\"}" --swfUrl "http://www-cdn.justin.tv/widgets/live_site_player.r810da0619bb02a0918e62891c49ea927f19a4a36.swf"