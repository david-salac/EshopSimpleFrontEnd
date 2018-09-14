/*
Table of products
*/
CREATE TABLE produkt (
    prodCode VARCHAR(64) NOT NULL UNIQUE,
    prodColorClass VARCHAR(128) NOT NULL, /* black, nastavi to cerne pozadi ve vypisu atd... */

    prodCsSEOname VARCHAR(256) NOT NULL PRIMARY KEY,
    prodCsName VARCHAR (256) NOT NULL,

    prodEnSEOname VARCHAR(256) NOT NULL UNIQUE,
    prodEnName VARCHAR (256) NOT NULL,

    prodColor ENUM('modra', 'indigo', 'cerna', 'zluta', 'purpurova'),
    
    prodVolume ENUM('50-ml', '100-ml'),
    
    prodCsShortDescription VARCHAR(512) NOT NULL,
    prodCsLongDescription VARCHAR(4096) NOT NULL,

    prodEnShortDescription VARCHAR(512) NOT NULL,
    prodEnLongDescription VARCHAR(4096) NOT NULL,

    prodCsTagDescription VARCHAR(180),
    prodEnTagDescription VARCHAR(180),

    prodCsTagKeywords VARCHAR(180),
    prodEnTagKeywords VARCHAR(180),

    priceBeforeAction INT,
    price INT NOT NULL, /* 128.00 */

    prodInStock ENUM('skladem', 'na-ceste'), /* in stock, on delivery */
    
    prodTitleImage VARCHAR(128) NOT NULL, /* modry-inkoust.png */
    prodImage1 VARCHAR (128), /* inkoust-modry (-mala | -stredni | -velka .jpg) */
    prodImage2 VARCHAR (128), /* inkoust-modry (-mala | -stredni | -velka .jpg) */
    prodImage3 VARCHAR (128), /* inkoust-modry (-mala | -stredni | -velka .jpg) */
    prodImage4 VARCHAR (128), /* inkoust-modry (-mala | -stredni | -velka .jpg) */
    prodImage5 VARCHAR (128), /* inkoust-modry (-mala | -stredni | -velka .jpg) */
    prodImage6 VARCHAR (128) /* inkoust-modry (-mala | -stredni | -velka .jpg) */
);

CREATE TABLE message (
    mesHash VARCHAR(257) NOT NULL,
    mesLanguage VARCHAR(25),
    mesJmeno VARCHAR(255),
    mesAdresaelposty VARCHAR(255),
    mesPredmet VARCHAR(255),
    mesZprava VARCHAR(1024),
    PRIMARY KEY(mesHash)
);
CREATE TABLE Ulozenka (
    ulozenka_id VARCHAR(20) PRIMARY KEY,
    ulozenka_nazev VARCHAR(256) NOT NULL,
    ulozenka_stat VARCHAR(10) NOT NULL
);


INSERT INTO produkt VALUES("10M50",
"blueInkItem", 
"modry-vodeodolny-inkoust-do-plnicich-per-annella-50-ml", 
"Modrý voděodolný inkoust do plnících per ANNELLA 50 ml", 
"blue-waterproof-ink-for-fountain-pens-annella-50-ml", 
"Blue waterproof ink for fountain pens ANNELLA 50 ml",
"modra",
"50-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) modré barvy v lahvičce 50 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of blue color in bottle of 50 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera modré barvy 50 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolností.",
"This is high quality waterproof ink of blue color in bottle of 50 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, modrý inkoust, plnící pero, modrá",
"waterproof ink, blue ink, fountain pen, blue",
NULL, 599,
"skladem",
"title_inkoust_ink_annella_modra_blue", 
"inkoust_annella_modry_middle", NULL, NULL, NULL, NULL, NULL
);



INSERT INTO produkt VALUES("20C50",
"blackInkItem", 
"cerny-vodeodolny-inkoust-do-plnicich-per-annella-50-ml", 
"Černý voděodolný inkoust do plnících per ANNELLA 50 ml", 
"black-waterproof-ink-for-fountain-pens-annella-50-ml", 
"Black waterproof ink for fountain pens ANNELLA 50 ml",
"cerna",
"50-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) černé barvy v lahvičce 50 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of black color in bottle of 50 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera černé barvy 50 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolností.",
"This is high quality waterproof ink of black color in bottle of 50 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, černý inkoust, plnící pero, černá",
"waterproof ink, black ink, fountain pen, black",
NULL, 599,
"skladem",
"title_inkoust_ink_annella_cerna_black", 
"inkoust_annella_cerny_middle", NULL, NULL, NULL, NULL, NULL
);



