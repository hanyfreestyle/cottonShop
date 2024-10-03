<?php

namespace App\AppPlugin\Customers;

use App\AppPlugin\Customers\Models\ShoppingOrder;
use App\AppPlugin\Customers\Models\ShoppingOrderAddress;
use App\AppPlugin\Customers\Models\ShoppingOrderProduct;
use App\AppPlugin\Customers\Models\UsersCustomersAddress;
use App\AppPlugin\Customers\Request\ShoppingOrderSaveNoneUserRequest;
use App\AppPlugin\Customers\Request\ShoppingOrderSaveRequest;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Orders\Models\Order;
use App\AppPlugin\Orders\Models\PayMobResponses;
use App\AppPlugin\Orders\Models\ShippingCity;
use App\AppPlugin\Product\Models\Product;
use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Paymob\Library\Paymob;

class ShoppingCartController extends WebMainController {

    public function __construct() {
        parent::__construct();

        $stopCash = 0;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PaymobCallback(Request $request) {
        $orderInfo = explode("#", $request->merchant_order_id);

        if (intval($request->id) > 0 and count($orderInfo) == 2) {
            try {
                DB::transaction(function () use ($request, $orderInfo) {
                    $response = json_encode($request->all());
                    if ($request->success == 'true') {
                        $success = 1;
                    } else {
                        $success = 0;
                    }
                    $saveResponse = new PayMobResponses();
                    $saveResponse->paymob_id = $request->id;
                    $saveResponse->paymob_order_id = $request->order;
                    $saveResponse->success = $success;
                    $saveResponse->merchant_order_id = $request->merchant_order_id;
                    $saveResponse->amount_cents = $request->amount_cents;
                    $saveResponse->order_id = $orderInfo[0];
                    $saveResponse->order_uuid = $orderInfo[1];
                    $saveResponse->responses = $response;
                    $saveResponse->save();

                    $orderUpdate = Order::query()
                        ->where('id', $saveResponse->order_id)
                        ->where('uuid', $saveResponse->order_uuid)
                        ->where('payment_method', 1)
                        ->firstOrFail();

                    $orderUpdate->paymob_id = $saveResponse->paymob_id;
                    $orderUpdate->paymob_order_id = $saveResponse->paymob_order_id;
                    $orderUpdate->success = $saveResponse->success;
                    $orderUpdate->save();

                });

            } catch (\Exception $exception) {
                return redirect()->route('Shop_CartView');
            }
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PaymobResponse(Request $request) {

        dd($request->all());
        $orderInfo = explode("#", $request->merchant_order_id);

        if (intval($request->id) > 0 and count($orderInfo) == 2) {
            try {
                $getData = DB::transaction(function () use ($request, $orderInfo) {
                    $response = json_encode($request->all());
                    if ($request->success == 'true') {
                        $success = 1;
                    } else {
                        $success = 0;
                    }
                    $saveResponse = new PayMobResponses();
                    $saveResponse->paymob_id = $request->id;
                    $saveResponse->paymob_order_id = $request->order;
                    $saveResponse->success = $success;
                    $saveResponse->merchant_order_id = $request->merchant_order_id;
                    $saveResponse->amount_cents = $request->amount_cents;
                    $saveResponse->order_id = $orderInfo[0];
                    $saveResponse->order_uuid = $orderInfo[1];
                    $saveResponse->responses = $response;
                    $saveResponse->save();

                });
            } catch (\Exception $exception) {
                return redirect()->route('Shop_CartView');
            }

            return redirect()->route('Shop_PaymobConfirm', [$orderInfo[1], $request->id]);

        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PaymobConfirm($uuid, $id) {
        try {
            $res = PayMobResponses::query()
                ->where('order_uuid', $uuid)
                ->where('paymob_id', $id)
                ->firstOrFail();

            $orderUpdate = Order::query()
                ->where('id', $res->order_id)
                ->where('uuid', $res->order_uuid)
                ->where('payment_method', 1)
                ->firstOrFail();

            $orderUpdate->paymob_id = $res->paymob_id;
            $orderUpdate->paymob_order_id = $res->paymob_order_id;
            $orderUpdate->success = $res->success;
            $orderUpdate->save();

            if ($res->success) {
                Cart::destroy();
                return redirect()->route('Shop_CartOrderCompleted');
            } else {
                return redirect()->route('Shop_CartOrderCompleted');
            }
        } catch (\Exception $e) {
            self::abortError404('root');
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CartView
    public function CartView(Request $request) {

        $meta = parent::getMeatByCatId('cart');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Offers';
        $pageView['page'] = 'cart_page';
        $pageView['profileMenu'] = 'cart_page';

        return view('web.cart.cart_view')->with([
            'meta' => $meta,
            'pageView' => $pageView,
        ]);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CartOrderCompleted
    public function CartOrderCompleted() {

        $meta = parent::getMeatByCatId('cart');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Offers';
        $pageView['page'] = 'cart_page';
        $pageView['profileMenu'] = 'cart_page';


        $CartList = Cart::content();

        if ($CartList->count() > 0) {
            return redirect()->route('Shop_CartView');
        } else {
            return view('web.cart.cart_completed')->with([
                'meta' => $meta,
                'pageView' => $pageView,
            ]);

        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CartConfirm
    public function CartConfirm() {

        $meta = parent::getMeatByCatId('cart');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Offers';
        $pageView['page'] = 'cart_page';

        if (Auth::guard('customer')->user()) {
            $UserProfile = Auth::guard('customer')->user();
            $addresses = UsersCustomersAddress::where('customer_id', $UserProfile->id)->get();
            $UserProfile = UsersCustomersAddress::where('customer_id', 0)->get();
        } else {
            $UserProfile = null;
            $addresses = null;
        }

        $cartList = Cart::content();
        $subTotal = Cart::subtotal();

        $PageErr = self::CheckCartProduct();

        if ($cartList->count() > 0 and $PageErr == 0) {

            return view('web.cart.cart_confirm')->with([
                'meta' => $meta,
                'pageView' => $pageView,
                'cartList' => $cartList,
                'subTotal' => $subTotal,
                'UserProfile' => $UserProfile,
                'addresses' => $addresses,
            ]);

        } else {
            return redirect()->route('Shop_CartView');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ShippingConfirm(Request $request) {
        $subTotal = Cart::subtotal();

        if ($request->city_id) {
            $city_id = [$request->city_id];
            $getRates = ShippingCity::query()->whereJsonContains('city_id', $city_id)->with('rates')->first();

            if (!$getRates->is_active) {
                $sendData = [
                    'cityRate' => null,
                    'cityDiscount' => null,
                    'cityName' => null,
                    'shipping' => 'Error',
                    'shippingText' => '<span class="free_shipping">' . __('web/cart.table_shipping_mass_4') . '</span>',
                    'shippingSpan' => null,
                    'invoiceTotal' => "0"
                ];

            } else {

                $cityData = $this->cashCityList->where('id', $request->city_id)->first();

                $getRates = ShippingCity::query()->whereJsonContains('city_id', $city_id)->with('rates')->first();

                if (count($getRates->rates) == 0) {
                    $shipping = 0;
                    $invoiceTotal = intval($subTotal);
                    $shippingText = '<span class="free_shipping">' . __('web/cart.table_shipping_mass_5') . '</span>';
                    $shippingSpan = '<span class="free_shippingX">' . __('web/cart.table_shipping_mass') . '</span>';

                } else {
                    $rates = $getRates->rates
                        ->where('price_from', '<=', $subTotal)
                        ->where('price_to', '>=', $subTotal)->first();

                    $shipping = intval($rates->rate);
                    $goodRates = $getRates->rates->toarray();
                    $goodRates = array_sort($goodRates, 'rate', $order = SORT_ASC);

                    if ($shipping == 0) {
                        $shippingText = '<span class="free_shipping">' . __('web/cart.table_shipping_mass_3') . '</span>';
                    } else {
                        $shippingText = intval($shipping);
                    }
                    $invoiceTotal = intval($shipping + $subTotal);

                    if (intval($goodRates['0']['rate']) == 0) {
                        $goodRates['0']['rate'] = __('web/cart.mass_free_1');
                    }

                    $rep = ['[CityName]', '[CityRate]', '[CityDiscount]'];
                    $rep_2 = [$cityData->name, $goodRates['0']['rate'], $goodRates['0']['price_from']];
                    $shippingSpan = str_replace($rep, $rep_2, __('web/cart.table_shipping_mass_2'));

                }

                $sendData = [
                    'cityRate' => "",
                    'cityDiscount' => 'cityDiscount',
                    'cityName' => $cityData,
                    'shipping' => $shipping,
                    'shippingText' => $shippingText,
                    'shippingSpan' => $shippingSpan,
                    'invoiceTotal' => number_format($invoiceTotal) . " " . __('web/product.label_currency_s')
                ];

            }

        } else {
            $sendData = [
                'cityRate' => null,
                'cityDiscount' => null,
                'cityName' => null,
                'shipping' => null,
                'shippingText' => null,
                'shippingSpan' => null,
                'invoiceTotal' => null
            ];
        }

        return response()->json(['data' => $sendData]);
    }

    public function ShippingConfirm_BackUp(Request $request) {
        $subTotal = Cart::subtotal();

        if ($request->city_id) {
            $city_id = $request->city_id;

            $cityData = $this->cashCityList->where('id', $city_id)->first();
            $cityRate = $cityData->rate;
            $cityDiscount = $cityData->discount;

            if ($subTotal >= $cityDiscount) {
                $shipping = '0';
                $shippingText = '<span class="free_shipping">' . __('web/cart.table_shipping_mass_3') . '</span>';
            } else {
                $shipping = $cityRate;
                $shippingText = number_format($cityRate) . " " . __('web/product.label_currency_s');
            }

            $rep = ['[CityName]', '[CityRate]'];
            $rep_2 = [$cityData->name, $cityDiscount];
            $shippingSpan = str_replace($rep, $rep_2, __('web/cart.table_shipping_mass_2'));

            $sendData = [
                'cityRate' => $cityRate,
                'cityDiscount' => $cityDiscount,
                'cityName' => $cityData->name,
                'shipping' => $shipping,
                'shippingText' => $shippingText,
                'shippingSpan' => $shippingSpan,
                'invoiceTotal' => number_format($subTotal + $shipping) . " " . __('web/product.label_currency_s')
            ];
        } else {
            $sendData = [
                'cityRate' => null,
                'cityDiscount' => null,
                'cityName' => null,
                'shipping' => null,
                'shippingText' => null,
                'shippingSpan' => null,
                'invoiceTotal' => null
            ];
        }

        return response()->json(['data' => $sendData]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ShippingAddressUpdate(Request $request) {
        if ($request->address_id) {
            $address_id = $request->address_id;
            $address = UsersCustomersAddress::where('uuid', $address_id)->first();
            return response()->json(['data' => $address]);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function NoneUserOrderSave(ShoppingOrderSaveNoneUserRequest $request) {

        $PageErr = self::CheckCartProduct();

        if ($PageErr > 0) {
            return redirect()->route('Shop_CartView');
        }

        $CartList = Cart::content();

        if ($CartList->count() > 0) {

            try {
                $getData = DB::transaction(function () use ($request) {
                    $saveData = true;

                    $CartList = Cart::content();
                    $subtotal = Cart::subtotal();

                    $newAddress = new ShoppingOrderAddress();
                    $cityName = City::where('id', $request->input('city_id'))->first()->name;

                    $newAddress->name = $request->input('name');
                    $newAddress->city = $cityName;
                    $newAddress->address = $request->input('address');
                    $newAddress->phone = $request->input('phone');
                    $newAddress->phone_option = $request->input('phone_option');
                    $newAddress->notes = $request->input('notes');
                    if ($saveData == true) {
                        $newAddress->save();
                    }

                    $newOrder = self::saveOrderData($request, $saveData, $newAddress);

                    if ($saveData == true) {
                        if ($request->input('payment_method') == 2) {
                            Cart::destroy();
                        }
                    }

                    return [
                        'order_id' => $newOrder->id,
                        'order_uuid' => $newOrder->uuid,
                        'cust_name' => $request->input('name'),
                        'city_name' => $cityName,
                        'order_total' => $subtotal,
                        'total_invoice' => $newOrder->total_invoice,
                        'order_units' => $CartList->count(),
                        'order_date' => $newOrder->getFormatteDateOrderView(),
                    ];

                });
            } catch (\Exception $exception) {
                return redirect()->back()->with('Error', __('web/order.err_order_not_saved'));
            }

            if ($request->input('payment_method') == 2) {
                return redirect()->route('Shop_CartOrderCompleted');
            } else {

                $paymobKeys['apiKey'] = env('PAYMOB_API_KEY');
                $paymobKeys['pubKey'] = env('PAYMOB_PUB_KEY');
                $paymobKeys['secKey'] = env('PAYMOB_SEC_KEY');
                $cents = 100; // 100 for all countries and 1000 for Oman
                $name = $request->input('name');

                if ((count(explode(" ", $name)) == 1)) {
                    $first_name = $name;
                    $last_name = $name;
                } else {
                    $first_name = explode(" ", $name)[0];
                    $last_name = explode(" ", $name)[1];
                }

                $paymobReq = new Paymob();
                $result = $paymobReq->authToken($paymobKeys);

                $billing = [
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "street" => $request->input('address'),
                    "phone_number" => $request->input('phone'),
                    "city" => $getData['city_name'],
                    "country" => 'Egypt',
                    "state" => $getData['city_name'],
                    "postal_code" => "21111",
                ];

                $orderId = $getData['order_id'] . '#' . $getData['order_uuid'];
                $order_total = intval($getData['total_invoice']);
                $data = [
                    "amount" => $order_total * $cents,
                    "currency" => 'EGP',
                    "payment_methods" => array(3768464, 4846820), // replace this id 1234567 with your integration ID(s)
                    "billing_data" => $billing,
                    "extras" => ["merchant_intention_id" => $orderId],
                    "special_reference" => $orderId
                ];

                $status = $paymobReq->createIntention($paymobKeys['secKey'], $data, $orderId);

                $countryCode = $paymobReq->getCountryCode($paymobKeys['secKey']);
                $apiUrl = $paymobReq->getApiUrl($countryCode);
                $cs = $status['cs'];

                $to = $apiUrl . "unifiedcheckout/?publicKey=" . $paymobKeys['pubKey'] . "&clientSecret=$cs";
                return redirect($to);
            }

        } else {
            return redirect()->route('Shop_CartView');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function sendTelegramConfirm($getData) {
        $Brek = "%0a";
//        $Brek = '<br/>';
        $Mass = "";
        $Mass .= "تم اضافة طلب جديد" . $Brek;
        $Mass .= '---------------------' . $Brek;
        $Mass .= "رقم الطلب " . " " . ($getData['order_id'] + 1000) . $Brek;
        $Mass .= "اسم العميل : " . $getData['cust_name'] . $Brek;
        $Mass .= "الاجمالى : " . $getData['order_total'] . $Brek;
        $Mass .= "عدد الاصناف " . $getData['order_units'] . $Brek;
        $Mass .= "" . $getData['order_date'] . $Brek;

        if ($this->WebConfig->telegram_key != null) {
            $KEY = $this->WebConfig->telegram_key;
            $PhoneID = $this->WebConfig->telegram_phone;
            $GroupID = $this->WebConfig->telegram_group;

            if ($this->WebConfig->telegram_phone != null) {
                $url = "https://api.telegram.org/bot$KEY/sendMessage?chat_id=$PhoneID&text=" . $Mass;
                $sendrequest = Http::post($url);
            }
            if ($this->WebConfig->telegram_group != null) {
                $url = "https://api.telegram.org/bot$KEY/sendMessage?chat_id=$GroupID&text=" . $Mass;
                $sendrequest = Http::post($url);
            }
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   saveOrderData
    public function saveOrderData($request, $saveData, $newAddress) {

        $CartList = Cart::content();
        $subtotal = Cart::subtotal();


        $newOrder = new ShoppingOrder();
        $newOrder->customer_id = $request->input('customer_id');
        $newOrder->city_id = $request->input('city_id');
        $newOrder->address_id = $newAddress->id;
        $newOrder->uuid = Str::uuid()->toString();
        $newOrder->payment_method = $request->input('payment_method');
        $newOrder->order_date = now();
        $newOrder->status = 1;
        $newOrder->total = $subtotal;
        $newOrder->shipping = $request->input('shipping');
        $newOrder->total_invoice = $subtotal + $request->input('shipping');
        $newOrder->units = $CartList->count();

        if ($saveData == true) {
            $newOrder->save();
        }


        foreach ($CartList as $product) {

            $addProduct = new ShoppingOrderProduct();
            $addProduct->order_id = $newOrder->id;

            if ($product->model->parent_id == null) {
                $addProduct->name = $product->model->name;
                $addProduct->product_id = $product->model->id;
                $addProduct->variant_id = null;
                $addProduct->sku = $product->model->sku;
            } else {
                $addProduct->name = $product->name . $product->options->v_name ?? '';
                $addProduct->product_id = $product->model->parent_id;
                $addProduct->variant_id = $product->model->id;
                $addProduct->sku = $product->model->mainPro->sku;
            }

            $addProduct->price = $product->model->price;
            $addProduct->regular_price = $product->model->regular_price;
            $addProduct->qty = $product->qty;

            if ($saveData == true) {
                $addProduct->save();
                Product::find($product->model->id)->increment('sales_count', $product->qty);
            }
        }

        return $newOrder;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CartOrderSave
    public function CartOrderSave(ShoppingOrderSaveRequest $request) {

        $PageErr = self::CheckCartProduct();
        if ($PageErr > 0) {
            return redirect()->route('Shop_CartView');
        }

        $CartList = Cart::content();

        if ($CartList->count() > 0) {
            try {

                $getData = DB::transaction(function () use ($request) {

                    $saveOrderData = true;

                    $CartList = Cart::content();
                    $subtotal = Cart::subtotal();
                    $UserProfile = Auth::guard('customer')->user();


                    $address = UsersCustomersAddress::with('city')
                        ->where('uuid', $request->input('address_id'))
                        ->firstOrFail();

                    $newAddress = new ShoppingOrderAddress;

                    $newAddress->name = $address->name;
                    $newAddress->city = $address->city->name;
                    $newAddress->address = $address->address;
                    $newAddress->recipient_name = $address->recipient_name;
                    $newAddress->phone = $address->phone;
                    $newAddress->phone_option = $address->phone_option;
                    $newAddress->notes = $request->input('notes');

                    if ($saveOrderData == true) {
                        $newAddress->save();
                    }


                    $newOrder = new ShoppingOrder;
                    $newOrder->customer_id = $UserProfile->id;
                    $newOrder->address_id = $newAddress->id;
                    $newOrder->uuid = Str::uuid()->toString();
                    $newOrder->order_date = now();
                    $newOrder->status = 1;
                    $newOrder->total = $subtotal;
                    $newOrder->units = $CartList->count();

                    if ($saveOrderData == true) {
                        $newOrder->save();
                    }


                    foreach ($CartList as $product) {
                        $addProduct = new ShoppingOrderProduct();
                        $addProduct->order_id = $newOrder->id;
                        $addProduct->sku = $product->model->ref_code;
                        $addProduct->product_ref = $product->model->id;
                        $addProduct->name = $product->model->name;
                        $addProduct->price = $product->model->price;
                        $addProduct->sale_price = $product->model->sale_price;
                        $addProduct->qty = $product->qty;

                        if ($saveOrderData == true) {
                            $addProduct->save();
                            Product::find($product->model->id)->decrement('qty_left', $product->qty);
                        }

                    }

                    if ($saveOrderData == true) {
                        Cart::destroy();
                    }

                    return $data = [
                        'order_id' => $newOrder->id,
                        'cust_name' => $UserProfile->name,
                        'order_total' => $subtotal,
                        'order_units' => $CartList->count(),
                        'order_date' => $newOrder->getFormatteDateOrderView(),
                    ];


                });

            } catch (\Exception $exception) {
                return redirect()->back()->with('order_not_saved', __('web/orders.err_order_not_saved'));
            }

            //$Brek = '<br/>';
            $Mass = "";
            $Brek = "%0a";
            $Mass .= "تم اضافة طلب جديد" . $Brek;
            $Mass .= '---------------------' . $Brek;
            $Mass .= "رقم الطلب " . " " . ($getData['order_id'] + 1000) . $Brek;
            $Mass .= "اسم العميل : " . $getData['cust_name'] . $Brek;
            $Mass .= "الاجمالى : " . $getData['order_total'] . $Brek;
            $Mass .= "عدد الاصناف " . $getData['order_units'] . $Brek;
            $Mass .= "" . $getData['order_date'] . $Brek;


            if ($this->WebConfig->telegram_key != null) {

                $KEY = $this->WebConfig->telegram_key;
                $PhoneID = $this->WebConfig->telegram_phone;
                $GroupID = $this->WebConfig->telegram_group;

                if ($this->WebConfig->telegram_phone != null) {
                    $url = "https://api.telegram.org/bot$KEY/sendMessage?chat_id=$PhoneID&text=" . $Mass;
                    $sendrequest = Http::post($url);
                }
                if ($this->WebConfig->telegram_group != null) {
                    $url = "https://api.telegram.org/bot$KEY/sendMessage?chat_id=$GroupID&text=" . $Mass;
                    $sendrequest = Http::post($url);
                }

            }

            $Mass = "";
            $Brek = '\n';
            $Mass .= "تم اضافة طلب جديد" . $Brek;
            $Mass .= '---------------------' . $Brek;
            $Mass .= "رقم الطلب " . " " . ($getData['order_id'] + 1000) . $Brek;
            $Mass .= "اسم العميل : " . $getData['cust_name'] . $Brek;
            $Mass .= "الاجمالى : " . $getData['order_total'] . $Brek;
            $Mass .= "عدد الاصناف " . $getData['order_units'] . $Brek;
            $Mass .= "" . $getData['order_date'] . $Brek;
            AdminHelper::SendWhatsapp($this->WebConfig->whatsapp_send_to, $Mass);

            return redirect()->route('Shop_CartOrderCompleted');
        } else {
            return redirect()->route('Shop_CartView');
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CheckCartProduct
    static function CheckCartProduct() {
        $PageErr = 0;
        return $PageErr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CheckCartProduct_soure
    static function CheckCartProduct_soure() {
        $CartList = Cart::content();

        $products = Product::select('id', 'qty_left', 'price', 'sale_price')
            ->whereIn('id', $CartList->pluck('id'))
            ->get()->keyBy('id');

        $PageErr = 0;
        foreach ($CartList as $ProductCart) {

            $options_price = $ProductCart->options->price;
            $options_sale_price = $ProductCart->options->sale_price;
            $qty = $ProductCart->qty;

            $price_err = 0;
            $qty_err = 0;

            if ($products[$ProductCart->id]->price != $options_price or $products[$ProductCart->id]->sale_price != $options_sale_price) {
                $price_err = 1;
                $PageErr = $PageErr + 1;
            }
            if ($qty > $products[$ProductCart->id]->qty_left) {
                $qty_err = 1;
                $PageErr = $PageErr + 1;
            }

            Cart::update($ProductCart->rowId, [
                'options' => [
                    'price' => $options_price,
                    'sale_price' => $options_sale_price,
                    'qty_left' => $products[$ProductCart->id]->qty_left,
                    'price_err' => $price_err,
                    'qty_err' => $qty_err,
                ]
            ]);
        }
        return $PageErr;
    }


    /*
    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| # CartOrderSave
        public function CartOrderSave(ShoppingOrderSaveRequest $request) {


            $PageErr = self::CheckCartProduct();
            if($PageErr > 0) {
                return redirect()->route('Shop_CartView');
            }

            $CartList = Cart::content();

            if($CartList->count() > 0) {
                try {

                    $getData = DB::transaction(function () use ($request) {

                        $saveOrderData = true;

                        $CartList = Cart::content();
                        $subtotal = Cart::subtotal();
                        $UserProfile = Auth::guard('customer')->user();


                        $address = UsersCustomersAddress::with('city')
                            ->where('uuid', $request->input('address_id'))
                            ->firstOrFail();

                        $newAddress = new ShoppingOrderAddress;

                        $newAddress->name = $address->name;
                        $newAddress->city = $address->city->name;
                        $newAddress->address = $address->address;
                        $newAddress->recipient_name = $address->recipient_name;
                        $newAddress->phone = $address->phone;
                        $newAddress->phone_option = $address->phone_option;
                        $newAddress->notes = $request->input('notes');

                        if($saveOrderData == true) {
                            $newAddress->save();
                        }


                        $newOrder = new ShoppingOrder;
                        $newOrder->customer_id = $UserProfile->id;
                        $newOrder->address_id = $newAddress->id;
                        $newOrder->uuid = Str::uuid()->toString();
                        $newOrder->order_date = now();
                        $newOrder->status = 1;
                        $newOrder->total = $subtotal;
                        $newOrder->units = $CartList->count();

                        if($saveOrderData == true) {
                            $newOrder->save();
                        }


                        foreach ($CartList as $product) {
                            $addProduct = new ShoppingOrderProduct();
                            $addProduct->order_id = $newOrder->id;
                            $addProduct->sku = $product->model->ref_code;
                            $addProduct->product_ref = $product->model->id;
                            $addProduct->name = $product->model->name;
                            $addProduct->price = $product->model->price;
                            $addProduct->sale_price = $product->model->sale_price;
                            $addProduct->qty = $product->qty;

                            if($saveOrderData == true) {
                                $addProduct->save();
                                Product::find($product->model->id)->decrement('qty_left', $product->qty);
                            }

                        }

                        if($saveOrderData == true) {
                            Cart::destroy();
                        }

                        return $data = [
                            'order_id' => $newOrder->id,
                            'cust_name' => $UserProfile->name,
                            'order_total' => $subtotal,
                            'order_units' => $CartList->count(),
                            'order_date' => $newOrder->getFormatteDateOrderView(),
                        ];


                    });

                } catch (\Exception $exception) {
                    return redirect()->back()->with('order_not_saved', __('web/orders.err_order_not_saved'));
                }

                //$Brek = '<br/>';
                $Mass = "";
                $Brek = "%0a";
                $Mass .= "تم اضافة طلب جديد" . $Brek;
                $Mass .= '---------------------' . $Brek;
                $Mass .= "رقم الطلب " . " " . ($getData['order_id'] + 1000) . $Brek;
                $Mass .= "اسم العميل : " . $getData['cust_name'] . $Brek;
                $Mass .= "الاجمالى : " . $getData['order_total'] . $Brek;
                $Mass .= "عدد الاصناف " . $getData['order_units'] . $Brek;
                $Mass .= "" . $getData['order_date'] . $Brek;


                if($this->WebConfig->telegram_key != null) {

                    $KEY = $this->WebConfig->telegram_key;
                    $PhoneID = $this->WebConfig->telegram_phone;
                    $GroupID = $this->WebConfig->telegram_group;

                    if($this->WebConfig->telegram_phone != null) {
                        $url = "https://api.telegram.org/bot$KEY/sendMessage?chat_id=$PhoneID&text=" . $Mass;
                        $sendrequest = Http::post($url);
                    }
                    if($this->WebConfig->telegram_group != null) {
                        $url = "https://api.telegram.org/bot$KEY/sendMessage?chat_id=$GroupID&text=" . $Mass;
                        $sendrequest = Http::post($url);
                    }

                }

                $Mass = "";
                $Brek = '\n';
                $Mass .= "تم اضافة طلب جديد" . $Brek;
                $Mass .= '---------------------' . $Brek;
                $Mass .= "رقم الطلب " . " " . ($getData['order_id'] + 1000) . $Brek;
                $Mass .= "اسم العميل : " . $getData['cust_name'] . $Brek;
                $Mass .= "الاجمالى : " . $getData['order_total'] . $Brek;
                $Mass .= "عدد الاصناف " . $getData['order_units'] . $Brek;
                $Mass .= "" . $getData['order_date'] . $Brek;
                AdminHelper::SendWhatsapp($this->WebConfig->whatsapp_send_to, $Mass);

                return redirect()->route('Shop_CartOrderCompleted');
            } else {
                return redirect()->route('Shop_CartView');
            }

        }

    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     CheckCartProduct
        static function CheckCartProduct() {
            $CartList = Cart::content();

            $products = Product::select('id', 'qty_left', 'price', 'sale_price')
                ->whereIn('id', $CartList->pluck('id'))
                ->get()->keyBy('id');

            $PageErr = 0;
            foreach ($CartList as $ProductCart) {

                $options_price = $ProductCart->options->price;
                $options_sale_price = $ProductCart->options->sale_price;
                $qty = $ProductCart->qty;

                $price_err = 0;
                $qty_err = 0;

                if($products[$ProductCart->id]->price != $options_price or $products[$ProductCart->id]->sale_price != $options_sale_price) {
                    $price_err = 1;
                    $PageErr = $PageErr + 1;
                }
                if($qty > $products[$ProductCart->id]->qty_left) {
                    $qty_err = 1;
                    $PageErr = $PageErr + 1;
                }

                Cart::update($ProductCart->rowId, [
                    'options' => [
                        'price' => $options_price,
                        'sale_price' => $options_sale_price,
                        'qty_left' => $products[$ProductCart->id]->qty_left,
                        'price_err' => $price_err,
                        'qty_err' => $qty_err,
                    ]
                ]);
            }
            return $PageErr;
        }


    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     CartEmpty
        public function CartEmpty() {
            //Session::flush();
            Cart::destroy();
            return redirect()->back();
        }

    */
}
