<aside>
    <div class="sepOption colorSelIcons">
        <h1 id="fastNavIcon">Options</h1>
        <ul>
            <li>
                <a href="#navTelMail">Email and GSM</a>
            </li>
            <li>
                <a href="#navContactForm">Contact form</a>
            </li>
            <li>
                <a href="#navLawInfo">Web keeper</a>
            </li>
            
        </ul>
    </div>
    <div class="clean">&nbsp;</div>
    <a href="/" class="toShopButton">
        <span>Link to shop</span>
    </a>
    <div class="clean"></div>
</aside>

<article class="blueH">
    
    <h1 id="contactIcon">Contact</h1>

    <strong>If you have any question write us or call us right now!</strong>
    
    <h2 id="navTelMail">ANNELLA inks</h2>
    
    <div class="specification">
        <div class="par"><strong class="emailIcon">E-mail:</strong></div> <div class="val"><strong>inkswaterproof@gmail.com</strong></div>
        <div class="clear"></div>
        <?php /*<div class="par last"><span class="phoneIcon">Phone:</span></div> <div class="val last">+420 774 842 596</div>
        <div class="clear"></div>*/?>
    </div>
    
    <h2 id="navContactForm">Contact form</h2>
    <strong>If you want to contact us, you can use contact form bellow.</strong>
    
    <div class="contactForm">
        <form action="sendMessage.php" method="post">
            <input type="hidden" name="language" value="<?php echo getCurrentLanguage(); ?>">
            <p>
                Your name:<br>
                <input type="text" id="jmeno" maxlength="255">
            </p>
            <p>
                Your&nbsp;email:<br>
                <input type="text" id="adresaelposty" maxlength="255">
            </p>
            <p>
                Subject:<br>
                <input type="text" id="predmet" maxlength="255">
            </p>
            <p>
                Your message:<br>
                <textarea cols="25" rows="5" id="zprava" maxlength="1024"></textarea>
            </p>
            <p>
                <em>For send click the button below!</em><br>
                <input type="submit" name="odesliTo" value="Send message">
            </p>
        </form>
    </div>
    
    <h2 id="navLawInfo">Web keeper</h2>
    <div class="specification">
        <div class="par">Corporation name:</div> <div class="val">ANNELLA s.r.o.</div>
        <div class="clear"></div>
        <div class="par">Justice information:</div> <div class="val">C 27756, Krajsky soud v Usti nad Labem</div>
        <div class="clear"></div>
        <div class="par">Address:</div> <div class="val">Liberec, Voronezska 144/20, ZIP 46001</div>
        <div class="clear"></div>
        <div class="par">Identification number:</div> <div class="val">28706951</div>
        <div class="clear"></div>
    </div>
</article>