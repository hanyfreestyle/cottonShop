<div class="invoice  invoice_info p-3 mb-3">
    <div class="row">
        <div class="col-12">
            <h4>#{{$order->id+1000}}
                <small class="float-right">{{$order->orderDate()}}</small>
            </h4>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-5 invoice-col">
            <h2>بيانات الطلب</h2>
            <p> رقم الطلب : <span>{{$order->id}}</span></p>
            <p style="direction: ltr"> {{$order->id}}#{{$order->uuid}}</p>
            {!! ordersInvoiceInfo($order) !!}
        </div>


        <div class="col-sm-3 invoice-col">
            <h2>{{__('admin/orders.inv_cust_info')}}</h2>
            @if($order->customer == null)
                <p>{{__('admin/orders.inv_cust_info_not_user')}}</p>
            @else
                <p>{{$order->customer->name}}</p>
                <p>{{$order->customer->phone}}</p>
                <p>{{$order->customer->whatsapp}}</p>
            @endif
        </div>

        <div class="col-sm-4 invoice-col">
            <h2>{{__('admin/orders.inv_address_info')}}</h2>
            <p>{{$order->address->name }}</p>
            <p>{{$order->address->phone }}</p>
            <p>{{$order->address->phone_option }}</p>
            <p>{{$order->address->city }}</p>
            <p>{!! nl2br($order->address->address) !!}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{__('admin/orders.title_qty')}}</th>
                    <th>{{__('admin/orders.title_pro_name')}}</th>
                    <th>{{__('admin/orders.title_pro_price_regular')}}</th>
                    <th>{{__('admin/orders.title_pro_price')}}</th>
                    <th>{{__('admin/orders.title_total')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{ number_format($product->regular_price) }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>{{ number_format($product->price * $product->qty) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-6 p-0">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{__('admin/orders.title_pro_total')}}</th>
                        <td class="total_invoice">{{ number_format($order->total) }}</td>
                    </tr>
                    <tr>
                        <th>{{__('admin/orders.title_shipping')}}</th>
                        <td class="total_invoice">{{ number_format($order->shipping) }}</td>
                    </tr>
                    <tr>
                        <th>{{__('admin/orders.title_total_invoice')}}</th>
                        <td class="total_invoice">{{ number_format($order->total_invoice) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
