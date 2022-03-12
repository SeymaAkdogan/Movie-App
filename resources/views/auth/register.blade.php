@extends('base')
@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top: 75px;">
            <h1>Register</h1>
            <hr />
            <form method='POST' action="/register">
                @csrf
                @isset($error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endisset
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" name='username'/>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name='email' />
                </div>

                <div class='row mb-3'>
                    <div class='col'>
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" name='firstname'/>
                    </div>
                    <div class='col'>
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name='lastname' />
                    </div>
                </div>

                <div class='row mb-3'>
                    <div class='col'>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name='password' />
                    </div>
                    <div class='col'>
                        <label for="repassword" class="form-label">Re-Password</label>
                        <input type="password" class="form-control" name='repassword' />
                    </div>
                </div>


                <button type="submit" class="btn btn-danger">Register</button>
            </form>
        </div>
    </div>
</div>

@endsection
