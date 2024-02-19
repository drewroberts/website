<?php namespace Tipoff\Addresses\Http\Livewire;

use Livewire\Component;
use Tipoff\Addresses\Actions\SavePhoneNumberAction;

class PhoneNumberField extends Component
{
    public function savePhoneNumber($phoneNumber)
    {
        try {
            (new SavePhoneNumberAction)->execute($phoneNumber);

            $this->dispatchBrowserEvent('success', $phoneNumber);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('addresses::livewire.phone-number-field');
    }
}
