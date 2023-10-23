<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            // Create a PaymentIntent with amount and currency
            // $paymentIntent = PaymentIntent::create([
            //     'amount' => 30,
            //     'currency' => 'usd',

            // ]);

            // $price = \Stripe\Price::create([
            //     'unit_amount' => 99,
            //     'currency' => 'usd',
            //     'recurring' => ['interval' => 'month'],
            //     'product_data' => [
            //         'name' => "Pro plan",
            //         // 'description' => "its a pro plan that has lot of information",
            //     ],
            // ]);

            // $customer = Customer::create([
            //     'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
            //     // Add any other customer-related attributes here
            // ]);

            // $coupon = Coupon::create([
            //     'percent_off' => 25.5,
            //     'duration' => 'repeating',
            //     'duration_in_months' => 3,
            //     // Add any other coupon-related attributes here
            // ]);

            // $subscription = \Stripe\Subscription::create([
            //     'customer' => 'cus_OfUUQFVcJyoPNY',
            //     'items' => [
            //         ['price' => 'price_1NuqKVSCGOvHPgAsqi4mHeY8'], // Replace with the price ID
            //     ],
            //     'payment_settings' => [
            //         'payment_method_types' => ['card'],
            //     ],
            // ]);
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

            $paymentMethod = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 12,
                    'exp_year' => 2034,
                    'cvc' => '314',
                ],
            ]);

            // $output = [
            //     'clientSecret' => $paymentIntent->client_secret,
            // ];

            return response()->json($paymentMethod);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function findStipeUser(Request $req)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $get_results = DB::table('users')
                ->where('user_id', $req->user_id)
                ->where('remember_token', $req->token)
                ->first();
            if ($get_results) {
                if ($get_results->stripe_userid != null) {
                    return response()->json(['stripe Id' => $get_results->stripe_userid], 200);
                } else {
                    $customer = Customer::create([
                        'description' => 'ehoa customer with id :-',
                        'email' => $get_results->email,
                        'name' => $get_results->name,
                        // Add any other customer-related attributes here
                    ]);
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'stripe_userid' => $customer->id,
                            )
                        );
                    return response()->json(['stripe Id' => $get_results->stripe_userid], 200);
                }
            } else {
                return response()->json(['error' => 'Your token is expired, please check your token and user id'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function createSubscription(Request $req)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $get_results = DB::table('users')
                ->where('user_id', $req->user_id)
                ->where('remember_token', $req->token)
                ->first();
            if ($get_results) {
                if ($req->package == 1) {
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $get_results->stripe_userid,
                        'items' => [
                            ['price' => 'price_1NuqKVSCGOvHPgAsqi4mHeY8'],
                        ],
                        'default_payment_method' => "pm_1NwOSLSCGOvHPgAs3ozOxGgT",
                        'description' => "payment for the Ehoa Monthly plan",
                    ]);
                } else {
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $req->stripe_id,
                        'items' => [
                            ['price' => 'price_1Nw1SUSCGOvHPgAsiLQ3CbIO'],
                        ],
                        'coupon' => "7yx5Juh0",
                    ]);

                }
            } else {
                return response()->json(['error' => 'Your token is expired, please check your token and user id'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function addDefaultPaymentMethod(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $get_results = DB::table('users')
                ->where('user_id', $request->user_id)
                ->where('remember_token', $request->token)
                ->first();
            $customerId = Customer::retrieve($get_results->stripe_userid);
            $paymentMethodId = $request->input('payment_method_id');
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);

            // Attach the payment method to the customer
            $paymentMethod->attach(['customer' => $customerId->id]);

            $customer = Customer::update($customerId->id, ['invoice_settings' => ['default_payment_method' => $paymentMethodId]]);

            // $paymentMethodId = $request->input('payment_method_id');
            // $customer->invoice_settings->default_payment_method = $paymentMethodId;
            // $customer->save();

            return response()->json(['message' => 'Default payment method set successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function createPrice(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            // You can customize these values based on your requirements
            $price = Price::create([
                'product_data' => [
                    'name' => $request->input('product_name'),
                ],
                'unit_amount' => $request->input('unit_amount'), // Amount in cents (e.g., $10.00 is 1000 cents)
                'currency' => 'usd',
                'recurring' => [
                    'interval' => 'year',
                ],
            ]);

            return response()->json(['price_id' => $price->id], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
