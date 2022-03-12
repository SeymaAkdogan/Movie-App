<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMovie;
use Curl\Curl;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function addFav(Request $request, $type, $movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                $new = $type . "=>" . $movieId;
                UserMovie::create([
                    'user_id' => Auth::user()->id,
                    'fav_movie_list' => json_encode($new)
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                if (Str::contains($check['fav_movie_list'], $movieId)) {
                    session()->now('infobox', 'You have already added this movie');
                    if ($type == 'movie') {
                        return MovieController::getMovieDetail($request, $movieId);
                    } elseif ($type == 'tv') {
                        return TVSeriesController::getTvSeriesDetail($request, $movieId);
                    }
                } else {
                    $new = $type . "=>" . $movieId;
                    $fav_list = json_decode($check['fav_movie_list'], true) . ',' . $new;

                    UserMovie::whereId($check['id'])->update([
                        'fav_movie_list' => json_encode($fav_list)
                    ]);
                }
            }
            if ($type == 'movie') {
                return MovieController::getMovieDetail($request, $movieId);
            } elseif ($type == 'tv') {
                return TVSeriesController::getTvSeriesDetail($request, $movieId);
            }
        } else {
            if ($type == 'movie') {
                return MovieController::getMovieDetail($request, $movieId);
            } elseif ($type == 'tv') {
                return TVSeriesController::getTvSeriesDetail($request, $movieId);
            }
        }
    }

    public function addWatchList(Request $request, $type, $movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                $new = $type . "=>" . $movieId;
                UserMovie::create([
                    'user_id' => Auth::user()->id,
                    'watch_list' => json_encode($new)
                ]);
            } else {
                $check = json_decode(json_encode($check), true);

                if (Str::contains($check['watch_list'], $movieId)) {
                    session()->now('infobox', 'You have already added this movie');
                    if ($type == 'movie') {
                        return MovieController::getMovieDetail($request, $movieId);
                    } elseif ($type == 'tv') {
                        return TVSeriesController::getTvSeriesDetail($request, $movieId);
                    }
                } else {
                    $new = $type . "=>" . $movieId;
                    $watch_list = json_decode($check['watch_list'], true) . ',' . $new;
                    UserMovie::whereId($check['id'])->update([
                        'watch_list' => json_encode($watch_list)
                    ]);
                }
            }
            if ($type == 'movie') {
                return MovieController::getMovieDetail($request, $movieId);
            } elseif ($type == 'tv') {
                return TVSeriesController::getTvSeriesDetail($request, $movieId);
            }
        } else {
            if ($type == 'movie') {
                return MovieController::getMovieDetail($request, $movieId);
            } elseif ($type == 'tv') {
                return TVSeriesController::getTvSeriesDetail($request, $movieId);
            }
        }
    }

    public function movieReview(Request $request, $type, $movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                if ($request->rate) {
                    if ($request->comment) {
                        $new = $type . "=>" . $movieId;
                        $rate_list = array($new => $request->rate);

                        $comment_list = array($new => $request->comment);
                        UserMovie::create([
                            'user_id' => Auth::user()->id,
                            'rate_list' => json_encode($rate_list),
                            'comment_list' => json_encode($comment_list)
                        ]);
                    } else {
                        $rate_list = array($movieId => $request->rate);
                        UserMovie::create([
                            'user_id' => Auth::user()->id,
                            'rate_list' => json_encode($rate_list)
                        ]);
                    }
                } else {
                    if ($request->comment) {
                        $comment_list = array($movieId => $request->comment);
                        UserMovie::create([
                            'user_id' => Auth::user()->id,
                            'comment_list' => json_encode($comment_list)
                        ]);
                    }
                }
            } else {
                $check = json_decode(json_encode($check), true);
                if ($request->rate) {
                    if ($request->comment) {
                        if ($check['rate_list'] != null) {
                            $dc = json_decode($check['rate_list'], true);
                            foreach ($dc as $key => $value) {
                                if (Str::contains($key, 'tv')) {
                                    $id = str_replace('tv=>', '', $key);
                                } elseif (Str::contains($key, 'movie')) {
                                    $id = str_replace('movie=>', '', $key);
                                }
                                if ($id == $movieId) {
                                    unset($dc[$key]);
                                }
                            }

                            $new = $type . "=>" . $movieId;
                            $rate_list = $dc;
                            $rate_list += [$new => $request->rate];
                        } else {
                            $new = $type . "=>" . $movieId;
                            $rate_list = array($new => $request->rate);
                        }

                        if ($check['comment_list'] != null) {
                            $dc_c = json_decode($check['comment_list'], true);
                            foreach ($dc_c as $key => $value) {
                                if (Str::contains($key, 'tv')) {
                                    $id = str_replace('tv=>', '', $key);
                                } elseif (Str::contains($key, 'movie')) {
                                    $id = str_replace('movie=>', '', $key);
                                }
                                if ($id == $movieId) {
                                    unset($dc_c[$key]);
                                }
                            }
                            $new_c = $type . "=>" . $movieId;
                            $comment_list = $dc_c;
                            $comment_list += [$new_c => $request->comment];
                        } else {
                            $new_c = $type . "=>" . $movieId;
                            $comment_list = array($new_c => $request->comment);
                        }

                        UserMovie::whereId($check['id'])->update([
                            'rate_list' => json_encode($rate_list),
                            'comment_list' => json_encode($comment_list)
                        ]);
                    } else {
                        if ($check['rate_list'] != null) {
                            $dc = json_decode($check['rate_list'], true);
                            foreach ($dc as $key => $value) {
                                if ($key == $movieId) {
                                    unset($dc[$key]);
                                }
                            }
                            $rate_list = $dc;
                            $new = $type . "=>" . $movieId;
                            $rate_list += [$new => $request->rate];
                        } else {
                            $new = $type . "=>" . $movieId;
                            $rate_list = array($new => $request->rate);
                        }

                        UserMovie::whereId($check['id'])->update([
                            'rate_list' => json_encode($rate_list)
                        ]);
                    }
                } else {
                    if ($request->comment) {
                        if ($check['comment_list'] != null) {
                            $dc_c = json_decode($check['comment_list'], true);
                            foreach ($dc_c as $key => $value) {
                                if ($key == $movieId) {
                                    unset($dc_c[$key]);
                                }
                            }
                            $new_c = $type . "=>" . $movieId;
                            $comment_list = $dc_c;
                            $comment_list += [$new_c => $request->comment];
                        } else {
                            $new_c = $type . "=>" . $movieId;
                            $comment_list = array($new_c => $request->comment);
                        }

                        UserMovie::whereId($check['id'])->update([
                            'comment_list' => json_encode($comment_list)
                        ]);
                    }
                }
            }

            if ($type == 'movie') {
                return MovieController::getMovieDetail($request, $movieId);
            } elseif ($type == 'tv') {
                return TVSeriesController::getTvSeriesDetail($request, $movieId);
            }
        } else {
            if ($type == 'movie') {
                return MovieController::getMovieDetail($request, $movieId);
            } elseif ($type == 'tv') {
                return TVSeriesController::getTvSeriesDetail($request, $movieId);
            }
        }
    }

    public function myReview()
    {
        if (Auth::user() != null) {
            $curl = new Curl();
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                return view('account.my_review', [
                    'rate_list' => [],
                    'comment_list' => []
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $comment_list = explode(',', $check['comment_list']);
                $rate_list = explode(',', $check['rate_list']);

                $rate_last_list = [];
                if (count($rate_list) > 0) {
                    foreach ($rate_list as $rate) {
                        $rate = str_replace('"', '', $rate);
                        $rate = str_replace('{', '', $rate);
                        $rate = str_replace('}', '', $rate);
                        $rate = explode(':', $rate);
                        $rate_t = explode('=>', $rate[0]);
                        $type = $rate_t[0];

                        if ($rate_t[0] != '' && $rate_t[0] != null && $rate_t[0] != '[]') {
                            $movieId = $rate_t[1];

                            if (Str::of($rate[1])->contains('}')) {
                                $rate[1] = str_replace('}', '', $rate[1]);
                            }
                            $rateDegree = $rate[1];

                            if ($movieId != '' && $movieId != null) {
                                if ($type == 'tv') {
                                    $url1 = config('settings.site.url') . 'tv/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                    $res1 = $curl->get($url1);

                                    $res1 = json_decode(json_encode($res1), true);
                                    $array = ['rate' => $rateDegree, 'image' => $res1['poster_path'], 'title' => $res1['name'], 'id' => $res1['id'], 'type' => $type];
                                } elseif ($type == 'movie') {
                                    $url = config('settings.site.url') . 'movie/' . $movieId . '?api_key=' . config('settings.site.api_key');

                                    $res = $curl->get($url);
                                    $res = json_decode(json_encode($res), true);
                                    $array = ['rate' => $rateDegree, 'image' => $res['poster_path'], 'title' => $res['title'], 'id' => $res['id'], 'type' => $type];
                                }
                                array_push($rate_last_list, $array);
                            }
                        }
                    }
                }


                $comment_last_list = [];
                if (count($comment_list) > 0) {
                    foreach ($comment_list as $comment) {
                        $comment = str_replace('"', '', $comment);
                        $comment = str_replace('{', '', $comment);
                        $comment = explode(':', $comment);
                        $comment_t = explode('=>', $comment[0]);
                        $type = $comment_t[0];

                        if ($comment_t[0] != '' && $comment_t[0] != null && $comment_t[0] != '[]') {

                            $movieId = $comment_t[1];
                            if (Str::of($comment[1])->contains('}')) {
                                $comment[1] = str_replace('}', '', $comment[1]);
                            }
                            $movieComment = $comment[1];
                            if ($movieId != '' && $movieId != null) {
                                if ($type == 'tv') {
                                    $url1 = config('settings.site.url') . 'tv/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                    $res1 = $curl->get($url1);

                                    $res1 = json_decode(json_encode($res1), true);
                                    $array = ['comment' => $movieComment, 'image' => $res1['poster_path'], 'title' => $res1['name'], 'id' => $res1['id'], 'type' => $type];
                                } elseif ($type == 'movie') {
                                    $url = config('settings.site.url') . 'movie/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                    $res = $curl->get($url);
                                    $res = json_decode(json_encode($res), true);
                                    $array = ['comment' => $movieComment, 'image' => $res['poster_path'], 'title' => $res['title'], 'id' => $res['id'], 'type' => $type];
                                }
                                array_push($comment_last_list, $array);
                            }
                        }
                    }
                }

                return view('account.my_review', [
                    'rate_list' => $rate_last_list,
                    'comment_list' => $comment_last_list
                ]);
            }
        } else {
            return redirect('/');
        }
    }

    public function myWatchList()
    {
        if (Auth::user() != null) {
            $curl = new Curl();
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                return view('account.my_watch_list', [
                    'error' => "No Movies In Your Watch List",
                    'watch_list' => []
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $watch_list = explode(',', $check['watch_list']);

                $watch_last_list = [];
                if (count($watch_list) > 0) {
                    foreach ($watch_list as $watch) {
                        $watch = str_replace('"', '', $watch);
                        $watch = str_replace('{', '', $watch);
                        $watch = str_replace('}', '', $watch);
                        $watch = explode('=>', $watch);

                        if ($watch[0] != '' && $watch[0] != null && $watch[0] != '"' && $watch[0] != '[]') {
                            $movieId = $watch[1];
                            if ($watch[0] == 'tv') {
                                $url1 = config('settings.site.url') . 'tv/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                $res1 = $curl->get($url1);

                                $res1 = json_decode(json_encode($res1), true);

                                $array = ['image' => $res1['poster_path'], 'title' => $res1['name'], 'id' => $res1['id'], 'type' => $watch[0]];
                            } elseif ($watch[0] == 'movie') {
                                $url = config('settings.site.url') . 'movie/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                $res = $curl->get($url);
                                $res = json_decode(json_encode($res), true);
                                $array = ['image' => $res['poster_path'], 'title' => $res['title'], 'id' => $res['id'], 'type' => $watch[0]];
                            }
                            array_push($watch_last_list, $array);
                        }
                    }
                }
            }
            if(count($watch_last_list)>0){
                return view('account.my_watch_list', [
                    'watch_list' => $watch_last_list
                ]);
            }else{
                return view('account.my_watch_list', [
                    'error' => 'No Movies In Your Watch List',
                    'watch_list' => $watch_last_list
                ]);
            }
        } else {
            return redirect('/');
        }
    }

    public function myFavList()
    {
        if (Auth::user() != null) {
            $curl = new Curl();
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                return view('account.my_fav_list', [
                    'error' => "No Movies In Your Favorite List",
                    'fav_list' => []
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $fav_list = explode(',', $check['fav_movie_list']);

                $fav_last_list = [];
                if (count($fav_list) > 0) {
                    foreach ($fav_list as $fav) {
                        $fav = str_replace('"', '', $fav);
                        $fav = str_replace('{', '', $fav);
                        $fav = str_replace('}', '', $fav);
                        $fav = explode('=>', $fav);

                        if ($fav[0] != "" || $fav[0] != null) {
                            $movieId = $fav[1];
                            if ($movieId != '') {
                                if ($fav[0] == 'tv') {
                                    $url1 = config('settings.site.url') . 'tv/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                    $res1 = $curl->get($url1);

                                    $res1 = json_decode(json_encode($res1), true);
                                    $array = ['image' => $res1['poster_path'], 'title' => $res1['name'], 'id' => $res1['id'], 'type' => $fav[0]];
                                } elseif ($fav[0] == 'movie') {
                                    $url = config('settings.site.url') . 'movie/' . $movieId . '?api_key=' . config('settings.site.api_key');
                                    $res = $curl->get($url);

                                    $res = json_decode(json_encode($res), true);
                                    $array = ['image' => $res['poster_path'], 'title' => $res['title'], 'id' => $res['id'], 'type' => $fav[0]];
                                }

                                array_push($fav_last_list, $array);
                            }
                        }
                    }
                }

                if(count($fav_last_list)>0){
                    return view('account.my_fav_list', [
                        'fav_list' => $fav_last_list
                    ]);
                }else{
                    return view('account.my_fav_list', [
                        'error' => 'No Movies In Your Favorite List',
                        'fav_list' => $fav_last_list
                    ]);
                }

            }
        } else {
            return redirect('/');
        }
    }

    public function removebyCommentList($movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                return view('account.my_review', [
                    'error' => "you don't have any review"
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $comment_list = explode(',', $check['comment_list']);

                $comment_last_list = [];
                foreach ($comment_list as $key => $value) {
                    if (Str::contains($value, $movieId)) {
                        unset($comment_list[$key]);
                    }
                }


                foreach ($comment_list as $comment) {
                    $comment = str_replace('"', '', $comment);
                    $comment = str_replace('{', '', $comment);
                    $comment = explode(':', $comment);
                    if ($comment[0] != '' && $comment[0] != null && $comment[0] != '[]') {
                        $id = $comment[0];
                        if (Str::of($comment[1])->contains('}')) {
                            $comment[1] = str_replace('}', '', $comment[1]);
                        }
                        $movieComment = $comment[1];
                        if ($id != '' && $id != null) {

                            $comment_last_list += [$id => $movieComment];
                        }
                    }
                }

                UserMovie::whereId($check['id'])->update([
                    'comment_list' => json_encode($comment_last_list)
                ]);

                return AccountController::myReview();
            }
        } else {
            return redirect('/');
        }
    }

    public function removebyWatchList($movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            $last_watch = '';
            if ($check == null) {
                return view('account.my_review', [
                    'error' => "you don't have any review"
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $watch_list = explode(',', $check['watch_list']);

                foreach ($watch_list as $key => $value) {
                    if (!Str::contains($value, $movieId) && $value != '"') {
                        $last_watch = $last_watch . $value . ',';
                    }
                }
            }

            $replaced = Str::replace('"', '', $last_watch);

            UserMovie::whereId($check['id'])->update([
                'watch_list' => json_encode($replaced)
            ]);

            return AccountController::myWatchList();
        } else {
            return redirect('/');
        }
    }

    public function removebyRateList($movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            if ($check == null) {
                return view('account.my_review', [
                    'error' => "you don't have any review"
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $rate_list = explode(',', $check['rate_list']);

                $rate_last_list = [];
                foreach ($rate_list as $key => $value) {
                    if (Str::contains($value, $movieId)) {
                        unset($rate_list[$key]);
                    }
                }
                foreach ($rate_list as $rate) {
                    $rate = str_replace('"', '', $rate);
                    $rate = str_replace('{', '', $rate);
                    $rate = explode(':', $rate);
                    if ($rate[0] != '' && $rate[0] != null && $rate[0] != '[]') {
                        $id = $rate[0];
                        if (Str::of($rate[1])->contains('}')) {
                            $rate[1] = str_replace('}', '', $rate[1]);
                        }
                        $rateDegree = $rate[1];
                        if ($id != '' && $id != null) {

                            $rate_last_list += [$id => $rateDegree];
                        }
                    }
                }
            }
            UserMovie::whereId($check['id'])->update([
                'rate_list' => json_encode($rate_last_list)
            ]);
            return AccountController::myReview();
        } else {
            return redirect('/');
        }
    }

    public function removebyFavList($movieId)
    {
        if (Auth::user() != null) {
            $check = UserMovie::where('user_id', Auth::user()->id)->first();
            $last_fav = '';
            if ($check == null) {
                return view('account.my_review', [
                    'error' => "you don't have any review"
                ]);
            } else {
                $check = json_decode(json_encode($check), true);
                $fav_list = explode(',', $check['fav_movie_list']);

                foreach ($fav_list as $key => $value) {
                    if (!Str::contains($value, $movieId) && $value != '"') {
                        $last_fav = $last_fav . $value . ',';
                    }
                }
            }

            $replaced = Str::replace('"', '', $last_fav);

            UserMovie::whereId($check['id'])->update([
                'fav_movie_list' => json_encode($replaced)
            ]);

            return AccountController::myFavList();
        } else {
            return redirect('/');
        }
    }
}
