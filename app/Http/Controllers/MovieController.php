<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;

class MovieController extends Controller
{
    public function getGenre()
    {
        $curl = new Curl();

        $url1 = config('settings.site.url') . 'genre/movie/list?api_key=' . config('settings.site.api_key') . '&language=en-US';
        $res1 = $curl->get($url1);
        $res1 = json_decode(json_encode($res1), true);

        return $res1['genres'];
    }

    public function getTopRatedMovie()
    {
        $curl = new Curl();

        $url = config('settings.site.url') . 'movie/top_rated?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1';
        $res = $curl->get($url);
        $res = json_decode(json_encode($res), true);

        return view('movies.movie_list', [
            'movies' => $res['results'],
            'genres' => MovieController::getGenre()
        ]);
    }

    public function getPopularMovie()
    {
        $url = config('settings.site.url') . 'movie/popular?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1';
        $curl = new Curl();

        $res = $curl->get($url);
        $res = json_decode(json_encode($res), true);

        return view('movies.movie_list', [
            'movies' => $res['results'],
            'genres' => MovieController::getGenre()
        ]);
    }

    public function getNowPlayingMovie(Request $request)
    {
        $curl = new Curl();

        $url = config('settings.site.url') . 'movie/now_playing?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1';
        $res = $curl->get($url);
        $res = json_decode(json_encode($res), true);

        return view('movies.movie_list', [
            'movies' => $res['results'],
            'genres' => MovieController::getGenre()
        ]);
    }

    public function getUpcomingMovie(Request $request)
    {
        $curl = new Curl();

        $url = config('settings.site.url') . 'movie/upcoming?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1';
        $res = $curl->get($url);
        $res = json_decode(json_encode($res), true);

        return view('movies.movie_list', [
            'movies' => $res['results'],
            'genres' => MovieController::getGenre()
        ]);
    }

    public function getMovieDetail(Request $request, $movieId)
    {
        $url = config('settings.site.url') . 'movie/' . $movieId . '?api_key=' . config('settings.site.api_key') . '&language=en-US';
        $curl = new Curl();

        $res = $curl->get($url);
        $res = json_decode(json_encode($res), true);

        $url_video = config('settings.site.url') . 'movie/' . $movieId . '/videos?api_key=' . config('settings.site.api_key') . '&language=en-US';
        $res_video = $curl->get($url_video);
        $res_video = json_decode(json_encode($res_video), true);

        if (count($res_video['results']) > 0) {
            return view('movies.movie_detail', [
                'movie' => $res,
                'video_key' => $res_video['results'][0]['key'],
                'type' => 'movie'
            ]);
        } else {
            return view('movies.movie_detail', [
                'movie' => $res,
                'type' => 'movie'
            ]);
        }
    }

    public function getFilterResults(Request $request)
    {
        $curl = new Curl();
        $url = config('settings.site.url') . 'discover/movie?api_key=' . config('settings.site.api_key') . '&language=en-US&sort_by=popularity.desc';

        $genre_key = $request->movie_type;
        $imdb_score = 0;

        switch ($request->imdb_score) {
            case '9 or more':
                $imdb_score = 9;
                break;
            case '8 or more':
                $imdb_score = 8;
                break;
            case '7 or more':
                $imdb_score = 7;
                break;
            case '6 or more':
                $imdb_score = 6;
                break;
            case '5 or more':
                $imdb_score = 5;
                break;
            case '4 or more':
                $imdb_score = 4;
                break;
            case '3 or more':
                $imdb_score = 3;
                break;
            default:
                # code...
                break;
        }


        $res = $curl->get($url);
        $res = json_decode(json_encode($res), true);
        $movies = [];
        foreach ($res['results'] as $key => $movie) {
            if ($movie['vote_average'] >= $imdb_score) {
                if (in_array($genre_key, $movie['genre_ids'])) {
                    array_push($movies, $movie);
                }
            }
        }

        return view('movies.movie_list', [
            'movies' => $movies,
            'genres' => MovieController::getGenre(),
            'selected_genre' => $genre_key,
            'imdb' => $imdb_score
        ]);
    }


}
