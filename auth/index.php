<?
$showFooter = false;
if ($_REQUEST['ajax_mode'] == 'Y') {
    require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
    if ($USER->GetID()) {
        $APPLICATION->IncludeComponent("bitrix:system.auth.form", "", Array());
        echo '<br>Вы авторизовались, обновление страницы...';
        echo '<script>setTimeout(function(){ location.reload(); }, 3000);</script>';
    } else {
        $APPLICATION->AuthForm('', false, false);
    }
    die;
} elseif (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Авторизация");
    $showFooter = true;
}

CJSCore::Init(["popup", "jquery"]);

// https://habr.com/ru/sandbox/103916/ - Основа скрипта
// https://dev.1c-bitrix.ru/community/webdev/user/64008/blog/5942/ - BX.PopupWindow
// http://realty.lyrmin.ru/bitrix/js/main/core/core_popup.js - BX.PopupWindowManager, onAfterPopupShow
// https://dev.1c-bitrix.ru/api_help/js_lib/ajax/bx_ajax.php - BX.ajax
// http://realty.lyrmin.ru/bitrix/js/main/core/core_ajax.js - BX.ajax.prepareForm
// https://dev.1c-bitrix.ru/api_help/main/reference/cmain/authform.php - $APPLICATION->AuthForm
?>

<?if ($USER->IsAuthorized()):?>
    <a href="<?=$APPLICATION->GetCurPage()?>?logout=yes" rel="nofollow"><b>Выход</b></a>
<?else:?>
    <?$jsAuthVariable = \Bitrix\Main\Security\Random::getString(20)?>
    <a href="#" onclick="<?=$jsAuthVariable?>.showPopup('/auth/')" rel="nofollow"><b>Авторизация</b></a>
    <script>
        let <?=$jsAuthVariable?> = {
            id: "modal_auth",
            popup: null,
            /**
             * 1. Обработка ссылок в форме модального окна для добавления в ссылку события onclick и выполнения
             * перехода по ссылке через запрос новой формы через AJAX
             * 2. Установка на форму обработчика onsubmit вместо стандартного перехода
             */
            convertLinks: function() {
                let links = $("#" + this.id + " a");
                links.each(function (i) {
                    $(this).attr('onclick', "<?=$jsAuthVariable?>.set('" + $(this).attr('href') + "')");
                });
                links.attr('href', '#');

                let form = $("#" + this.id + " form");
                form.attr('onsubmit', "<?=$jsAuthVariable?>.submit('" + form.attr('action') + "');return false;");
            },
            /**
             * Вывод модального окна с формой на странице при клике по ссылке
             * @param url - url с параметрами для определения какую форму показать
             */
            showPopup: function(url) {
                let app = this;
                this.popup = BX.PopupWindowManager.create(this.id, '', {
                    closeIcon: true,
                    autoHide: true,
                    draggable: {
                        restrict: true
                    },
                    closeByEsc: true,
                    content: this.getForm(url),
                    overlay: {
                        backgroundColor: 'black',
                        opacity: '20'
                    },
                    events: {
                        onPopupClose: function(PopupWindow) {
                            PopupWindow.destroy(); //удаление из DOM-дерева после закрытия
                        },
                        onAfterPopupShow: function (PopupWindow) {
                            app.convertLinks();
                        }
                    }
                });

                this.popup.show();
            },
            /**
             * Получение формы при открытии модального окна или при переходе по ссылке
             * @param url - url с параметрами для определения какую форму показать
             * @returns string - html код формы
             */
            getForm: function(url) {
                let content = null;
                url += (url.includes("?") ? '&' : '?') + 'ajax_mode=Y';
                BX.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'html',
                    async: false,
                    preparePost: false,
                    start: true,
                    processData: false, // Ошибка при переходе по ссылкам в форме
                    skipAuthCheck: true,
                    onsuccess: function(data) {
                        let html = BX.processHTML(data);
                        content = html.HTML;
                    },
                    onfailure: function(html, e) {
                        console.error('getForm onfailure html', html, e, this);
                    }
                });

                return content;
            },
            /**
             * Получение формы при переходе по ссылке и вывод её в модальном окне
             * @param url - url с параметрами ссылки
             */
            set: function(url) {
                let form = this.getForm(url);
                this.popup.setContent(form);
                this.popup.adjustPosition();
                this.convertLinks();
            },
            /**
             * Отправка данных формы и получение новой формы в ответе
             * @param url - url с параметрами ссылки
             */
            submit: function(url) {
                let app = this;
                let form = document.querySelector("#" + this.id + " form");
                let data = BX.ajax.prepareForm(form).data;
                data.ajax_mode = 'Y';

                BX.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    preparePost: true,
                    dataType: 'html',
                    async: false,
                    start: true,
                    processData: true,
                    skipAuthCheck: true,
                    onsuccess: function(data) {
                        let html = BX.processHTML(data);
                        app.popup.setContent(html.HTML);
                        app.convertLinks();
                    },
                    onfailure: function(html, e) {
                        console.error('getForm onfailure html', html, e, this);
                    }
                });
            }
        };
    </script>
<?endif?>
<?if ($showFooter) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
