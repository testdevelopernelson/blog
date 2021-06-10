@extends('layouts.master')

@section('content')

<div class="container">
  <h1>Nuestro blog</h1>
  <section class="articles">
    <div class="row">
      @foreach ($articles as $item)
        <div class="item col-lg-4">
        <div class="card">
          <img class="card-img-top" src="{{ asset('uploads/' . $item->image) }}">
          <div class="card-body">
            <h5 class="card-title">{{ $item->title }}</h5>
            <p class="card-text">{!! substr(strip_tags($item['text']), 0, 150) . '...' !!}</p>
            <a href="{{ route('article', $item->slug) }}" class="btn btn-primary">Ver más</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    
  </section>
</div>

@endsection

@push('js')

<script type="text/javascript">


var continueLoad = true;
var moreContent = true;
var page = 1;
var url = '{{url()->current()}}';
$( document ).ready(function() {
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height()) * 1.5 >= $(document).height() && continueLoad && moreContent) {
          loadMoreProducts();
        }
    });


    function loadMoreProducts(){

        continueLoad = false;
        page++;
        $.ajax({
                url : url,
                type : 'GET',
                dataType : 'json',
                data : {page : page},
                beforeSend:  function(){
                  $('.spinner').fadeIn();
                },
                success : function(response){                    
                    $('.spinner').fadeOut(); 
                    $('#load-records').append(response.content);                    
                    if(!response.more_content){
                        moreContent = false;
                    }
                },
                complete : function(){ 
                   continueLoad = true;
                }
        });
    }
});



</script>

@endpush