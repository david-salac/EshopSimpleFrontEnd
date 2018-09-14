<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * UTF conversion
 * @param string $s input
 * @return string output
 */
function autoUTF($s)
{
    // detect UTF-8
    if (preg_match('#[\x80-\x{1FF}\x{2000}-\x{3FFF}]#u', $s))
        return $s;
    // detect WINDOWS-1250
    if (preg_match('#[\x7F-\x9F\xBC]#', $s))
        return iconv('WINDOWS-1250', 'UTF-8', $s);
    // assume ISO-8859-2
    return iconv('ISO-8859-2', 'UTF-8', $s);
}

/**
 * Send email
 * @param string $to email of recipient
 * @param string $predmet subject of email
 * @param string $zprava body of email
 * @param string $head head of email
 * @return string True if OK
 */
function cs_mail ($to, $predmet, $zprava, $head = "")
{  
    $predmet = "=?utf-8?B?".base64_encode(autoUTF ($predmet))."?=";
    $head .= "MIME-Version: 1.0\n";
    $head .= "Content-Type: text/plain; charset=\"utf-8\"\n";
    $head .= "Content-Transfer-Encoding: base64\n";
    $zprava = base64_encode (autoUTF ($zprava));

    return mail ($to, $predmet, $zprava, $head); 
}



/**
 * Conversion between EUR to CZK
 * @param int $koruny Amount of money
 * @return int Output in EUR
 */
function KcToEur($koruny) {
    $euroKurz = 26; /* Spise nizsi (ale legalni) cislo! */
    return ceil($koruny / $euroKurz);
}

/**
 * Get the current language code
 * @return string Code of current language
 */
function getCurrentLanguage() {
    if(strtolower($_SERVER['HTTP_HOST'][0].$_SERVER['HTTP_HOST'][1]) == "en") {
        return "en";
    }
    return "cs";
}

/**
 * Function for creating of links
 * @param string $target Target of link
 * @param string $tType Type of link
 * @return string
 */
function createLink($target, $tType = "static") {
    if($target == "_HOME_CS_") {
        echo "/";
        return;
    }
    if($target == "_HOME_EN_") {
        echo "/";
        return;
    }
    
    if($tType=="basketAdd" && getCurrentLanguage() == "cs") {
        echo 'pridat-do-kosiku-'.$target.".html";
        return;
    }
    if($tType=="basketAdd" && getCurrentLanguage() == "en") {
        echo 'basket-add-'.$target.".html";
        return;
    }
    if($tType=="productDetail") {
        echo $target.".html";
        return;
    }
    if($tType=="basketDelete") {
        echo $target.".jsp";
        return;
    }
    if($tType == "basketChange") {
        echo "edit-no.phtm";
    }
    if($tType == "sendOrder") {
        echo "ok-no.phtm";
    }
    if($tType=="sortOptCol"  && getCurrentLanguage() == "en") {
        echo "color-".$target.".html";
        return;
    }
    if($tType=="sortOptCol"  && getCurrentLanguage() == "cs") {
        echo "barva-".$target.".html";
        return;
    }
    if($tType=="sortOptVol" && getCurrentLanguage() == "cs") {
        echo "objem-".$target.".html";
        return;
    }
    if($tType=="sortOptVol" && getCurrentLanguage() == "en") {
        echo "volume-".$target.".html";
        return;
    }
    if($tType=="basketDetail" && getCurrentLanguage() == "en") {
        echo "basket-prehled.phtml";
        return;
    }
    if($tType=="basketDetail" && getCurrentLanguage() == "cs") {
        echo "kosik-prehled.phtml";
        return;
    }
    if($tType=="static") {
        echo $target.".phtml";
        return;
    }
    
    return "/";
}

/**
 * Translate of expression on front-end
 * @param string $expr Expression for translation
 * @param string $language Desired language
 * @return string Translated term
 */
