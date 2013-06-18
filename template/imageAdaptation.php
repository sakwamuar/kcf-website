<?php
/*
The function library is developed by Muntasir Mamun Joarder and is FREE to use. 
In case you are using the library please update me to svo97_12@yahoo.com so that 
I can keep you in the loop to let you update about the next versions.
Thanks to them who will find bug and report to svo97_12@yahoo.com.
*/

//include 'C:\xampp\htdocs\Mobi\Mtld\DA\Api.php';
require_once 'mobileAssets/libs/Mobi/Mtld/DA/Api.php';
require_once 'mobileAssets/libs/config.php';


function getmicrotime() 
{ 
list($usec, $sec) = explode(" ", microtime()); 
return ((float)$usec + (float)$sec); 
} 

function getUA()
{

$operaHeader = "HTTP_X_OPERAMINI_PHONE_UA";
 if (array_key_exists($operaHeader, $_SERVER)) 
  {
  	$ua = $_SERVER[$operaHeader];
 	} 
 else 
 {
   $ua = $_SERVER['HTTP_USER_AGENT'];
 }

//$ua = $_SERVER['HTTP_USER_AGENT'];;
return $ua; 
}

// Is this a Mobile Device
function isMobile($ua)
{
 global $defaultJSON;
 $isMob='0'; 
 $tree = Mobi_Mtld_DA_Api::getTreeFromFile($defaultJSON);
 if (Mobi_Mtld_DA_Api::getProperty($tree,$ua,"mobileDevice")=='1')
    $isMob='1';
 return $isMob;
}

function convertImage($imagepath)
{
	$ua=getUA();
	$isMob=isMobile($ua);
	
	if ($isMob=='1') // So this is Mobile
	{
		$uri=convertImageUA($imagepath,$ua);
		return $uri;	
	}
	else // May be Desktop
	{
		
		return $imagepath;
	}
	
} 

function convertImageUA($imagepath,$ua)
{
/*********************************************************
$resizeOption=0; Resize it considering the default value
$resizeOption=2; Resize as per the device capabilities
*********************************************************/

global $defaultFormat,$defaultWidth,$defaultHeight,$defaultJSON;


	list ($imwidth,$imheight)= getimagesize($imagepath);
	list($format,$devwidth,$devheight,$resizeOption)= getCAP($ua);
	
	if ($resizeOption==1)// So it is not mobile. ust return the main image path
	{
	return $imagepath;
	}
	if ($resizeOption==0)// Use default value as Screen resolution
	{
  		list($Rwidth,$Rheight)= array($defaultWidth,$defaultHeight); 
	}
	else // So the Value is 2. You got a device, resize it
	{
		list($Rwidth,$Rheight)=setImageDimension($imwidth,$imheight,$devwidth,$devheight);
	}

list ($imwidth,$imheight)= getimagesize($imagepath);

$convD=$Rwidth."X".$Rheight;
$InputPathArr=explode("/",$imagepath);
$InputPathArrSize=count($InputPathArr);
$InputImageFileName=$InputPathArr[$InputPathArrSize-1];
$farray=explode(".",$InputImageFileName);
$InputImageName=strtolower($farray[0]);
$outputImageName=$InputImageName."_".$Rwidth."x".$Rheight;

$outputFileFullpath="";

$OutputImageDir="";
   for ($i=0; $i < ($InputPathArrSize-1); $i++ )
   {
   $OutputImageDir=$OutputImageDir.$InputPathArr[$i]."/";	
   }
$outputFileFullpath=$OutputImageDir."Resized/".$outputImageName;
$outputImageFull=$outputFileFullpath.".".$format;
$uri="";
if (file_exists($outputImageFull))// So no need to resize again
   {
   return $outputImageFull;
   }
if (($imwidth<= $devwidth)&&($imheight <= $devheight))// Image is shorter than screen  
  $uri=$imagepath;
else
  $uri=resizeImage($imagepath,$format,$outputImageName,$Rwidth,$Rheight); 
  
return $uri;

} 

function setImageDimension($imageWidth,$imageHeight,$deviceWidth,$deviceHeight)
{
$imageAspect=$imageWidth/$imageHeight;
$deviceAspect=$deviceWidth/$deviceHeight;
$imageAspectRatio=$imageAspect;

if (($imageWidth>$deviceWidth)&&($imageHeight>$deviceHeight))// Image larger than the screen
{
if (($imageAspect< 1) && ($deviceAspect< 1)) // both case Height is bigger than the width
  {
  	$device2imageratio=$deviceHeight/$imageHeight;
        $imageDimensionHeight=(integer)($imageHeight*$device2imageratio);
        $imageDimensionWidth=(integer) ($imageDimensionHeight*$imageAspectRatio);
  }
else if (($imageAspect > 1) && ($deviceAspect > 1)) // both case Width is bigger than the width
 { 
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);	
 }
else if (($imageAspect < 1) && ($deviceAspect > 1)) // So fit to Height
  {
  	$device2imageratio=$deviceHeight/$imageHeight;
        $imageDimensionHeight=(integer)($imageHeight*$device2imageratio);
        $imageDimensionWidth=(integer) ($imageDimensionHeight*$imageAspectRatio);
  }
else if (($imageAspect > 1) && ($deviceAspect< 1)) // So fit to Width
 { 
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);	
 }
