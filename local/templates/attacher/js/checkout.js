if (document.getElementById('checkout_app')) {
    var checkout_app = new Vue({
        el: '#checkout_app',
        data: {
            result: {
                success: 0,
                errors: [],
                order_id: ''
            },
            items: basket_list ? basket_list : [],
            items_checked: [],
            check_all_items_enabled: true,
            show_popup_pickup: false,
            no_photo: '/templates/img/no_photo.webp',
            user_info: user ? user : [],
            pickup_city: {
                value: 'Московская обл, г Дзержинский',
                unrestricted_value: '140090, Московская обл, г Дзержинский',
                fias_id: '6fa8b59c-cda7-4c98-8b41-e0bcb2867e16',
                approved: true
            },
            manual_set_city: {},
            total: {
                sum: 0,
                sumGoods: 0,
                sumDelivery: 0
            },
            current_step: 0,
            error_next_step: false,
            error_submit: false,
            show_all_items_current: 0,
            show_all_items_state: [
                {
                    text: 'Показать все товары'
                },
                {
                    text: 'Скрыть все товары'
                }
            ],
            agreements: true,
            dadata_address_delay: false,
            dadata_address_options: {
                city: [],
                street: [],
                house: []
            },
            address: {
                city: {
                    title: 'Населенный пункт',
                    name: 'city',
                    value: 'г Москва',
                    beltway_distance: null,
                    beltway_hit: null,
                    full_value: '101000, г Москва',
                    fias_id: '0c5b2444-70a0-4932-980c-b4dc0d3f02b5',
                    dadata: true,
                    placeholder: 'Введите город',
                    required: true,
                    approved: true
                },
                street: {
                    title: 'Улица',
                    name: 'street',
                    value: '',
                    fias_id: '',
                    dadata: true,
                    placeholder: 'Введите улицу',
                    required: true,
                    approved: false
                },
                house: {
                    title: 'Дом',
                    name: 'house',
                    value: '',
                    fias_id: '',
                    dadata: true,
                    placeholder: 'Введите номер дома',
                    required: true,
                    approved: false
                },
                flat: {
                    title: 'Квартира/офис',
                    name: 'flat',
                    value: '',
                    dadata: false,
                    placeholder: 'Введите номер квартиры',
                    required: false,
                    approved: true
                },
            },
            payment: {
                value: ''
            },
            person: {
                title: 'Вид плательщика',
                value: '',
                list: {
                    // физ. лицо
                    individual: {
                        title: 'Физическое лицо',
                        value: 'individual',
                        contact_info: {
                            name: {
                                type: 'text',
                                title: 'ФИО',
                                placeholder: 'Введите ФИО',
                                name: 'name',
                                required: true,
                                value: ''
                            },
                            phone: {
                                type: 'tel',
                                title: 'Телефон',
                                placeholder: '8(___)___-__-__',
                                name: 'phone',
                                required: true,
                                value: ''
                            },
                            email: {
                                type: 'email',
                                title: 'E-Mail',
                                placeholder: 'Введите E-Mail',
                                name: 'email',
                                required: true,
                                value: ''
                            },
                            comment: {
                                type: 'text',
                                title: 'Комментарий',
                                placeholder: 'Введите комментарий к заказу',
                                name: 'comment',
                                required: false,
                                value: ''
                            },
                        },
                        payment: {
                            online_card_pay: {
                                title: 'Онлайн оплата (SberPay, карта банка)',
                                name: 'online_card_pay',
                            },
                            link_qr_pay: {
                                title: 'Оплата по ссылке и QR-коду',
                                name: 'link_qr_pay',
                            },
                            individual_bill_pay: {
                                title: 'Оплата по счету',
                                name: 'individual_bill_pay',
                            }
                        }
                    },
                    // юр. лицо
                    legal: {
                        title: 'Юридическое лицо',
                        value: 'legal',
                        contact_info: {
                            name: {
                                type: 'text',
                                title: 'Представитель',
                                placeholder: 'Введите ФИО',
                                name: 'name',
                                required: true,
                                value: ''
                            },
                            phone: {
                                type: 'tel',
                                title: 'Телефон',
                                placeholder: '8(___)___-__-__',
                                name: 'phone',
                                required: true,
                                value: ''
                            },
                            email: {
                                type: 'email',
                                title: 'E-Mail',
                                placeholder: 'Введите E-Mail',
                                name: 'email',
                                required: true,
                                value: ''
                            },
                            companyname: {
                                type: 'text',
                                title: 'Название компании',
                                placeholder: 'Введите название',
                                name: 'companyname',
                                required: false,
                                value: ''
                            },
                            file: {
                                type: 'file',
                                title: 'Прикрепить реквизиты',
                                placeholder: '',
                                name: 'file',
                                required: false,
                                value: ''
                            },
                            comment: {
                                type: 'text',
                                title: 'Комментарий',
                                placeholder: 'Введите комментарий к заказу',
                                name: 'comment',
                                required: false,
                                value: ''
                            },
                        },
                        payment: {
                            online_card_pay: {
                                title: 'Онлайн оплата (SberPay, карта банка)',
                                name: 'online_card_pay',
                            },
                            link_qr_pay: {
                                title: 'Оплата по ссылке и QR-коду',
                                name: 'link_qr_pay',
                            },
                            legal_bill_pay: {
                                title: 'Оплата по счету с НДС',
                                name: 'legal_bill_pay',
                            },
                            ip_bill_pay: {
                                title: 'Оплата по счету для ИП без НДС',
                                name: 'ip_bill_pay',
                            }
                        }
                    },
                }
            },

            delivery: {
                title: 'Cпособ получения',
                value: '',
                title_value: '',
                type: {
                    courier: {
                        title: 'Курьерская доставка (от 500 ₽)',
                        value: 'courier',
                        price_list: {
                            '500': {
                                'price': 500,
                                'distance': [0, 5],
                                'location': ['г Москва']
                            },
                            '700': {
                                'price': 700,
                                'distance': [5, 10],
                            },
                            '0': {
                                'price': 0,
                                'title': 'по договоренности'
                            }
                        },
                        add_address_fields: true,
                        enabled: true
                    },
                    pickup: {
                        title: "Самовывоз из Дзержинский(МО) (0 ₽)",
                        value: 'pickup',
                        price: 0,
                        add_address_fields: false,
                        enabled: true
                    },
                    to_del_line: {
                        title: 'До ТК Деловые Линии в Москве (0 ₽)',
                        value: 'to_del_line',
                        price: 0,
                        add_address_fields: false,
                        enabled: true
                    },
                    to_tk: {
                        title: 'До ТК (на выбор) в Москве (от 500 ₽)',
                        value: 'to_tk',
                        price: 500,
                        add_address_fields: false,
                        enabled: true
                    },
                }
            }
        },
        created() {
            // Добавляем в список выбранных товаров все, кроме под заказ
            if (this.items && this.items.length > 0) {
                this.items.forEach(element => {
                    if (this.item_disabled(element.price) === false && element.out_of_stock == 0) {
                        this.items_checked.push(element.id)
                    }
                })
            }

            // Подставляем вид плательщика
            if (this.user_info) {
                this.person.value = this.user_info.usertype == 1 ? 'individual' : 'legal';
                if (this.user_info.address) {
                    Object.values(this.address).forEach(element => {
                        element.value = this.user_info.address[element.name]
                        element.approved = true
                    })

                    if (this.address.city.value) {
                        this.dadata_get_city()
                    }

                }
            }

            // Копируем адрес по умолчанию
            for (let key in this.address.city) {
                this.manual_set_city[key] = this.address.city[key];
            }
        },
        methods: {
            sortItems: function (arr) {
                // Set slice() to avoid to generate an infinite loop!
                return arr.slice().sort(function (a, b) {
                    return a.basket_list_id - b.basket_list_id;
                });
            },
            show_payment(type) {
                if (this.delivery.value == 'courier' && this.total.sumDelivery == 0 && type == 'online_card_pay') {
                    return false
                }
                return true
            },
            delivery_reset() {
                this.delivery.value = ''
                this.total.sumDelivery = 0
                this.address.city.approved = false
            },
            // Отключаем блок доставки, если город не подтвержден выбором из списка
            delivery_disabled() {
                return !this.address.city.approved
            },
            item_disabled(price) {
                return price == 0 ? true : false
            },
            check_all_items() {
                this.items_checked = []
                if (this.check_all_items_enabled) {
                    this.check_all_items_enabled = false
                } else {
                    this.items.forEach(element => {
                        if (this.item_disabled(element.price) === false && element.out_of_stock == 0) {
                            this.items_checked.push(element.id)
                        }
                    })
                    this.check_all_items_enabled = true
                }
            },
            check_item(id) {
                if (this.items_checked.includes(id)) {
                    let i = this.items_checked.indexOf(id)
                    this.items_checked.splice(i, 1)
                    this.check_all_items_enabled = false
                } else {
                    this.items_checked.push(id)
                }
            },
            set_delivery(item) {
                // Если самовывоз, то включаем сообщение и сохраняем введенный в ручную город
                if (item.value == 'pickup') {
                    this.show_popup_pickup = true;
                    if(this.address.city.value != this.pickup_city.value) {
                        for (let key in this.address.city) {
                            this.manual_set_city[key] = this.address.city[key];
                        }
                    }
                // Иначе обнуляем переменную показа сообщения о самовывозе и подставляем введенный в ручную город
                } else {
                    this.show_popup_pickup = false;
                    if(this.manual_set_city) {
                        for (let key in this.manual_set_city) {
                            this.address.city[key] = this.manual_set_city[key];
                        }
                    }
                }
                // Устанавливаем значение выбранной доставки
                if (this.delivery.value = item.value) {
                    if (item.value == 'pickup') {
                        Object.values(this.address).forEach(function (element) {
                            element.value = '';
                        })
                        this.address.city.value = this.pickup_city.value;
                        this.address.city.full_value = this.pickup_city.unrestricted_value;
                        this.address.city.approved = this.pickup_city.approved;
                        this.address.city.fias_id = this.pickup_city.fias_id;
                    }
                    Object.values(this.delivery.type).forEach(element => {
                        // Находим выбранную доставку 
                        if (element.value == this.delivery.value) {
                            // Стоимость курьерской доставки рассчитывается через прайс-лист
                            if (element.price_list) {
                                // по договоренности
                                this.total.sumDelivery = element.price_list[0]['price']
                                this.delivery.title_value = element.price_list[0]['title']
                                for (let price_key in element.price_list) {
                                    // Все кроме по договоренности
                                    if (price_key > 0 &&
                                        (
                                            (
                                                element.price_list[price_key]['distance'] &&
                                                this.address.city.beltway_distance > element.price_list[price_key]['distance'][0] &&
                                                this.address.city.beltway_distance <= element.price_list[price_key]['distance'][1]
                                            ) ||
                                            (
                                                element.price_list[price_key]['location'] &&
                                                element.price_list[price_key]['location'].includes(this.address.city.value)
                                            )
                                        )
                                    ) {
                                        this.total.sumDelivery = element.price_list[price_key]['price']
                                    }
                                }
                            } else {
                                // Остальные доставки
                                this.total.sumDelivery = element.price
                            }
                        }
                    })
                }

            },
            dadata_set_city(item) {
                this.address.city.value = item.value
                this.address.city.fias_id = item.data.fias_id
                this.address.city.beltway_distance = item.data.beltway_distance
                this.address.city.beltway_hit = item.data.beltway_hit
                this.address.city.full_value = item.unrestricted_value
                this.address.city.approved = true
                for (let key in this.address.city) {
                    this.manual_set_city[key] = this.address.city[key];
                }
                this.dadata_address_options.city = []
            },
            dadata_get_city() {
                this.delivery_reset()
                // Если нет паузы, делать запрос
                if (this.dadata_address_delay == false) {
                    if (this.address.city.value) {
                        let formData = new FormData()
                        formData.append('action', 'city')
                        formData.append('city', this.address.city.value)

                        axios.post('/api/dadata',
                            formData,
                            {}
                        )
                            .then(response => {
                                this.dadata_address_options.city = []
                                response.data.suggestions.forEach(row => {
                                    this.dadata_address_options.city.push(row)
                                })
                                // снимаем ограничения на запросы
                                this.dadata_address_delay = false
                            })
                            .catch()
                        // 1 запрос = 1 ответ
                        this.dadata_address_delay = true
                    } else {
                        this.dadata_address_options.city = []
                    }
                }
            },
            dadata_set_add_address_fields(item, index) {
                let get_index = index
                if(index == 'street') {
                    get_index = 'street_with_type'
                }
                this.address[index].value = item.data[get_index]
                this.address[index].fias_id = item.data.fias_id
                this.address[index].approved = true
                this.dadata_address_options[index] = []
            },
            dadata_get_add_address_fields(address_part) {
                this.address[address_part].approved = false
                // Если нет паузы, делать запрос
                if (this.dadata_address_delay == false) {
                    if (this.address[address_part].value) {
                        let fias_parent = ''
                        let loop_break = false
                        Object.values(this.address).forEach(function (element) {
                            if (loop_break == true)
                                return

                            if (element.name == address_part) {
                                loop_break = true
                                return
                            }

                            fias_parent = element.name
                        })

                        let formData = new FormData()
                        formData.append('action', 'add_address_fields')
                        formData.append('address_part', address_part)
                        formData.append(address_part, this.address[address_part].value)
                        formData.append('fias_parent', fias_parent)
                        formData.append('fias_id', this.address[fias_parent].fias_id)

                        axios.post('/api/dadata',
                            formData,
                            {}
                        )
                            .then(response => {
                                this.dadata_address_options[address_part] = []
                                response.data.suggestions.forEach(row => {
                                    this.dadata_address_options[address_part].push(row)
                                })

                                // снимаем ограничения на запросы
                                this.dadata_address_delay = false
                            })
                            .catch()
                        // 1 запрос = 1 ответ
                        this.dadata_address_delay = true
                    } else {
                        this.dadata_address_options[address_part] = []
                    }
                }
            },
            decrease_number(item) {
                let formData = new FormData()

                formData.append('action', 'del')
                formData.append('basket', 'basket')
                formData.append('rec', item.id)
                formData.append('cnt', 1)

                axios.post('/basket_info',
                    formData,
                    {}
                )
                    .then(response => {
                        $('#basket_info').html(response.data)

                        if (item.count == 1) {
                            let index = 0;
                            for (let good of this.items) {
                                if (good.id === item.id) break;
                                index++
                            }
                            this.items.splice(index, 1)
                            let i = this.items_checked.indexOf(item.id)
                            this.items_checked.splice(i, 1)
                        } else {
                            item.count = parseInt(item.count) - 1
                        }
                    })
                    .catch()
            },
            set_number(item) {
                let formData = new FormData()
                item.count = Number(item.count.replace(/[a-zA-Z]+/ig, ''));
                if (item.count == 0) {
                    this.delete_item(item)
                } else {
                    formData.append('action', 'basket_update')
                    formData.append('basket', 'basket')
                    formData.append('rec', item.id)
                    formData.append('cnt', item.count)

                    axios.post('/basket_info',
                        formData,
                        {}
                    )
                        .then(response => {
                            $('#basket_info').html(response.data)
                        })
                        .catch()
                }
            },
            increase_number(item) {
                let formData = new FormData()
                formData.append('action', 'add')
                formData.append('basket', 'basket')
                formData.append('rec', item.id)
                formData.append('cnt', 1)

                axios.post('/basket_info',
                    formData,
                    {}
                )
                    .then(response => {
                        $('#basket_info').html(response.data)
                        item.count = parseInt(item.count) + 1
                    })
                    .catch()
            },
            changeText() {
                this.show_all_items_current++
                if (this.show_all_items_current > 1) {
                    this.show_all_items_current = 0
                }
            },
            delete_item(item) {
                let formData = new FormData()

                formData.append('action', 'del')
                formData.append('basket', 'basket')
                formData.append('rec', item.id)
                formData.append('cnt', item.count)

                axios.post('/basket_info',
                    formData,
                    {}
                )
                    .then(response => {
                        $('#basket_info').html(response.data)
                        let index = 0;
                        for (let good of this.items) {
                            if (good.id === item.id) break;
                            index++
                        }
                        this.items.splice(index, 1)
                        let i = this.items_checked.indexOf(item.id)
                        this.items_checked.splice(i, 1)
                    })
                    .catch()
            },
            handleFileUpload(event) {
                this.person.list[this.person.value].contact_info.file.value = event.target.files[0]
            },
            setResult(response) {
                this.result = response
            },
            getResult() {
                return this.result
            },
            submit() {
                let formData = new FormData()
                formData.append('action', 'form_send')
                formData.append('payment', this.payment.value)
                formData.append('delivery', this.delivery.value)
                formData.append('sum_delivery', this.total.sumDelivery)
                formData.append('user_id', this.user_info.id)

                let delete_items = []
                this.items.forEach(element => {
                    if (!this.items_checked.includes(element.id)) {
                        delete_items.push(element.id)
                    }
                })
                if (delete_items) {
                    formData.append('delete_items', delete_items)
                }

                Object.values(this.person.list[this.person.value].contact_info).forEach(element => {
                    if (element.name == 'phone') {
                        formData.append(element.name, this.user_phone)
                    } else {
                        formData.append(element.name, element.value)
                    }
                })

                Object.values(this.address).forEach(function (element) {
                    if (element.value) {
                        if (element.name == 'city') {
                            formData.append('full_city', element.full_value)
                        }
                        formData.append(element.name, element.value)
                    }
                })

                axios.post(
                    '/order',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response) => {
                    this.result = response['data'];
                    if (response['data']['payment']) {
                        location.replace(response['data']['payment']);
                    }
                    else if(this.result['success'] == 1) {
                        location.replace(this.result['success_url']);
                    }
                }).catch()
            },
            check_error_next_step() {
                if (this.person.value && this.address.city.value && this.delivery.value && this.items_checked && this.items_checked.length > 0) {
                    // Следующий шаг
                    this.current_step = 1
                    // Если всего 1 способ оплаты, выбираем его по умолчанию
                    if (this.person.value) {
                        this.person.list[this.person.value].contact_info.name.value = this.user_info.name
                        this.person.list[this.person.value].contact_info.email.value = this.user_info.email
                        this.person.list[this.person.value].contact_info.phone.value = this.user_info.phone
                        if (this.person.list[this.person.value].contact_info.companyname) {
                            this.person.list[this.person.value].contact_info.companyname.value = this.user_info.companyname ? this.user_info.companyname : ''
                        }

                        if (Object.keys(this.person.list[this.person.value].payment).length == 1) {
                            let first_name = Object.keys(this.person.list[this.person.value].payment)[0]
                            this.payment.value = this.person.list[this.person.value].payment[first_name].name
                        }
                    }

                } else {
                    this.error_next_step = true
                }
            },
            check_error_submit() {
                let contact_info = this.person.list[this.person.value].contact_info
                if (
                    contact_info.name.value && contact_info.phone.value && this.user_phone.length == 11 && contact_info.email.value
                    && this.payment.value && this.agreements && this.delivery.value &&
                    (
                        !this.delivery.type[this.delivery.value].add_address_fields ||
                        (this.delivery.type[this.delivery.value].add_address_fields && this.address.street.value && this.address.house.value)
                    )
                ) {
                    this.submit()
                } else {
                    this.error_submit = true
                }
            }
        },
        computed: {
            user_phone() {
                let phone = ''
                if (this.person.value) {
                    phone = this.person.list[this.person.value].contact_info.phone.value.replace(/\D/g, '')
                }

                return phone
            },
            items_checked_count() {
                let count = 0

                this.items.forEach(element => {
                    if (this.items_checked.includes(element.id)) {
                        count += Number(element.count)
                    }
                })

                return count
            },

            getSumDelivery() {
                return this.total.sumDelivery
            },

            getSumGoods() {
                this.total.sumGoods = 0
                if (this.items) {
                    this.items.forEach(element => {
                        if (this.items_checked.includes(element.id)) {
                            this.total.sumGoods += element.price * element.count
                        }
                    })
                }
                return this.total.sumGoods
            },

            getSum() {
                return this.total.sumGoods + this.total.sumDelivery
            },

            disabled_next_step() {
                // Устанавливать disabled на кнопке "Оформить заказ"
                if (this.person.value && this.address.city.value && this.delivery.value && this.items_checked && this.items_checked.length > 0) {
                    this.error_next_step = false
                    return false
                } else {
                    return true
                }
            },
            disabled_submit() {
                if (this.current_step == 1) {
                    let contact_info = this.person.list[this.person.value].contact_info
                    // Проверка адреса
                    let good_address = true;
                    if(this.delivery.value && this.delivery.type[this.delivery.value] && this.delivery.type[this.delivery.value].add_address_fields) {
                        for (let key in this.address) {
                            if((this.address[key].required && !this.address[key].value) || !this.address[key].approved) {
                                good_address = false;
                            }
                        }
                    }

                    if (
                        contact_info.name.value && contact_info.phone.value && this.user_phone.length == 11 && contact_info.email.value
                        && this.payment.value && this.agreements && good_address
                    ) {
                        this.error_submit = false
                        return false
                    } else {
                        this.error_submit = true
                        return true
                    }
                }
            }
        }
    })
}