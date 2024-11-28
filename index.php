<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle(""); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="mx_slider">
                <div class="inner">
                    <div class="big">
                        <a href="/catalog" class="img_wrapper"> <img src="<?=SITE_TEMPLATE_PATH?>/img/banner-5.webp" alt="">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</a>
                    </div>
                    <div class="side_top">
                        <a href="/catalog/tovary-dlya-ofisa-147752" class="img_wrapper"> <img src="<?=SITE_TEMPLATE_PATH?>/img/banner-6.webp" alt=""> </a>
                    </div>
                    <div class="side_bottom">
                        <a href="/catalog/filter/price-from-0/price-to-1143789/label-is-sale/apply" class="img_wrapper"> <img src="<?=SITE_TEMPLATE_PATH?>/img/banner-7.webp" alt=""> </a>
                    </div>
                </div>
                <div class="nav">
                    <button id="minus_slide">&lt;</button> <button id="plus_slide">&gt;</button>
                </div>
            </div>
        </div>
    </div>
    [% BLOCK PRODUCT_SLIDE_BLOCK %]


    <div class="full_page_catalog_block items_section">
        <div class="container">
            <div class="row">
                <div class="h1_wrapper">
                    <h2 class="h1">[% PRODUCT_SLIDE_NAME %]</h2>
                </div>
            </div>
            <div class="row">
                <div class="items_wrapper">
                    [% FOREACH good IN PRODUCT_LIST %]
                    <div class="item">
                        <div class="inner_wrapper">
                            <a href="#" title="[% IF FAVORITE_GOOD_ID_LIST.${good.id} %]Добавлено в избранное[% ELSE %]Добавить в избранное[% END %]" class="fav[% IF FAVORITE_GOOD_ID_LIST.${good.id} %] faved[% END %]" data-id="[% good.id %]"></a> <a href="[% good.url %]" class="link">
                                <div class="img_wrapper">
                                    [% PROCESS LABELS good=good %] [% TRY; USE File( MAIN_DIR _ good.photo_and_path_mini1 ) %] <img alt="[% good.header %]" src="[% good.photo_and_path_mini1 %]" title="[% good.header %]">
                                    [% CATCH File %] <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.webp" alt="">
                                    [%END%]
                                </div>
                                [% IF good.out_of_stock == 1 %]
                                <div class="price good_not_available">
                                    выведен из ассортимента
                                </div>
                                [% ELSE %] [% IF good.price &gt; 0 %]
                                <div class="price">
                                    <div class="price_value">
                                        [% PROCESS PRINT_PRICE price=good.price %]
                                    </div>
                                    [% IF good.old_price &amp;&amp; good.old_price &gt; good.price %]
                                    <div class="old_price">
                                        [% PROCESS PRINT_PRICE price=good.old_price %]
                                    </div>
                                    [% END %]
                                </div>
                                [% ELSE %]
                                <div class="price good_not_available">
                                    под заказ
                                </div>
                                [% END %]
                                <div>
                                    арт: [% good.artikul %]
                                </div>
                                <div class="short_desc">
                                    [% good.header %]
                                </div>
                                [% END %] </a>
                            [% IF good.out_of_stock == 0 %]
                            <div class="raiting">
                                [% IF 0 %] [% FOREACH i IN [1..5] %]
                                <div class="star [% IF i <= good.stars %]raited[% END %]">
                                </div>
                                [% END %] [% END %]
                            </div>
                            <div class="btm_wrapper">
                                <div class="good_counter number_wrapper">
                                    <button class="minus_good_count"> <img src="<?=SITE_TEMPLATE_PATH?>/img/num_arrow.svg" alt=""> </button> <input type="text" class="number basket_good_count[% IF basket.basket.good_ids.${good.id} %] update_basket_count[% END %]" value="[% basket.basket.good_ids.${good.id} ? basket.basket.good_ids.${good.id} : '1' %]" data-id="[% good.id %]" data-value="[% basket.basket.good_ids.${good.id} ? basket.basket.good_ids.${good.id} : '1' %]"> <button class="plus_good_count"> <img src="[%TEMPLATE_FOLDER%]img/num_arrow-right.svg" alt=""> </button>
                                </div>
                                [% IF basket.basket.good_ids.${good.id} %] <a href="/basket" class="shop_it disabled" data-id="[% good.id %]">В корзине</a>
                                [% ELSE %] <a href="#" class="add_basket shop_it" data-id="[% good.id %]">В корзину</a>
                                [% END %]
                            </div>
                            [% END %]
                        </div>
                    </div>
                    [% END %]
                </div>
                <a href="[% MORE_LINK %]" class="view_all">Смотреть все <img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-view-all.svg" alt=""></a>
            </div>
        </div>
    </div>
    [% END %] [% INCLUDE PRODUCT_SLIDE_BLOCK PRODUCT_SLIDE_NAME = 'Популярные товары' PRODUCT_LIST = popular_list MORE_LINK = '/catalog/filter/label-is-popular-goods/apply' %] [% INCLUDE PRODUCT_SLIDE_BLOCK PRODUCT_SLIDE_NAME = 'Новинки' PRODUCT_LIST = new_list MORE_LINK = '/catalog/filter/label-is-new/apply' %] [% INCLUDE PRODUCT_SLIDE_BLOCK PRODUCT_SLIDE_NAME = 'Распродажа' PRODUCT_LIST = raspr_list MORE_LINK = '/catalog/filter/label-is-sale/apply' %]


    <div class="gen_about_contacts">
        <div class="container">
            <div class="row">
                <div class="inner">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        Array(
                            "AREA_FILE_RECURSIVE" => "Y",
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "index_contacts",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/includes/index_contacts.php"
                        )
                    );?>
                    <div class="desc">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            Array(
                                "AREA_FILE_RECURSIVE" => "Y",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "description",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/includes/description.php"
                            )
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>