else // Fit to anything
 { 
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);	
 } 
}
else if (($imageWidth< $deviceWidth)&&($imageHeight < $deviceHeight)) // Image smaller than the screen
{
       $imageDimensionHeight=$imageHeight;
       $imageDimensionWidth=$imageWidth;
}
else // Any one portion of the image is outside the screen
{
 if ($imageWidth> $deviceWidth)	// So fit width
  {
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);
  }
 else // So fit Height
 {
  	$device2imageratio=$deviceHeight/$imageHeight;
        $imageDimensionHeight=(integer)($imageHeight*$device2imageratio);
        $imageDimensionWidth=(integer) ($imageDimensionHeight*$imageAspectRatio);
 }
 
}
$dimensionArray=array ($imageDimensionWidth,$imageDimensionHeight);
$widthError=0;
$heightError=0;

if($deviceWidth< $imageDimensionWidth)
  {
  $widthError=1;
}

if($deviceHeight< $imageDimensionHeight){
  $heightError=1;
}
return $dimensionArray;
}

function getImageDimension($imagepath)
{
$InputPathArr=explode("/",$InputImage);
$InputPathArrSize=count($InputPathArr);
$InputImageFileName=$InputPathArr[$InputPathArrSize-1];
$farray=split(".",$InputImageFileName);
$InputImageFileExtension=strtolower($farray[1]);


switch ($InputImageFileExtension)
   {
   case 'jpg':
   case 'jpeg':
   		$SRC_IMAGE = ImageCreateFromJPEG($OutputImageFullPath);
   		break;
   case 'gif':
   		$SRC_IMAGE = ImageCreateFromgif($OutputImageFullPath);
   		break;
   case 'wbmp':
   		$SRC_IMAGE = ImageCreateFromwbmp($OutputImageFullPath);
   		break;
   case 'png':
   		$SRC_IMAGE = ImageCreateFrompng($OutputImageFullPath);
   		break;
   }
$imageWidth=imagesx($SRC_IMAGE);
$imageHeight=imagesy($SRC_IMAGE);
$imginf=array ($imageWidth,$imageHeight);
return $imginf;
}

function getDevice($ua)
{
 global $defaultJSON;

 $tree = Mobi_Mtld_DA_Api::getTreeFromFile($defaultJSON);
 $vendor=Mobi_Mtld_DA_Api::getProperty($tree,$ua,"vendor");
 $model=Mobi_Mtld_DA_Api::getProperty($tree,$ua,"model");
 $colorVal=Mobi_Mtld_DA_Api::getProperty($tree,$ua,"displayColorDepth");
 $devInfo=array($vendor,$model,$colorVal);
 return $devInfo;
}

function getDeviceData($ua)
{
 global $defaultJSON;

 $tree = Mobi_Mtld_DA_Api::getTreeFromFile($defaultJSON);
 $maxWidth = Mobi_Mtld_DA_Api::getPropertyAsInteger($tree, $ua, "displayWidth");
 $maxHeight= Mobi_Mtld_DA_Api::getPropertyAsInteger($tree, $ua, "displayHeight");
 $devInfo=array($maxWidth,$maxHeight);
 return $devInfo;
}

