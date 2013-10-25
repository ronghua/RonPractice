
<TITLE> Hello World in PHP </TITLE>
</HEAD>
<BODY>

<?

print("Hello World<br>");

// $HTTP_USER_AGENT and $REMOTE_ADDR are two of many evironment
// variables in PHP.  Environent variables store information about
// the user's and server's environment

print("You are using $_SERVER[HTTP_USER_AGENT]<br>");
print("Your Internet address is $_SERVER[REMOTE_ADDR]<br>");

$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
print("You are at $details");
?>

</BODY>
</HTML>
