<?php
include_once './config.php'; 

abstract class CPage {
        
    public $selectedPageType; /* produkt, do kosiku, statika, kosik, prehled */
    public $selectedPageCs; /* V Title */
    public $selectedPageEn; /* V Title en */
    
    public $selectedPageMenu; /* id jako home, oznaci cerne prvni stranku... */
    
    public $metaDescriptionCs;
    public $metaDescriptionEn;
    
    public $metaKeywordCs;
    public $metaKeywordEn;
    
    public $idInCs;
    public $idInEn;
    
    public $appendToHead;
    
    protected $mysqlConn;
    
    public function __construct() {
        
        $server = "mysql-g1.gransy.com";
        $username = "inkoust_net";
        $password = "UG2OZGVwrc";
        $database_name = "inkoust_net";

        $this->mysqlConn = mysql_connect($server, $username, $password);
        mysql_select_db($database_name);


        mysql_query("SET CHARACTER SET utf8");
        mysql_query("SET NAMES utf8"); 
        
        
        $this->appendToHead = "";
        $this->idInCs = '';
        $this->idInEn = '';
        
        $this->selectedPageType = "overview";
        $this->selectedPageCs = "nákup";
        $this->selectedPageEn = "shop";
        
        $this->metaDescriptionCs = "Kvalitní voděodolné inkousty do plnících per v různých barvách vhodné pro psaní delších dokumentů a archiválií. Vynikají barevnou stálostí a odolností.";
        $this->metaDescriptionEn = "High quality waterproof ink for fountain pen offered in many colors useful for writing of long documents and archives with color stability and resistance.";
        
        $this->metaKeywordCs = "pigmentový inkoust, inkoust, plnící pera, voděodolný, barevná stálost, archiválie";
        $this->metaKeywordCs = "pigment ink, ink, fountain pen, waterproof, color stability, archives";
    }
    
    public function __destruct() {
        mysql_close($this->mysqlConn);
    }

    public static function getCurrentLanguage() {
        if(strtolower($_SERVER['HTTP_HOST'][0].$_SERVER['HTTP_HOST'][1]) == "en") {
            return "en";
        }
        return "cs";
    }
    
    public function plotHead() {
        ?>
        <!DOCTYPE html>
        <html <?php echo getCurrentLanguage() == "cs" ? 'lang="cs"' : 'lang="en"'; ?>>
            <head>
                <title><?php 
                if(getCurrentLanguage() == "cs") { echo "Voděodolné inkousty"; }
                else if(getCurrentLanguage() == "en") { echo "Waterproof inks"; }
                ?>: <?php 
                if(getCurrentLanguage() == "cs") { echo $this->selectedPageCs; }
                else if(getCurrentLanguage() == "en") { echo $this->selectedPageEn; }
                ?></title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
                <meta name="description" content="<?php 
                if(getCurrentLanguage() == "cs") { echo $this->metaDescriptionCs; }
                else if(getCurrentLanguage() == "en") { echo $this->metaDescriptionEn; }
                ?>">
                <meta name="keywords" content="<?php 
                if(getCurrentLanguage() == "cs") { echo $this->metaKeywordCs; }
                else if(getCurrentLanguage() == "en") { echo $this->metaKeywordCs; }
                ?>">
                <meta name="author" content="ANNELLA s.r.o.">
                
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
                
                <?php echo $this->appendToHead; ?>
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
        <?php
    }
    
    public function plotFooter() {
    ?> 
                    <div class="clear"></div>
                    <footer>
                    <div class="left">
                        &copy; 2016 ANNELLA s.r.o.
                    </div>
                    <div class="right">
                        <a href="<?php if(getCurrentLanguage() == "cs") { createLink("prohlaseni"); } else { createLink("exclamation"); } ?>" id="declarationIcon"><?php echo translate("conditions-of-use", getCurrentLanguage()); ?></a>
                    </div>
                    <div class="clear"></div>
                    
                    
                    <script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                    ga('create', 'UA-81237678-1', 'auto');
                    ga('send', 'pageview');

                    </script>
                </footer>
            </div>
        </div>
        
    </body>
</html>
        <?php
    }
    
    public function plotBasket() {
        if(count($_SESSION['basket']) > 0 ) {
            $sumKc = 0;
            $sumEur = 0;
            $countSum = 0;
            
            foreach ($_SESSION['basket']  as $item) {
                $sumKc += $item->priceKc*$item->prodCount;
                $sumEur += $item->priceEur*$item->prodCount;
                $countSum += $item->prodCount;
            }
            
        ?>
        <a href="<?php createLink(null, "basketDetail") ?>" class="basket">
            <span id="count"><strong><?php echo $countSum; ?></strong> <?php echo translate("items-in-basket", getCurrentLanguage()) ?></span>
            <br>
            <span id="sum"><?php echo translate("basket-total", getCurrentLanguage()) ?> <?php if(getCurrentLanguage() == "cs") { ?><strong><?php echo $sumKc; ?>,- Kč</strong><?php } else if(getCurrentLanguage () == "en") { ?><strong><?php echo $sumEur; ?> &euro;</strong> <?php } ?></span>
        </a>
    <?php
        }
        else {
            ?>
        <a href="/" class="basket">
            <span id="count"><?php echo translate("basket-your-basket", getCurrentLanguage()) ?></span>
            <br>
            <span id="sum"><?php echo translate("basket-is-empty", getCurrentLanguage()) ?></span>
        </a>
    <?php
        }
    }
    
    public function plotHeader() {
        ?> 
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
                    <?php } 
                    
                    $this->plotBasket();
                    ?>
                
                
                    
                    
                    
                    <div class="clear"></div>
                    
                    <ul>
                        
                        <?php 
                        if (getCurrentLanguage() == "cs") {
                            ?> 
                        <li>
                            <a href="<?php createLink("_HOME_CS_") ?>"  <?php if($this->selectedPageMenu == "shop") { echo 'class="selected"'; } ?>  id="menuShop">Nákup</a>
                        </li>
                        <li>
                            <a href="<?php createLink("o-inkoustech") ?>" <?php if($this->selectedPageMenu == "o-inkoustech") { echo 'class="selected"'; } ?> id="menuAboutInk">O inkoustech</a>
                        </li>
                        <li>
                            <a href="<?php createLink("obchodni-podminky") ?>"  <?php if($this->selectedPageMenu == "obchodni-podminky") { echo 'class="selected"'; } ?> id="menuCondition">Obchodní podmínky</a>
                        </li>
                        <li>
                            <a href="<?php createLink("cena-dopravy") ?>" <?php if($this->selectedPageMenu == "cena-dopravy") { echo 'class="selected"'; } ?>  id="menuPrice">Cena dopravy</a>
                        </li>
                        <li>
                            <a href="<?php createLink("kontakt") ?>" <?php if($this->selectedPageMenu == "kontakt") { echo 'class="selected"'; } ?>  id="menuContact">Kontakt</a>
                        </li>
                        <li class="english">
                            <a href="http://en.inkoust.net/<?php createLink($this->idInEn, $this->selectedPageType); ?>"  id="menuEnglish">English</a>
                        </li>
                                <?php
                        }
                        else {
                            ?>
                        <li>
                            <a href="<?php createLink("_HOME_EN_") ?>"  <?php if($this->selectedPageMenu == "shop") { echo 'class="selected"'; } ?>  id="menuShop">Shop</a>
                        </li>
                        <li>
                            <a href="<?php createLink("about-ink") ?>" <?php if($this->selectedPageMenu == "o-inkoustech") { echo 'class="selected"'; } ?> id="menuAboutInk">About ink</a>
                        </li>
                        <li> 
                            <a href="<?php createLink("rules-and-policies") ?>" <?php if($this->selectedPageMenu == "obchodni-podminky") { echo 'class="selected"'; } ?>  id="menuCondition">Rules &amp; policies</a>
                        </li>
                        <li>
                            <a href="<?php createLink("shipping-fee") ?>"  <?php if($this->selectedPageMenu == "cena-dopravy") { echo 'class="selected"'; } ?>  id="menuPrice">Shipping fee</a>
                        </li>
                        <li>
                            <a href="<?php createLink("contact") ?>" <?php if($this->selectedPageMenu == "kontakt") { echo 'class="selected"'; } ?>  id="menuContact">Contact</a>
                        </li>
                        <li class="czech">
                            <a href="http://www.inkoust.net/<?php createLink($this->idInCs, $this->selectedPageType); ?>"  id="menuCzech">Čeština</a>
                        </li>
                        <?php
                        }
                        ?>
                        