function translate($expr, $language) {
    if($expr == "skladem") {
        if($language == "cs") return "Máme více než  5 inkoustů skladem!";
        else { return "Already more than 5 ink in stock!"; }
    }
    else if($expr == "add-ink-to-basket") {
        if($language == "cs") return "Vložit inkoust do košíku";
        else { return "Add ink to cart"; }
    }
    else if($expr== "items-in-basket") {
        if($language == "cs") return "položek v košíku";
        else { return "items in basket"; }
    }
    else if($expr == "4-days-expeded") {
        if($language == "cs") return "Odešleme do 4 dnů.";
        else { return "Dispatched in 4 days."; }
    }
    else if($expr == "basket-your-basket") {
        if($language == "cs") return "Váš košík";
        else { return "Your basket"; }
    }
    else if($expr == "basket-is-empty") {
        if($language == "cs") return "je <strong>prázdný!</strong>";
        else { return "is <strong>empty!</strong>"; }
    }
    else if($expr== "basket-total") {
        if($language == "cs") return "Celkem: ";
        else { return "Total: "; }
    }
    else if($expr== "modra") {
        if($language == "cs") return "modrá";
        else { return "blue"; }
    }
    else if($expr== "cerna") {
        if($language == "cs") return "černá";
        else { return "black"; }
    }
    else if($expr== "indigo") {
        if($language == "cs") return "modrofialová";
        else { return "indigo"; }
    }
    else if($expr== "purpurova") {
        if($language == "cs") return "purpurová";
        else { return "magenta"; }
    }
    else if($expr== "zluta") {
        if($language == "cs") return "žlutá";
        else { return "yellow"; }
    }
    else if($expr== "selected-color") {
        if($language == "cs") return "Zvolená barva";
        else { return "Selected color"; }
    }
    else if($expr== "selected-volume") {
        if($language == "cs") return "Vybrán objem";
        else { return "Bottle volume"; }
    }
    else if($expr== "50-ml") {
        if($language == "cs") return "50 ml";
        else { return "50 ml (&Tilde; 0.42 US gill)"; }
    }
    else if($expr== "100-ml") {
        if($language == "cs") return "100 ml";
        else { return "100 ml (&Tilde; 0.84 US gill)"; }
    }
    else if($expr== "product-overview") {
        if($language == "cs") return "Přehled všech produktů";
        else { return "Product overview"; }
    }
    else if($expr== "selection-reset") {
        if($language == "cs") return "resetovat výběr";
        else { return "no sorting"; }
    }
    else if($expr== "conditions-of-use") {
        if($language == "cs") return "Prohlášení";
        else { return "Conditions of Use"; }
    }
    else if($expr== "your-price") {
        if($language == "cs") return "Vaše cena";
        else { return "Price"; }
    }
    else if($expr== "all-products") {
        if($language == "cs") return "Všechny produkty";
        else { return "All products"; }
    }
    else if($expr == "producer") {
        if($language == "cs") return "Dodavatel";
        else { return "Producer"; }
    }
    else if($expr == "product-code") {
        if($language == "cs") return "Kód výrobku";
        else { return "Product code"; }
    }
    else if($expr == "origin") {
        if($language == "cs") return "Původ";
        else { return "Origin"; }
    }
    else if($expr == "ink-added-in-basket") {
        if($language == "cs") return "Inkoust byl přidán do košíku.";
        else { return "Ink is added in the cart."; }
    }
    else if($expr == "item-added") {
        if($language == "cs") return "Zboží přidáno do košíku";
        else { return "Item is added in the cart."; }
    }
    else if($expr == "back-to-product") {
        if($language == "cs") return "Zpátky k produktu";
        else { return "Continue shopping"; }
    }
    else if($expr == "proceed-to-checkout") {
        if($language == "cs") return "Přejít do košíku";
        else { return "Proceed to checkout"; }
    }
    else if($expr == "shopping-basket") {
        if($language == "cs") return "Nákupní košík";
        else { return "Shopping basket"; }
    }
    else if($expr == "is-in-stock") {
        if($language == "cs") return "Dostupnost";
        else { return "In stock?"; }
    }
    else if($expr == "in-stock") {
        if($language == "cs") return "Skladem";
        else {                return "In stock"; }
    }
    else if($expr == "count") {
        if($language == "cs") return "Kusů";
        else {                return "Count"; }
    }
    else if($expr == "price-item") {
        if($language == "cs") return "Cena/Kus";
        else {                return "Price/Item"; }
    }
    else if($expr == "shipping-packing-fee") {
        if($language == "cs") return "Dopravné a balné";
        else {                return "Shipping and packing"; }
    }
    else if($expr == "ulozenka-service") {
        if($language == "cs") return "Síť Úloženka";
        else {                return "Ulozenka service"; }
    }
    else if($expr == "free-shipping") {
        if($language == "cs") return "Dopravu máte zdarma!";
        else {                return "For free!"; }
    }
    else if($expr == "to-free-shipping-buy") {
        if($language == "cs") return "Pro dopravu zdarma nutno ještě nakoupit za ";
        else {                return "For free shipping you have to buy items for "; }
    }
    else if($expr == "order") {
        if($language == "cs") return "Objednávka";
        else {                return "Order"; }
    }
    else if($expr == "delivery") {
        if($language == "cs") return "Způsob doručení";
        else {                return "Delivery option"; }
    }
    else if($expr == "delivery-option") {
        if($language == "cs") return "Výběr způsobu a místa doručení zásilky.";
        else {                return "Choose delivery option and destination."; }
    }
    else if($expr == "destination") {
        if($language == "cs") return "Cílová země";
        else {                return "Destination country"; }
    }
    else if($expr == "shipper") {
        if($language == "cs") return "Dopravce";
        else {                return "Shipper"; }
    }
    else if($expr == "czech-republic") {
        if($language == "cs") return "Česká republika";
        else {                return "Czech republic"; }
    }
    else if($expr == "slovak-republic") {
        if($language == "cs") return "Slovensko";
        else {                return "Slovakia"; }
    }
    else if($expr == "select-ulozenka") {
        if($language == "cs") return "Vyberte pobočku sítě Úloženka pro vyzvednutí zásilky:";
        else {                return "Select Ulozenka service branch:"; }
    }
    else if($expr == "address") {
        if($language == "cs") return "Údaje pro doručení a fakturaci";
        else {                return "Shipping address"; }
    }
    else if($expr == "all-required") {
        if($language == "cs") return "Vyplňte prosím všechny údaje níže!";
        else {                return "All fields are required!"; }
    }
    else if($expr == "billing-info") {
        if($language == "cs") return "Fakturační údaje";
        else {                return "Billing information"; }
    }
    else if($expr == "fast-information") {
        if($language == "cs") return "Rychlá navigace";
        else {                return "Options"; }
    }
    else if($expr == "link-to-shop") {
        if($language == "cs") return "Přejít do obchodu";
        else {                return "Link to shop"; }
    }
}

/**
 * Security clean
 * @param string $str Input string
 * @return string String with removed " and ' symbols
 */
function cleanTextField($str) {
    return str_replace("'", "‘", str_replace("\"", '“', strip_tags($str)));
}


session_start();