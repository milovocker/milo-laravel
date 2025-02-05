@extends('layout')


@section('title', 'Alta de usuarios')

@section('content')

    @php

        if (session('formData'))
            $user = session('formData');

        $disabled = '';
        $checked = '';
        $boton_guardar = '<button type="submit" class="btn btn-primary">Guardar</button>';
        if (session('formData') || $oper == 'cons' || $oper == 'supr')
        {
            $disabled = 'disabled';

            foreach ($roles as $role) {
                if($user->hasRole($role)){
                    $checked = 'checked';
                }
            }

            if ($oper == 'supr')
                $boton_guardar = '<button type="submit" class="btn btn-danger">Eliminar</button>';
            else
                $boton_guardar = '';
        }
            



    @endphp

    <br />
    @if(session('success'))
        <p style="text-align:center;" class="alert alert-success">{{ session('success') }}</p>
    @endif
    
    <form action="{{ route('users.almacenar') }}" method="POST">
        @csrf
        <input type="hidden" name="oper" value="{{ $oper }}" />
        <input type="hidden" name="id" value="{{ $user->id }}" />

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input {{ $disabled }} type="text" name="name" class="form-control" id="name" value="{{ old('name',$user->name)}}" placeholder="Name">
            @error('name') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input {{ $disabled }}  type="text" name="email" class="form-control" id="email" value="{{ old('email',$user->email)}}" placeholder="Email">
            @error('email') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input {{ $disabled }}  type="password" name="password" class="form-control" id="password" value="{{ old('password',$user->password)}}" placeholder="Contraseña">
            @error('password') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">

            @foreach($roles as $role)
                <input type="checkbox" name="{{ $role }}" value="{{ $role }}" {{ $disabled }} {{ $checked }}>
                <label for="{{ $role }}">{{ $role }}</label>
            @endforeach
        </div>

        @php

        echo $boton_guardar ;
    
        @endphp

    </form>

@endsection

