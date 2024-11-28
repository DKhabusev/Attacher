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
$this->setFrameMode(true);?>
<form method="GET" action="<?=$arResult["FORM_ACTION"]?>" id="general_search_form">
    <input type="hidden" name="set_filter" value="Y">
    <input type="search" name="poisk" id="general_search"
           placeholder="Поиск" value="[%search_word|htmlit%]"
           class="placeholder js-autocomplete ui-autocomplete-input"
           data-autocomplete-url="/api/search" autocomplete="off">
<!--    <input type="text" name="q" value="" size="15" maxlength="50" />
    <input name="s" type="submit" value="<?/*=GetMessage("BSF_T_SEARCH_BUTTON");*/?>" />-->

    <button class="delete [%IF !search_word%]hidden[% END %]"><img
                src="<?=SITE_TEMPLATE_PATH?>/img/nice-x.svg" alt=""></button>
    <button class="loop"><img src="<?=SITE_TEMPLATE_PATH?>/img/loupe.svg" alt=""></button>
</form>