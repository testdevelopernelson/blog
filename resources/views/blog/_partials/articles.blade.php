 @foreach ($articles as $item)
     <div class="nws_itm">
        <div class="nws_img cursor" onclick="window.location.href=('{{ route('article', $item->slug) }}')">
            <img src="{{ asset('uploads/' . $item->image_intro) }}" alt="{{ $item->alt }}" title="{{ $item->tit }}">
        </div>
        <div class="nws_title">
            <h4 class="cursor" onclick="window.location.href=('{{ route('article', $item->slug) }}')">{{ $item->title }}</h4>
        </div>
        <div class="nws_content">
            <p>
               {{ $item->text_intro }}
            </p>
        </div>
        <div class="nws_link">
            @if (!empty($item->date))
                <p>{{ $item->formatDate() }}</p>
            @endif            
            <a href="{{ route('article', $item->slug) }}">{{ __('links.see_more') }}</a>
        </div>
    </div> 
@endforeach  