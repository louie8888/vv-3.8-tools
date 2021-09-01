#!/bin/bash
for line in `cat domain-addAd.txt`
do
    rm -rf /www/wwwroot/www.$line/static.js
    cp  /www/vv-3.8-tools/vv/ad.js  /www/wwwroot/www.$line/static.js
	echo -e "\033[32m 站点:"$line "===添加广告成功 \033[0m"
done
# ----以上是要下挂广告的时候执行的脚本addAd.sh