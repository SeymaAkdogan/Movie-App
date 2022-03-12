
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>
<div class="container mb-3">
    <form action="/{{$type}}/review/{{$movie['id']}}" method="post">
        @csrf
        <div class="rate" id="rate">
            <input type="radio" id="star10" name="rate" value="10" />
            <label for="star10" title="text">10 stars</label>
            <input type="radio" id="star9" name="rate" value="9" />
            <label for="star9" title="text">9 stars</label>
            <input type="radio" id="star8" name="rate" value="8" />
            <label for="star8" title="text">8 stars</label>
            <input type="radio" id="star7" name="rate" value="7" />
            <label for="star7" title="text">7 stars</label>
            <input type="radio" id="star6" name="rate" value="6" />
            <label for="star6" title="text">6 star</label>

            <input type="radio" id="star5" name="rate" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" />
            <label for="star1" title="text">1 star</label>
        </div>
        <div class="form-group mb-3">
            <label for="comment">comment</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
