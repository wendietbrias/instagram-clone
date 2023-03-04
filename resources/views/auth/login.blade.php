@extends("layouts.layout")


@section("packages")

<link rel="stylesheet" type="text/css" href="{{ url("style/auth/login.css") }}">

@endsection

@section("content")

 <div class="container">
    <section class="container-login">
      <form method="POST" action="{{ route("auth.login") }}" class="login-form">
         @csrf
 
         <h3>Instagram</h3>
         <input value="{{ old('email') }}" class="@error('email') invalid @enderror" name="email" type="email" placeholder="example@gmail.com"/>
         @error("email")
         <div class="alert-danger">
            <p>
                {{ $message }}
               </p>
            </div>
            @enderror
         <input value="{{ old('password') }}" class="@error('password') invalid @enderror" name="password" type="password" placeholder="password123">
         @error("password")
         <div class="alert-danger">
            <p>
                {{ $message }}
               </p>
            </div>
            @enderror

         <button id="login-btn" type="submit">Log in</button>

         <p>
            <a href="">Forgot password?</a>
         </p>
      </form>
      <div class="alternative">
         <p>Don't have account? <a href="{{ route("auth.register.view") }}">register</a></p>
      </div>
    </section>
 </div>

@endsection 

@section("js")

<script>

  

</script>

@endsection 