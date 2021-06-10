@extends('admin.layouts.admin')

@section('content')
<section class="content-header">

    
</section>

<section class="content">
   <div class="row">
  <div class="col-md-9 col-sm-12">
	 <div class="box box-info">	       
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo {{ $singular }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route($name.'.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
             @csrf
              <div class="box-body">
             
             <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                         <li class="active">
                         <a href="#tab_1" data-toggle="tab">Contenido</a>
                         </li> 
                        <li class="active pull-right">
                             <label>Seleccionar Fecha</label>
                             <input type="text" name="date" class="form-control datepicker" value="{{ old('date')}}" autocomplete="off">
                             @if ($errors->has('date'))
                                  <label class="text-red">{{ $errors->first('date') }}</label>
                             @endif
                             <br>
                        </li>
                        
                    </ul>
               <div class="tab-content">
                    <div class="tab-pane active fade in active" id="tab_1">
                          <label>Título </label>
                         <input type="text" name="title" class="form-control" value="{{ old('title')}}">
                         @if ($errors->has('title'))
                         <label class="text-red">{{ $errors->first('title') }}</label>
                         @endif
                         <br>

                         <label>URL Amigable </label>
                         <input type="text" name="slug" class="form-control" value="{{ old('slug')}}">
                         @if ($errors->has('slug'))
                              <label class="text-red">{{ $errors->first('slug') }}</label>
                         @endif
                         <br>

                         <label>Texto</label>
                         <textarea type="text" name="text" class="tinymce">{{ old('text')}}</textarea>
                         @if ($errors->has('text'))
                         <label class="text-red">{{ $errors->first('text') }}</label>
                         @endif
                         <br>

                         <label>Imagen intro (479 x 327 px)</label>
                         <input type="file" name="image">
                         @if ($errors->has('image'))
                         <label class="text-red">{{ $errors->first('image') }}</label>
                         @endif
                         <hr>
                         <br>                    
                    </div>
                    <div class="tab-pane fade in" id="tab_2">
                        {{-- @include('admin.admin._partials.meta_data', array('action' => 'add', 'metas_img' => true)) --}}
                    </div>
                    
               </div>
            <!-- /.tab-content -->
            </div>
             
          </div>
          </div>
      </div>

      <div class="col-md-3 col-sm-12">        
          @include('admin.admin._partials.save_cancel')             
          <!-- /.box-footer -->

          </form>
      </div>
   </div>
</section>

@endsection