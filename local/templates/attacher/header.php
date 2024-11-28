<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$CurDir = $APPLICATION->GetCurDir();
$CurUri = $APPLICATION->GetCurUri();
?>
<!doctype html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <?

    use Bitrix\Main\Page\Asset;
    use Bitrix\Main\UI\Extension;
    // JS
    CJSCore::Init(array("jquery3"));
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/fancy/jquery.fancybox.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/myscripts.min.js');
    // CSS;
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/js/fancy/jquery.fancybox.min.css');
    //Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/libs.css');
    // HEADERS
    $APPLICATION->ShowHead();
    ?>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title><? $APPLICATION->ShowTitle() ?></title>
</head>

<body>
<? $APPLICATION->ShowPanel(); ?>

<noindex>
    <svg style="display: none;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <symbol viewBox="0 0 24 24" id="ui_arrow_down">
                <path clip-rule="evenodd" d="M5.46967 8.46967C5.17678 8.76256 5.17678 9.23744 5.46967 9.53033L10.7626 14.8232C11.446 15.5066 12.554 15.5066 13.2374 14.8232L18.5303 9.53033C18.8232 9.23744 18.8232 8.76256 18.5303 8.46967C18.2374 8.17678 17.7626 8.17678 17.4697 8.46967L12.1768 13.7626C12.0791 13.8602 11.9209 13.8602 11.8232 13.7626L6.53033 8.46967C6.23744 8.17678 5.76256 8.17678 5.46967 8.46967Z"></path>
            </symbol>
            <symbol viewBox="0 0 24 24" id="ui_arrow_up">
                <path clip-rule="evenodd" d="M5.46967 14.7803C5.17678 14.4874 5.17678 14.0126 5.46967 13.7197L10.7626 8.42678C11.446 7.74336 12.554 7.74336 13.2374 8.42678L18.5303 13.7197C18.8232 14.0126 18.8232 14.4874 18.5303 14.7803C18.2374 15.0732 17.7626 15.0732 17.4697 14.7803L12.1768 9.48744C12.0791 9.38981 11.9209 9.38981 11.8232 9.48744L6.53033 14.7803C6.23744 15.0732 5.76256 15.0732 5.46967 14.7803Z"></path>
            </symbol>
            <symbol viewBox="0 0 24 24" id="catalog_icon_open">
                <path clip-rule="evenodd" d="M3.25 5C3.25 4.58579 3.58579 4.25 4 4.25H20C20.4142 4.25 20.75 4.58579 20.75 5C20.75 5.41421 20.4142 5.75 20 5.75H4C3.58579 5.75 3.25 5.41421 3.25 5Z"></path>
                <path clip-rule="evenodd" d="M3.25 12C3.25 11.5858 3.58579 11.25 4 11.25H20C20.4142 11.25 20.75 11.5858 20.75 12C20.75 12.4142 20.4142 12.75 20 12.75H4C3.58579 12.75 3.25 12.4142 3.25 12Z"></path>
                <path clip-rule="evenodd" d="M3.25 19C3.25 18.5858 3.58579 18.25 4 18.25H20C20.4142 18.25 20.75 18.5858 20.75 19C20.75 19.4142 20.4142 19.75 20 19.75H4C3.58579 19.75 3.25 19.4142 3.25 19Z"></path>
            </symbol>
            <symbol viewBox="0 0 24 24" id="catalog_icon_close">
                <path clip-rule="evenodd" d="M4.46967 4.46967C4.76256 4.17678 5.23744 4.17678 5.53033 4.46967L12 10.9393L18.4697 4.46967C18.7626 4.17678 19.2374 4.17678 19.5303 4.46967C19.8232 4.76256 19.8232 5.23744 19.5303 5.53033L13.0607 12L19.5303 18.4697C19.8232 18.7626 19.8232 19.2374 19.5303 19.5303C19.2374 19.8232 18.7626 19.8232 18.4697 19.5303L12 13.0607L5.53033 19.5303C5.23744 19.8232 4.76256 19.8232 4.46967 19.5303C4.17678 19.2374 4.17678 18.7626 4.46967 18.4697L10.9393 12L4.46967 5.53033C4.17678 5.23744 4.17678 4.76256 4.46967 4.46967Z"></path>
            </symbol>
            <symbol viewBox="0 0 24 24" id="catalog_icon_arrow_right">
                <path clip-rule="evenodd" d="M8.46967 18.5303C8.76256 18.8232 9.23744 18.8232 9.53033 18.5303L14.8232 13.2374C15.5066 12.554 15.5066 11.446 14.8232 10.7626L9.53033 5.46967C9.23744 5.17678 8.76256 5.17678 8.46967 5.46967C8.17678 5.76256 8.17678 6.23744 8.46967 6.53033L13.7626 11.8232C13.8602 11.9209 13.8602 12.0791 13.7626 12.1768L8.46967 17.4697C8.17678 17.7626 8.17678 18.2374 8.46967 18.5303Z"></path>
            </symbol>
        </defs>
    </svg>
