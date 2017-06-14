<?php
class help
{
   // public static $uid_now; //保存当前在线的用户id
    static function Judge($x,$z)  //判断x字符串是否是合法的
    {
        if (strlen($x) > 10 || strlen($x) < 6) return 1;
        if($z==0)
        {
            for($y = 0;$y < strlen($y); $y++)
            {
                if($x[$y] =='>' ||$x[$y] =='<'||$x[$y] =='.'||$x[$y] =="'"|| $x[$y] =='"') return 1;
            }
        }
        if($z>=1)
        {
            for ($y = 0; $y < strlen($x); $y++)
            {
                if ($x[$y] >= '0' && $x[$y] <= '9') continue;
                else return 1;
            }
        }
        if($z>=2)
        {
            for ($y = 0; $y < strlen($x); $y++)
            {
                if($x[$y] >= '0' && $x[$y] <= '9'||$x[$y] >= 'a' && $x[$y] <= 'z' || $x[$y] >= 'A' && $x[$y] <= 'Z') continue;
                else return 1;
            }
        }
        return 0;
    }

    static function Pop_info($text) //弹窗输出信息
    {
        echo "<script language='javascript'>";
        echo "alert('$text')";
        echo "</script>";
    }

    static function Jump_page($url)  //跳转页面
    {
        echo "<script language='javascript' 
        type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
    }
    static function Test_cookie() //检验cookie信息是否过期
    {
        if(!isset($_COOKIE["uid"]))
        {
            help::Pop_info("身份信息过期请重新登录");
            help::Jump_page("http://localhost:80/index.php");
        }
        else
        {
            include_once "dao/conn.php";
            $conn = new conn();
            $pass_now=$conn->operation_query_count_userpass($_COOKIE["uid"]);
        //    echo $pass_now."    ".$_COOKIE["pass"]." ++".help::Hash($pass_now);
            if(help::Hash($pass_now) != $_COOKIE["pass"])
            {
                help::Pop_info("身份信息过期请重新登录");
                help::Jump_page("http://localhost:80/index.php");
            }
        }
    }

    static function Hash($str)
    {
        return $str;
    }
}
?>