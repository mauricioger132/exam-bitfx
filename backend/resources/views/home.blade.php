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
                              </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($vendors))
                                    @foreach ($vendors as $vendor)
                                        <tr>
                                            <td>{{$vendor->name}}</td>
                                            <td>{{$vendor->email}}</td>
                                            <td>{{$vendor->rfc}}</td>
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
@endsection