</noindex>

<header>

    <div class="container top_menu">
        <div class="row">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top_header_menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N",
                ),
                false
            ); ?>
            <div class="right_side">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    Array(
                        "AREA_FILE_RECURSIVE" => "Y",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "rightside",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/local/includes/email.php"
                    )
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    Array(
                        "AREA_FILE_RECURSIVE" => "Y",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "rightside",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/local/includes/tel_number.php"
                    )
                );?>
            </div>
        </div>
    </div>

    <div class="middle">
        <div class="container">
            <div class="row align-items">
                <a href="/" class="logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo.svg" alt=""></a>

                <div class="ui">
                    <ul>
                        <li>
                            <div>
                                <a href="/favorite">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/heart.svg" alt="">
                                    <div class="index" id="fav_index">[% FAVORITE_GOOD_ID_LIST.size %]</div>
                                    <span>Избранное</span>
                                </a>
                            </div>
                        </li>

                        [% IF login_info.id %]
                        <li>
                            <div>
                                <a href="/lk">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/user.svg" alt="">
                                    <span>Профиль</span>
                                </a>
                            </div>
                        </li>
                        <!-- <li><a href="/enter?action=logout">выйти</a></li> -->
                        [% ELSE %]
                        <li>
                            <div class="user">
                                <a href="#" class="show_popup" data-popup-id="popup_login_app">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/user.svg" alt="">
                                    <span>Вход</span>
                                </a>
                            </div>
                        </li>
                        [% END %]

                        <li>
                            <div class="cart">

                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:sale.basket.basket.line",
                                    "",
                                    Array(
                                        "HIDE_ON_BASKET_PAGES" => "N",
                                        "PATH_TO_AUTHORIZE" => "",
                                        "PATH_TO_BASKET" => SITE_DIR."basket/",
                                        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                                        "PATH_TO_PROFILE" => "",
                                        "PATH_TO_REGISTER" => "",
                                        "POSITION_FIXED" => "N",
                                        "SHOW_AUTHOR" => "N",
                                        "SHOW_EMPTY_VALUES" => "Y",
                                        "SHOW_NUM_PRODUCTS" => "Y",
                                        "SHOW_PERSONAL_LINK" => "N",
                                        "SHOW_PRODUCTS" => "N",
                                        "SHOW_REGISTRATION" => "N",
                                        "SHOW_TOTAL_PRICE" => "N"
                                    )
                                );?>


                                <a href="/basket">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/shopping-cart.svg"
                                         alt="[%basket.basket.total_price||0%] руб.">
                                    <div class="index" id="basket_info">[%INCLUDE basket_info.tmpl%]</div>
                                    <span>Корзина</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="general_menu">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_header_catalog",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top_catalog",
                            "USE_EXT" => "Y"
                        )
                    );?>
                    <!--<ul>

                        <li class="catalog">
                            <div class="catalog-main">
                                <div class="catalog__button">
                                    <div class="toggle_menu">
                                        <svg class="catalog__icon catalog__icon--open" width="24" height="24">
                                            <use xlink:href="#catalog_icon_open"></use>
                                        </svg>
                                        <svg class="catalog__icon catalog__icon--close" width="24" height="24">
                                            <use xlink:href="#catalog_icon_close"></use>
                                        </svg>
                                    </div>
                                    <a href="#">
                                        <span>Каталог</span>
                                    </a>
                                </div>
                                [% INCLUDE main_menu.tmpl %]
                            </div>
                            <div class="catalog-mob">
                                <div class="catalog-mob__button">
                                    <div class="toggle_menu">
                                        <svg class="catalog__icon catalog__icon--open" width="24" height="24">
                                            <use xlink:href="#catalog_icon_open"></use>
                                        </svg>
                                        <svg class="catalog__icon catalog__icon--close" width="24" height="24">
                                            <use xlink:href="#catalog_icon_close"></use>
                                        </svg>
                                    </div>
                                    <a href="#">
                                        <span>Каталог</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>-->
                </div>



                <div class="search_area" style="visibility: hidden">
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:search.form",
                            "search",
                            Array(
                            "USE_SUGGEST" => "N",
                            "PAGE" => "#SITE_DIR#search/index.php"
                        )
                    );?>
                   <!-- <form method="GET" action="/catalog" id="general_search_form">
                        <input type="hidden" name="set_filter" value="Y">
                        <input type="search" name="poisk" id="general_search"
                               placeholder="Поиск" value="[%search_word|htmlit%]"
                               class="placeholder js-autocomplete ui-autocomplete-input"
                               data-autocomplete-url="/api/search" autocomplete="off">
                    </form>
                    <button class="delete [%IF !search_word%]hidden[% END %]"><img
                                src="<?/*=SITE_TEMPLATE_PATH*/?>/img/nice-x.svg" alt=""></button>
                    <button class="loop"><img src="<?/*=SITE_TEMPLATE_PATH*/?>/img/loupe.svg" alt=""></button>-->
                </div>
            </div>
        </div>
    </div>

</header>

