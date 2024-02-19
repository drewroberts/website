<div class="container">
    <form wire:ignore id="phone-number" onsubmit="savePhoneNumber(event)">
        <p>Enter your phone number:</p>

        <input id="phone" type="tel" name="phone"/>
        <input type="submit" class="btn" value="Submit"/>
    </form>

    <div id="success-message" style="display:none"></div>
</div>

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>

    <script>
        const phoneInputField = document.querySelector('#phone');
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ['us', 'ca', 'de', 'vn'],
            initialCountry: 'auto',
            geoIpLookup: getIp,
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js',
        });

        function savePhoneNumber(event) {
            event.preventDefault();

            const phoneNumber = phoneInput.getNumber();

            if (!phoneNumber) {
                alert('Phone number is empty');
            }
            else {
                @this.call('savePhoneNumber', phoneNumber);
            }
        }

        function getIp(callback) {
            fetch('https://ipinfo.io/json?token=0033205e80e0d9', {headers: {'Accept': 'application/json'}})
                .then((resp) => resp.json())
                .catch(() => {
                    return {
                        country: 'us',
                    };
                })
                .then((resp) => callback(resp.country));
        }

        window.addEventListener('error', (error) => {
            alert(error.detail);

            phoneInputField.value = '';
        });

        window.addEventListener('success', (result) => {
            const successMessage = document.querySelector('#success-message');

            successMessage.style.display = '';
            successMessage.innerHTML = `Phone number <strong>${result.detail}</strong> was saved!`;

            phoneInputField.value = '';
        });
    </script>
@endpush
