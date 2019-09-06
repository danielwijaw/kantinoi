<?php  
 
class dnllibrary
{
 
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    function cuk()
    {
        echo "COK";
    }
 
    function do_in_background($url, $params)
    {
        $post_string = http_build_query($params);
        $parts = parse_url($url);
        $errno = 0;
        $errstr = "";

        if(!isset($parts['host'])){
            $parts['host'] = $_SERVER['HTTP_HOST'];
        }else{
            $parts['host'] = $parts['host'];
        }
        if(!isset($parts['port'])){
            $parts['port'] = $_SERVER['SERVER_PORT'];
        }else{
            $parts['port'] = $parts['port'];
        }
        
        $fp = fsockopen($parts['host'], $parts['port'], $errno, $errstr, 30);
        if(!$fp)
        {
            echo "$errstr ($errno)<br />\n";   
        }
        $out = "GET ".$parts['path']."?".$post_string." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        fwrite($fp, $out);
        // while (!feof($fp)) {
        //     echo fgets($fp, 128);
        // }
        fclose($fp);
    }
}
?>