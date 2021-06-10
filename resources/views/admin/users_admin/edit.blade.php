@extends('admin.layouts.admin')

@section('content')
<section class="content-header">
      <h1>
        Editar administrador
      </h1>
  
</section>

<section class="content">
   <div class="row">
    <div class="col-md-7 col-md-offset-2">
	 <div class="box box-info">
	       @include('admin.admin._partials.errors')
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('admins.update' , [$admin->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
             {{ csrf_field() }}
             {{ method_field('PUT') }}
              <div class="box-body">
                 <label>Nombre</label>
                 <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                <br>

                <label>Usuario</label>
                 <input type="text" name="email" class="form-control" value="{{ $admin->email }}">
                <br>

                <label>Nueva contraseña</label>
                 <input type="password" name="password" class="form-control">
                <br>

                <label>Confirmar contraseña</label>
                 <input type="password" name="password_confirmation" class="form-control">
                <br>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('admins.index') }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-success pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
      </div>
   </div>
</section>

@endsection

