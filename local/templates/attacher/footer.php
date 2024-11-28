<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="inner">
                <div class="logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/footer-logo.svg" alt=""></div>
                <div class="addr">
                Тел:
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            Array(
                                "AREA_FILE_RECURSIVE" => "Y",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "bottomside",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/includes/tel_number.php"
                            )
                        );?>

                    <br><br>
                Почта:
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            Array(
                                "AREA_FILE_RECURSIVE" => "Y",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "bottomside",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/includes/email.php"
                            )
                        );?>

                </div>

                <ul class="menu">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom_menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "bottom",
                            "USE_EXT" => "N",
                        ),
                        false
                    ); ?>

                    <!--[%FOREACH m IN bottom_menu%]
                    <li><a href="[%m.url%]">[%m.header%]</a></li>
                    [%END%]-->
                </ul>
                <div class="cprt">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        Array(
                            "AREA_FILE_RECURSIVE" => "Y",
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "copyright",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/includes/copyright.php"
                        )
                    );?>
                    <div class="counter">
                    </div>
                    <!--/noindex-->
                </div>

            </div>
        </div>
    </div>
</footer>

<!--<script src="/templates/js/popup_login.js?154"></script>-->

<!--<div id="popup_login_app">
    <div class="popup_wrapper">
        <div class="popup" :class="{wider : tabs['reg'].visible}">
            <a href="#" class="close close_popup">
                <svg xmlns="http://www.w3.org/2000/svg" width="64.756" height="64.756" viewBox="0 0 64.756 64.756">
                    <g id="Group_17" data-name="Group 17" transform="translate(-1623.359 -72.879)">
                        <path id="Path_32" data-name="Path 32" d="M1685.994,75l-60.514,60.514" fill="none"
                              stroke="#8b8b8b" stroke-linecap="round" stroke-width="3" />
                        <path id="Path_33" data-name="Path 33" d="M1625.48,75l60.514,60.514"
                              transform="translate(0)" fill="none" stroke="#8b8b8b" stroke-linecap="round"
                              stroke-width="3" />
                    </g>
                </svg>
            </a>

            <div class="nav">
                <ul v-if="!tabs['member'].visible">

                    <li v-for="(tab,tab_name) in tabs" :class="{current : tab.visible}">
                        <button @click="set_current(tab_name)">{{tab.name}}</button>
                    </li>

                </ul>
            </div>

            <form v-for="(tab, tab_name) in tabs" :action="'/' + tab_name" method="POST" novalidate="true"
                  v-bind:class="{current : tab.visible, special : tab_name=='reg' & tab.visible}">
                <input type='hidden' name='action' value='form_send'>
                <h2 class="h2">{{tab.title}}</h2>
                <p>{{tab.pretitle}}</p>
                <div v-for="(element, name) in tab.form" class="input_wrapper" v-if="show(tab_name, element.set_show)">

                    <div v-if="element.type == 'submit'">
                        <input :type="element.type" :disabled="!tab.validated" class="btn" :value="element.value">
                        <p class="policy">Заполняя форму, Вы даете согласие на <a href="/securitypolicy">обработку своих персональных данных</a></p>
                    </div>

                    <div v-else-if="element.type == 'back'">
                        <a href="#" class="back" @click="goback">{{element.value}}</a>
                    </div>

                    <div v-else-if="element.type == 'member'">
                        <button @click.prevent="set_current('member')">{{element.value}}</button>
                    </div>

                    <div v-else-if="element.type == 'radio'">
                        <div v-for="(option, val) in element.list">
                            <input :type="element.type" :name="element.name" @input="checking(tab)" v-model="element.value" :value="val"
                                   :id="'form' + '_' + tab_name + '_' + name + val">
                            <label :for="'form' + '_' + tab_name + '_' + name + val">{{option}}</label>
                        </div>
                    </div>

                    <div v-else-if="element.type == 'select'">
                        <label :for="'form' + '_' + tab_name + '_' + name">{{element.label}}</label>
                        <select :name="element.name" @input="checking(tab)" v-model="element.value" :id="'form' + '_' + tab_name + '_' + name">
                            <option v-for="(option, val) in element.list" :value="val">{{option}}</option>
                        </select>
                    </div>

                    <div v-else-if="element.type == 'checkbox'">
                        <input :type="element.type" :name="element.name" @change="checking(tab)" v-model="element.value"
                               :id="'form' + '_' + tab_name + '_' + name">
                        <label :for="'form' + '_' + tab_name + '_' + name" v-html="element.label"></label>
                    </div>

                    <div v-else-if="element.type == 'tel'">
                        <label :for="'form' + '_' + tab_name + '_' + name">{{element.label}}</label>
                        <input :type="element.type" @input="checking(tab)" v-phone v-model="element.value"
                               :required="element.required" :name="element.name"
                               :id="'form' + '_' + tab_name + '_' + name" placeholder='8(___)___-__-__'>
                    </div>

                    <div v-else>
                        <div>
                            <label :for="'form' + '_' + tab_name + '_' + name">{{element.label}}</label>
                            <input :type="element.type" :required="element.required" @input="checking(tab)"
                                   v-model="element.value" :name="element.name" :id="'form' + '_' + tab_name + '_' + name">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>--> <!-- Поп-ап авторизации -->

</body>
</html>