                    </ul>
                </header>
                <div class="clear">  </div>
            <?php
    }
    public abstract function plotContent () ;
    
    public function plotPage() {
        $this->plotHead();
        $this->plotHeader();
        $this->plotContent();
        $this->plotFooter();
    }
}


class CStaticPage extends CPage {
    private $fileCsToInclude;
    private $fileEnToInclude;
    
    public function __construct($id) {
        parent::__construct ();
        
        $this->selectedPageType = "static"; /* produkt, do kosiku, statika, kosik, prehled */
        
        if($id == "o-inkoustech" || $id == "about-ink") {
            $this->fileCsToInclude = "page_cs_o_inkoustech.php";
            $this->fileEnToInclude = "page_en_about_ink.php";
            
            $this->selectedPageCs = "o inkoustech"; /* V Title */
            $this->selectedPageEn = "about ink"; /* V Title en */
            
            $this->selectedPageMenu = "o-inkoustech";
            
            $this->idInCs = "o-inkoustech";
            $this->idInEn = "about-ink";
        }
        else  if($id == "obchodni-podminky" || $id == "rules-and-policies") {
            $this->fileCsToInclude = "page_cs_obchodni_podminky.php";
            $this->fileEnToInclude = "page_en_rules_and_policies.php";
            
            $this->selectedPageCs = "obchodni podminky"; /* V Title */
            $this->selectedPageEn = "rules and policies"; /* V Title en */
            
            $this->selectedPageMenu = "obchodni-podminky";
            
            $this->idInCs = "obchodni-podminky";
            $this->idInEn = "rules-and-policies";
        }
        else  if($id == "obchodni-podminky" || $id == "rules-and-policies") {
            $this->fileCsToInclude = "page_cs_obchodni_podminky.php";
            $this->fileEnToInclude = "page_en_rules_and_policies.php";
            
            $this->selectedPageCs = "obchodni podminky"; /* V Title */
            $this->selectedPageEn = "rules and policies"; /* V Title en */
            
            $this->selectedPageMenu = "obchodni-podminky";
            
            $this->idInCs = "obchodni-podminky";
            $this->idInEn = "rules-and-policies";
        }
        else  if($id == "cena-dopravy" || $id == "shipping-fee") {
            $this->fileCsToInclude = "page_cs_cena_dopravy.php";
            $this->fileEnToInclude = "page_en_shipping_fee.php";
            
            $this->selectedPageCs = "cena dopravy"; /* V Title */
            $this->selectedPageEn = "shipping fee"; /* V Title en */
            
            $this->selectedPageMenu = "cena-dopravy";
            
            $this->idInCs = "cena-dopravy";
            $this->idInEn = "shipping-fee";
        }
        else  if($id == "kontakt" || $id == "contact") {
            $this->fileCsToInclude = "page_cs_kontakt.php";
            $this->fileEnToInclude = "page_en_contact.php";
            
            $this->selectedPageCs = "kontakt"; /* V Title */
            $this->selectedPageEn = "contact"; /* V Title en */
            
            $this->selectedPageMenu = "kontakt";
            
            $this->idInCs = "kontakt";
            $this->idInEn = "contact";
        }
        else  if($id == "prohlaseni" || $id == "exclamation") {
            $this->fileCsToInclude = "page_cs_prohlaseni.php";
            $this->fileEnToInclude = "page_en_exclamation.php";
            
            $this->selectedPageCs = "prohlášení"; /* V Title */
            $this->selectedPageEn = "conditions of use"; /* V Title en */
            
            $this->selectedPageMenu = "prohlaseni";
            
            $this->idInCs = "prohlaseni";
            $this->idInEn = "exclamation";
        }
        
        
    }
    public function plotContent() {
        if(getCurrentLanguage() == "cs") {
            include $this->fileCsToInclude;
        }
        else if (getCurrentLanguage() == "en") {
            include $this->fileEnToInclude;
        }
    }
}


class CProductPage extends CPage {
    protected $selVolume;
    protected $selColor;
    
    protected $prodCsSEOname;
    protected $prodEnSEOname;
    
    protected $priceEur;
    protected $priceKc;
    protected $thumbImage;
    
    public function plotAside() {
        ?>
        
        <aside>
            <?php if(getCurrentLanguage() == "cs") {
        ?>
            <div class="sepOption colorSelIcons">
                <h1 id="colorInkIcon">Inkoust dle barvy</h1>
                <ul>
                    <li>
                        <a href="<?php createLink("modra", "sortOptCol"); ?>" id="blueIcon">Modrá</a>
                    </li>
                    <li>
                        <a href="<?php createLink("cerna", "sortOptCol"); ?>" id="blackIcon">Černá</a>
                    </li>
                    <li>
                        <a href="<?php createLink("indigo", "sortOptCol"); ?>" id="indigoIcon">Modrofialová</a>
                    </li>
                    <li>
                        <a href="<?php createLink("purpurova", "sortOptCol"); ?>" id="magentaIcon">Purpurová</a>
                    </li>
                    <li>
                        <a href="<?php createLink("zluta", "sortOptCol"); ?>" id="yellowIcon">Žlutá</a>
                    </li>
                </ul>
            </div>
            <?php } 
            else if(getCurrentLanguage() == "en") {
        ?>
            <div class="sepOption colorSelIcons">
                <h1 id="colorInkIcon">Color of ink</h1>
                <ul>
                    <li>
                        <a href="<?php createLink("blue", "sortOptCol"); ?>" id="blueIcon">Blue</a>
                    </li>
                    <li>
                        <a href="<?php createLink("black", "sortOptCol"); ?>" id="blackIcon">Black</a>
                    </li>
                    <li>
                        <a href="<?php createLink("indigo", "sortOptCol"); ?>" id="indigoIcon">Indigo</a>
                    </li>
                    <li>
                        <a href="<?php createLink("magenta", "sortOptCol"); ?>" id="magentaIcon">Magenta</a>
                    </li>
                    <li>
                        <a href="<?php createLink("yellow", "sortOptCol"); ?>" id="yellowIcon">Yellow</a>
                    </li>
                </ul>
            </div>
            <?php } 
            ?>
            <div class="sepOption">
                <h1 id="volumeInkIcon"><?php ?><?php if(getCurrentLanguage() == "cs") { echo 'Inkoust dle objemu'; } else if(getCurrentLanguage() == "en") { echo 'Bottle volume';  } ?></h1>
                <ul>
                    <li>
                        <a href="<?php createLink("50-ml", "sortOptVol"); ?>" id="halfIcon"><?php echo translate("50-ml", getCurrentLanguage()) ?></a>
                    </li>
                    <li>
                        <a href="<?php createLink("100-ml", "sortOptVol"); ?>" id="fullIcon"><?php echo translate("100-ml", getCurrentLanguage()) ?></a>
                    </li>
                </ul>
            </div>
            
            <?php 
            if($this->selColor != null || $this->selVolume != null || $this->prodCsSEOname != null || $this->prodEnSEOname != null) {
            ?>
            
            <div class="clean">&nbsp;</div>
            <a href="/" class="toShopButton">
                <span><?php echo translate("all-products", getCurrentLanguage()); ?></span>
            </a>
            <div class="clean"></div>
            <?php } ?>
        </aside>
        <?php
        
    }
    
