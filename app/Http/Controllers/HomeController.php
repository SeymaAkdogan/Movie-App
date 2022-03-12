<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $curl = new Curl();
        $movies = [];
        $tvs = [];
        $url_tv = config('settings.site.url') . "tv/popular?api_key=" . config("settings.site.api_key") . "&language=en-US&page=1";
        $res_tv = $curl->get($url_tv);
        $res_tv = json_decode(json_encode($res_tv), true);


        $url_movie = config('settings.site.url') . 'movie/popular?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1';
        $res_movie = $curl->get($url_movie);
        $res_movie = json_decode(json_encode($res_movie), true);

        if ($_GET) {
            $url2 = config('settings.site.url') .'search/movie?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1&query=' . $request->search;
            $res2 = $curl->get($url2);
            $res2 = json_decode(json_encode($res2), true);

            $url3 = config('settings.site.url') .'search/tv?api_key=' . config('settings.site.api_key') . '&language=en-US&page=1&query=' . $request->search;
            $res3 = $curl->get($url3);
            $res3 = json_decode(json_encode($res3), true);

            $i = 0;
            foreach ($res3['results'] as $key => $value) {
                if ($i < 6) {
                    array_push($tvs, $value);
                }
                $i++;
            }

            $k = 0;
            foreach ($res2['results'] as $key => $value) {
                if ($k < 6) {
                    array_push($movies, $value);
                }
                $k++;
            }

            if(count($tvs)==0 && count($movies)==0){
                return view('home', [
                    'movies' => $movies,
                    'tvs' => $tvs,
                    'error' => 'No result'
                ]);
            }

            return view('home', [
                'movies' => $movies,
                'tvs' => $tvs
            ]);

        }

        $i = 0;
        foreach ($res_tv['results'] as $key => $value) {
            if ($i < 6) {
                array_push($tvs, $value);
            }
            $i++;
        }

        $k = 0;
        foreach ($res_movie['results'] as $key => $value) {
            if ($k < 6) {
                array_push($movies, $value);
            }
            $k++;
        }


        return view('home', [
            'movies' => $movies,
            'tvs' => $tvs
        ]);
    }
}
