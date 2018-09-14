<aside>
    <div class="sepOption colorSelIcons">
        <h1 id="colorInkIcon">Inkoust dle barvy</h1>
        <ul>
            <li>
                <a href="#" id="blueIcon">Modrá</a>
            </li>
            <li>
                <a href="#" id="blackIcon">Černá</a>
            </li>
            <li>
                <a href="#" id="cyanIcon">Světle modrá</a>
            </li>
            <li>
                <a href="#" id="magentaIcon">Purpurová</a>
            </li>
            <li>
                <a href="#" id="yellowIcon">Žlutá</a>
            </li>
        </ul>
    </div>
    <div class="sepOption">
        <h1 id="volumeInkIcon">Inkoust dle objemu</h1>
        <ul>
            <li>
                <a href="#" id="halfIcon">25 ml</a>
            </li>
            <li>
                <a href="#" id="fullIcon">50 ml</a>
            </li>
        </ul>
    </div>
</aside>

<article>
    <h1>Voděodolné inkousty neleptající pero</h1>
    <p>
        Inkousty ANNELLA jsou špičkové <strong>voděodolné inkousty</strong>. Jsou pH neutrální a tedy <strong>neleptají hroty per</strong>. Mají vysokou <strong>barevnou stálost</strong>, odolnost a životnost. Inkousty jsou ideální pro archiválie a delší psaní.
    </p>


    <div class="sortOptionWrap">
        <div class="sortOption">
            <span id="overviewIcon">Přehled všech produktů</span>
            <a href="#" class="deleteIcon">resetovat výběr</a>
            <div class="clear"></div>
        </div>
    </div>
    
    <?php 
    $query = mysql_query("SELECT * FROM produkt");
    
    while($prod = mysql_fetch_assoc($query)) {
    ?>

    <div class="itemWrap <?php echo $prod['prodColorClass'] ?>">
        <div class="item">
            <a href="<?php createLink( getCurrentLanguage() == "cs" ? $prod['prodCsSEOname'] : $prod['prodEnSEOname'], "productDetail") ?>" class="itemHref">
                <span><?php echo getCurrentLanguage() == "cs" ? $prod['prodCsName'] : $prod['prodEnName'] ?></span>
                <strong class="price"><span> </span> <?php echo $prod['price'] ?>,- Kč</strong>
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
    <?php } ?>

</article>