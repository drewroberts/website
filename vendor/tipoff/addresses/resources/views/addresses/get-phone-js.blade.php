<div>
    <style>
        #error-msg {
            color: red;
        }
        #valid-msg {
            color: #00C900;
        }
        input.error {
            border: 1px solid #FF7C7C;
        }
        .hide {
            display: none;
        }
    </style>
    <div>
        <x-jet-authentication-card>
            <x-slot name="logo">
                <a href="https://thegreatescaperoom.com/">
                    <img src="{{ asset('/images/tger.png') }}" style="border-radius: 6px" alt="">
                </a>
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <form id="phone_form">
                @csrf
                    <label class="block font-medium text-sm text-gray-700" for="phone_number">
                        Phone Number
                    </label>
                    <div class="flex">
                        <input  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm inline-flex mt-1 w-full" id="phone" name="phone" type="tel" required="required" autofocus="autofocus">
                    </div>
                    <input type="hidden" name="country_code" id="country_code">
                    <span id="valid-msg" class="hide">✓ Valid</span>
                    <span id="error-msg" class="hide"></span>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                        Submit
                    </button>
                </div>
            </form>
        </x-jet-authentication-card>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.10/js/intlTelInput.min.js" integrity="sha512-WLRxTYYWjmQXqpP4+ubqmluKUgXV/1hI3Nv8n1t0xCKSMBoZ+NnqL5/wcXYWGlTkkDGUazDbttW6i+EjPwpGQA==" crossorigin="anonymous"></script>
    <script>
        const formElem = document.querySelector('#phone_form');
        const phoneInputField = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg"),
            countryCode = document.querySelector("#country_code");

        const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        const iti = window.intlTelInput(phoneInputField, {
            initialCountry: "us",
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        const reset = function() {
            phoneInputField.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // on blur: validate
        phoneInputField.addEventListener('blur', function() {
            reset();
            if (phoneInputField.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                    countryCode.value = iti.getSelectedCountryData().dialCode;
                } else {
                    phoneInputField.classList.add("error");
                    let errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });

        // on keyup / change flag: reset
        phoneInputField.addEventListener('change', reset);
        phoneInputField.addEventListener('keyup', reset);

        // formdata handler to retrieve data

        formElem.addEventListener('submit', (e) => {
            e.preventDefault();
            const data = new FormData( formElem );
            const request = new XMLHttpRequest();
            request.open("POST", "/phone");
            request.send(data);
            console.log("data returned: "+ e.target.data)
        });
    </script>
</div>