    public function plotProductList() {
        $condCol = "1";
        $condVol = "1";
        if($this->selColor != null) {
            $condCol = "prodColor='".$this->selColor."'";
        }
        if($this->selVolume != null) {
            $condCol = "prodVolume='".$this->selVolume."'";
        }
        $query = mysql_query("SELECT * FROM produkt WHERE $condCol AND $condVol ORDER BY prodVolume DESC, prodCode");
    
        //print("SELECT * FROM produkt WHERE  $condCol AND $condVol ");
        
        while($prod = mysql_fetch_assoc($query)) {
    ?>

    <div class="itemWrap <?php echo $prod['prodColorClass'] ?>">
        <div class="item">
            <a href="<?php createLink( getCurrentLanguage() == "cs" ? $prod['prodCsSEOname'] : $prod['prodEnSEOname'], "productDetail") ?>" class="itemHref">
                <span><?php echo getCurrentLanguage() == "cs" ? $prod['prodCsName'] : $prod['prodEnName'] ?></span>
                <strong class="price"><span> </span> <?php echo getCurrentLanguage() == "cs" ? $prod['price'].',- Kč' : KcToEur($prod['price']).' &euro;'; ?></strong>
                <div class="clear"></div>
            </a>
            <a href="<?php createLink( getCurrentLanguage() == "cs" ? $prod['prodCsSEOname'] : $prod['prodEnSEOname'], "productDetail") ?>" class="image">
                <img src="images/<?php echo $prod['prodTitleImage'] ?>.png" alt="<?php echo getCurrentLanguage() == "cs" ? $prod['prodCsName'] : $prod['prodEnName'] ?>" >
            </a>
            <div class="itemDescription">
                <?php echo getCurrentLanguage() == "cs" ? $prod['prodCsShortDescription'] : $prod['prodEnShortDescription'] ?>
                
                <div class="basketOption">

                    <strong class="inStock"><?php echo translate($prod['prodInStock'], getCurrentLanguage()); ?></strong>
                    <div class="clear"></div>
                    <a class="addToBasket" href="<?php createLink( getCurrentLanguage() == "cs" ? $prod['prodCsSEOname'] : $prod['prodEnSEOname'], "basketAdd") ?>"><?php echo translate('add-ink-to-basket', getCurrentLanguage()); ?></a>  
                </div>

            </div>
            <div class="clear"></div>
        </div>
    </div>
        <?php }
    }


    public function plotListOfProduct() {
        ?>
<article>
    <?php 
    if(getCurrentLanguage() == "cs") {
    ?>
    <h1>Kvalitní voděodolné inkousty neleptající pero</h1>
    <p>
        Inkousty ANNELLA jsou špičkové <strong>voděodolné inkousty</strong>. Jsou pH neutrální a tedy <strong>neleptají hroty per</strong>. Mají vysokou <strong>barevnou stálost</strong>, odolnost a životnost. Inkousty jsou ideální pro archiválie a delší psaní.
    </p>
    <?php 
    }
    else if(getCurrentLanguage() == "en") {
        ?>
    <h1>High quality waterproof fountain pen inks</h1>
    <p>
        ANNELLA inks are high quality waterproof inks for fountain pens. Inks are pigment based which mean that they have great color stability. Another advantage is pH neutral composition that <strong>does not damage your pen</strong> (in opposite of acid based iron gall ink).
    </p>
    <?php 
    }
    ?>

    <div class="sortOptionWrap">
        <div class="sortOption">
            <span id="overviewIcon">
                <?php if($this->selColor == null && $this->selVolume == null) { echo translate('product-overview', getCurrentLanguage()); } ?>
                <?php if($this->selColor != null) { echo translate("selected-color", getCurrentLanguage()).": ".  translate($this->selColor, getCurrentLanguage()); } ?>
                <?php if($this->selVolume != null) { echo translate("selected-volume", getCurrentLanguage()).": ".  translate($this->selVolume, getCurrentLanguage()); } ?>
            </span>
            <?php if($this->selColor != null || $this->selVolume != null) { echo '<a href="/" class="deleteIcon">'.  translate("selection-reset", getCurrentLanguage()).'</a>'; } ?>
            
            <div class="clear"></div>
        </div>
    </div>
    
    <?php 
    $this->plotProductList();
    ?>

   </article>
                <?php
    }
    
