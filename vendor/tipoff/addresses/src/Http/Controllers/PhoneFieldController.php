<?php

namespace Tipoff\Addresses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tipoff\Addresses\Actions\SavePhoneNumberAction;

class PhoneFieldController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \libphonenumber\NumberParseException
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'max:254'],
        ]);

        $phoneNumber = str_replace(' ', '', $request->phone_number);

        return (new SavePhoneNumberAction)->execute($phoneNumber);
    }
}
