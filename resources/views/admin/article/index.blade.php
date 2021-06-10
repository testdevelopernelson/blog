@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
@include('admin.admin._partials.messages')

    <!-- Main content -->
    <section class="content">      
      <div class="row">
        <div class="col-xs-12">          
          <div class="box">
            <div class="box-header">              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="pull-right">
                <a href=" {{ route($name.'.create') }} " class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="w-10">Fecha</th>
                  <th>Título</th>
                  <th class="w-15">Imágen</th>
                  <th class="w-10">Publicado</th>
                  <th class="actions">Acciones</th>
                </tr>
                </thead>

              <tbody>
                 @foreach($records as $item)
                  <tr>
                  <td>{{ !empty($item->date) ? $item->formatDate() : '' }}</td>
                   <td>{{ $item->title }}</td>
                  <td>
                    <img src="{{ asset('/uploads/'.$item->image) }}" width="100">
                  </td>
                  <td class="btn-actions-index">
                    <input type="checkbox" name="{{ $item->id }}" class="input-switch" {{ $item->published ? 'checked':''}} data-size="mini" data-url="{{ route($name . '.published') }}">
                  </td>
                  <td class="btn-actions-index">
                    <a href="{{ route($name.'.edit' , [$item->id]) }}" class="btn btn-primary btn-flat" title="Editar"><i class="fa fa-edit"></i></a>
                  <form action="{{route($name.'.destroy' , [$item->id])}}" method="POST" style="display:inline;">@csrf 
                    @method('DELETE')<buttton  type="submit" class="btn btn-danger btn-flat btn-delete" title="Eliminar" data-name = "{{ $item->title }}" data-table = 'este artículo'><i class="fa fa-trash"></i></buttton> </form>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
               
              
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection
@include('admin.admin._partials.push_switch')  
