@extends('layouts.app')

@section('title', config('app.users'))


@section('content')

    @component('structure.index', ['modal'=> 'App\User', 'prefix' => 'user', 'table'=> 'users', 'obj'=> $users, 'message'=> isset($message) ? $message : null])

        @slot('filter')
            {{ parse_str(Request::getQueryString()) }}

            {!! \App\Filter\Filter::factory()->label('Search')
                ->name('search')
                ->placeholder('Search')
                ->value(isset($search) ? $search : null)->input() !!}

            {!! \App\Filter\Filter::factory()->label('Status')
                ->name('status')
                ->options(['1'=>'Active','2'=>'InActive'])
                ->value(isset($status) ? $status : null)->select() !!}

            {!! \App\Filter\Filter::factory()->label('Type')
                ->name('userType')
                ->options(['null'=>'All','1'=>'Admin','2'=>'User'])
                ->value(isset($userType) ? $userType : null)->select() !!}
        @endslot
        
        @slot('thead')
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Role</th>
            <th>Status</th>
            <th>Options</th>
        @endslot

        @slot('tbody')
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->userType == 1 ? 'Admin' : 'User' }}</td>
                    <td>{{ $user->getRoleNames() }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        @component('structure.index-options', ['prefix' => 'user', 'obj'=> $user])
                        @endcomponent
                    </td>
                </tr>
            @endforeach
        @endslot

    @endcomponent

@endsection
