<!--**********************
*Title: Hello Zombies
*Work by :Winnie Soon (www.siusoon.net)
*Last update: 11 Oct 2017
*Description:
“We are with you everyday, we live in the Internet with peculiar addresses and enticing titbits, but you call us “spam”. We wander around the network, mindlessly, and you wanted to trash us, but we are still everywhere. We are just the children of your economic and social system, but you ignore and avoid us. We are not dead, we write, we create.”
—This artwork examines these nonhuman zombies as a cultural phenomenon that produces quantified data and network identities.This project explores zombies of the living dead that bring forward social, technical, capitalistic and aesthetic relations in everyday lives.
More: http://siusoon.net/?p=112

Logic: 
1/ Get spammer list (copy to server, unzip to txt from cron job-> other php)
2/ read the txt file and put into arrays
3/ display email in rolling with hyperlink effects
4/ Refresh for a certain period of time

Configurable items:
1/ spammer source url, extracted path, filename
2/ display no of lines
3/ font size, color
4/ refresh rate
5/ rolling direction and speed

*****Log:
11 Oct 2017: Add metatag to replace css screen/mobile, fixed iOS browser issue
24 Aug 2017: Add css for screen/mobile
9 Oct 2014: hide scrollbar in firefox with css
30 Sep 2014: Removed all random values
25 Aug 2014: Final testing

******-->
<!DOCTYPE html>
<html>
<head>
<title>Hello Zombies</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="hello zombies" />
<meta name="keywords" content="spam,spammer,zombies,spam culture" />
<meta name="author" content="Winnie Soon" />
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no shrink-to-fit = no" />
<style>
body {background-color: black; font-size: 15px;}
th {padding: 1px;}
td {overflow: hidden;white-space: nowrap;}
::-webkit-scrollbar {width: 0px;height: 10px;} 
</style>
</head>
<body>

<?php
header("refresh: 3600;"); #one hour

#### get file ####
$filename = "list_output/list.txt";   #DEFINE file name of the spammer list
$myfile = fopen($filename, "r") or die("Unable to open file!");
$email = array();
while (!feof($myfile)) { 
	$email[] = fgets($myfile);
}
fclose($myfile);
##### end of get file ####

##### arrays #####
$no_lines = 60; #DEFINE no of line for the web page displays
$list = array_fill(0,$no_lines, "");
for ($i = 0; $i < sizeof($email); $i++)
{
	$list[fmod($i,$no_lines)]= $list[fmod($i,$no_lines)] . "," . $email[$i];
}	
##### end of array ####

##### display rolling text #####
echo "<table>\n";
for ($y = 0; $y < sizeof($list); $y++)
{
# >>>add the random parameter of direction and scrollamount
$roll=array("left","right");
echo "<tr>\n";
echo "<td><marquee behavior=\"scroll\" direction=\""; 
if (strlen($list[$y]) % 2) {  #DEFINE the rolling direction by the no of characters in each row
	echo $roll[0];
}
else{
	echo $roll[1];
}
#echo $roll[rand(0,1)]; #DEFINE the rolling direction
	echo "\" scrollamount=\"";
	$scroll= (strlen($list[$y]) % 5); #DEFINE the rolling speed by the no of characters in each row
if ($scroll < 1) {
	echo "1";
}else{
	echo $scroll;
}
#echo rand(1,8); #DEFINE rolling speed
echo "\" width=\"100%\" bgcolor=\"#F2F5A9\">"; ##ffffff

$email_item = explode(",", $list[$y]);
	for ($z = 0; $z < sizeof($email_item); $z++)
	{ 
	 $getEmail = trim($email_item[$z]);
	 echo "<a href=\"$getEmail\">$getEmail</a>&nbsp;";
	}
echo "</marquee></td>\n";
echo "</tr>\n";
}
##### end of display rolling text #####
echo "</table>";
?>

</body>
</html>