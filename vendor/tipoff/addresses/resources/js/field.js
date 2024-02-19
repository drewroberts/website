import VueTelInput from 'vue-tel-input';
import vueDebounce from 'vue-debounce';

Nova.booting((Vue, router) => {
    Vue.use(VueTelInput);
    Vue.use(vueDebounce);

    Vue.directive('click-outside', {
        bind: function (el, binding, vnode) {
            el.clickOutsideEvent = function (event) {
                // here I check that click was outside the el and his children
                if (!(el == event.target || el.contains(event.target))) {
                    // and if it did, call method provided in attribute value
                    vnode.context[binding.expression](event);
                }
            };
            document.body.addEventListener('click', el.clickOutsideEvent)
        },
        unbind: function (el) {
            document.body.removeEventListener('click', el.clickOutsideEvent)
        },
    });

    // Phone Number field
    Vue.component('index-phone-number', require('./components/PhoneNumber/IndexField'));
    Vue.component('detail-phone-number', require('./components/PhoneNumber/DetailField'));
    Vue.component('form-phone-number', require('./components/PhoneNumber/FormField'));

    // Address field
    Vue.component('form-address-field', require('./components/Address/FormField'));
})
