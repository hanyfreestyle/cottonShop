<thead>
<tr>
  <th class="TD_20">#</th>
  <th class="TD_50">{{__('admin/customer.table_date')}}</th>
  <th class="TD_200">{{__('admin/customer.table_name')}}</th>
  @if($pageData['ViewType'] == 'deleteList')
    <x-admin.table.soft-delete/>
  @else
    <th class="TD_100">{{__('admin/customer.table_city')}}</th>
    <th class="TD_100">{{__('admin/customer.table_phone')}}</th>
    <th class="TD_20"></th>
    <x-admin.table.action-but po="top" type="edit"/>
    <x-admin.table.action-but po="top" type="edit"/>
    <x-admin.table.action-but po="top" type="delete"/>
  @endif
</tr>
</thead>