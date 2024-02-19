<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <input
                :ref="field.attribute"
                :id="field.attribute"
                :dusk="field.attribute"
                type="text"
                v-model="value"
                v-debounce:500ms="getPredictions"
                @focus="showPredictions"
                v-click-outside="hidePredictions"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                :disabled="isReadonly"
            />
            <div id="results-list" class="absolute top-9 z-10 w-full">
                <div
                    v-for="prediction in predictions"
                    :key="prediction.place_id"
                    @click="getAddressInfo(prediction.place_id)"
                    class="block w-full px-2 py-1 text-left bg-white cursor-default hover:bg-gray-50"
                >
                    {{ prediction.description }}
                </div>
            </div>
            <div id="attributions"></div>
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
    mixins: [HandlesValidationErrors, FormField],

    data() {
        return {
            placesAutocomplete: null,
            predictions: []
        }
    },

    /**
     * Mount the component.
     */
    mounted() {
        this.setInitialValue()

        this.field.fill = this.fill

        Nova.$on(this.field.attribute + '-value', value => {
            this.value = value
        })

        this.initializePlaces();
    },

    methods: {
        getPredictions() {
            this.placesAutocomplete.getPredictions(this.value)
                .then(res => {
                    this.predictions = res;
                })
                .catch(error => {
                    this.placesAutocomplete.hidePredictions();
                    Nova.error(error);
                });
        },

        showPredictions() {
            this.placesAutocomplete.showPredictions();
        },

        hidePredictions() {
            this.placesAutocomplete.hidePredictions();
        },

        getAddressInfo(placeId) {
            this.placesAutocomplete.getAddressInfo(placeId)
                .then(res => {
                    this.value = res.addressLine1;
                    Nova.$emit(this.field.secondAddressLine + '-value', '');
                    Nova.$emit(this.field.city + '-value', res.city);
                    Nova.$emit(this.field.postalCode + '-value', res.zip);
                    Nova.$emit(this.field.state + '-value', res.state);
                });
        },

        /**
         * Initialize Algolia places library.
         */
        initializePlaces() {
            const places = require('./../../address').default;

            places.setup({
                googleApiKey: Nova.config.googleMapApiKey,
                predictionListElement: document.getElementById('results-list'),
                placeElement: document.getElementById('attributions')
            });

            this.placesAutocomplete = places;
        }
    }
}
</script>
