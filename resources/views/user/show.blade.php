@extends('layouts.app')

@section('title', config('app.users'))

@section('content')
    @component('structure.show', ['modal'=> 'App\User', 'prefix' => 'user', 'table'=> 'users', 'obj'=> $user, 'message'=> isset($message) ? $message : null ])

        @slot('tbody')
            @component('structure.show-row', ['title'=> 'Name', 'value' => $user->name])
            @endcomponent

            @component('structure.show-row', ['title'=> 'Email', 'value' => $user->email])
            @endcomponent

            @component('structure.show-row', ['title'=> 'Type', 'value' => $user->userType == 1 ? 'Admin' : 'User' ])
            @endcomponent

            @component('structure.show-row', ['title'=> 'Status', 'value' => $user->status ])
            @endcomponent

            @component('structure.show-row', ['title'=> 'Role', 'value' => $user->getRoleNames() ])
            @endcomponent
        @endslot

    @endcomponent
@endsection
