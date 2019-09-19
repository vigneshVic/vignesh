@extends('layouts.app')

@section('title', config('app.users'))

@section('content')
    @component('structure.form', ['modal'=> 'App\User', 'prefix' => 'user', 'table'=> 'users', 'obj'=> isset($user) ? $user : null ])

        @slot('body')
            @component('structure.form-control', ['title'=> 'Name', 'column' => 'name'])
                <input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    value="{{ old('name',  isset($user->name) ? $user->name : null) }}" 
                    required 
                    autofocus
                >
            @endcomponent

            @component('structure.form-control', ['title'=> 'Email', 'column' => 'email'])
                <input 
                    type="email" 
                    class="form-control" 
                    name="email" 
                    value="{{ old('email',  isset($user->email) ? $user->email : null) }}" 
                    required
                >
            @endcomponent

            @component('structure.form-control', ['title'=> 'Type', 'column' => 'userType'])
                <select 
                    class="form-control" 
                    name="userType" 
                    value="{{ old('userType') }}"
                >
                    <option 
                        value="1" {{ (old('userType', isset($user->userType) ? $user->userType : null) == 1) ? 'selected' : '' }}
                    >
                        Admin
                    </option>
                    <option 
                        value="2" {{ (old('userType', isset($user->userType) ? $user->userType : null) == 2) ? 'selected' : '' }}
                    >
                        User
                    </option>
                </select>
            @endcomponent

            @component('structure.form-control', ['title'=> 'Password', 'column' => 'password'])
                <input 
                    type="password" 
                    class="form-control" 
                    name="password" 
                    {{ isset($user) ? '' : 'required' }}
                >
            @endcomponent

            @component('structure.form-control', ['title'=> 'Confirm Password', 'column' => null])
                <input 
                    id="password-confirm" 
                    type="password" 
                    class="form-control" 
                    name="password_confirmation" 
                    {{ isset($user) ? '' : 'required' }}
                >
            @endcomponent

            @if(isset($user))
                @component('structure.form-control', ['title'=> 'Status', 'column' => 'status'])
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="status" 
                        {{ $user->status == 'Active' ? 'checked' : '' }}
                    >
                @endcomponent
            @endif

            @component('structure.form-control', ['title'=> 'Roles', 'column' => null])
                @foreach ($roles as $role)
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="roles[]"
                        value="{{ $role->id }}" 
                        {{ isset($user) ? $user->hasRole($role) ? 'checked' : '' : '' }}
                    >
                    &emsp;&emsp;{{ $role->name }}<br>
                @endforeach
            @endcomponent
        @endslot

    @endcomponent
@endsection
