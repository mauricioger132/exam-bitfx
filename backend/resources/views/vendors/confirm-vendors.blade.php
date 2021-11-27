@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Confirmación de datos 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">Nombre completo</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">RFC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data))
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$item[0]}}</td>
                                            <td>{{$item[1]}}</td>
                                            <td>{{$item[2]}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                <td colspan="3"><p class="text-center"> NO HAY DATOS PRE IMPORTADOS</p></td>
                                @endif
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="card-footer">
                    @php $params = array('params'=>$data, 'aux'=>1 )@endphp
                    <form action="{{route('import.vendors',$params )}}" method="POST">
                        @csrf
                        <a href="{{route('cancel')}}"><div class="btn btn-dark">Cancelar</div></a>
                        <button class="btn btn-success">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
