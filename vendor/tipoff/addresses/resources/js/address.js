const Address = (function () {
    const autocompleteParams = {
        input: null,
        sessionToken: null,
        componentRestrictions: {
            country: 'us',
        },
        fields: [
            'address_components',
            // "place_id",     // if needed, Google place ID
            // "utc_offset_minutes",   // if needed, derive timezone from minutes
        ],
        types: [
            'address',
        ],
    };

    const placeDetailsParams = {
        placeId: null,
        sessionToken: null,
        fields: [
            'address_components',
            // can retrieve more fields if needed for data consistency e.g. timezone
        ],
    };

    let autocompleteService;
    let placesService;
    let predictionListElement;
    let placeElement;

    let resetSessionToken = function () {
        let sessionToken = new google.maps.places.AutocompleteSessionToken();

        autocompleteParams.sessionToken = sessionToken;
        placeDetailsParams.sessionToken = sessionToken;
    };

    window.initGoogleMapAutocomplete = function () {
        autocompleteService = new google.maps.places.AutocompleteService();
        placesService = new google.maps.places.PlacesService(placeElement);

        resetSessionToken();
    };

    let getPredictions = function (query) {
        return new Promise((resolve, reject) => {
            let startsWithStreetNumber = /^\d/;

            if (!startsWithStreetNumber.test(query)) {
                hidePredictions();
                reject('Please enter a street number.');
            } else {
                showPredictions();
                autocompleteParams.input = query;
                autocompleteService.getPlacePredictions(autocompleteParams, (predictions, status) => {
                    if (status === 'OK') {
                        resolve(predictions);
                    }
                });
            }
        })
    };

    let getAddressInfo = function (placeId) {
        return new Promise((resolve, reject) => {
            placeDetailsParams.placeId = placeId;
            placesService.getDetails(placeDetailsParams, function (placeDetails, status) {
                let addressLine1 = '';
                let city = '';
                let state = '';
                let zip = '';

                // Get each component of the address from the place details,
                // and then fill-in the corresponding field on the form.
                // place.address_components are google.maps.GeocoderAddressComponent objects
                // which are documented at http://goo.gle/3l5i5Mr
                for (const component of placeDetails.address_components) {
                    // Street number
                    switch (component.types[0]) {
                        case 'street_number':
                            addressLine1 = `${component.long_name} ${addressLine1}`;
                            break;

                        // Street name, e.g. Main Street
                        case 'route':
                            addressLine1 += component.long_name;
                            break;

                        // Postal code
                        case 'postal_code':
                            zip = `${component.long_name}${zip}`;
                            break;

                        // case "postal_code_suffix":
                        //     postcode = `${postcode}-${component.long_name}`;
                        //     break;

                        // City
                        case 'locality':
                            city = component.long_name;
                            break;

                        // State
                        case 'administrative_area_level_1':
                            state = component.short_name;
                            break;

                        // case "country":
                        //     country = component.long_name;
                        //     break;
                    }
                }

                resolve({
                    addressLine1: addressLine1,
                    city: city,
                    state: state,
                    zip: zip
                });
            });
            resetSessionToken();
        });
    };

    let showPredictions = function () {
        predictionListElement.classList.remove('invisible');
    };

    let hidePredictions = function () {
        predictionListElement.classList.add('invisible');
    };

    let addGoogleMapScript = function (key) {
        let documentTag = document, tag = 'script',
            object = documentTag.createElement(tag),
            scriptTag = documentTag.getElementsByTagName(tag)[0];

        object.src = `https://maps.googleapis.com/maps/api/js?key=${key}&libraries=places&callback=initGoogleMapAutocomplete`;

        scriptTag.parentNode.insertBefore(object, scriptTag);
    };

    let setup = function (settings) {
        // Assign essential element.
        predictionListElement = settings.predictionListElement;
        placeElement = settings.placeElement;

        // Add Google Map script.
        addGoogleMapScript(settings.googleApiKey);
    };

    // Explicitly reveal public pointers to the private functions
    // that we want to reveal publicly
    return {
        setup: setup,
        getPredictions: getPredictions,
        showPredictions: showPredictions,
        hidePredictions: hidePredictions,
        getAddressInfo: getAddressInfo
    }
})();

export default Address;
