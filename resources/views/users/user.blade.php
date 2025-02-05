@extends('layout')


@section('title', 'Listado de usuarios')

@section('content')
<div class="table-responsive">
    <table  class="table">
        <tr>
            <td>#</td>
            <td>Nombre</td>
            <td>Email</td>
            <td>Rol</td> 
        </tr>

    
    @foreach ($users as $user)
        

    <tr>
            <td>
                <div>
                    <a href="/user/{{ $user->id }}" class="btn btn-primary"><i class="bi bi-search"></i></a>
                    <a href="/user/actualizar/{{ $user->id }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="/user/eliminar/{{ $user->id }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                </div>

            </td>
            <td style="">{{ $user->name }}</td>
            <td>{{ $user->email }}</td> 
            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                @foreach($user->getRoleNames() as $role)
                    <p>{{ $role }}</p>
                @endforeach
                
            </td> 

    </tr>

    @endforeach

    </table>
</div>
    <a href="/users/nuevo" class="btn btn-success"><i class="bi bi-plus"></i> Nuevo usuario</a>


@endsection