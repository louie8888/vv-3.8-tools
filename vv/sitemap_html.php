<?php
//rewrite  ^/sitemap.html(.*)$ /sitemap_html.php?$1 last;
#自定义采集的层数
$levelCount = 1;
//$url = "http://". $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';//必须是这个格式。后面不全url需要。
//$host = 'http://fishexportint.com/';//临时测试，后面直接删除
$link_arr_all = [];
function getLinks($url, $level)
{
    global $host,$levelCount,$link_arr_all;
    //达到指定层数递归停止
    if($level > $levelCount)
    {
        return;
    }
    //正则提取网页首页的所有连接
    $html = file_get_contents($url);
    $reg_a = '#<a.*?href="(.*?)".*?>.*?</a>#';
    preg_match_all($reg_a, $html,$result_a_arr);
    $link_arr = array_unique($result_a_arr[1]);//去除重复链接
    //补全url
    foreach ($link_arr as $key =>$link)
    {

        //过滤掉不正确的url 包含 ' 或者是 javascript
        if(strpos($link,'\'') !== false || strpos($link,'javascript') !== false)
        {
            //echo '包含';
            continue;//退出当前循环继续
        }
        $full_link = _expandlinks($link, $host);
        $linkresult[$key] = $full_link;
        $link_arr_all [] = $full_link;//放入总的数组中
        getLinks($full_link, $level + 1);

    }

}

getLinks($host,1);

$str = '<div id="header">
        <h1>HTML Sitemap</h1>
        <div id="desc">本站连接列表：</div>
        </div>';
$str .= "<table>";
$str .= "<thead>
            <tr>
                <th>网址</th>
                <th>最后更新时间</th>
           </tr>
         </thead>";
$str .= "<tbody>";
foreach ($link_arr_all as $full_link){
    $str .= "<tr>";
    $str .=     '<td><a href="' . $full_link . '">' . $full_link . '</a></td>';
    $str .=     "<td><time>" . date('Y-m-d') . "</time></td>";
    $str .= "</tr>";
}
$str .= "</tbody></table>";
echo $str;


/*===================================================================*

Function: _expandlinks

Purpose: 补全整个url，比如提取的是 '/' 或者是 'abc.html' ,自动拼接上域名，补全为  http://baidu.com/或者是 http://baidu.com/abc.html

Input:  $links   the links to qualify

$URI   the full URI to get the base from

Output:  $expandedLinks the expanded links

*===================================================================*/

function _expandlinks($links, $URI) {
    $URI_PARTS = parse_url($URI);

    $host = $URI_PARTS["host"];

    preg_match("/^[^?]+/", $URI, $match);

    $match = preg_replace("|/[^/.]+.[^/.]+$|", "", $match[0]);

    $match = preg_replace("|/$|", "", $match);

    $match_part = parse_url($match);

    $match_root = $match_part["scheme"] . "://" . $match_part["host"];

    $search = array(

        "|^http://" . preg_quote($host) . "|i",

        "|^(/)|i",

        "|^(?!http://)(?!mailto:)|i",

        "|/./|",

        "|/[^/]+/../|"

    );

    $replace = array(

        "",

        $match_root . "/",

        $match . "/",

        "/",

        "/"

    );

    $expandedLinks = preg_replace($search, $replace, $links);

    return $expandedLinks;

}

