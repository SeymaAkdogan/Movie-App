@extends('base')
@section('content')

<div class="container mt-3">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="margin-top: 75px;">
      <h1>Login</h1>
      <hr />
      <form method='POST' action="/login">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="username" class="form-control" name='username' />

        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name='password' />
        </div>

        <button type="submit" class="btn btn-danger">Login</button>
      </form>
    </div>
  </div>
</div>

@endsection
