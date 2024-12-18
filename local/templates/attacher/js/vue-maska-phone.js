Vue.directive('phone', {
        inserted: function(el, binding, vnode) {
            function replaceNumberForInput(value) {
                let val = ''
                
                const x = value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/)

                if (!x[2] && x[1] !== '') {
                    val = x[1] === '8' ? x[1] : '8' + x[1]
                } else {
                    val = !x[3] ? x[1] + x[2] : x[1] + '(' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '')
                }

                return val
            }

            function replaceNumberForPaste(value) {
                const r = value.replace(/\D/g, '')
                let val = r

                if (val.charAt(0) === '7') {
                    val = '8' + val.slice(1)
                }                

                return replaceNumberForInput(val)
            }

            el.onfocus = function(e) {
                el.value = replaceNumberForInput(el.value)
            }

            el.oninput = function(e) {
                if (!e.isTrusted) {
                    return
                }
                
                let cursor_pos = this.selectionStart
                
                setTimeout(() => {
                    const pasteVal = el.value
                    el.value = replaceNumberForPaste(pasteVal) 
                    
                    if(pasteVal.length == 1) {
                        cursor_pos += 1
                    }
                    else if((el.value.length - pasteVal.length) > 0 || (pasteVal.length >= 16 && (pasteVal.length - el.value.length) > 0)) {
                        k = el.value.length - pasteVal.length
                        if(cursor_pos == 1 || cursor_pos == 6 || cursor_pos == 7 || cursor_pos == 11 || cursor_pos == 13 || cursor_pos == 14) {
                            cursor_pos += k>0?(1 + k):1
                        }
                        else if(cursor_pos == 5) {
                            cursor_pos += k>0?(2 + k):2
                        }
                    }
                    this.setSelectionRange(cursor_pos,cursor_pos)
                })               
            }

            el.onpaste = function() {
                setTimeout(() => {
                    const pasteVal = el.value
                    el.value = replaceNumberForPaste(pasteVal)
                    this.setSelectionRange(el.value.length,el.value.length)
                })
            }
            el.onchange = function() {
                setTimeout(() => {
                    const pasteVal = el.value
                    el.value = replaceNumberForPaste(pasteVal)
                    this.setSelectionRange(el.value.length,el.value.length)
                })
            }
        }
    })