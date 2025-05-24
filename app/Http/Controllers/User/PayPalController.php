<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction($total, $req, $productId, $transactionId)
    {
        // $req = 'Netbanking';
        // $transactionId =  uniqid('PAYPAL_');
        
        // Configure paypal library for payment
        return redirect()->route('order',[$total, $req, $productId, $transactionId]);
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request, $total, $req, $productId, $transactionId   )
    {
        $provider = new PayPalClient;
        // $number = $total/83.21;
        $val = 0;
        if (is_numeric($total)) {
            $number = $total/83.21;
            $val = number_format($number, 2, '.', ',');
        } 
        else {
            // handle the case where $total is not numeric
            // e.g. log an error message, return an error response, etc.
        }
        // $val = number_format($number, 2, '.', ',');
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction',[$total, $req, $productId, $transactionId]),
                "cancel_url" => route('cancelTransaction',[$total, $req, $productId, $transactionId]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $val
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction',[$total, $req, $productId, $transactionId])
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction',[$total, $req, $productId, $transactionId])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request, $total, $req, $productId, $transactionId)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // $transactionId = $provider->getTransactionId();
            $transactionId = $response['id'];
            return redirect()
                ->route('order',[$total, $req, $productId, $transactionId])
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction0',[$total, $req, $productId, $transactionId])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request, $total, $req, $productId, $transactionId)
    {
        return redirect()
            ->route('createTransaction',[$total, $req, $productId, $transactionId])
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    // cart 
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransactions($total, $req, $transactionId)
    {
        // $req = 'Netbanking';
        // $transactionId =  uniqid('PAYPAL_');
        
        // Configure paypal library for payment
        return redirect()->route('cart.order',[$total, $req, $transactionId]);
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransactions(Request $request, $total, $req, $transactionId)
    {
        $provider = new PayPalClient;
        // $number = $total/83.21;
        $val = 0;
        if (is_numeric($total)) {
            $number = $total/83.21;
            $val = number_format($number, 2, '.', ',');
        } 
        else {
            // handle the case where $total is not numeric
            // e.g. log an error message, return an error response, etc.
        }
        // $val = number_format($number, 2, '.', ',');
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransactions',[$total, $req, $transactionId]),
                "cancel_url" => route('cancelTransactions',[$total, $req, $transactionId]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $val
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransactions',[$total, $req, $transactionId])
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransactions',[$total, $req, $transactionId])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransactions(Request $request, $total, $req, $transactionId)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        // $transactionId = $provider->getTransactionId(config('paypal');
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $transactionId = $response['id'];
            return redirect()
                ->route('cart.order',[$total, $req, $transactionId])
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransactions',[$total, $req, $transactionId])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransactions(Request $request, $total, $req, $transactionId)
    {
        return redirect()
            ->route('createTransactio0ns',[$total, $req, $transactionId])
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
