@extends('base')
@section('content')

@include('partials.jumbotron')
<div class="container mt-3">
    @isset($error)
        <h3>{{$error}}</h3>
    @endisset
    <div class="row mb-3">
        <h2>MOVIES</h2>
        @foreach($movies as $movie)
        <div class="col-md-2 mb-3">

            <div class="card  bg-transparent" style="border:none;">
                <a href="/movie/{{$movie['id']}}">
                    <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" class="card-img-top">
                </a>
                <div class="card-body">
                    <h6 class="card-title">{{$movie['title']}}</h6>
                    <p class="card-text"><small class="text-muted">{{$movie['release_date']}}</small></p>

                </div>
            </div>

        </div>
        @endforeach

    </div>
    <div class="row mb-3">
        <h2>TV SHOWS</h2>
        @foreach($tvs as $tv)
        <div class="col-md-2 mb-3">

            <div class="card bg-transparent" style="border:none;">
                <a href="/tv/{{$tv['id']}}">
                    <img src="https://image.tmdb.org/t/p/w500/{{$tv['poster_path']}}" class="card-img-top">
                </a>
                <div class="card-body">
                    <h6 class="card-title">{{$tv['name']}}</h6>
                    <p class="card-text"><small class="text-muted">{{$tv['first_air_date']}}</small></p>

                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>


@endsection