INSERT INTO produkt VALUES("30I50",
"indigoInkItem", 
"modrofialovy-vodeodolny-inkoust-do-plnicich-per-annella-50-ml", 
"Modrofialový voděodolný inkoust do plnících per ANNELLA 50 ml", 
"indigo-waterproof-ink-for-fountain-pens-annella-50-ml", 
"Indigo waterproof ink for fountain pens ANNELLA 50 ml",
"indigo",
"50-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) modrofialové barvy v lahvičce 50 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of indigo color in bottle of 50 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera modrofialové barvy 50 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká svou barevnou stálostí.",
"This is high quality waterproof ink of indigo color in bottle of 50 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, modrofialový inkoust, plnící pero, tmavě modrá",
"waterproof ink, indigo ink, fountain pen, indigo",
NULL, 599,
"skladem",
"title_inkoust_ink_annella_modrofialova_indigo", 
"inkoust_annella_indigo_middle", NULL, NULL, NULL, NULL, NULL
);


INSERT INTO produkt VALUES("40P50",
"magentaInkItem", 
"purpurovy-vodeodolny-inkoust-do-plnicich-per-annella-50-ml", 
"Purpurový voděodolný inkoust do plnících per ANNELLA 50 ml", 
"magenta-waterproof-ink-for-fountain-pens-annella-50-ml", 
"Magenta waterproof ink for fountain pens ANNELLA 50 ml",
"purpurova",
"50-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) purpurové barvy v lahvičce 50 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of magenta color in bottle of 50 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera purpurové barvy 50 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolnostíí.",
"This is high quality waterproof ink of magenta color in bottle of 50 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, purpurový inkoust, plnící pero, purpurová",
"waterproof ink, magenta ink, fountain pen, magenta",
NULL, 599,
"skladem",
"title_inkoust_ink_annella_purpurova_magenta", 
"inkoust_annella_magenta_middle", NULL, NULL, NULL, NULL, NULL
);



INSERT INTO produkt VALUES("50Z50",
"yellowInkItem", 
"zluty-vodeodolny-inkoust-do-plnicich-per-annella-50-ml", 
"Žlutý voděodolný inkoust do plnících per ANNELLA 50 ml", 
"yellow-waterproof-ink-for-fountain-pens-annella-50-ml", 
"Yellow waterproof ink for fountain pens ANNELLA 50 ml",
"zluta",
"50-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) žluté barvy v lahvičce 50 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of yellow color in bottle of 50 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera žluté barvy 50 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolností.",
"This is high quality waterproof ink of yellow color in bottle of 50 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, žlutý inkoust, plnící pero, žlutá",
"waterproof ink, yellow ink, fountain pen, yellow",
NULL, 599,
"skladem",
"title_inkoust_ink_annella_zluta_yellow", 
"inkoust_annella_zluta_middle", NULL, NULL, NULL, NULL, NULL
);

/*-----------------------*/


INSERT INTO produkt VALUES("10M00",
"blueInkItem", 
"modry-vodeodolny-inkoust-do-plnicich-per-annella-100-ml", 
"Modrý voděodolný inkoust do plnících per ANNELLA 100 ml", 
"blue-waterproof-ink-for-fountain-pens-annella-100-ml", 
"Blue waterproof ink for fountain pens ANNELLA 100 ml",
"modra",
"100-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) modré barvy v lahvičce 100 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of blue color in bottle of 100 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera modré barvy 100 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolností.",
"This is high quality waterproof ink of blue color in bottle of 100 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, modrý inkoust, plnící pero, modrá",
"waterproof ink, blue ink, fountain pen, blue",
NULL, 799,
"skladem",
"title_inkoust_ink_annella_modra_blue_100", 
"inkoust_annella_modry_100_middle", NULL, NULL, NULL, NULL, NULL
);



