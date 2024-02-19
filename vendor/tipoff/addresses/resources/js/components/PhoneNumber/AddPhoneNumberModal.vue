<template>
    <modal
        dusk="new-relation-modal"
        tabindex="-1"
        role="dialog"
        @modal-close="handleClose"
        :classWhitelist="[
          'flatpickr-current-month',
          'flatpickr-next-month',
          'flatpickr-prev-month',
          'flatpickr-weekday',
          'flatpickr-weekdays',
          'flatpickr-calendar',
          'form-file-input',
        ]"
    >
        <div
            class="bg-40 rounded-lg shadow-lg overflow-hidden p-8"
            style="width: 800px; min-height: 350px;"
        >
            <form @submit.prevent="savePhoneNumber" autocomplete="off">
                <div class="mb-8">
                    <h1 class="text-90 font-normal text-2xl mb-3">Add New Phone Number</h1>

                    <!-- More configurations: https://iamstevendao.github.io/vue-tel-input/ -->
                    <vue-tel-input
                        v-model="phoneNumber"
                        mode="international"
                        styleClasses=""
                    />

                    <form-error v-if="errors['phone_number']" :errors="errors">
                        {{ errors['phone_number'] }}
                    </form-error>
                </div>
                <div class="flex items-center">
                    <a @click="handleClose" tabindex="0" class="btn btn-link dim cursor-pointer text-80 ml-auto mr-6">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-default btn-primary inline-flex items-center relative">
                        Create Phone
                    </button>
                </div>
            </form>
        </div>
    </modal>
</template>

<script>
import 'vue-tel-input/dist/vue-tel-input.css';
import {validationMixin} from "../../validationMixin";

export default {
    mixins: [validationMixin],

    props: {
        resourceName: {},
        resourceId: {},
        viaResource: {},
        viaResourceId: {},
        viaRelationship: {},
    },

    data() {
        return {
            phoneNumber: ''
        }
    },

    methods: {
        handleRefresh(data) {
            // alert('wew refreshing')
            this.$emit('set-phone-number', data)
        },

        handleCancelledCreate() {
            return this.$emit('cancelled-add')
        },

        /**
         * Close the modal.
         */
        handleClose() {
            this.$emit('cancelled-add')
        },

        savePhoneNumber() {
            this.parseErrors([]);

            Nova.request().post('/nova-vendor/addresses/save-phone-number', {
                phone_number: this.phoneNumber
            }).then(res => {
                Nova.success(`Phone number ${res.data.full_number} was saved!!!`);

                this.phoneNumber = '';
                this.handleRefresh(res.data);
            }).catch(err => {
                this.parseErrors(err);

                Nova.error(err.data);
            })
        }
    },
}
</script>
