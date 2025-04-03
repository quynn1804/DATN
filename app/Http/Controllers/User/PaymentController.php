<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momoQr_payment(Request $request){

        $cart_Total = $request->all();
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount =  $cart_Total['amount'];
        $orderId = time() ."";
        $redirectUrl = route('momo.callback');
        $ipnUrl = route('momo.callback');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash,  $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        } else {
            return back()->with('error', 'Lỗi khi tạo thanh toán MoMo: ' . json_encode($jsonResult));
        }
        }

    public function momoCallback(Request $request)
    {
        $orderId = $request->input('orderId');
        $resultCode = $request->input('resultCode');
        $amount = $request->input('amount');
        $data = $request->all();

        Log::info("MomoPay Response Data: ", $data);

        if ($resultCode == 0) {
            try {
                $cartItems = Cart::where('user_id', auth()->id())->get();
                if ($cartItems->isEmpty()) {
                    return redirect()->route('checkout')->with('error', 'Giỏ hàng trống, không thể tạo đơn hàng.');
                }

                $fullname = $data['fullname'] ?? 'Khách hàng chưa nhập';
                $phone = $data['phone'] ?? '0000000000';
                $address = $data['address'] ?? 'Chưa có địa chỉ';

                // Kiểm tra nếu đơn hàng đã tồn tại (tránh tạo trùng)
                $order = Order::where('order_code', $orderId)->first();

                if ($order) {
                    $order->update([
                        'status' => 'pending', // Cập nhật trạng thái đã thanh toán
                        'payment_method' => 'MoMo',
                    ]);
                } else {
                    $order = Order::create([
                        'order_code' => $orderId,
                        'user_id' => auth()->check() ? auth()->id() : null,
                        'name' => $fullname,
                        'phone' => $phone,
                        'address' => $address,
                        'total_money' => $amount,
                        'status' => 'pending',
                        'payment_method' => 'MoMo',
                        'note' => $data['voucher'] ?? null,
                    ]);
                }

                foreach ($cartItems as $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price_at_time' => $item->price_at_time,
                        'total_price' => $item->price_at_time * $item->quantity,
                    ]);
                }

                Cart::where('user_id', auth()->id())->delete();

                return redirect()->route('checkout')->with('success', 'Thanh toán thành công! Đơn hàng đã được cập nhật.');
            } catch (\Exception $e) {
                Log::error("Lỗi khi cập nhật đơn hàng: " . $e->getMessage());
                return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng. Vui lòng thử lại.');
            }
        } else {
            return redirect()->route('checkout')->with('error', 'Thanh toán không thành công. Vui lòng thử lại.');
        }
    }

    public function momo_payment(Request $request){
        $cart_Total = $request->all();
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $cart_Total['amount'] ;
        $orderId = time() ."";
        $redirectUrl = route('momo.callback');
        $ipnUrl = route('momo.callback');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";


    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);
    if (isset($jsonResult['payUrl'])) {
        return redirect($jsonResult['payUrl']);
    } else {
        return back()->with('error', 'Lỗi khi tạo thanh toán MoMo: ' . json_encode($jsonResult));
    }

}


    // public function momo_payment(Request $request)
    // {
    //     $cart_Total = $request->all();
    //     $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    //     $partnerCode = 'MOMOBKUN20180529';
    //     $accessKey = 'klm05TvNBzhg7h7j';
    //     $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    //     $orderInfo = "Thanh toán qua MoMo";
    //     $amount = $cart_Total['amount'];
    //     $orderId = time() . "";
    //     $returnUrl = "http://localhost:8000/atm/result_atm.php";
    //     $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
    //     // Lưu ý: link notifyUrl không phải là dạng localhost
    //     $bankCode = "";
    //     $requestId = time() . "";
    //     $requestType = "payWithMoMoATM";
    //     $extraData = "";
    //     //before sign HMAC SHA256 signature
    //     $rawHashArr = array(
    //         'partnerCode' => $partnerCode,
    //         'accessKey' => $accessKey,
    //         'requestId' => $requestId,
    //         'amount' => $amount,
    //         'orderId' => $orderId,
    //         'orderInfo' => $orderInfo,
    //         'bankCode' => $bankCode,
    //         'returnUrl' => $returnUrl,
    //         'notifyUrl' => $notifyurl,
    //         'extraData' => $extraData,
    //         'requestType' => $requestType
    //     );
    //     // echo $serectkey;die;
    //     $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
    //     $signature = hash_hmac("sha256", $rawHash, $secretKey);

    //     $data = array(
    //         'partnerCode' => $partnerCode,
    //         'accessKey' => $accessKey,
    //         'requestId' => $requestId,
    //         'amount' => $amount,
    //         'orderId' => $orderId,
    //         'orderInfo' => $orderInfo,
    //         'returnUrl' => $returnUrl,
    //         'bankCode' => $bankCode,
    //         'notifyUrl' => $notifyurl,
    //         'extraData' => $extraData,
    //         'requestType' => $requestType,
    //         'signature' => $signature
    //     );
    //     $result = $this->execPostRequest($endpoint, json_encode($data));
    //     $jsonResult = json_decode($result, true);  // decode json
    //     return redirect($jsonResult['payUrl']);


    // }


    public function vnpay_payment(Request $request){
        $cart_Total = $request->all();

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $vnp_Returnurl = url('/vnpay/return');
        $vnp_TmnCode = "BTBFJN9W";//Mã website tại VNPAY
        $vnp_HashSecret = "GGHNNJ0P5F96PLOMSWBVM0N4NVR0RNPY"; //Chuỗi bí mật

        $vnp_TxnRef = time() . ""; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này
        $vnp_OrderInfo = "Thanh Toan Don Hang";
        $vnp_OrderType = "PinaStore";
        $vnp_Amount =  $cart_Total['amount'] * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect()->away($vnp_Url);
            // vui lòng tham khảo thêm tại code demo
        }



        public function vnpayReturn(Request $request)
        {
            $vnp_ResponseCode = $request->input('vnp_ResponseCode');
            $vnp_TxnRef = $request->input('vnp_TxnRef');
            $vnp_Amount = $request->input('vnp_Amount') / 100;
            $data = $request->all();

            Log::info("VNPay Response Data: ", $data);

            if ($vnp_ResponseCode == '00') {
                try {
                    $cartItems = Cart::where('user_id', auth()->id())->get();
                    if ($cartItems->isEmpty()) {
                        Log::error("Giỏ hàng trống, không thể tạo đơn hàng.");
                        return redirect()->route('checkout')->with('error', 'Giỏ hàng trống, không thể tạo đơn hàng.');
                    }

                    // Xử lý nếu thiếu dữ liệu
                    $fullname = $data['fullname'] ?? 'Khách hàng chưa nhập';
                    $phone = $data['phone'] ?? '0000000000';
                    $address = $data['address'] ?? 'Chưa có địa chỉ';

                    $order = Order::create([
                        'order_code' => $vnp_TxnRef,
                        'user_id' => auth()->check() ? auth()->id() : null,
                        'name' => $fullname,
                        'phone' => $phone,
                        'address' => $address,
                        'total_money' => $vnp_Amount,
                        'status' => 'pending',
                        'payment_method' => 'VNPay',
                        'note' => $data['voucher'] ?? null,
                    ]);

                    Log::info("Đơn hàng đã tạo thành công: ", $order->toArray());

                    foreach ($cartItems as $item) {
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'product_variant_id' => $item->product_variant_id,
                            'quantity' => $item->quantity,
                            'price_at_time' => $item->price_at_time,
                            'total_price' => $item->price_at_time * $item->quantity,
                        ]);
                    }

                    Cart::where('user_id', auth()->id())->delete();
                    Log::info("Đã xóa giỏ hàng của user_id: " . auth()->id());

                    return redirect()->route('checkout')->with('success', 'Thanh toán thành công! Đơn hàng đã được cập nhật.');
                } catch (\Exception $e) {
                    Log::error("Lỗi khi tạo đơn hàng: " . $e->getMessage());
                    return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra khi tạo đơn hàng. Vui lòng thử lại.');
                }
            } else {
                Log::warning("Thanh toán thất bại, mã phản hồi: " . $vnp_ResponseCode);
                return redirect()->route('checkout')->with('error', 'Thanh toán không thành công. Vui lòng thử lại.');
            }
        }


    public function checkout()
    {
        // Lấy giỏ hàng của người dùng từ cơ sở dữ liệu
        $cartItems = \App\Models\Cart::where('user_id', auth()->id())->get();

        // Tính tổng tiền của giỏ hàng
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->price_at_time * $item->quantity;
        });

        return view('user.checkout', compact('cartItems', 'cartTotal'));
    }

    public function processPayment(Request $request)
    {
        $data = $request->all();

        // Lấy tổng tiền sau khi đã trừ giảm giá từ request
        $finalAmount = $data['amount'];

        // Kiểm tra phương thức thanh toán
        if ($data['payment_method'] === 'cod') {
            try {
                // Tạo mã đơn hàng duy nhất
                $orderCode = 'ORD-' . strtoupper(uniqid());
                $cartItems = Cart::where('user_id', auth()->id())->get();

                // Lưu đơn hàng vào bảng orders
                $order = Order::create([
                    'order_code' => $orderCode,
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'name' => $data['fullname'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'total_money' => $finalAmount, // ✅ Lưu giá trị đã trừ giảm giá
                    'status' => 'pending',
                    'payment_method' => 'cash',
                    'note' => $data['voucher'] ?? null,
                ]);

                // Lưu các sản phẩm trong giỏ hàng vào bảng `order_details`
                foreach ($cartItems as $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price_at_time' => $item->price_at_time,
                        'total_price' => $item->price_at_time * $item->quantity,
                    ]);
                }

                // Xoá giỏ hàng sau khi đặt hàng thành công
                Cart::where('user_id', auth()->id())->delete();

                // Chuyển hướng về trang cảm ơn hoặc trang chủ
                return redirect()->route('home')->with('success', 'Đơn hàng của bạn đã được tạo thành công!');
            } catch (\Exception $e) {
                return back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng. Vui lòng thử lại.');
            }
        }

        // Các phương thức thanh toán khác
        if ($data['payment_method'] === 'momo') {
            return $this->momo_payment($request);
        }

        if ($data['payment_method'] === 'momoQr') {
            return $this->momoQr_payment($request);
        }

        if ($data['payment_method'] === 'vnpay') {
            return $this->vnpay_payment($request);
        }

        return back()->with('error', 'Phương thức thanh toán không hợp lệ.');
    }


}