    public function plotProductDetail() {
        
        
        $query = mysql_query("SELECT * FROM produkt WHERE prodCsSEOname='".$this->prodCsSEOname."' OR  prodEnSEOname='".$this->prodEnSEOname."' LIMIT 1 ");
    
        $prod = mysql_fetch_assoc($query);
        
        
        ?>
                <article class="blueH">
                
        <div class="detail">
            <h1><?php echo getCurrentLanguage() == "cs" ? $prod['prodCsName'] : $prod['prodEnName']; ?></h1>
            <div class="right">
                <p id="productName"><strong><?php echo getCurrentLanguage() == "cs" ? "Inkoust: ".$prod['prodCsName'] : "Ink: ".$prod['prodEnName']; ?></strong></p>
                
                <?php echo getCurrentLanguage() == "cs" ? $prod['prodCsShortDescription'] : $prod['prodEnShortDescription']; ?>
                
                <div id="price">
                    <span><?php echo translate("your-price", getCurrentLanguage()); ?>:</span>
                    <strong><?php echo getCurrentLanguage() == "cs" ? $prod['price'].',- Kč' : KcToEur($prod['price']).' &euro;'; ?></strong>
                    <div class="clear"></div>
                </div>
                <div class="basketOptionWrap">
                    <div class="basketOption">
                        <strong><?php echo translate($prod['prodInStock'], getCurrentLanguage()); ?></strong>
                        <div class="clear"></div>
                        <em><?php echo translate("4-days-expeded", getCurrentLanguage()); ?></em>
                        <div class="clear"></div>
                        <a class="addToBasket" href="<?php createLink( getCurrentLanguage() == "cs" ? $prod['prodCsSEOname'] : $prod['prodEnSEOname'], "basketAdd") ?>"><?php echo translate('add-ink-to-basket', getCurrentLanguage()); ?></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>

                <div class="techDetail">
                    <span><?php echo translate("product-code", getCurrentLanguage()); ?>:</span> <?php echo $prod['prodCode']; ?>
                    <div class="clear"></div>
                    <span><?php echo translate("producer", getCurrentLanguage()); ?>:</span> ANNELLA
                    <div class="clear"></div>
                    <span><?php echo translate("origin", getCurrentLanguage()); ?>:</span> EU
                </div>


            </div>
            <div class="left">
                <a href="#">
                    <img src="images/<?php echo $prod['prodImage1']; ?>.png" alt="<?php echo getCurrentLanguage() == "cs" ? $prod['prodCsName'] : $prod['prodEnName']; ?>">
                </a>
                <?php /*<div class="thumbnail">
                    <a href="#">
                        <img src="images/inkoust_annella_cerny_thumb.png" alt="Inkoust cerny ANNELLA" >
                    </a>
                    <a href="#">
                        <img src="images/inkoust_annella_cerny_thumb.png" alt="Inkoust cerny ANNELLA" >
                    </a>
                    <a href="#">
                        <img src="images/inkoust_annella_cerny_thumb.png" alt="Inkoust cerny ANNELLA" >
                    </a>
                    <a href="#">
                        <img src="images/inkoust_annella_cerny_thumb.png" alt="Inkoust cerny ANNELLA" >
                    </a>
                    <a href="#">
                        <img src="images/inkoust_annella_cerny_thumb.png" alt="Inkoust cerny ANNELLA" >
                    </a>
                </div> */ ?>
            </div>
            <div class="clear"></div>
        </div>

                    <?php if(getCurrentLanguage() == "cs") { ?> 
        <h1>Blíže k inkoustům ANNELLA</h1>

        <strong>Kvalitní voděodolné inkousty do plnících per neleptající hrot pera.</strong>

        <p>Inkousty ANNELLA jsou voděodolné inkousty založené na pigmentové bázi. Odolnost vůči vodě se projevuje minimálním rozpouštěním a blednutím při namočení (což jsou běžné nešvary standardních inkoustů). Na rozdíl od většiny ostatních voděodolných inkoustů <strong>inkousty ANNELLA nejsou kyselé a neleptají tak hrot pera</strong> (což je příznačné především pro tzv. duběnkové inkousty). Jsou vhodné především pro krátkodové užití, dále při psaní delších dokumentů jako kronik a podobných archiválií.</p>


        <h2>Prametry a vlastnosti inkoustu</h2>
        <div class="specification">
            <div class="par">Typ inkoustu</div> <div class="val">pigmentový</div>
            <div class="clear"></div>
            <div class="par">Barva</div> <div class="val"><?php echo translate($prod['prodColor'], getCurrentLanguage()); ?></div>
            <div class="clear"></div>
            <div class="par">Výrobce</div> <div class="val">ANNELLA s.r.o.</div>
            <div class="clear"></div>
            <div class="par">Objem lahvičky</div> <div class="val"><?php echo translate($prod['prodVolume'], getCurrentLanguage()); ?></div>
            <div class="clear"></div>

            <div class="par last">Voděodolný</div> <div class="val  last">Ano</div>
            <div class="clear"></div>
        </div>
        
        
        <h2 id="navBasicProp">Základní vlastnosti inkoustů ANNELLA:</h2>
        <ul>
            <li>Jsou voděodolné (projevují pouze minimální rozpustnost ve vodě). </li>
            <li>Jsou pH neutrální – neleptají tedy hrot pera při použití (na rozdíl od duběnkových inkoustů) </li>
            <li>Projevují vysokou stálost barev (barva při běžných podmínkách nestárne a nemění se). </li>
            <li>K dispozici je široká nabídka barev (především modrá, černá, světle modrá, purpurová, žlutá). </li>
            <li>Inkoust při psaní není cítit (neprojevuje se charakteristický zápach běžných inkoustů). </li>
            <li>Jsou k dispozici za rozumnou cenou od českého dodavatele (vyhnete se některým problémům spojeným s objednávkami ze zahraničních eshopů). </li>
        </ul>

        <h2 id="navUseOfInk">Používání inkoustů ANNELLA</h2>
        <p>Při používání inkoustů ANNELLA je vhodné mít k dispozici kus papíru, na němž se pero po delším nepoužívání rozepíše. Důvodem je zaschnutí média v kanálku pera, způsobující vynechávání při psaní.</p>
        <p>Dále doporučujeme používat inkoust spíše jednorázově a nenechávat jej v peru déle než několik dní a to především z důvodu zasychání média. Při využívání inkoustu v dražších modelech per doporučujeme zvážit jeho využití s ohledem na specifika pigmentového inkoustu. Stejně tak dopředu zvažte, zdali se inkoust nepropíše na druhou stranu používaného papíru.</p>
        <p>Obvzláště opatrní buďte při manipulaci s inkoustem. Potřísněný šatník se špatně čistí (a někdy nelze vyčistit vůbec), pro čištění poničených textílií doporučujeme využívat tzv. tekutý benzinový čistič (po rozvaze, zdali nepoškodí i textílii).</p>

        <h2 id="navDifUse">Rozdíly oproti ostatním inkoustům</h2>
        <p>Voděodolné duběnkové inkousty, které se běžně využívají, mají zásadní nevýhody spočívající jednak v leptání hrotu pera při používání (jsou kyselé a obvzláště u dražších per je jejich používání rizikové) a jednak v horší stálosti barev (v podstatě máte za rozumnou cenu na výběr pouze varianty černé). Pigmentové inkousty ANNELLA jsou naproti tomu pH neutrální (díky čemuž hrot pera neleptají) a jsou k dispozici v širší nabídce barev. </p>
        <p>Používání inkoustů, které nejsou voděodolné, zase vede k jejich rozpíjení i při pouhém doteku rukou. Jejich využití je tak značně rizikové, obvzláště u důležitých dokumentů, a to i při řádném skladování (natož pak při mimořádné události). </p>
        <p>Stálost barev je další zásadní faktor při výběru inkoustu. Některé konkureční inkousty po napsání linky začnou časem měnit barvu, což je nepříjemné zejména při u podpisů. Pigmentové inkousty ANNELLA mají vysokou barevnou stálost, tedy se časem jejich barva nemění.</p>

        <?php } else if(getCurrentLanguage () == "en") {?>
        
        <h1>About ANNELLA inks</h1>

        <strong>High quality waterproof inks for fountain pen.</strong>

        <p>ANNELLA inks are high quality waterproof pigment inks. The waterproof means that ink does not dissolve or loosing color in the water (with is common for other water based inks). The other benefit of ANNELLA inks is pH neutral composition. That basically means that inks does not damage pen by rusting metal parts (in opposite to iron gall inks that does corrode pen). ANNELLA inks is especially useful for short-term using (writing long or important documents and so on). Another benefit of ANNELLA ink is color stability (ink does not change color during the time).</p>


        <h2>Ink parameters</h2>
        <div class="specification">
            <div class="par">Ink type</div> <div class="val">pigment based</div>
            <div class="clear"></div>
            <div class="par">Color</div> <div class="val"><?php echo translate($prod['prodColor'], getCurrentLanguage()); ?></div>
            <div class="clear"></div>
            <div class="par">Producer</div> <div class="val">ANNELLA s.r.o.</div>
            <div class="clear"></div>
            <div class="par">Bottle volume</div> <div class="val"><?php echo translate($prod['prodVolume'], getCurrentLanguage()); ?></div>
            <div class="clear"></div>

            <div class="par last">Waterproof</div> <div class="val  last">yes</div>
            <div class="clear"></div>
        </div>
        
        
        <h2 id="navBasicProp">ANNELLA inks characteristic:</h2>
        <ul>
            <li>Waterproof inks for fountain pens. </li>
            <li>Ink is pH neutral (does not corrode or demage metal parts of pen).</li>
            <li>Extremly color stable (color does not change during the time). </li>
            <li>Inks are offered in many colors. </li>
            <li>Inks are available with acceptable price.</li>
        </ul>

        <h2 id="navUseOfInk">Other information</h2>
        <p>It is highly recommended to using ANNELLA inks in short-term only. We does not recommend using inks in relatively expensive pens (or much old ones). If you are writing on thin paper ink could be easily found on the other side of the paper. You should be careful not to stain cloth by ink (it could irrecoverably demage cloth).</p>
    
        
        
        <?php } ?>
        
        
                </article>
                <?php
    }
    
