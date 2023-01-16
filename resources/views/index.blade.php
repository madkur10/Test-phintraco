@extends('layout/plain')

@section('container')
<div class="card">
  <div class="card-body">
    <main class="form-signin w-100 m-auto">
      <form action="{{ route('login.action') }}" method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
        <div class="form-floating mb-4">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-4">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy;Test Programming Phintraco 2023</p>
      </form>
    </main>
  </div>
</div>
@endsection