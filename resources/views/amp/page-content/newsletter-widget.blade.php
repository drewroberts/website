<div class="bg-gray-100">
    <form method="post" class="p-5">
        <input type="hidden" name="_token" value="3wSBZm9GM1F2AcMobOzOXHfYvbFD05QFdbyz5zOi">
        <div class="newsletter">
            <div class="mb-4">
                <h2 class="font-bold text-black text-4xl mb-4">Get the #1 Newsletter for Programmers.</h2>
                <p class="font-bold uppercase text-black">Sign up for coding tips and personalized insights, delivered weekly.</p>
            </div>
            <div class="mb-4">
                <input id="email" type="email" required="" placeholder="Email Address" class="bg-white text-black p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <input id="name" type="text" required="" placeholder="Name" class="bg-white text-black p-2 rounded w-full">
            </div>
            <div>
                <input type="submit" value="Subscribe" class="text-white bg-black uppercase px-6 py-2 rounded">
            </div>
            <span visible-when-invalid="valueMissing" validation-for="show-first-on-submit-name"></span>
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
