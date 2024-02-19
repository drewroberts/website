<div class="relative">
    <input
        id="search-bar"
        type="text"
        placeholder="Enter your address"
        class="w-full px-2 py-1 focus:outline-none text-gray-700 ring-1 ring-gray-300 rounded-md overflow-hidden focus:ring-2 focus:ring-blue-300"
    >
    <span id="error-msg" class="ml-2 text-xs text-red-500"></span>
    <div id="results-list" class="absolute top-9 z-10 w-full"></div>
    <div id="attributions"></div>
</div>

@push ('scripts')
    <script src="{{ asset('js/address.js') }}" async defer type="text/javascript"></script>

    <script type="text/javascript" async defer>
        window.onload = function () {
            Address.setup({
                googleApiKey: '{{ config('google-api.services.places.key') }}',
                predictionListElement: document.getElementById('results-list'),
                placeElement: document.getElementById('attributions')
            });

            const addressInput = document.getElementById('search-bar');

            addressInput.addEventListener('input', debounce(populateDirections, 400));
            addressInput.addEventListener('focus', Address.showPredictions);
            addressInput.addEventListener('blur', Address.hidePredictions);
        };

        function populateDirections(event) {
            Address.getPredictions(event.target.value)
                .then(res => {
                    // Clear results in list
                    document.getElementById('results-list').innerHTML = "";

                    // Show results in list
                    res.forEach(prediction => {
                        const result = document.createElement('div');
                        result.className = 'block w-full px-2 py-1 text-left bg-white cursor-default hover:bg-gray-50';
                        result.innerText = prediction.description;
                        result.onmousedown = function () {
                            Address.hidePredictions();
                            document.getElementById('search-bar').value = prediction.description;

                            Address.getAddressInfo(prediction.place_id)
                                .then(res => {
                                    document.getElementById('address-line-1').value = res.addressLine1;
                                    document.getElementById('city').value = res.city;
                                    document.getElementById('state').value = res.state;
                                    document.getElementById('zip').value = res.zip;

                                    // After filling the form with address components from the Autocomplete
                                    // prediction, set cursor focus on the second address line to encourage
                                    // entry of subpremise information such as apartment, unit, or floor number.
                                    document.getElementById('address-line-2').focus();
                                });
                        }

                        document.getElementById('results-list').appendChild(result);
                    });
                })
                .catch(error => {
                    Address.hidePredictions();
                    document.getElementById('error-msg').innerText = error;
                });
        }

        function debounce(func, wait, immediate) {
            var timeout;
            return function () {
                var context = this, args = arguments;
                var later = function () {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }
    </script>
@endpush
