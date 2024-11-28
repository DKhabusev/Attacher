if (document.getElementById('popup_request_info_app') !== null) {

    $(document).on('click', '.request_info', function () {
        $('body').addClass('popup_shown');
        let $input = $(this).siblings('.good_counter').find('.basket_good_count');
        let good_count = parseInt($input.val());
        let $text = 'Интересует ' + 'Артикул: ' + $(this).data('artikul') + "\n" +
            'Кол-во: ' + good_count + 'шт.' + "\n" +
            'Название: ' + $(this).data('header');
        request_info_app.set_message($text);
        request_info_app.checking();
        request_info_app.open_popup();
        return false;
    });

    $(document).on('click', '.request_info_close_popup', function () {
        $('body').removeClass('popup_shown');
        request_info_app.close_popup();
        request_info_app.checking();
        return false;
    });

    var request_info_app = new Vue({
        el: '#popup_request_info_app',
        data: {
            response: {result: 0},
            validated: false,
            open_flag: false,
            user_info: user ? user : [],
            form: {
                name: {
                    label: 'Имя *',
                    type: 'text',
                    placeholder: '',
                    required: true,
                    value: '',
                    name: 'name'
                },
                email: {
                    label: 'E-mail *',
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
                message: {
                    label: 'Вопрос *',
                    type: 'textarea',
                    placeholder: '',
                    required: true,
                    value: '',
                    name: 'message'
                },
                submit: {
                    type: 'submit',
                    value: 'Отправить'
                }
            }
        },
        created() {
            if (this.user_info) {
                Object.values(this.form).forEach(element => {
                    if (this.user_info[element.name]) {
                        element.value = this.user_info[element.name]
                        element.approved = true
                    }
                })
            }
        },
        methods: {
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
            },
            submit() {
                let formData = new FormData()
                formData.append('action', 'save_request_info')

                Object.values(this.form).forEach(element => {
                    if (element.type != 'submit') {
                        formData.append(element.name, element.value)
                    }
                })

                axios.post(
                    '/api/request_info',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response) => {
                    this.response = response['data']
                })
            },
            open_popup() {
                this.open_flag = true;
                return false;
            },
            close_popup() {
                this.open_flag = false;
                setTimeout(() => this.response.result = 0, 2000);
                return false;
            },
            set_message(text) {
                this.form.message.value = text;
            }
        }
    });
}