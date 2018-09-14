<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Write google code
if($_GET['product']=="google4df22ea76e311f75") { /* CHECK FOR GOOGLE */
    include './google4df22ea76e311f75.html';
}
else if(true /*strtolower($_SERVER['HTTP_HOST'][2].$_SERVER['HTTP_HOST'][3]) == "zk"*/) {
    include './CPage.php';
}
else {
    echo "Stranky jsou momentalne v rekonstrukci!";
}

/*
include_once './config.php'; ?><!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Voděodolné inkousty: nákup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='font/fonts.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="images/logo.svg" />
        <link rel="stylesheet" href="responsive.css">
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="ie.css">
        <![endif]-->
        <!--[if lt IE 9]>
        <script src="ieJS.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if IE]>
        <div class="noIE">
        <div class="noIEcontent">Pro bezproblémové používání této stránky prosím přejděte na prohlížeč <strong>Firefox</strong> nebo <strong>Chrome</strong>. Vámi používaný prohlížeč (MS Internet Explorer) je již bohužel zastaralý a bezpečnostně rizikový. <br> Za vzniklé komplikace se omlouváme, děkujeme za pochopení.</div>
        </div>
        <div class="noIEmargin">&nbsp;</div>
        <![endif]-->
        <div id="contentWrap">
            <div id="content">
                <header>
                    <?php 
                    if(getCurrentLanguage() == "cs") {
                    ?>
                    <div id="logo">
                        <a href="<?php createLink("_HOME_CS_") ?>">Inkousty ANNELLA</a> <div class="clear"></div>
                        <span>kvalitní voděodolné inkousty do plnících per</span>
                    </div>
                    <?php } else { ?>
                    <div id="logo">
                        <a href="<?php createLink("_HOME_CS_") ?>">ANNELLA Inks</a> <div class="clear"></div>
                        <span>fine waterproof inks for fountain pen</span>
                    </div>
                    <?php } ?>
                    <a href="#" class="basket">
                        <span id="count"><strong>5</strong> položek v košíku</span>
                        <br>
                        <span id="sum">Celkem za <strong>4 589,- Kč</strong></span>
                    </a>
                    
                    <div class="clear"></div>
                    
                    <ul>
                        
                        <?php 
                        if (getCurrentLanguage() == "cs") {
                            ?> 
                        <li>
                            <a href="<?php createLink("_HOME_CS_") ?>"  <?php if(getCurrentPage() == "_HOME_CS_") { echo 'class="selected"'; } ?>  id="menuShop">Nákup</a>
                        </li>
                        <li>
                            <a href="<?php createLink("o-inkoustech") ?>" <?php if(getCurrentPage() == "o-inkoustech") { echo 'class="selected"'; } ?> id="menuAboutInk">O inkoustech</a>
                        </li>
                        <li>
                            <a href="<?php createLink("obchodni-podminky") ?>"  <?php if(getCurrentPage() == "obchodni-podminky") { echo 'class="selected"'; } ?> id="menuCondition">Obchodní podmínky</a>
                        </li>
                        <li>
                            <a href="<?php createLink("cena-dopravy") ?>"  <?php if(getCurrentPage() == "cena-dopravy") { echo 'class="selected"'; } ?> id="menuPrice">Cena dopravy</a>
                        </li>
                        <li>
                            <a href="<?php createLink("kontakt") ?>" <?php if(getCurrentPage() == "kontakt") { echo 'class="selected"'; } ?>  id="menuContact">Kontakt</a>
                        </li>
                        <li class="english">
                            <a href="http://en.inkoust.net/inkoust.net/"  id="menuEnglish">English</a>
                        </li>
                                <?php
                        }
                        else {
                            ?>
                        <li>
                            <a href="<?php createLink("_HOME_EN_") ?>"  <?php if(getCurrentPage() == "_HOME_CS_") { echo 'class="selected"'; } ?>  id="menuShop">Shop</a>
                        </li>
                        <li>
                            <a href="<?php createLink("o-inkoustech") ?>" <?php if(getCurrentPage() == "o-inkoustech") { echo 'class="selected"'; } ?> id="menuAboutInk">About ink</a>
                        </li>
                        <li> 
                            <a href="<?php createLink("obchodni-podminky") ?>" <?php if(getCurrentPage() == "obchodni-podminky") { echo 'class="selected"'; } ?>  id="menuCondition">Rules &amp; policies</a>
                        </li>
                        <li>
                            <a href="<?php createLink("cena-dopravy") ?>" <?php if(getCurrentPage() == "cena-dopravy") { echo 'class="selected"'; } ?> id="menuPrice">Shipping fee</a>
                        </li>
                        <li>
                            <a href="<?php createLink("kontakt") ?>" <?php if(getCurrentPage() == "kontakt") { echo 'class="selected"'; } ?> id="menuContact">Contact</a>
                        </li>
                        <li class="czech">
                            <a href="http://www.inkoust.net/inkoust.net/"  id="menuCzech">Čeština</a>
                        </li>
                        <?php
                        }
                        ?>
                        
                    </ul>
                </header>

                <div class="clear">  </div>

                <?php 
                if(getCurrentPage() == "o-inkoustech") {
                    include './page_cs_o_inkoustech.php';
                }
                else if(getCurrentPage() == "obchodni-podminky") {
                    include './page_cs_obchodni_podminky.php';
                }
                else if(isset($_GET['product'])) {
                    include './page_cs_detail.php';
                }
                
                else {
                    include './page_cs_home.php';
                }
                ?>

                
                <div class="clear"></div>

                <footer>
                    <div class="left">
                        &copy; 2016 ANNELLA s.r.o.
                    </div>
                    <div class="right">
                        <a href="#" id="declarationIcon">Prohlášení</a>
                    </div>
                    <div class="clear"></div>
                </footer>
            </div>
        </div>
        
    </body>
</html>*/ 