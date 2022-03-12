@extends('base')
@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <h5>Filter Movies</h5>
            <form action="/movies/filter" method="GET">
                <div class="form-group mb-3">
                    <label for="movie_type mb-3">Movie Type</label>
                    <select class="form-control" id="movie_type" name="movie_type">
                        <option>Choose</option>
                        @foreach($genres as $genre)
                        <option value="{{$genre['id']}}" @if(@$genre['id']==@$selected_genre) selected @endif>
                            {{$genre['name']}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="imdb_score mb-3">IMDB Puan</label>
                    <select class="form-control" id="imdb_score" name="imdb_score">
                        <option>Choose</option>
                        <option @if(@$imdb==9) selected @endif>9 or more</option>
                        <option @if(@$imdb==8) selected @endif>8 or more</option>
                        <option @if(@$imdb==7) selected @endif>7 or more</option>
                        <option @if(@$imdb==6) selected @endif>6 or more</option>
                        <option @if(@$imdb==5) selected @endif>5 or more</option>
                        <option @if(@$imdb==4) selected @endif>4 or more</option>
                        <option @if(@$imdb==3) selected @endif>3 or more</option>
                    </select>
                </div>
                <button class="btn btn-primary mb-3">Filter</button>
            </form>
        </div>
        <div class="col-md-9">
            <div class="row">
                @if(count($movies)>0)
                @foreach($movies as $movie)
                <div class="col-md-4 mb-3">

                    <div class="card  bg-transparent" style="border: none;">
                        <a href="/movie/{{$movie['id']}}">
                            <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" class="card-img-top" style="height: 250px;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{$movie['title']}}</h5>
                            <p class="card-text">{{substr($movie['overview'], 0, 50)}}</p>
                        </div>
                    </div>

                </div>
                @endforeach
                @else
                    <div class="alert alert-danger">
                        No Movie
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>




@endsection
