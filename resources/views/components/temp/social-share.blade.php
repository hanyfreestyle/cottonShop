@if(issetArr($WebConfig,"pro_social_share",1))
  <div class="tc shareIcon">
    @if($facebook)
      <a href="{{$links['facebook']}}" title="{{$row->name}}" class="facebook" rel="nofollow noopener noreferrer">
        <i class="facl facl-facebook"></i>
      </a>
    @endif

    @if($twitter)
      <a href="{{$links['twitter']}}" title="{{$row->name}}" class="twitter" rel="nofollow noopener noreferrer">
        <i class="facl facl-twitter"></i>
      </a>
    @endif

    @if($whatsapp)
      <a href="{{$links['whatsapp']}}" title="{{$row->name}}" class="whatsapp" rel="nofollow noopener noreferrer">
        <i class="facl facl-whatsapp"></i>
      </a>
    @endif

    @if($gmail)
      <a href="{{$links['gmail']}}" title="{{$row->name}}" class="mail" rel="nofollow noopener noreferrer">
        <i class="facl facl-mail-alt"></i>
      </a>
    @endif


    @if($pinterest)
      <a href="{{$links['pinterest']}}" title="{{$row->name}}" class="pinterest" rel="nofollow noopener noreferrer">
        <i class="facl facl-pinterest"></i>
      </a>
    @endif

    @if($telegram)
      <a href="{{$links['telegram']}}" title="{{$row->name}}" class="telegram" rel="nofollow noopener noreferrer">
        <i class="facl facl-telegram"></i>
      </a>
    @endif
  </div>

@endif
