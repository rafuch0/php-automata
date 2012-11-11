<?php

function onedimensional()
{
	mt_srand ((double) microtime() * 1000000);
	$im=imagecreate(64,48);
	for($i=0,$r=array();$i<2;$i++)for($j=0,$r[$i]=array();$j<2;$j++)for($k=0,$r[$i][$j]=array();$k<2;$k++)$r[$i][$j][$k]=mt_rand(0,1);
	for($i=0;$i<64;$i++)$l[0][$i]=$l[1][$i]=mt_rand(0,1);
	for($i=0;$i<32;$i++)$c[$i]=($i<16)?imagecolorallocate($im,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100)):imagecolorallocate($im,mt_rand(155,255),mt_rand(155,255),mt_rand(155,255));
	for($y=0;$y<48;$y++)
	{
		for($i=1;$i<64-1;$i++)$l[1][$i]=$r[$l[0][$i-1]][$l[0][$i]][$l[0][$i+1]];
		for($i=0;$i<64;$i++)$l[0][$i]=$l[1][$i];
		for($i=0;$i<64;$i++)$l[0][$i]?imagefilledrectangle($im,$i,$y,$i,$y,$c[mt_rand(0,15)]):imagefilledrectangle($im,$i,$y,$i,$y,$c[mt_rand(16,31)]);
	}

	$sx=rand()%320+320;
	$sy=rand()%240+240;
	$iml=imagecreate($sx,$sy);
	imagecopyresized($iml,$im,0,0,0,0,$sx,$sy,64,48);
	header("content-type:image/png");
	imagepng($iml,NULL,9);
	imagedestroy($im);
	imagedestroy($iml);
	die();
}

function margolis()
{
        mt_srand ((double) microtime() * 1000000);
//	for($i=0,$r=array();$i<16;$i++)for($j=0,$r[$i]=array();$j<6;$j++)$r[$i][$j]=mt_rand(0,1);
$r = array(
array(0,0,0,0,0,0),
array(1,0,0,0,0,0),
array(0,1,0,0,0,0),
array(0,0,0,0,0,0),
array(0,1,0,0,0,0),
array(0,0,0,0,0,0),
array(0,0,1,1,0,0),
array(1,0,0,0,0,0),
array(1,0,0,0,0,0),
array(0,0,1,1,0,0),
array(0,0,0,0,0,0),
array(0,1,0,0,0,0),
array(0,0,0,0,0,0),
array(0,1,0,0,0,0),
array(1,0,0,0,0,0),
array(0,0,0,0,0,0)
);

//	for($i=0,$l=array();$i<64*64;$i++)$l[$i]=mt_rand(0,31);
//	for($i=0;$i<64;$i++)for($j=0;$j<64;$j++)$l[$i+$j*64]=(($i>16)&&($i<48)&&($j>16)&&($j<48)&&($j%10<3))?mt_rand(0,15):mt_rand(16,31);
	for($i=0;$i<64;$i++)for($j=0;$j<64;$j++)$l[$i+$j*64]=((($i>16)&&($i<48)&&($j>16)&&($j<48))?15:31);
//	$l[mt_rand(0,4095)]=($l[mt_rand(0,4095)]<16)?31:0;

for($k=0,$e=0;$k<rand()%50;$k++,$e=($e+1)%2)
for($i=$e;$i<64;$i+=2)
for($j=$e;$j<64;$j+=2)
{
$s=$l[(64+$i+1)%64+((64+$j+1)%64)*64]>15?8:0+$l[(64+$i)%64+((64+$j+1)%64)*64]>15?4:0+$l[(64+$i+1)%64+((64+$j)%64)*64]>15?2:0+$l[(64+$i)%64+((64+$j)%64)*64]>15?1:0;
for($h=0;$h<6;$h++)if($r[$s][$h])
switch($h){
case 0:
$t=$l[(64+$i  )%64+((64+$j  )%64)*64];
$l[(64+$i  )%64+((64+$j  )%64)*64]=$l[(64+$i+1)%64+((64+$j+1)%64)*64];
$l[(64+$i+1)%64+((64+$j+1)%64)*64]=$t;break;

case 1:
$t=$l[(64+$i+1)%64+((64+$j  )%64)*64];
$l[(64+$i+1)%64+((64+$j  )%64)*64]=$l[(64+$i  )%64+((64+$j+1)%64)*64];
$l[(64+$i  )%64+((64+$j+1)%64)*64]=$t;break;

case 2:
$t=$l[(64+$i  )%64+((64+$j  )%64)*64];
$l[(64+$i  )%64+((64+$j  )%64)*64]=$l[(64+$i+1)%64+((64+$j  )%64)*64];
$l[(64+$i+1)%64+((64+$j  )%64)*64]=$t;break;

case 3:
$t=$l[(64+$i  )%64+((64+$j+1)%64)*64];
$l[(64+$i  )%64+((64+$j+1)%64)*64]=$l[(64+$i+1)%64+((64+$j+1)%64)*64];
$l[(64+$i+1)%64+((64+$j+1)%64)*64]=$t;break;

case 4:
$t=$l[(64+$i  )%64+((64+$j  )%64)*64];
$l[(64+$i  )%64+((64+$j  )%64)*64]=$l[(64+$i  )%64+((64+$j+1)%64)*64];
$l[(64+$i  )%64+((64+$j+1)%64)*64]=$t;break;

case 5:
$t=$l[(64+$i+1)%64+((64+$j  )%64)*64];
$l[(64+$i+1)%64+((64+$j  )%64)*64]=$l[(64+$i+1)%64+((64+$j+1)%64)*64];
$l[(64+$i+1)%64+((64+$j+1)%64)*64]=$t;break;}
}
	$im=imagecreate(64,64);
	for($i=0;$i<32;$i++)$c[$i]=($i<16)?imagecolorallocate($im,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100)):imagecolorallocate($im,mt_rand(155,255),mt_rand(155,255),mt_rand(155,255));
	for($i=0;$i<64;$i++)for($j=0;$j<64;$j++)$l[$i+$j*64]>15?imagefilledrectangle($im,$i,$j,$i,$j,$c[mt_rand(0,15)]):imagefilledrectangle($im,$i,$j,$i,$j,$c[mt_rand(16,31)]);

        $sx=rand()%320+320;
        $sy=rand()%320+320;
        $iml=imagecreate($sx,$sy);
        imagecopyresized($iml,$im,0,0,0,0,$sx,$sy,64,64);

	header("content-type:image/png");
	imagepng($iml,NULL,9);

	imagedestroy($im);
	imagedestroy($iml);
}

function twodimensional()
{

}

//if(rand()%2==0) onedimensional();
margolis();
//onedimensional();

//margolis();
?>
