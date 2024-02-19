<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payment;

interface ChargeableInterface
{
    /**
     * (From Laravel/Cashier) Make a "one off" charge on the customer for the given amount.
     *
     * @param  int  $amount
     * @param  string  $paymentMethod
     * @param  array  $options
     * @return \Laravel\Cashier\Payment
     */
    public function charge($amount, $paymentMethod, array $options = []);

    /**
     * (From Laravel/Cashier) Refund a customer for a charge.
     *
     * @param  string  $paymentIntent
     * @param  array  $options
     * @return \Stripe\Refund
     */
    public function refund($paymentIntent, array $options = []);
}
