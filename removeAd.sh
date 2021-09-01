#!/bin/bash
for line in `cat domain-removeAd.txt`
do
    rm -rf /www/wwwroot/www.$line/static.js
    cp  /www/vv-3.8-tools/vv/static.js  /www/wwwroot/www.$line/
	#echo "站点:"$line "===移除广告成功!"
	echo -e "\033[32m 站点:"$line "===移除广告成功 \033[0m"
done
# ----以上是要下掉广告的时候执行的脚本removeAd.sh
