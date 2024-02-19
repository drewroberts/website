<div
    x-data="{
        addressFocused: false
    }"
    @focus-address-line-2.window="$refs.addressLine2.focus()"
    class="flex justify-between w-full text-gray-700 ring-1 ring-gray-300 rounded-md overflow-hidden"
    x-bind:class="{ 'ring-2 ring-blue-300' : addressFocused }"
>
    <div class="w-9/12">
        <label class="ml-2 text-xs text-gray-400 font-semibold tracking-widest">
            Address 1
        </label>
        <input
            id="address-line-1"
            name="address-line-1"
            type="text"
            readonly="readonly"
            wire:model="addressLine1"
            x-on:focus="addressFocused = true"
            x-on:blur="addressFocused = false"
            class="w-full px-2 py-1 focus:outline-none"
            required
        >
    </div>
    <div class="w-3/12 ml-2">
        <label class="ml-2 text-xs text-gray-400 font-semibold tracking-widest">
            Address 2
        </label>
        <input
            id="address-line-2"
            name="address-line-2"
            type="text"
            x-ref="addressLine2"
            x-on:focus="addressFocused = true"
            x-on:blur="addressFocused = false"
            class="w-full px-2 py-1 focus:outline-none"
        >
    </div>
    <div class="">
        <input
            id="city"
            name="city"
            type="hidden"
            wire:model="city"
            required
        >
    </div>
    <div class="">
        <input
            id="state"
            name="state"
            type="hidden"
            wire:model="state"
            required
        >
    </div>
    <div class="">
        <input
            id="zip"
            name="zip"
            type="hidden"
            readonly="readonly"
            wire:model="zip"
            required
        >
    </div>
</div>