@extends('layouts.app')

@section('content')

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
         @foreach ($users as $user)    
            <tr>
                <th scope="row">1</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            <td><a href="/post/{{$user->id}}" class="btn btn-primary">Xem</a></td>
            </tr>
        @endforeach   
            </tbody>
            
        </table>
        


@endsection