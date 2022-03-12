<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;

class TVSeriesController extends Controller
{
    public function getGenre()
    {
        $curl = new Curl();
        $url_genre = config('settings.site.url').'genre/tv/list?api_key='.config("settings.site.api_key").'&language=en-US';
        $res_genre = $curl->get($url_genre);
        $res_genre = json_decode(json_encode($res_genre),true);
        return $res_genre['genres'];
    }

    public function getPopularTv()
    {
        $url = config('settings.site.url')."tv/popular?api_key=".config("settings.site.api_key")."&language=en-US&page=1";
        $curl = new Curl();
        $res = $curl->get($url);
        $res = json_decode(json_encode($res),true);


        return view('tvseries.tv_list',[
            'series'=> $res['results'],
            'genres' => TVSeriesController::getGenre()
        ]);
    }

    public function getOnTheAirTv()
    {

        $url = config('settings.site.url')."tv/on_the_air?api_key=".config("settings.site.api_key")."&language=en-US&page=1";
        $curl = new Curl();
        $res = $curl->get($url);
        $res = json_decode(json_encode($res),true);
        return view('tvseries.tv_list',[
            'series'=> $res['results'],
            'genres' => TVSeriesController::getGenre()
        ]);
    }

    public function getAiringTodayTv()
    {
        $url = config('settings.site.url')."tv/airing_today?api_key=".config("settings.site.api_key")."&language=en-US&page=1";
        $curl = new Curl();
        $res = $curl->get($url);
        $res = json_decode(json_encode($res),true);
        return view('tvseries.tv_list',[
            'series'=> $res['results'],
            'genres' => TVSeriesController::getGenre()
        ]);
    }

    public function getTopRatedTv()
    {
        $url = config('settings.site.url')."tv/top_rated?api_key=".config("settings.site.api_key")."&language=en-US&page=1";
        $curl = new Curl();
        $res = $curl->get($url);
        $res = json_decode(json_encode($res),true);
        return view('tvseries.tv_list',[
            'series'=> $res['results'],
            'genres' => TVSeriesController::getGenre()
        ]);
    }

    public function getTVFilterResults(Request $request)
    {

        $curl = new Curl();
        $url = config('settings.site.url') . 'discover/tv?api_key=' . config('settings.site.api_key') . '&language=en-US&sort_by=popularity.desc';

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
        $series = [];
        foreach ($res['results'] as $key => $serie) {
            if ($serie['vote_average'] >= $imdb_score) {
                if (in_array($genre_key, $serie['genre_ids'])) {
                    array_push($series, $serie);
                }
            }
        }

        return view('tvseries.tv_list', [
            'series' => $series,
            'genres' => TVSeriesController::getGenre(),
            'selected_genre' => $genre_key,
            'imdb' => $imdb_score
        ]);
    }

    public function getTvSeriesDetail(Request $request,$serieId)
    {
        $url = config('settings.site.url')."tv/".$serieId."?api_key=".config("settings.site.api_key");
        $curl = new Curl();
        $res = $curl->get($url);
        $res = json_decode(json_encode($res),true);

        $url_video = config('settings.site.url')."tv/".$serieId."/videos?api_key=".config("settings.site.api_key");
        $res_video = $curl->get($url_video);
        $res_video = json_decode(json_encode($res_video),true);

        if (count($res_video['results']) > 0) {
            return view('tvseries.tv_detail', [
                'tvserie'=> $res,
                'type' => 'tv',
                'video_key' => $res_video['results'][0]['key']
            ]);
        } else {
            return view('tvseries.tv_detail',[
                'tvserie'=> $res,
                'type' => 'tv'
            ]);
        }

    }

}
