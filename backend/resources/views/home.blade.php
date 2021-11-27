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
@include('modals.add-vendor')
@include('modals.add-pwd')
@endsection
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script>
$(function() {

    $(".modalPassword").on('click',function(){
        $("#id").val($(this).data('id'));
        $("#modal-pwrcc").modal('show');
    });
    
    $(".save-pwd").on('click',function(){
       
        $("#p-info").empty();
        if($("#passw").val() == $("#pwd-confirm").val() ){
     
            $(this).text('Espere...');
            $(this).prop('disabled', true);
            $('.save-pwd').submit();
            
        }else{
         
            $("#p-info").append('<div class="alert alert-danger text-center" role="alert">Las contraseñas no coinciden..!!</div>');
        }
       
    });
    
});
</script>

