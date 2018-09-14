<aside>
    <div class="sepOption colorSelIcons">
        <h1 id="fastNavIcon">Rychlá navigace</h1>
        <ul>
            <li>
                <a href="#navTelMail">Email a telefon</a>
            </li>
            <li>
                <a href="#navContactForm">Kontaktní formulář</a>
            </li>
            <li>
                <a href="#navLawInfo">Provozovatel webu</a>
            </li>
            
        </ul>
    </div>
    <div class="clean">&nbsp;</div>
    <a href="/" class="toShopButton">
        <span>Přejít do obchodu</span>
    </a>
    <div class="clean"></div>
</aside>

<article class="blueH">
    
    <h1 id="contactIcon">Kontakt</h1>

    <strong>V případě jakýchkoli dotazů neváhejte, volejte či pište právě nyní!</strong>
    
    <h2 id="navTelMail">Inkousty ANNELLA</h2>
    
    <div class="specification">
        <div class="par"><strong class="emailIcon">E-mail:</strong></div> <div class="val"><strong>inkswaterproof@gmail.com</strong></div>
        <div class="clear"></div>
        <?php /*<div class="par last"><span class="phoneIcon">Telefon:</span></div> <div class="val last">+420 774 842 596</div>
        <div class="clear"></div>*/?>
    </div>
    
    <h2 id="navContactForm">Kontaktní formulář</h2>
    <strong>Pokud nám chcete sdělit jakékoli náměty, stížnosti, podněty... můžete využít kontaktní formulář níže!</strong>
    
    <div class="contactForm">
        <form action="sendMessage.php" method="post">
            <input type="hidden" name="language" value="<?php echo getCurrentLanguage(); ?>">
            <p>
                Vaše jméno:<br>
                <input type="text" id="jmeno" maxlength="255">
            </p>
            <p>
                Váš&nbsp;email:<br>
                <input type="text" id="adresaelposty" maxlength="255">
            </p>
            <p>
                Předmět vaší zprávy:<br>
                <input type="text" id="predmet" maxlength="255">
            </p>
            <p>
                Vaše zpráva:<br>
                <textarea cols="25" rows="5" id="zprava" maxlength="1024"></textarea>
            </p>
            <p>
                <em>Ještě jednou přečíst a odeslat!</em><br>
                <input type="submit" name="odesliTo" value="Odeslat zprávu">
            </p>
        </form>
    </div>
    
    <h2 id="navLawInfo">Právní informace o provozovateli stránek</h2>
    <div class="specification">
        <div class="par">Obchodní firma:</div> <div class="val">ANNELLA s.r.o.</div>
        <div class="clear"></div>
        <div class="par">Spisová značka:</div> <div class="val">C 27756 vedená u Krajského soudu v Ústí nad Labem</div>
        <div class="clear"></div>
        <div class="par">Sídlo:</div> <div class="val">Liberec, Voroněžská 144/20, PSČ 46001</div>
        <div class="clear"></div>
        <div class="par">Identifikační číslo:</div> <div class="val">28706951</div>
        <div class="clear"></div>
        <div class="par last">Právní forma:</div> <div class="val last">Společnost s ručením omezeným</div>
        <div class="clear"></div>
    </div>
</article>