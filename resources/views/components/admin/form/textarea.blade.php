<div class="form-group {{($horizontalLabel) ? 'row' : '' }}  {{$topclass}}">
    @if ($labelview)
        <div class="{{($horizontalLabel) ? 'col-sm-4' : '' }}">
            <label class="def_form_label font-weight-light {{($horizontalLabel) ? 'font-weight-normal' : '' }}" for="{{$id}}">{{$label}}
                @if($requiredSpan)
                    <span class="required_Span">*</span>
                @endif
            </label>
        </div>
    @endif
    <div class="{{($horizontalLabel) ? 'col-sm-8' : '' }}">
    <textarea class="form-control {{$inputclass}} @error($name) is-invalid @enderror"
              rows="{{$rows}}" id="{{$id}}" name="{{$name}}"
              @if($placeholder) placeholder="{{$label}}" @endif

    {{($required) ? 'required' : '' }}
        {{($disabled) ? 'disabled' : '' }}
    >{{$value}}</textarea>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong> {{ \App\Helpers\AdminHelper::error($message,$name,$label)  }}</strong>
        </span>
        @enderror
    </div>
</div>
