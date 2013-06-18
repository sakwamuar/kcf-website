<?php
  include('imageAdaptation.php');
	include('mobileAssets/libs/deviceDetection.php');
	$i = 'assets/img/carousel/slide-1.jpg'; // This is the main image that you want to see in your mobile screen
	echo ".";
	$imgurl=convertImage($i); // $imgurl will hold the path of the converted image that is suitable for your mobile
?>
 <!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<!--meta data -->
			<meta name="description" content="The Official Website of The Kingdom Christian Fellowship">
			<meta name="keywords" content="KCF, Christian, Fellowship, Ashesi">
			<meta name="author" content="Emmanuel Antwi Nkansah">
			<meta http-equiv="Cache-Control" content="no-cache" />
			<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
			
			<!-- Styles-->
			<link href="mobileAssets/css/style.css" rel="stylesheet" type="text/css"/> 
			
			<title>KCF &middot; The Official Website of The Kingdom Christian Fellowship</title>
		</head>
		
		<body style= "width: <?php echo $width; ?>">
			<div class="container">
				<div class="navbar">
					Logo Goes Here!!
				</div>
			</div>
			<div class="container">
				<h3>Home</h3>
				<div>
					<img src= "<? echo $imgurl;?>"><!--this is a converted image-->
				</div>
			</div>
				
			<div class = "container">
				Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			</div>
		
			<div class = "container">
				<h4 align="left" class="text-info">Mission</h4>
					Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. 
			</div>
			
			<div class = "container">
				<h4 align="left" class="text-info">News</h4>
					Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			
			</div>
			
			
			<div class="container">
				<div class="navItem1"  accesskey="1"><a class="navlink" href="#">1.) About</a>
				</div>
			</div>
			
			<div class="container">
				<div class="navItem1" accesskey="2"><a class="navlink" href="#">2.) Ministeries</div>
			</div>
			
			<div class="container">
				<div class="navItem1" accesskey="3"><a class="navlink" href="#">3.) Events</div>
			</div>
			
			<div class "container">
				<div class="navItem1" accesskey="4"><a class="navlink" href="#">4.) Gallery</div>
			</div>
			
			<div >
				<a href="#">Go To Top</a>
			</div>
		
		
		<footer>
			<span >&copy; Kingdom Christian Fellowship 2013</span>
			<div>Powered by <a href="#">JellyCore llc</a></div>
			<?echo "You are viewing on a/an ".$vendor ." device"?>
		</footer>
	</body>
</html>
