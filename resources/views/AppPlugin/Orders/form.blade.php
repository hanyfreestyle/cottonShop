@if($order->status == 1)
  <x-admin.card.normal :title="__('admin/orders.form_card_update')">
    <form action="{{route('admin.ShopOrders.ConfirmNew',$order->uuid)}}" method="post">
      @csrf
      <div class="row">
        <x-admin.form.select-arr name="order_status" :sendvalue="old('order_status')" :label="__('admin/orders.from_order_status')" col="12" :send-arr="$OrdersStatusArr"/>
      </div>
      <x-admin.form.textarea name="notes" :label="__('admin/orders.form_notes')" value="{{old('notes')}}"/>

      <x-admin.form.submit text="Update"/>
    </form>
  </x-admin.card.normal>
@elseif($order->status == 2)
  <x-admin.orders.log :order="$order"/>

  <x-admin.card.normal :title="__('admin/orders.form_card_update')">
    <form action="{{route('admin.ShopOrders.ConfirmPending',$order->uuid)}}" method="post">
      @csrf

      <div class="row">
        <x-admin.form.select-arr name="order_status" :sendvalue="old('order_status')" :label="__('admin/orders.from_order_status')" col="12" :send-arr="$PendingStatusArr"/>
      </div>

      <div class="row">
        <x-admin.form.input name="invoice_number" value="{{old('invoice_number')}}" :req="false" :label="__('admin/orders.log_invoce_num')"/>
      </div>

      <x-admin.form.textarea name="notes" :label="__('admin/orders.form_notes')" value="{{old('notes')}}"/>
      <x-admin.form.submit text="Update"/>
    </form>
  </x-admin.card.normal>
@endif
