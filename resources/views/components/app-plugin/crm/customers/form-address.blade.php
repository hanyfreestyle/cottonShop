<div class="box_form">
    @if($title)
        <span class="box_title">{{$title}}</span>
    @endif
    <input type="hidden" name="phoneAreaCode" value="{{$phoneAreaCode}}" dir="ltr">
    <div class="row">
        <x-admin.form.input name="name" :row="$rowData" :label="__($defLang.'form_name')" col="6" tdir="ar"/>
        <x-admin.form.select-data name="evaluation_id" :row="$rowData" cat-id="EvaluationCust" :label="__($defLang.'form_evaluation')" :req="false"/>
    </div>



</div>
