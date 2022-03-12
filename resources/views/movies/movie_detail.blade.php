@extends('base')
@section('content')

<style>
    .demo-wrap {
        position: relative;
    }

    .demo-wrap:before {
        content: ' ';
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 480px;
        opacity: 0.6;

        background-image: url("https://image.tmdb.org/t/p/w500/{{$movie['backdrop_path']}}");
        background-repeat: no-repeat;
        background-position: 50% 0;
        background-size: cover;
    }

    .demo-content {
        position: relative;
        color: #032541;
    }

    i {
        color: white;
    }

    .review {
        font-size: 20px;
        border: 1px solid #032541;
        background-color: #FFFFFF;
        height: 40px;
        border-radius: 50%;
        width: 40px;
        text-align: center;
        background-color: #032541;
        display: inline-block;
        margin-right: 8px;
    }

    .video {
        position: absolute;
        top: 250px;
        left: 150px;
        font-size: 70px;
    }

    .c {
        font-size: 12px;
    }

</style>

@include('partials.alerts')

<div class="demo-wrap">
    <div class="row demo-content mx-4 p-4">
        <div class="col-md-4">
            <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" alt="" class="" style="height: 450px;">
            @isset($video_key)
            <a href="https://www.themoviedb.org/video/play?key={{$video_key}}" target="blank" class="video"><i class="fas fa-play-circle" id="video"></i></a>
            @endisset
        </div>
        <div class="col-md-8">
            <h2 class="my-3 h1">{{$movie['title']}}</h2>
            <div>
                <span>{{$movie['release_date']}}</span> <span style="text-transform: uppercase;">({{$movie['original_language']}})</span>
                <span> <i class="fas fa-ellipsis-h"></i></span>
                @foreach($movie['genres'] as $genre)
                <span> {{$genre['name']}} , </span>
                @endforeach
                <span> <i class="fas fa-ellipsis-h"></i></span>
                <span> {{$movie['runtime']}} min.</span>

            </div>
            <div class="mt-3">
                <div class="review">
                    <a href="/{{$type}}/addFav/{{$movie['id']}}"><i class="fas fa-heart c"></i></a>
                </div>
                <div class="review">
                    <a href="/{{$type}}/addWatchList/{{$movie['id']}}"><i class="fas fa-bookmark c"></i></a>
                </div>

                <div class="review">
                    <a href="#" id="rate"><i class="fas fa-star c"></i></a>
                </div>
                <div class="review">
                    <a href="#" id='comment'><i class="fas fa-comment c"></i></a>
                </div>


            </div>

            <p class="mt-3" style="font-size: 22px;">{{$movie['overview']}}</p>

            <div>
                <span class="badge rounded-pill bg-danger"> {{$movie['vote_count']}} </span>
                <span class="badge rounded-pill bg-danger"> {{$movie['vote_average']}} </span>
            </div>
        </div>
    </div>
</div>

@auth
<div class="hide" id="review">
    @include('movies.movie_review')
</div>
@endauth

<script>
    $('#review').hide();
    $(document).ready(function() {

        $("#rate").click(function() {
            $("#review").toggle();
        });
        $("#comment").click(function() {
            $("#review").toggle();
        });
    });
</script>

@endsection
