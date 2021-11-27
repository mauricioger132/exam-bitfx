@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="row">
                    <div class="alert alert-success" style="width: 100%;" align="center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Notificación: </strong>
                        {{ session()->get('success') }}
                    </div>
                </div>
            @elseif(session()->has('danger'))
                <div class="row">
                    <div class="alert alert-danger" style="width: 100%;" align="center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Notificación: </strong>
                        {{ session()->get('danger') }}
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                        Importar proveedores
                      </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Nombre_completo</th>
                                <th scope="col">Email</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($vendors))
                                    @foreach ($vendors as $vendor)
                                        <tr>
                                            <td>{{$vendor->name}}</td>
                                            <td>{{$vendor->email}}</td>
                                            <td>{{$vendor->rfc}}</td>
                                            <td>
                                                <button class="btn btn-secondary btn-sm modalPassword" 
                                                        data-toggle="tooltip" 
                                                        title="Asignar contraseña"
                                                        data-id={{Crypt::encrypt($vendor->id)}}
                                                 ><i class="fas fa-key"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="3"><p class="text-center"> NO HAY PROVEEDORES</p></td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-pwrcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Asignar contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add.password')}}" method="POST" id="form-pwd" >
          @csrf
          <div class="modal-body">
            <div id="p-info"></div>
            <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" class="form-control" name="password" id="passw"  placeholder="Ingresa una contraseña" required>
            </div>
            <div class="form-group">
                <label>Confirma contraseña</label>
                <input type="password" class="form-control" id="pwd-confirm"  placeholder="Confirmar contraseña" required>
            </div>
            <input type="hidden" name="id" id="id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success save-pwd" >Asignar</button>
          </div>
        </form>
      </div>
    </div>
</div>
@include('modals.add-vendor')
@endsection
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script>
$(function() {

    $(".modalPassword").on('click',function(){
        $("#id").val($(this).data('id'));
        $("#modal-pwrcc").modal('show');
    });
});
</script>

