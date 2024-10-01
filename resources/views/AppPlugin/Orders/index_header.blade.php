<thead>
<tr>
    <th class="TD_20">{{ __('admin/orders.title_num') }}</th>
    <th class="TD_50">{{ __('admin/orders.title_date') }}</th>
    <th class="TD_100">{{ __('admin/orders.title_payment_method') }}</th>
    <th class="TD_100">{{ __('admin/orders.title_payment_method_state') }}</th>
    @if($OrderStatus == 3)
        <th class="TD_50">{{ __('admin/orders.title_date_delivery') }}</th>
    @endif
    <th class="TD_50">{{ __('admin/orders.title_city') }}</th>
    <th class="TD_120">{{ __('admin/orders.title_customer') }}</th>
    <th class="TD_50">{{ __('admin/orders.title_phone') }}</th>
    <th class="TD_50">{{__('admin/orders.title_total') }}</th>
    <th class="TD_50">{{__('admin/orders.title_shipping') }}</th>
    <th class="TD_100">{{__('admin/orders.title_total_invoice') }}</th>
    <th class="tbutaction TD_20"></th>
</tr>
</thead>