    public function __construct($sortOptCol, $sortOptVol, $productDetail) {
        parent::__construct ();
        $this->selColor = $sortOptCol; $this->selVolume = $sortOptVol;
        if(getCurrentLanguage() == "en") {
            $this->prodEnSEOname = $productDetail;
            switch ($sortOptCol):
                case "blue":
                    $this->selColor="modra";
                    break;
                case "black":
                    $this->selColor="cerna";
                    break;
                case "indigo":
                    $this->selColor="indigo";
                    break;
                case "magenta";
                    $this->selColor="purpurova";
                    break;
                case "yellow";
                    $this->selColor="zluta";
                    break;
                default:
                    $this->selColor=null;
            endswitch;
        } else if(getCurrentLanguage() == "cs") {
            $this->prodCsSEOname = $productDetail;
        }
        switch ($this->selColor):
            case "modra":
                $this->selectedPageCs = "modrý inkoust";
                $this->selectedPageEn = "blue inks";
                break;
            case "cerna":
                $this->selectedPageCs = "černý inkoust";
                $this->selectedPageEn = "black inks";
                break;
            case "indigo":
                $this->selectedPageCs = "modrofialový inkoust inkoust";
                $this->selectedPageEn = "indigo inks";
                break;
            case "purpurova";
                $this->selectedPageCs = "purpurový inkoust";
                $this->selectedPageEn = "magenta inks";
                break;
            case "zluta";
                $this->selectedPageCs = "žlutý inkoust";
                $this->selectedPageEn = "yellow inks";
                break;
        endswitch;
        
        switch ($this->selVolume):
            case "50-ml":
                $this->selectedPageCs = "objem 50 ml";
                $this->selectedPageEn = "50 ml bottles";
                break;
            case "100-ml":
                $this->selectedPageCs = "objem 100 ml";
                $this->selectedPageEn = "100 ml bottles";
                break;
        endswitch;
        $this->selectedPageMenu = "shop";
    
        if($this->prodCsSEOname != null || $this->prodEnSEOname != null) {
            $query = mysql_query("SELECT * FROM produkt WHERE prodCsSEOname='".$this->prodCsSEOname."' OR  prodEnSEOname='".$this->prodEnSEOname."' LIMIT 1 ");

            $prod = mysql_fetch_assoc($query);

            $this->metaDescriptionCs = $prod['prodCsTagDescription'];
            $this->metaDescriptionEn = $prod['prodEnTagDescription'];

            $this->metaKeywordCs = $prod['prodCsTagKeywords'];
            $this->metaKeywordEn = $prod['prodEnTagKeywords'];

            $this->selectedPageType = "productDetail";
            $this->idInCs = $prod['prodCsSEOname'];
            $this->idInEn = $prod['prodEnSEOname'];
            
            $this->priceKc = $prod['price'];
            $this->priceEur = KcToEur($this->priceKc);
            $this->thumbImage = $prod['prodTitleImage'];
            
            $this->selectedPageCs = $prod['prodCsName'];
            $this->selectedPageEn = $prod['prodEnName'];
        }
    }
    public function plotContent() {
        $this->plotAside();
        if($this->prodCsSEOname != null || $this->prodEnSEOname != null) {
            $this->plotProductDetail();
        }
        else {
            $this->plotListOfProduct();
        }
    }
    public function createProdLink() {
        createLink( getCurrentLanguage() == "cs" ? $this->prodCsSEOname : $this->prodEnSEOname, "productDetail");
    }
}


class CBasketItem {
    public $prodCsSEOname, $prodEnSEOname, $prodCount, $priceKc, $priceEur;
    public function __construct($prodCsSEOname, $prodEnSEOname, $prodCount, $priceKc, $priceEur) {
        $this->prodCsSEOname = $prodCsSEOname; 
        $this->prodEnSEOname = $prodEnSEOname;
        $this->prodCount = $prodCount;
        $this->priceKc = $priceKc;
        $this->priceEur = $priceEur;
    }
    public function plotThisItem () {
        echo $this->prodCsSEOname." ";
        echo $this->prodEnSEOname." ";
        echo $this->prodCount." ";
        echo $this->priceKc." ";
        echo $this->priceEur." ";
        echo "------------";
    }
}


class CAddBasketPage extends CProductPage {
    public function addToBasket() {
        $notAdded = true;
        if(isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as  $key => $item) {
                if(($item->prodCsSEOname == $this->prodCsSEOname && $this->prodCsSEOname != null)  || ($item->prodEnSEOname == $this->prodEnSEOname && $this->prodEnSEOname != null)) {
                    $notAdded = false;
                    $_SESSION['basket'][$key]->prodCount = $_SESSION['basket'][$key]->prodCount + 1;
                }
            }
        }
        if($notAdded) {
            $_SESSION['basket'][] = new CBasketItem($this->prodCsSEOname, $this->prodEnSEOname, 1, $this->priceKc, $this->priceEur);
        }
    }
    public function plotAddedToBasket() {
        ?>
    <article>
        
        <h1><?php echo translate("item-added", getCurrentLanguage()); ?></h1>
            <div class="addedInBasket">
                <div>
                    <div class="thumbnail">
                        <a href="<?php $this->createProdLink();?>">
                            <img src="images/<?php echo $this->thumbImage ?>.png" alt="<?php echo getCurrentLanguage() == "cs" ?  $this->selectedPageCs : $this->selectedPageEn; ?>" >
                        </a>
                    </div>
                    <div id="addedInBasketDetail">
                        <strong><?php echo translate("ink-added-in-basket", getCurrentLanguage()); ?></strong>
                        <br>
                        <a href="<?php $this->createProdLink();?>"><?php echo getCurrentLanguage() == "cs" ?  $this->selectedPageCs : $this->selectedPageEn; ?></a>
                    </div>
                    <div class="clear"></div>
                </div>

            </div>
            <a id="addedInBasketRight" href="<?php $this->createProdLink();?>"><?php echo translate("back-to-product", getCurrentLanguage()); ?></a>  
            <a class="addToBasket" id="addedInBasketLeft" href="<?php createLink(null, "basketDetail") ?>"><?php echo translate("proceed-to-checkout", getCurrentLanguage()); ?></a>  
            <div class="clear"></div>
    </article>
        <?php
    }
    public function __construct($id) {
        parent::__construct (null, null, $id);
        $this->appendToHead = '<meta name="robots" content="noindex">';
        $this->addToBasket();
        
    }
    public function plotContent() {
        $this->plotAside();
        $this->plotAddedToBasket();
        
    }
}

class CBasketPage  extends CPage {
    private $sendedOrder;
    