function getCAP($ua)
{
/*********************************************************
$capDecision=0; Resize it considering the default value
$capDecision=1; DONT Resize
$capDecision=2; Resize as per the device capabilities
*********************************************************/
global $defaultFormat,$defaultWidth,$defaultHeight,$defaultJSON;

$bestFormat=$defaultFormat;
$maxWidth=$defaultWidth;
$maxHeight=$defaultHeight;
$capDecision=2; 

$memcache_enabled = extension_loaded("memcache");
$no_cache = array_key_exists("nocache", $_GET);
if ($memcache_enabled && !$no_cache) {
  $memcache = new Memcache;
  $memcache->connect('localhost', 11211);
  $tree = $memcache->get('tree');
}

if (!is_array($tree)) {
  $tree = Mobi_Mtld_DA_Api::getTreeFromFile($defaultJSON);
  if ($memcache_enabled && !$no_cache) {
    $memcache->set('tree', $tree, false, 10);
  }
}

if ($memcache_enabled && !$no_cache) {
  $memcache->close();
}

	if (Mobi_Mtld_DA_Api::getProperty($tree,$ua,"mobileDevice")!='1')// Not mobile
	{
		$capinfo=array ($defaultFormat,$defaultWidth,$defaultHeight,1);	
		return $capinfo;
	}
	else // So it is mobile
	{
		$maxWidth = Mobi_Mtld_DA_Api::getPropertyAsInteger($tree, $ua, "displayWidth");
		$maxHeight= Mobi_Mtld_DA_Api::getPropertyAsInteger($tree, $ua, "displayHeight");
		if (($maxWidth!=0) && ($maxHeight!=0)) // So width and height properties are there
  		{	
		$bestFormat='';
		if (Mobi_Mtld_DA_Api::getProperty($tree,$ua,"image.Png")){
			$bestFormat='png';}
		else if (Mobi_Mtld_DA_Api::getProperty($tree,$ua,"image.Jpg")){
			$bestFormat='jpg';}
		else
			$bestFormat='gif';
		$capinfo=array ($bestFormat,$maxWidth,$maxHeight,2);
		return $capinfo; 
        	}
  		else // No it is not found. Just use the default value to resize.
  		{
  		$capinfo=array ($defaultFormat,$defaultWidth,$defaultHeight,0);
		return $capinfo;
  		}
	}

}

function resizeImage($InputImage,$OutputFormat,$outputFileName,$Out_X,$Out_Y)
{
	//echo $InputImage,$OutputFormat,$outputFileName,$Out_X,$Out_Y;
/*
How it works: In the folder where the main image resides, this function will Create a new folder named 'Resized' into it and copy the resized image into this folder. So at the end the main image will be unchanged.

Return : In the return the function will provide the final URL of the resized image in specific format. 

Capability: This function can work with four types of images: PNG, JPG and GIF. WBMP is intentionaly kept out of the scope.

Parameters:

$InputImage= Full path of Input Image which is to be resized. Example: 'testImage/test.jpg'
$OutputFormat= What is the output format.Example: 'gif'
$outputFileName= What will be the name of the output file. Must remember that there will be no file extension with this name.Example: file0000. So then in the final version of the resized file the name will be : file0000.gif
$Out_X= Length of the X asis of the resized image.
$Out_Y= Length of the Y asis of the resized image.

Author: Muntasir Mamun (svo97_12@yahoo.com). If anyone find any bug please inform me by mail.
*/

$URL="";
$InputPathArr=explode("/",$InputImage);
$InputPathArrSize=count($InputPathArr);
$InputImageFileName=$InputPathArr[$InputPathArrSize-1];
$InputImageFileExtension=strtolower(substr("$InputImageFileName",-3));
$OutputImageDir="";
   for ($i=0; $i < ($InputPathArrSize-1); $i++ )
   {
   $OutputImageDir=$OutputImageDir.$InputPathArr[$i]."/";	
   }
   
   if (!file_exists($OutputImageDir."Resized/"))
   	mkdir($OutputImageDir."Resized/");
   
   $OutputImageFullPath=$OutputImageDir."Resized/".$outputFileName.".".$InputImageFileExtension;
   if (!copy($InputImage,$OutputImageFullPath))
      echo 'Failed to copy';
   
   switch ($InputImageFileExtension)
   {
   case "png":
   		$SRC_IMAGE = ImageCreateFrompng($OutputImageFullPath);
   		break;
   case "jpg":
   		$SRC_IMAGE = ImageCreateFromJPEG($OutputImageFullPath);
   		break;
   default:
   		$SRC_IMAGE = ImageCreateFromgif($OutputImageFullPath);
   		break;
   
   }
   $SRC_X = ImageSX($SRC_IMAGE);
   $SRC_Y = ImageSY($SRC_IMAGE);
   $DEST_IMAGE = imagecreatetruecolor($Out_X, $Out_Y);
   unlink($OutputImageFullPath);
   $OUTPUT_FILE=$OutputImageDir."Resized/".$outputFileName.".".$OutputFormat;
      if (!imagecopyresized($DEST_IMAGE, $SRC_IMAGE, 0, 0, 0, 0, $Out_X, $Out_Y, $SRC_X, $SRC_Y)) {
     imagedestroy($SRC_IMAGE);
     imagedestroy($DEST_IMAGE);
     return(0);
   } else {
     imagedestroy($SRC_IMAGE);
   
   switch(strtolower($OutputFormat))
        {
      case "png":
   		$I = Imagepng($DEST_IMAGE,$OUTPUT_FILE);
   		break;
   		
      case "jpg":
   		$I = ImageJPEG($DEST_IMAGE,$OUTPUT_FILE);
   		break;
      default:
   		$I = Imagegif($DEST_IMAGE,$OUTPUT_FILE);
   		break;
    }
    
   if ($DEST_IMAGE)
     	imagedestroy($DEST_IMAGE);
   }
     $URL=$OUTPUT_FILE;
     return ($URL);
}
?>
