<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul>
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
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
    <?if ($arItem["DEPTH_LEVEL"] > 2) {
        continue;
    }?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["DEPTH_LEVEL"] == 1 && $arItem["IS_PARENT"]):?>
        <li><a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
            <ul>
	<?else:?>
         <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li><a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
        <?else:?>
            <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
        <?endif?>
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>
