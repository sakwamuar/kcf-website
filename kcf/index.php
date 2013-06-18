<?php
/* =================================================================================================================
 *  KCF website template 03.06.13 (21.50) @author Frank Anamuah-Koufie & Emmanuel Nkansah for JellyCore*
 * currenr edit by frank @date 17.06.13 (21.44)
 * ================================================================================================================ */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KFC &verbar; Welcome!</title>

        <!--meta section-->
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="author" content="frank anamuah-koufie"/>
        <meta name="description" content="KCF Official Website."/>
        <meta name="keywords" content="kcf, christian ministry, church, religion"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="viewport" content="width=device-width"/>
        <!--link section-->
        <link rel="shortcut icon" href="images/components/favicon.png" type="image/x-icon" />	
        <link rel="stylesheet" href="styles/base.css" type="text/css" media="all" />

        <!--script section-->
        <script src="scripts/jquery.js"></script>
        <script>
            var pos = 0;
            var i = 0;
            $.noConflict();
            jQuery(document).ready(function($){
                var allowHolder = false;
                $("#right_arrow").click(function(){
                    $("#slider").css("left",pos-1000);
                    if(pos<=-4000){
                        pos=0;
                        i = 0;
                        $("#slider").css("left",pos);
                    }
                    else
                    {
                        pos-=1000;
                        i+=1;
                    }
                });
                $("#left_arrow").click(function(){
                    $("#slider").css("left",pos+1000);
                    if(pos>=0){
                        pos=-4000;
                        i = 4;
                        $("#slider").css("left",pos);
                    }
                    else
                    {
                        pos+=1000;
                        i-=1;
                    }
                });
                $('#holder').css('left',event.screenX);
                $('#drop').hover(function(){
                    allowHolder = true;
                    $('#holder').removeClass('hide_menu');
                    $('#holder').addClass('show_menu');
                }, function(){
                    $('#holder').removeClass('show_menu');
                    $('#holder').addClass('hide_menu');
                });
                $('#holder').hover(function(){
                    if(allowHolder){
                        $(this).removeClass('hide_menu');
                        $(this).addClass('show_menu');}
                },function(){
                    allowHolder = false;
                    $(this).removeClass('show_menu');
                    $(this).addClass('hide_menu');
                });		
            });//end of DOM-ready   
        </script>

    </head>
    <body>
        <header>
            <div id="logo" title="logo goes here...">
                KCF
            </div>
            <nav id="top_nav">
                <ul>
                    <li>Home</li>
                    <li>About</li>
                    <li>Ministries</li>
                    <li>Events</li>
                    <li>Gallery</li>
                    <li><span id="drop" class="menu_header">Extra&nbsp;<span class="no_hover_effect">&blacktriangledown;</span></span>
                        <div id="holder" class="hide_menu">
                            <ul id="extras">
                                <li>prayer request</li>
                                <li>testimonies</li>
                                <li>alumni</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        <section id="outer_shell">
            <section id="inner_shell">
                <div class="shadow" id="left_shadow"></div>
                <div class="shadow" id="right_shadow"></div>
                <section id="top_half">
                    <div id="slider">
                        <img src="images/img1.jpg" alt="description here"/>
                        <img src="images/img2.jpg" alt="description here"/>
                        <img src="images/img3.jpg" alt="description here"/>
                        <img src="images/img2.jpg" alt="description here"/>
                        <img src="images/img1.jpg" alt="description here"/>
                    </div>
                    <span class="arrow" id="left_arrow">&lsaquo;</span>
                    <span class="arrow" id="right_arrow">&rsaquo;</span>
                </section>
                <section id="bottom_half">
                    <section id="mission">
                        <img src="images/mission.png" alt="mission"/>
                        <p>
                            Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                            tellus ac cursus commodo, tortor mauris condimentum nibh, 
                            ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                        </p>
                    </section>
                    <div id="down_shadow"></div>
                    <section id="boxes">
                        <div class="box">
                            <img src="images/news.png"/>
                            <h3>news</h3>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus uris condimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit nus. Fusce dapibus, 
                                    tellus ac cursus commodo, tortor mauris condimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem ma sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus ac cursus commodo, tortor mauris condimentjusto sit amet risus
                                    Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                        </div>
                        <div class="box">
                            <img src="images/ministries.png"/>
                            <h3>ministries</h3>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus ac cursusdimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus ac cursus commodo, tortor mauris condimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus ac cursus commodo, tortimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                        </div>
                        <div class="box box_no_border">
                            <img src="images/testimonies.png"/>
                            <h3>testimonies</h3>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellondimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus ac cursus commodo, tortor mauris condimentum nibh, 
                                    ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                            <div class="item">
                                <p>
                                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                                    tellus ac cursus commodo, tortor mauris condimentum nibit amet risus.
                                    Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                </p>
                            </div>
                        </div>
                    </section>
                </section>
            </section>
        </section>
        <div id="overhang"></div>
        <footer>
            <h6 id="copyright">&copy;2013&nbsp;&nbsp;&nbsp;&middot;&nbsp;&nbsp;&nbsp;Kingdom Christian Fellowship</h6>
        </footer>
    </body>
</html>