@extends('base')
@section('content')

<div class="container mt-3">
<h3>MY FAVORITE</h3>
@if(count($fav_list)>0)
<table class="table">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($fav_list as $fav)
        <tr>
            <td>
                <a href="/{{$fav['type']}}/{{$fav['id']}}">
                <img src="https://image.tmdb.org/t/p/w500/{{$fav['image']}}" style='height: 200px;'>
                </a>
            </td>
            <td>{{$fav['title']}}</td>
            <td> <a href="/removebyFavList/{{$fav['id']}}" class="btn btn-danger">Remove</a> </td>
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
