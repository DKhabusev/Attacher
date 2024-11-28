if (document.getElementById('popup_login_app') !== null) {
    var login_app = new Vue({
        el: '#popup_login_app',
        data: {
            tabs: {
                enter: {
                    name: 'Вход',
                    visible: true,
                    validated: false,
                    form: {
                        email: {
                            label: 'E-mail (логин) *',
                            type: 'text',
                            placeholder: '',
                            required: true,
                            value: '',
                            name: 'email'
                        },
                        password: {
                            label: 'Пароль *',
                            type: 'password',
                            placeholder: '***********',
                            required: true,
                            value: '',
                            name: 'password'
                        },                        
                        submit: {
                            type: 'submit',
                            value: 'Войти'
                        },
                        member: {
                            type: 'member',
                            value: 'Забыли пароль?'
                        },
                    }
                },
                reg: {
                    name: 'Регистрация',
                    visible: false,
                    validated: false,
                    form: {
                        usertype: {
                            label: 'Вид плательщика *',
                            type: 'select',
                            placeholder: '',
                            required: true,
                            list: {
                                1: "Физическое лицо",
                                2: "Юридическое лицо или ИП",
                            },
                            value: 2,
                            name: 'usertype'
                        },
                        name: {
                            label: 'Имя *',
                            type: 'text',
                            placeholder: '',
                            required: true,
                            value: '',
                            name: 'name'
                        },
                        email: {
                            label: 'Основной e-mail (логин) *',
                            type: 'email',
                            placeholder: '',
                            required: true,
                            value: '',
                            name: 'email'
                        },
                        phone: {
                            label: 'Телефон *',
                            type: 'tel',
                            placeholder: '',
                            required: true,
                            value: '',
                            name: 'phone'
                        },
                        password: {
                            label: 'Пароль *',
                            type: 'password',
                            placeholder: '********',
                            required: true,
                            value: '',
                            name: 'password'
                        },
                        companyname: {
                            label: 'Название компании',
                            type: 'text',
                            placeholder: '',
                            value: '',
                            name: 'companyname',
                            set_show: {
                                name: 'usertype',
                                value: '2',
                            }
                        },                        
                        password2: {
                            label: 'Повторите пароль *',
                            type: 'password',
                            placeholder: '********',
                            required: true,
                            value: '',
                            name: 'password2'
                        },
                        /*policy: {
                            label: 'Я принимаю <a href="#">договор оферты</a>, <a href="/securitypolicy">политику конфиденциальности</a> и правила обработки <a href="#">персональных данных</a> ',
                            type: 'checkbox',
                            placeholder: '',
                            required: true,
                            value: false,
                            name: 'policy'
                        },*/
                        submit: {
                            type: 'submit',
                            value: 'Регистрация'
                        }
                    }
                },
                member: {
                    title: 'Восстановить доступ',
                    pretitle: 'Введите ваш e-mail, который вы указывали при регистрации',
                    visible: false,
                    special: true,
                    validated: false,
                    form: {
                        back: {
                            type: 'back',
                            value: 'Назад',
                            class: 'back'
                        },
                        email: {
                            label: 'E-mail (логин) *',
                            type: 'text',
                            placeholder: '',
                            required: true,
                            value: '',
                            name: 'email'
                        },
                        submit: {
                            type: 'submit',
                            value: 'Войти'
                        }
                    }   
                }
            }
        },
        methods: {
            set_current(tab_name) {
                for (let name in this.tabs) {
                    this.tabs[name].visible = false;
                }
                this.tabs[tab_name].visible = true;

            },
            goback() {
                for (let name in this.tabs) {
                    this.tabs[name].visible = false;
                }
                this.tabs['enter'].visible = true;
            },

            show(tab_name, set_show) {
                if (set_show && this.tabs[tab_name].form[set_show['name']].value != set_show['value']) {
                    return false
                }
                return true
            },

            checking(tab) {
                // подсчитываем количество инпутов для проверки
                let count = 0;
                let validated = 0;
                //создаем массив в который будет сохраняться количество ошибок

                for (let name in tab.form) {
                    let element = tab.form[name];

                    if (element.required) {
                        count += 1;
                    }

                    if (element.value && element.required) {
                        validated += 1;
                    }

                }

                if (validated == count && count > 0) {
                    tab.validated = true;
                } else {
                    tab.validated = false;
                }

            }
        }
    });
}