INSERT INTO produkt VALUES("20C00",
"blackInkItem", 
"cerny-vodeodolny-inkoust-do-plnicich-per-annella-100-ml", 
"Černý voděodolný inkoust do plnících per ANNELLA 100 ml", 
"black-waterproof-ink-for-fountain-pens-annella-100-ml", 
"Black waterproof ink for fountain pens ANNELLA 100 ml",
"cerna",
"100-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) černé barvy v lahvičce 100 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of black color in bottle of 100 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera černé barvy 100 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolností.",
"This is high quality waterproof ink of black color in bottle of 100 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, černý inkoust, plnící pero, černá",
"waterproof ink, black ink, fountain pen, black",
NULL, 799,
"skladem",
"title_inkoust_ink_annella_cerna_black_100", 
"inkoust_annella_cerny_100_middle", NULL, NULL, NULL, NULL, NULL
);




INSERT INTO produkt VALUES("30I00",
"indigoInkItem", 
"modrofialovy-vodeodolny-inkoust-do-plnicich-per-annella-100-ml", 
"Modrofialový voděodolný inkoust do plnících per ANNELLA 100 ml", 
"indigo-waterproof-ink-for-fountain-pens-annella-100-ml", 
"Indigo waterproof ink for fountain pens ANNELLA 100 ml",
"indigo",
"100-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) modrofialové barvy v lahvičce 100 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of indigo color in bottle of 100 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera modrofialové barvy 100 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká svou barevnou stálostí.",
"This is high quality waterproof ink of indigo color in bottle of 100 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, modrofialový inkoust, plnící pero, tmavě modrá",
"waterproof ink, indigo ink, fountain pen, indigo",
NULL, 799,
"skladem",
"title_inkoust_ink_annella_modrofialova_indigo_100", 
"inkoust_annella_modrofialovy_100_middle", NULL, NULL, NULL, NULL, NULL
);

INSERT INTO produkt VALUES("40P00",
"magentaInkItem", 
"purpurovy-vodeodolny-inkoust-do-plnicich-per-annella-100-ml", 
"Purpurový voděodolný inkoust do plnících per ANNELLA 100 ml", 
"magenta-waterproof-ink-for-fountain-pens-annella-100-ml", 
"Magenta waterproof ink for fountain pens ANNELLA 100 ml",
"purpurova",
"100-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) purpurové barvy v lahvičce 100 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of magenta color in bottle of 100 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera purpurové barvy 100 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolnostíí.",
"This is high quality waterproof ink of magenta color in bottle of 100 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, purpurový inkoust, plnící pero, purpurová",
"waterproof ink, magenta ink, fountain pen, magenta",
NULL, 799,
"skladem",
"title_inkoust_ink_annella_purpurova_magenta_100", 
"inkoust_annella_purpurova_100_middle", NULL, NULL, NULL, NULL, NULL
);



INSERT INTO produkt VALUES("50Z00",
"yellowInkItem", 
"zluty-vodeodolny-inkoust-do-plnicich-per-annella-100-ml", 
"Žlutý voděodolný inkoust do plnících per ANNELLA 100 ml", 
"yellow-waterproof-ink-for-fountain-pens-annella-100-ml", 
"Yellow waterproof ink for fountain pens ANNELLA 100 ml",
"zluta",
"100-ml",
"Představuje kvalitní voděodolný inkoust (nerozpustný ve vodě) žluté barvy v lahvičce 100 ml. Inkoust je pH neutrální a tudíž neleptá hroty per.
<p>Jedná se o kvalitní inkoust na pigmentové bázi vyznačující se stálostí barev a dlouhou výdrží.</p>", 
"dlouhy popis",
"This is high quality waterproof ink of yellow color in bottle of 100 ml volume. This ink is pH neutral which means that pen does not corrode.
<p>This ink is pigment based high quality ink. Is is remarkable because of color stability and resistance.</p>",
"long description",
"Kvalitní voděodolný inkoust do plnícího pera žluté barvy 100 ml. Je vhodný pro psaní delších dokumentů a archiválií. Vyniká barevnou stálostí a odolností.",
"This is high quality waterproof ink of yellow color in bottle of 100 ml volume. The advantage of ink is pH neutral composition that does not damage your pen.",
"voděodolný inkoust, žlutý inkoust, plnící pero, žlutá",
"waterproof ink, yellow ink, fountain pen, yellow",
NULL, 799,
"skladem",
"title_inkoust_ink_annella_zluta_yellow_100", 
"inkoust_annella_zluta_100_middle", NULL, NULL, NULL, NULL, NULL
);