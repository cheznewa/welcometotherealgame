<?php
if ($_SERVER["HTTP_HOST"][32] !== "." and $_SERVER["HTTP_HOST"][33] !== "a" and $_SERVER["HTTP_HOST"][34] !== "n" and $_SERVER["HTTP_HOST"][35] !== "n")
{
echo "please begin the game the host end .ann and the address have 32 chars";
exit(1);
}
if (!file_exists("sessiogame.txt"))
file_put_contents("sessiogame.txt",time());
$basecharaddr = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
$thewinaddr = "";
$linkaddr = "";
$sess = file_get_contents("sessiogame.txt");
mt_srand($sess);
for ($n = 0;$n<32;$n++)
$thewinaddr = $thewinaddr . $basecharaddr[mt_rand(0,15)];
$thewinaddr = $thewinaddr . ".ann";
$addr = $_SERVER["HTTP_HOST"];
$words = file_get_contents("/usr/share/dict/words");
$awords = explode("\n",$words);
$windicea = "";$windiceb = "";$windicec = "";$windiced = "";$windicee = "";$windicef = "";$windiceg = "";$windiceh = "";
for ($n = 0;$n<4;$n++)
{
$windicea = $windicea . $thewinaddr[$n];$windiceb = $windiceb . $thewinaddr[$n+4];$windicec = $windicec . $thewinaddr[$n+8];$windiced = $windiced . $thewinaddr[$n+12];
$windicee = $windicee . $thewinaddr[$n+16];$windicef = $windicef . $thewinaddr[$n+20];$windiceg = $windiceg . $thewinaddr[$n+24];$windiceh = $windiceh . $thewinaddr[$n+28];
}
$addrdec = 0;
for ($n = 0;$n<32;$n++)
{
$addrdec = intval($addrdec * 16 + array_search($addr[$n],$basecharaddr))%(pow(2,38)-1);
}
mt_srand(intval(($sess+$addrdec)%(pow(2,38)-1)));
if ($addr == $thewinaddr)
{
unlink("sessiogame.txt");
echo "<style>html{background-color:black;color:green;font-size:125px;}</style>";
echo "<title>YOU WIN!!!</title><h1>You WIN!!!</h1>";
}
elseif (mt_rand(1,100) == 1)
{
echo "<style>html{background-color:black;color:red;font-size:125px;}</style>";
echo "<title>YOU LOSE!!!</title><h1>You Are Loser!!!</h1>Another Gamer Maybe?";
unlink("sessiogame.txt");
}
else
{
switch (mt_rand(1,6))
{
case 1:
$color = ["black","white"];
break;
case 2:
$color = ["black","white"];
break;
case 3:
$color = ["black","white"];
break;
case 4:
$color = ["white","black"];
break;
case 5:
$color = ["white","red"];
break;
case 6:
$color = ["black","green"];
break;
}
$nwords = count($awords);
$colorone = $color[0];
$colortwo = $color[1];
echo "<style>html{background-color:".$colortwo.";color:".$colorone.";}</style>";
echo "<title>".$awords[mt_rand(0,$nwords)]." ".$awords[mt_rand(0,$nwords)]."</title>";
for ($n = 0;$n<mt_rand(50,200);$n++)
{
if (mt_rand(1,10) == 1)
{
for ($n = 0;$n<32;$n++)
$linkaddr = $linkaddr . $basecharaddr[mt_rand(0,15)];
$linkaddr = $linkaddr . ".ann";
echo "<a href=\"http://$linkaddr\">".$awords[mt_rand(0,$nwords)]."</a>\n";
$linkaddr = "";
}
elseif (mt_rand(1,25) == 1)
{
echo "<font face='emoticon-composer'>".chr(mt_rand(65,90)).chr(mt_rand(97,122));
if (mt_rand(1,5) == 1)
echo chr(mt_rand(48,57));
echo "</font>\n";
}
elseif (mt_rand(1,1000) == 1)
{
switch (mt_rand(1,8))
{
case 1:
echo "1 - $windicea ";
break;
case 2:
echo "2 - $windiceb ";
break;
case 3:
echo "3 - $windicec ";
break;
case 4:
echo "4 - $windiced ";
break;
case 5:
echo "5 - $windicee ";
break;
case 6:
echo "6 - $windicef ";
break;
case 7:
echo "7 - $windiceg ";
break;
case 8:
echo "8 - $windiceh ";
break;
}
}
else
{
echo $awords[mt_rand(0,$nwords)];
}
}
}
?>