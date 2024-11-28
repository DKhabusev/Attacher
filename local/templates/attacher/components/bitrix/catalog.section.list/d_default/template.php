<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if (!empty($arResult['SECTIONS'])): ?>
    <div class="inner_cats">
        <ul>
            <?foreach($arResult['SECTIONS'] as $arSection):?>
                <?
                    $curPage = $APPLICATION->GetCurPage(false);
                    $is_active = $arSection['SECTION_PAGE_URL'] == $curPage ? "active": "";
                ?>
                <li>
                    <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="<?=$is_active?>">
                        <div class="img_wrapper">
                            <?if (!empty($arSection['PICTURE'])): ?>
                            <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="">
                            <?endif?>
                        </div>
                        <div class="title"><?=$arSection["NAME"]?></div>
                    </a>
                </li>
            <?endforeach?>
        </ul>
    </div>
<?endif?>