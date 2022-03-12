@extends('base')
@section('content')

<div class="container mt-3">
    <h3>RATE LIST</h3>
    @if(count($rate_list)>0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Rate</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>


            @foreach($rate_list as $rate)
            <tr>
                <td>
                    <a href="/{{$rate['type']}}/{{$rate['id']}}">
                    <img src="https://image.tmdb.org/t/p/w500/{{$rate['image']}}" style='height: 200px;'>
                    </a>
                </td>
                <td>{{$rate['title']}}</td>
                <td>{{$rate['rate']}}</td>
                <td> <a href="/removebyRateList/{{$rate['id']}}" class="btn btn-danger">Remove</a> </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    @else
    <div class="alert alert-danger">
        You Don't Have Any Movie Rate
    </div>
    @endif
    <h3>COMMENT LIST</h3>
    @if(count($comment_list)>0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Comment</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($comment_list as $comment)
            <tr>
                <td>
                    <a href="/{{$comment['type']}}/{{$comment['id']}}">
                    <img src="https://image.tmdb.org/t/p/w500/{{$comment['image']}}" style='height: 200px;'>
                    </a>
                </td>
                <td>{{$comment['title']}}</td>
                <td>{{$comment['comment']}}</td>
                <td> <a href="/removebyCommentList/{{$comment['id']}}" class="btn btn-danger">Remove</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-danger">
        You Don't Have Any Movie Comment
    </div>
    @endif
</div>
@endsection
