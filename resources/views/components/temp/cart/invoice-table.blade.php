<h3 class="order-review__title">{{__('web/cart.table_confirm_h6')}}</h3>
<div class="order-review__wrapper">
  <div class="checkout-order-review">
    <table class="checkout-review-order-table">
      <thead>
      <tr>
        <th class="product-name"><strong>{{__('web/cart.review_product')}}</strong></th>
        <th class="product-total"><strong>{{__('web/cart.review_pro_subtotal')}}</strong></th>
      </tr>
      </thead>
      <tbody>
      @foreach($cartList as $ProductCart)
        <tr class="cart_item">
          <td class="product-name"><strong class="product-quantity">{{$ProductCart->qty}} × </strong> {{$ProductCart->name}} {{$ProductCart->options->v_name ?? '' }}</td>
          <td class="product-total"><span class="cart_price">{{number_format($ProductCart->price *  $ProductCart->qty)}}   {!! __('web/product.label_currency_s') !!}</span></td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
      <tr class="cart_subtotal cart_item">
        <th><strong>{{__('web/cart.review_total')}}</strong></th>
        <td><span class="cart_price">{{number_format($subTotal)}}  {!! __('web/product.label_currency_s') !!}</span></td>
      </tr>
      <tr class="cart_item">
        <th>
          <strong>{{__('web/cart.table_shipping')}}</strong>
          <span id="shippingSpan">{{__('web/cart.table_shipping_mass')}}</span>
        </th>

        <td><span class="cart_price" id="shippingText"></span></td>
      </tr>
      <tr class="cart_subtotal cart_item">
        <th><strong>{{__('web/cart.review_total_invoce')}}</strong></th>
        <td><strong><span class="cart_price amount" id="invoiceTotal" >{{number_format($subTotal)}}  {!! __('web/product.label_currency_s') !!}</span></strong></td>
      </tr>
      </tfoot>
    </table>

  </div>
</div>