require('./bootstrap');
require('./main');

import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

window.verify = (button) => {
    let verify = prompt('Masukkan kata sandi anda...');
    button.parentElement.querySelector('input[name=verify]').value = verify;
    return verify != null;
}