    public function plotBasketContent() {
        ?>
                <article class="blueH">
                <h1><?php echo translate("shopping-basket", getCurrentLanguage()); ?></h1>
                
                
                <form action="<?php createLink(null,"basketChange") ?>" method="POST" name="basketChange">
                    <?php
                    $sumBasket = 0;
                    foreach ($_SESSION['basket'] as $item) {
                        $query = mysql_query("SELECT * FROM produkt WHERE prodCsSEOname='".$item->prodCsSEOname."' OR prodEnSEOname='".$item->prodEnSEOname."' LIMIT 1");
                        $product = mysql_fetch_assoc($query);
                        ?>
                        <div class="basketItem">
                            <div>
                                <div class="thumbnail">
                                    <a href="<?php createLink($product['prodCsSEOname'], "productDetail") ?>">
                                        <img src="images/<?php echo $product['prodTitleImage']; ?>.png" alt="<?php echo getCurrentLanguage() == "cs" ? $product['prodCsName'] :  $product['prodEnName']; ?>" >
                                    </a>
                                </div>
                                <div class="basketItemName">
                                    <a href="<?php createLink($product['prodCsSEOname'], "productDetail") ?>"><?php echo getCurrentLanguage() == "cs" ? $product['prodCsName'] :  $product['prodEnName'];?></a>
                                </div>
                                <div class="basketInStock">
                                    <em><?php echo translate("is-in-stock", getCurrentLanguage()); ?>:</em><br>
                                    <span><?php echo translate("in-stock", getCurrentLanguage()); ?></span>
                                </div>
                                <div class="basketCount">
                                    <em><?php echo translate("count", getCurrentLanguage()); ?></em><br>
                                    <input type="number" value="<?php echo $item->prodCount; ?>" min="1" max="50" onchange="this.form.submit()" name="<?php echo getCurrentLanguage() == "cs" ? $product['prodCsSEOname'] :  $product['prodEnSEOname'];?>">
                                </div>
                                <div class="pricePerItem">
                                    <em><?php echo translate("price-item", getCurrentLanguage()); ?></em><br>
                                    <?php echo getCurrentLanguage() == "cs" ? $product['price'].",- Kč" : KcToEur($product['price'])."&euro;"; ?> 
                                </div>

                                <div class="priceAllItems">
                                    <em><?php echo translate("basket-total", getCurrentLanguage()); ?></em><br>
                                    <?php echo (getCurrentLanguage() == "cs" ? $product['price'] : KcToEur($product['price']))  *$item->prodCount; ?><?php echo getCurrentLanguage() == "cs" ? ",- Kč" : '&euro;';?>
                                </div>
                                <div class="basketItemDelete">
                                    <br>
                                    <a href="<?php createLink(   getCurrentLanguage() == "cs" ?  $product['prodCsSEOname'] : $product['prodEnSEOname'] , "basketDelete"); ?>">&nbsp;</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <?php
                        $sumBasket += $product['price']*$item->prodCount;;
                        }
                        ?>


                        <div class="basketItem" id="basketShipping">
                            <div>
                                <div class="thumbnail">
                                    <a href="#">
                                        &nbsp;
                                    </a>
                                </div>
                                <div class="basketItemName">
                                    <a href="#"><?php echo translate("shipping-packing-fee", getCurrentLanguage()); ?></a>
                                </div>
                                <div class="basketInStock">
                                    <span><?php echo translate("ulozenka-service", getCurrentLanguage()); ?></span>
                                </div>


                                <div class="priceAllItems">

                                    <?php if($sumBasket >= 1200) { echo (getCurrentLanguage() == "cs" ? "0,- Kč" : KcToEur(0)."&euro;"); } else { echo (getCurrentLanguage() == "cs" ? "49,- Kč" : KcToEur(49)." &euro;"); } ?>
                                </div>

                                <div class="clear"></div>
                                <div class="thumbnail">
                                    &nbsp;
                                </div>
                                <strong>&nbsp;<?php if($sumBasket >= 1200) { echo translate("free-shipping", getCurrentLanguage()); } else { echo translate("to-free-shipping-buy", getCurrentLanguage()); echo getCurrentLanguage() == "cs" ? (1200-$sumBasket).",- Kč"  : KcToEur(1200-$sumBasket)."&euro;" ; $sumBasket += 49;} ?></strong>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </form>
                    <div class="basketOverview">
                        <strong><?php echo translate("basket-total", getCurrentLanguage()); ?> </strong> <span><?php  echo (getCurrentLanguage() == "cs" ? $sumBasket.",- Kč" : KcToEur($sumBasket)." &euro;"); ?></span>
                    </div>
                    <?php if($sumBasket >= 5000 && getCurrentLanguage() == "cs") { echo "<div class='clear'></div><p class='redText'><strong>Při objednávce nad 5 000,- Kč vyžadujeme platbu předem! Platební údaje Vám budou zaslány mailem později.</strong></p>"; } ?>
                    <?php if($sumBasket >= 5000 && getCurrentLanguage() == "en") { echo "<div class='clear'></div><p class='redText'><strong>If you want to order for more than ".  KcToEur(5000)." you have to pay your package by advance payment.</strong></p>"; } ?>
                    
                    <div class="clear"></div>
                    
                    
                    <form action="<?php createLink(null, "sendOrder") ?>" method="POST">
                        <h1><?php echo translate("order", getCurrentLanguage()); ?></h1>
                        <div class="basketDetail">

                            <h2 id='navDeliveryStyle'><?php echo translate("delivery", getCurrentLanguage()); ?></h2>
                            <span><?php echo translate("delivery-option", getCurrentLanguage()); ?></span>
                            <h3><?php echo translate("destination", getCurrentLanguage()); ?></h3>
                            <?php /*<em>Vyberte zemi/oblast, do které bude balíček doručen.</em>*/ ?>
                            <p class="destCountry">
                                <span><input type="radio" name="zeme" checked="checked" id="zemeCR" value="ČR"> <label for="zemeCR"><?php echo translate("czech-republic", getCurrentLanguage()); ?></label></span>
                                <span><input type="radio" name="zeme" value="SK" id="zemeSK"> <label for="zemeSK" value="SK"><?php echo translate("slovak-republic", getCurrentLanguage()); ?></label></span> <?php /*
                                <span><input type="radio" name="zeme"> Jinam v rámci EU nebo EHP</span>
                                <span><input type="radio" name="zeme"> USA</span> */ ?>
                            </p>
                            <div class="clear"></div>

                            <h3 id="navShipper"><?php echo translate("shipper", getCurrentLanguage()); ?></h3>
                            <?php /*<em>Zvolte dopravce pro zaslání zásilky. Doporučujeme využít služby Úloženka (s ohledem na negativní reference při doručování balíčků Českou poštou).</em>*/ 
                            if(getCurrentLanguage() == "cs") { ?><p><input type="radio" name="dodani" id="dodani" checked="checked" value="Ulozenka"> <label for="dodani"><strong><?php if($sumBasket >= 1200) { echo "0,- Kč"; } else { echo "49,- Kč"; } ?></strong> balík <?php if($sumBasket < 5000) { echo "s dobírkou"; } ?> prostřednictvím sítě <strong>Úloženka</strong></label></p> <?php }
                            else { ?><p><input type="radio" name="dodani" id="dodani" checked="checked" value="Ulozenka"> <label for="dodani"><strong><?php if($sumBasket >= 1200) { echo "0,- Kč"; } else { echo "2 &euro;"; } ?></strong> package <?php if($sumBasket < 5000) { echo " (cash on delivery) "; } ?> using <strong>Ulozenka service</strong></label></p><?php }
                            ?>
                            
                            <div>                                
                                <div class="clear">&nbsp;</div>
                                <strong><?php echo translate("select-ulozenka", getCurrentLanguage()); ?></strong><br>
                                <div id="ulozenka-branch-select-options"></div>
                                        

                                <script>
                                    var response = "";
                                    var request = new XMLHttpRequest();
                                    optionsDiv = document.getElementById('ulozenka-branch-select-options');
                                    request.open("GET", "https://api.ulozenka.cz/v2/branches?shopId=10969", true);
                                        request.setRequestHeader('Accept', 'application/json')
                                        request.onreadystatechange = function () {
                                            if (request.readyState == 4) {
                                                if (request.status == 200 || request.status == 0) {
                                                    response = JSON.parse(request.responseText);
                                                    branches = response.data;
                                                    var sortable = [];
                                                    for (i = 0; i < branches.length; i++) {
                                                        branch = branches[i];
                                                        sortable.push([branch.id, ""+branch.country+" - "+branch.name+""])
                                                    }
                                                    sortable.sort(function(a, b) { return a[1].localeCompare(b[1]);})
                                                    sortedBranches = sortable;
                                                    select = document.createElement("select");
                                                    select.setAttribute('name', "ulozenka_branches");
                                                    optionsDiv.appendChild(select);
                                                    option = document.createElement("option");
                                                    option.innerHTML = 'Vyberte Pobočku';
                                                    select.appendChild(option);
                                                    for (i = 0; i < sortedBranches.length; i++) {
                                                        branch = sortedBranches[i];
                                                        option = document.createElement("option");
                                                        option.setAttribute('value', branch[0]);
                                                        option.innerHTML = branch[1];
                                                        select.appendChild(option);
                                                    }
                                                } else {
                                                    optionsDiv.innerHTML = "Nepodařilo se načíst seznam poboček.";
                                                }
                                            }
                                        }
                                        request.send();
                                </script>

                                <div class="clear">&nbsp;</div>
                            </div>
                            <input type="hidden" name="PobocnkaName" id="PobocnkaName">
                            <?php /*<p><input type="radio" name="dodani"> <strong>129,- Kč</strong> Balík s dobírkou prostřednictvím <strong>České pošty</strong></p>*/?>





                            <h2 id='navDeliveryInfo'><?php echo translate("address", getCurrentLanguage()); ?></h2>
                            <em><?php echo translate("all-required", getCurrentLanguage()); ?></em>
                            <div class="billing">
                                <h3><?php echo translate("billing-info", getCurrentLanguage()); ?></h3>
                                
                                
                                <?php if(getCurrentLanguage() == "cs") { ?> 
                                <p>
                                    IČO <em>(vaše identifikační číslo)</em>: <br>
                                    <input type="text" id="ICO" name="ICO"><br>                                    
                                    
                                    <a href="javascript:;" class="helpIcon" onclick="$('#iHaveNoICO').html('<br>Pokud nemáte IČO, stačí se jednoduše domluvit s někým, kdo podniká (vlastní firmu / živnostenský list). Podotýkáme, že při úspěšném doručení zásilky se uvedenou osobu nesnažíme nikterak kontaktovat.'); ">Co mám dělat, když nemám IČO?</a>
                                    <em id="iHaveNoICO"></em>
                                </p>
                                <p>
                                    Firma <em>(jméno u živnostníka či název společnosti)</em>: <br>
                                    <input type="text" id="firma" name="firma">
                                </p>
                                <em>Fakturační údaje párujeme později prostřednictvím systému ARES (v ČR) či ZRSR (pro SK) ze zadaného IČ.</em>

                                <p>
                                    Jméno: <br>
                                    <input type="text" id="jmeno" name="jmeno">
                                </p>
                                <p>
                                    Příjmení: <br>
                                    <input type="text" id="prijmeni" name="prijmeni">
                                </p>
                                <p>
                                    Město: <br>
                                    <input type="text" id="mesto" name="mesto">
                                </p>
                                <p>
                                    Ulice a číslo popisné: <br>
                                    <input type="text" id="ulice" name="ulice">
                                </p>
                                <p>
                                    PSČ (poštovní směrovací číslo): <br>
                                    <input type="text" id="PSC" name="PSC">
                                </p>
                                <p>
                                    Telefon (mobil): <br>
                                    <input type="text" id="telefon" name="telefon">
                                </p>
                                <p>
                                    Email: <br>
                                    <input type="text" id="teeV9E" name="teeV9E">
                                </p>
                                <p>
                                    Poznámka: <br>
                                    <textarea cols="25" rows="5" id="poznamka" name="poznamka"></textarea>
                                </p>
                                <p>
                                    <input type="checkbox" id='acceptLicAgr' name='acceptLicAgr' value="ANO"> <label for='acceptLicAgr'>Souhlasím s obchodními podmínkami eshoopu inkoust.net (<a href="<?php createLink("obchodni-podminky") ?>" target="_blank">ZDE k pročtení</a>).</label>
                                </p>
                                <p>
                                    <em>Následující krok představuje odeslání závazné objednávky.</em> <br>
                                    <a href="javascript:;" id='confirmBasket' name='confirmBasket'>Odesílám závaznou objednávku</a>
                                </p>
                                <?php } else { ?>
                                <p>
                                    Company (registration) number : <br>
                                    <input type="text" id="ICO" name="ICO"><br>                                    
                                </p>
                                <p>
                                    Company name: <br>
                                    <input type="text" id="firma" name="firma">
                                </p>

                                <p>
                                    Name: <br>
                                    <input type="text" id="jmeno" name="jmeno">
                                </p>
                                <p>
                                    Surname: <br>
                                    <input type="text" id="prijmeni" name="prijmeni">
                                </p>
                                <p>
                                    City: <br>
                                    <input type="text" id="mesto" name="mesto">
                                </p>
                                <p>
                                    Street and number: <br>
                                    <input type="text" id="ulice" name="ulice">
                                </p>
                                <p>
                                    ZIP: <br>
                                    <input type="text" id="PSC" name="PSC">
                                </p>
                                <p>
                                    Phone (GSM) number: <br>
                                    <input type="text" id="telefon" name="telefon">
                                </p>
                                <p>
                                    Email: <br>
                                    <input type="text" id="teeV9E" name="teeV9E">
                                </p>
                                <p>
                                    Note: <br>
                                    <textarea cols="25" rows="5" id="poznamka" name="poznamka"></textarea>
                                </p>
                                <p>
                                    <input type="checkbox" id='acceptLicAgr' name='acceptLicAgr' value="ANO"> <label for='acceptLicAgr'> I agree with rules of eshop inkoust.net (<a href="<?php createLink("rules-and-policies") ?>" target="_blank">HERE</a>).</label>
                                </p>
                                <p>
                                    <em>This step is means serious order.</em> <br>
                                    <a href="javascript:;" id='confirmBasket' name='confirmBasket'>Send the order</a>
                                </p>
                                <?php } ?>
                                <div class="clear"></div>
                                <p><strong id="errorLog"></strong></p>
                            </div>

                        </div>
                        
                        
                        <script>
                        
                        $( document ).ready(function() {                            
                            $( "#confirmBasket" ).click(function() {
                                var message = "";
                                if($("select[name=ulozenka_branches]").val() == "Vyberte Pobočku") 
                                    message += "Nevybrali jste pobočku pro doručení; ";
                                if($("#ICO").val() == "")
                                    message += "Nevyplnili jste IČO; ";
                                if($("#firma").val() == "")
                                    message += "Nevyplnili jste firmu; ";
                                if($("#jmeno").val() == "")
                                    message += "Nevyplnili jste jméno; ";
                                if($("#prijmeni").val() == "")
                                    message += "Nevyplnili jste příjmení; ";
                                if($("#mesto").val() == "")
                                    message += "Nevyplnili jste město; ";
                                if($("#ulice").val() == "")
                                    message += "Nevyplnili jste ulici; ";
                                if($("#PSC").val() == "")
                                    message += "Nevyplnili jste PSČ; ";
                                if($("#telefon").val() == "")
                                    message += "Nevyplnili jste telefon; ";
                                if( ! ($("#teeV9E").val().indexOf("@") > 0))
                                    message += "Nevyplnili jste email; ";
                                if(!($('#acceptLicAgr').is(':checked')))
                                    message += "Musíte souhlasit s licenčními podmínkami; ";
                                if(message !== "") {
                                    $("#errorLog").html("Pozor: " + (message.split('; ').join('<br>') ) );
                                }
                                else {
                                    var pobockaN = $( "select[name=ulozenka_branches] option:selected" ).text();
                                    $("#PobocnkaName").val(pobockaN);
                                    
                                    this.form.submit();
                                }
                            });
                        });
                        </script>
                        
                    </form>
                    
                    
                    
                </article>
                
                <?php
    }
    
