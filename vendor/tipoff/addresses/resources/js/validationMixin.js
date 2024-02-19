export const validationMixin = {
    data() {
        return {
            errors: {}
        }
    },
    methods: {
        parseErrors(error) {
            this.errors = {};

            let response = error.response;

            if (response && response.status === 422) {
                let vm = this;
                let errors = response.data.errors;

                Object.keys(errors).forEach(function (key) {
                    vm.$set(
                        vm.errors,
                        key,
                        Array.isArray(errors[key]) ? errors[key][0] : errors[key])
                });
            }
        }
    }
};
