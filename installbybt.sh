#!/bin/bash
for line in `cat domain-tdk.txt`
do
        OLD_IFS="$IFS"
        #分割符
        IFS="*"
        arr=($line)
       
        domain=${arr[0]}
        from=${arr[1]}
        title=${arr[2]}
        description=${arr[3]}
        keyword=${arr[4]}
       # replace=${arr[5]} 
        IFS=$OLD_IFS
        echo "domain:" $domain 
        echo "from:" $from 
        echo "title:" $title 
        echo "keyword:" $keyword 
        echo "description:" $description  
       # echo "replace:" $replace
         #建站
        #拷贝模板站点文件并赋权
        mkdir -p /www/wwwroot/www.$domain/
        cp -r ./vv/*  /www/wwwroot/www.$domain/
        chmod -R 777 /www/wwwroot/www.$domain/*
        #拷贝nginx模板配置文件
        #先暂时用宝塔面板nginx路径测试
        #原nginx配置路径/usr/local/nginx/conf/vhost/
        cp -rf ./conf/bt/www.default.com.conf  /www/server/panel/vhost/nginx/www.$domain.conf
        #替换域名
        sed -i s/domain/$domain/g  /www/server/panel/vhost/nginx/www.$domain.conf

        #替换tdk
        sed -i s/@domain/$domain/g /www/wwwroot/www.$domain/data/configmoban.php
        sed -i s/@title/$title/g /www/wwwroot/www.$domain/data/configmoban.php
        sed -i s/@description/$description/g /www/wwwroot/www.$domain/data/configmoban.php
        sed -i s/@keyword/$keyword/g /www/wwwroot/www.$domain/data/configmoban.php
        #转码为gbk防止后台tdk栏目乱码
        iconv -f UTF-8 -t GBK /www/wwwroot/www.$domain/data/configmoban.php > /www/wwwroot/www.$domain/data/config.php
        #把url切割出，保留右侧域名部分 
        mbdomain=${from#*//}
        echo $mbdomain
        #再切割掉右边的斜杠，保留左侧部分。防止域名末尾带一个斜杠。
        mbdomain=${mbdomain%/*}
        echo $mbdomain
        #替换目标站等相关配置 不能直接用from变量替换进去，因为字符串带斜杠。
        sed -i s/@mburl/$mbdomain/g /www/wwwroot/www.$domain/data/config/moban.php
        sed -i s/@domain/$domain/g /www/wwwroot/www.$domain/data/config/moban.php
        #再转码成gbk输出为3.php  这个存在了data下的某个位置了
        iconv -f UTF-8 -t GBK /www/wwwroot/www.$domain/data/config/moban.php > /www/wwwroot/www.$domain/data/config/3.php
        #不知道为啥3.php会没有权限写入，先这样处理
        chmod -R 777 /www/wwwroot/www.$domain/data/config/3.php
        
        

done
service nginx restart