    public function plotAside() {
        
        
        ?>
                <aside>
    <div class="sepOption colorSelIcons">
        <h1 id="fastNavIcon"><?php echo translate("fast-information", getCurrentLanguage()); ?></h1>
        <ul>
            <li>
                <a href="#navDeliveryStyle"><?php echo translate("delivery", getCurrentLanguage()); ?></a>
            </li>
            <li>
                <a href="#navDeliveryInfo"><?php echo translate("address", getCurrentLanguage()); ?></a>
            </li>
            <li>
                <a href="#navShipper"><?php echo translate("shipper", getCurrentLanguage()); ?></a>
            </li>
            
        </ul>
    </div>
    <div class="clean">&nbsp;</div>
    <a href="/" class="toShopButton">
        <span><?php echo translate("link-to-shop", getCurrentLanguage()); ?></span>
    </a>
    <div class="clean"></div>
</aside>
                <?php
    }
    
    public function __construct($toDelete=null, $toChange=null, $toSand=null) {
        parent::__construct ();
        
        $this->appendToHead = '<script src="jquery-3.1.0.min.js"></script> ';
        $this->appendToHead .= '<meta name="robots" content="noindex">';
        $this->sendedOrder = false;
        if($toDelete != null) {
            foreach ($_SESSION['basket'] as $key => $val) {
                if($val->prodCsSEOname == $toDelete || $val->prodEnSEOname == $toDelete ) {
                    unset($_SESSION['basket'][$key]);
                }
            }
        }
        if($toChange === true) {
            foreach ($_SESSION['basket'] as $key => $val) {
                if(getCurrentLanguage() == "cs") {
                    $_SESSION['basket'][$key]->prodCount = $_POST[ $_SESSION['basket'][$key]->prodCsSEOname ];
                } else {
                    $_SESSION['basket'][$key]->prodCount = $_POST[ $_SESSION['basket'][$key]->prodEnSEOname ];
                }
            }
        }
        if($toSand === true) {
            $this->sendedOrder = true;
            $text  = "Objednávka z eshopu inkoust.net\n\n";
            $text .= "Dodací údaje:"."\nzkratka země: ".$_POST['zeme']."\nvybraná pobočka sítě úloženka, kód: ".$_POST['ulozenka_branches']."\nnázev pobočky: ".$_POST['PobocnkaName']. " (na tuto adresu si později příjďte zásilku vyzvednout)" . "\n\n";
            $text .= "Fakturační údaje: \nIČO:".$_POST['ICO']."\nfirma: ".$_POST['firma']."\njméno: ".$_POST['jmeno']."\npříjmení: ".$_POST['prijmeni']."\nměsto: ".$_POST['mesto']."\nulice: ".$_POST['ulice']."\nPSČ: ".$_POST['PSC']."\ntelefon: ".$_POST['telefon']. "\nemail: ".$_POST['teeV9E']. "\npoznámka: ".$_POST['poznamka']. "\n\n";
            $text .= "Souhrn Vaší objednávky na inkoust.net:\n";
            $text .= "-----------\n";
            $totalPrice = 0;
            foreach ($_SESSION['basket'] as $item) {
                $q = mysql_query("SELECT prodEnName, prodCsName, prodCode, price FROM produkt WHERE prodCsSEOname='".$item->prodCsSEOname."' OR prodEnSEOname='".$item->prodEnSEOname."' LIMIT 1");
                $product = mysql_fetch_assoc($q);
                
                $prodText = "Název položky: ".$product['prodCsName']."\n";
                $prodText .= "Kód položky: ".$product['prodCode']."\n";
                $prodText .= "Jednotková cena: ".$product['price'].",- Kč\n";
                $prodText .= "Počet kusů: ".$item->prodCount."\n";
                $totalPrice += $item->prodCount * $product['price'];
                $prodText .= "Celkem za položku: ".($item->prodCount * $product['price']).",- Kč\n";
                $prodText .= "-----------\n\n";
                
                $text .= $prodText;
            }
            if($totalPrice < 1200) {
                $text .= "Poštovné a balné: 49,- Kč";
                $totalPrice += 49;
            }
            else {
                $text .= "Poštovné a balné: Zdarma\n";
            }
            
            
            $text .= "\n\nCelková částka k úhradě: ".$totalPrice.",- Kč";
            if($totalPrice > 5000) {
                $text .= "\n\nU objednávek nad 5 000,- Kč vyžadujeme platbu předem! Údaje Vám na email zašleme později.\n";
            }
            $text .= "\n\nZásilka bude pravděpodobně odeslána do 4 pracovních dní.";
            $text .= "\n\nPro další dotazy nám pište na inkswaterproof@gmail.com nebo volejte +420 774 842 596";
/*
$this->prodCount = $prodCount;
        $this->priceKc = $priceKc;
 *  */
            cs_mail($_POST['teeV9E'], "Objednávka na eshopu inkoust.net", $text /*, 'From: inkswaterproof@gmail.com' */ );
            cs_mail("inkoust@annella.cz", "Objednávka na eshopu inkoust.net", $text /*, 'From: inkswaterproof@gmail.com' */ );
            
            unset($_SESSION['basket']);
        }
        
        $this->selectedPageCs = "košík"; /* V Title */
        $this->selectedPageEn = "basket"; /* V Title en */
        
        $this->selectedPageType = "basketDetail";
    }
    
