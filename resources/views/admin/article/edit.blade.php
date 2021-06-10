@extends('admin.layouts.admin')

@section('content')
<section class="content-header">  

</section>

<section class="content">
   <div class="row">
   <div class="col-md-9 col-sm-12"> 
	 <div class="box box-info">	       
            <div class="box-header with-border">
              <h3 class="box-title">Editar {{ $singular }}</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route($name.'.update',[$record->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="box-body">
             
             <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#tab_1" data-toggle="tab">Contenido</a>
                    </li> 
                   <li class="active pull-right">
                        <label>Seleccionar Fecha </label>
                        <input type="text" name="date" class="form-control datepicker" value="{{ $record->date }}" autocomplete="off">
                        @if ($errors->has('date'))
                             <label class="text-red">{{ $errors->first('date') }}</label>
                        @endif
                   </li>
                </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab_1">
                  <label>Título </label>
                  <input type="text" name="title" class="form-control" value="{{ $record->title }}">
                  @if ($errors->has('title'))
                     <label class="text-red">{{ $errors->first('title') }}</label>
                  @endif
                  <br>

                  <label>URL Amigable </label>
                   <input type="text" name="slug" class="form-control" value="{{ $record->slug }}" >
                  @if ($errors->has('slug'))
                     <label class="text-red">{{ $errors->first('slug') }}</label>
                  @endif
                  <br>

                  <label>Texto</label>
                  <textarea type="text" name="text" class="tinymce">{{ $record->text}}</textarea>
                  @if ($errors->has('text'))
                   <label class="text-red">{{ $errors->first('text') }}</label>
                   @endif
                  <br>
                  <br>

                  <label>Imagen intro (479 x 327 px)</label>
                  <input type="file" name="image">
                  @if ($errors->has('image'))
                   <label class="text-red">{{ $errors->first('image') }}</label>
                   @endif
                    <img src="{{ asset('uploads/' . $record->image )}}" width="150">
                  <br>
                 <br> 
              </div>
              <!-- /.tab-pane -->
             <!-- /.tab-pane -->
             <div class="tab-pane fade in" id="tab_2">
                {{-- @include('admin.admin._partials.meta_data', array('action' => 'edit', 'metas_img' => true)) --}}
            </div>
             
            </div>
            <!-- /.tab-content -->
          </div>
             
              </div>
          </div>
       </div>

       <div class="col-md-3 col-sm-12">        
         @include('admin.admin._partials.save_cancel')   
         <input type="hidden" name="_back" value="{{ $back }}"> 
          <!-- /.box-footer -->
           </form>
      </div>
   </div>
</section>

@endsection
