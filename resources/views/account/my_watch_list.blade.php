@extends('base')
@section('content')

<div class="container mt-3">
    <h3>MY WATCH LIST</h3>
    @if(count($watch_list)>0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($watch_list as $watch)
            <tr>
                <td>
                    <a href="/{{$watch['type']}}/{{$watch['id']}}">
                        <img src="https://image.tmdb.org/t/p/w500/{{$watch['image']}}" style='height: 200px;'>
                    </a>
                </td>
                <td>{{$watch['title']}}</td>
                <td> <a href="/removebyWatchList/{{$watch['id']}}" class="btn btn-danger">Remove</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    @isset($error)
    <div class="alert alert-danger">
        {{$error}}
    </div>
    @endisset
    @endif
</div>
@endsection
