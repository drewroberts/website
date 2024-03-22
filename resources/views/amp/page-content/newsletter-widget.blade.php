<div class="sidebar">
    <form method="post" class="p2 i-amphtml-form" action-xhr="" target="_top" custom-validation-reporting="show-first-on-submit" novalidate="">
        <input type="hidden" name="_token" value="3wSBZm9GM1F2AcMobOzOXHfYvbFD05QFdbyz5zOi">
        <div class="newsletter p-4-xs p-5-m dsp-flex-xs flex-wrap col-12-xs">
            <div class="newsletter__text col-12-xs">
                <h2 class="newsletter__heading hed-l m-b-3-xs">Get the #1 Newsletter for Programmers.</h2>
                <p class="newsletter__subheading hed-xs">Sign up for coding tips and personalized insights, delivered weekly.</p>
            </div>
            <div class="newsletter__input__container__top dsp-flex-xs col-12-xs grd-algn-item-flex-end-xs">
                <div class="newsletter__input dsp-flex-xs">
                    <input id="email" type="email" required="" placeholder="Email Address" class="input-text" value="">
                </div>
            </div>
            <span visible-when-invalid="valueMissing" validation-for="show-first-on-submit-name"></span>

            <div class="newsletter__input__container dsp-flex-xs col-12-xs grd-algn-item-flex-end-xs">
                <div class="newsletter__input dsp-flex-xs">
                    <input id="name" type="text" required="" placeholder="Name" class="input-text" value="">
                </div>
                <input type="submit" value="Subscribe" class="newsletter__submit__button btn btn-branded dsp-block-xs">
            </div>
            <span visible-when-invalid="valueMissing" validation-for="show-first-on-submit-email"></span>
            <span visible-when-invalid="typeMismatch" validation-for="show-first-on-submit-email"></span>

            <div submit-success="">
                <template type="amp-mustache">
                    Success! Thanks "Demo" for trying the
                    <code>amp-form</code> demo! Try to insert the word "error" as a name input in the form to see how
                    <code>amp-form</code> handles errors.
                </template>
            </div>
            <div submit-error="">
                <template type="amp-mustache">
                    Error! Thanks "Demo" for trying the
                    <code>amp-form</code> demo with an error response.
                </template>
            </div>
        </div>
    </form>

</div>