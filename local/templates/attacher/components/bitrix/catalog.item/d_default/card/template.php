<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>
<?/*pre($item);*/?>
<div class="item">
    <div class="inner_wrapper">
        <a href="#" title="Добавить в избранное" class="fav" data-id="120630"></a>
        <a href="<?=$item["DETAIL_PAGE_URL"]?>" class="link">
            <div class="img_wrapper">
                <div class="label"></div>
                <img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"
                     alt="<?=$item["DETAIL_PICTURE"]["ALT"]?>"
                     title="<?=$item["DETAIL_PICTURE"]["TITLE"]?>"></div>
            <div class="price">
                <div class="price_value"><?=$price['PRINT_RATIO_BASE_PRICE']?></div>
            </div>
            <div class="art"><?=$item['DISPLAY_PROPERTIES']['ART']['VALUE']?></div>
            <div class="short_desc"><?=$item["NAME"]?></div>
        </a>

        <div class="raiting"></div>

        <div class="btm_wrapper">
            <div class="good_counter number_wrapper">
                <button class="minus_good_count" id="<?=$itemIds['QUANTITY_DOWN']?>">
                    <img src="/local/templates/attacher/img/num_arrow.svg" alt="">
                </button>
                <input type="number" class="number basket_good_count" id="<?=$itemIds['QUANTITY']?>" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="1" data-id="120630" data-value="1">
                <button class="plus_good_count" id="<?=$itemIds['QUANTITY_UP']?>">
                    <img src="/local/templates/attacher/img/num_arrow-right.svg" alt="">
                </button>
            </div>
            <a href="javascript:void(0)" title="Добавить в корзину" class="add_basket shop_it" data-id="120630"
               id="<?=$itemIds['BUY_LINK']?>" rel="nofollow"><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></a>
        </div>



        <?

        if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
            foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
                switch ($blockName) {

                    case 'buttons':
                        ?>
                        <div class="product-item-info-container product-item-hidden" data-entity="buttons-block">
                            <?
                            if (!$haveOffers) {
                                if ($actualItem['CAN_BUY']) {
                                    ?>
                                    <div class="product-item-button-container" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
                                        <a class="btn btn-default <?= $buttonSizeClass ?>"
                                           id="<?= $itemIds['BUY_LINK'] ?>"
                                           href="javascript:void(0)" rel="nofollow">
                                            <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                        </a>
                                    </div>
                                    <?
                                } else {
                                    ?>
                                    <div class="product-item-button-container">
                                        <?
                                        if ($showSubscribe) {
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.product.subscribe',
                                                '',
                                                array(
                                                    'PRODUCT_ID' => $actualItem['ID'],
                                                    'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                    'BUTTON_CLASS' => 'btn btn-default ' . $buttonSizeClass,
                                                    'DEFAULT_DISPLAY' => true,
                                                    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                        }
                                        ?>
                                        <a class="btn btn-link <?= $buttonSizeClass ?>"
                                           id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" href="javascript:void(0)"
                                           rel="nofollow">
                                            <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                        </a>
                                    </div>
                                    <?
                                }
                            } else {
                                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                                    ?>
                                    <div class="product-item-button-container">
                                        <?
                                        if ($showSubscribe) {
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.product.subscribe',
                                                '',
                                                array(
                                                    'PRODUCT_ID' => $item['ID'],
                                                    'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                    'BUTTON_CLASS' => 'btn btn-default ' . $buttonSizeClass,
                                                    'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
                                                    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                        }
                                        ?>
                                        <a class="btn btn-link <?= $buttonSizeClass ?>"
                                           id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" href="javascript:void(0)"
                                           rel="nofollow"
                                            <?= ($actualItem['CAN_BUY'] ? 'style="display: none;"' : '') ?>>
                                            <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                        </a>
                                        <div id="<?= $itemIds['BASKET_ACTIONS'] ?>" <?= ($actualItem['CAN_BUY'] ? '' : 'style="display: none;"') ?>>
                                            <a class="btn btn-default <?= $buttonSizeClass ?>"
                                               id="<?= $itemIds['BUY_LINK'] ?>"
                                               href="javascript:void(0)" rel="nofollow">
                                                <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                            </a>
                                        </div>
                                    </div>
                                    <?
                                } else {
                                    ?>
                                    <div class="product-item-button-container">
                                        <a class="btn btn-default <?= $buttonSizeClass ?>"
                                           href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                            <?= $arParams['MESS_BTN_DETAIL'] ?>
                                        </a>
                                    </div>
                                    <?
                                }
                            }
                            ?>
                        </div>
                        <?
                        break;

                    case 'props':
                        if (!$haveOffers) {
                            if (!empty($item['DISPLAY_PROPERTIES'])) {
                                ?>
                                <div class="product-item-info-container product-item-hidden" data-entity="props-block">
                                    <dl class="product-item-properties">
                                        <?
                                        foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty) {
                                            ?>
                                            <dt<?= (!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '') ?>>
                                                <?= $displayProperty['NAME'] ?>
                                            </dt>
                                            <dd<?= (!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '') ?>>
                                                <?= (is_array($displayProperty['DISPLAY_VALUE'])
                                                    ? implode(' / ', $displayProperty['DISPLAY_VALUE'])
                                                    : $displayProperty['DISPLAY_VALUE']) ?>
                                            </dd>
                                            <?
                                        }
                                        ?>
                                    </dl>
                                </div>
                                <?
                            }

                            if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES'])) {
                                ?>
                                <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
                                    <?
                                    if (!empty($item['PRODUCT_PROPERTIES_FILL'])) {
                                        foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                                            ?>
                                            <input type="hidden"
                                                   name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                                                   value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                                            <?
                                            unset($item['PRODUCT_PROPERTIES'][$propID]);
                                        }
                                    }

                                    if (!empty($item['PRODUCT_PROPERTIES'])) {
                                        ?>
                                        <table>
                                            <?
                                            foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                                ?>
                                                <tr>
                                                    <td><?= $item['PROPERTIES'][$propID]['NAME'] ?></td>
                                                    <td>
                                                        <?
                                                        if (
                                                            $item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
                                                            && $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
                                                        ) {
                                                            foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                ?>
                                                                <label>
                                                                    <? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
                                                                    <input type="radio"
                                                                           name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                                                                           value="<?= $valueID ?>" <?= $checked ?>>
                                                                    <?= $value ?>
                                                                </label>
                                                                <br/>
                                                                <?
                                                            }
                                                        } else {
                                                            ?>
                                                            <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]">
                                                                <?
                                                                foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                    $selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?= $valueID ?>" <?= $selected ?>>
                                                                        <?= $value ?>
                                                                    </option>
                                                                    <?
                                                                }
                                                                ?>
                                                            </select>
                                                            <?
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?
                                            }
                                            ?>
                                        </table>
                                        <?
                                    }
                                    ?>
                                </div>
                                <?
                            }
                        }
                        break;
                }
            }
        }
        ?>
    </div>
</div>