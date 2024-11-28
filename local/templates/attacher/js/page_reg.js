if (document.getElementById('page_reg_app') !== null) {

    var page_reg_app = new Vue({
        el: '#page_reg_app',
        data: {
            validated: false,
            result: json_result,
            form_vls: json_form_vls?json_form_vls:[],
            form_errors: json_form_errors?json_form_errors:[],
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
                password: {
                    label: 'Пароль *',
                    type: 'password',
                    required: true,
                    value: '',
                    name: 'password'
                },                  
                password2: {
                    label: 'Повторите пароль *',
                    type: 'password',
                    required: true,
                    value: '',
                    name: 'password2'
                },
                submit: {
                    type: 'submit',
                    value: 'Регистрация'
                }
            },
        },
        mounted() {
            $('#page_reg_app').removeClass('hidden')
            
            for (let name in this.form_vls) {
                this.form[name].value = this.form_vls[name]
            }
        },
        methods: {
            show(set_show) {
                if (set_show && this.form[set_show['name']].value != set_show['value']) {
                    return false
                }
                return true
            },

            checking() {
                // подсчитываем количество инпутов для проверки
                let count = 0;
                let validated = 0;
                //создаем массив в который будет сохраняться количество ошибок

                for (let name in this.form) {
                    let element = this.form[name];

                    if (element.required) {
                        count += 1;
                    }

                    if (element.value && element.required) {
                        validated += 1;
                    }

                }

                if (validated == count && count > 0) {
                    this.validated = true;
                } else {
                    this.validated = false;
                }
            }
        }
    });
}