    public function plotAsideSendedOrder() {
        ?>
                <aside>
    
                    <div class="clean">&nbsp;</div>
                    <a href="/" class="toShopButton">
                        <span>Přejít do obchodu</span>
                    </a>
                    <div class="clean"></div>
                </aside>
                <?php
    }
    
    public function plotSendedOrder() {
        ?>
                <article class="blueH">
                    <h1>Odeslaná objednávka</h1>

                    <strong>Vaše objednávka byla úspěšně odeslána. O dalším průběhu budete vyrozuměni emailem.</strong>

                </article>
                <?php
    }
    
    public function plotContent() {
        if(!$this->sendedOrder) {
            $this->plotAside();
            $this->plotBasketContent();
        }
        else {
            $this->plotAsideSendedOrder();
            $this->plotSendedOrder();
        }
        
    }
}




//unset($_SESSION['basket']);




$str;
if(count($_GET) < 1 || isset($_GET['sortOptCol']) || isset($_GET['sortOptVol']) || isset($_GET['product']) ) {
    $sortOptCol = isset($_GET['sortOptCol']) ? cleanTextField($_GET['sortOptCol'])  : null;
    $sortOptVol = isset($_GET['sortOptVol']) ? cleanTextField($_GET['sortOptVol'])  : null;
    $productDetail = isset($_GET['product']) ? cleanTextField($_GET['product'])     : null;
    $str = new CProductPage($sortOptCol, $sortOptVol, $productDetail);
}
else if(isset($_GET['basket'])) {
    $str = new CAddBasketPage(cleanTextField($_GET['basket']));
}
else if(isset($_GET['basketDetail']) || isset ($_GET['basketDelete']) || isset ($_GET['basketChange']) || isset ($_GET['sendOrder']) ) {
    if(isset($_SESSION['basket'])) {
        $str = new CBasketPage(isset ($_GET['basketDelete']) ? $_GET['basketDelete'] : null, isset ($_GET['basketChange']) ? true : false, isset ($_GET['sendOrder']) ? true : false);
    } else {
        $str = new CProductPage(null, null, null);
    }
}
else if(isset($_GET['id'])) {
    $str = new CStaticPage(cleanTextField($_GET['id']));
}

$str->plotPage();

/*
 * 
 *  RYCHLA NAVIGACE V KOSIKU!!!
 *  
 *  */