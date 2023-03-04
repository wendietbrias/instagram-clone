@extends("layouts.layout")

@section("packages")

<link rel="stylesheet" type="text/css" href="{{ url("style/auth/register.css") }}">

@endsection

@section("content")

<div class="container">
    <section class="container-register">
        <form method="POST" action="{{ route("auth.register") }}" class="register-form">
            @csrf 
            
            <h3>Instagram</h3>
            
            <input value="{{ old('phone_number') }}" name="phone_number" class="@error('phone_number') invalid @enderror" type="text" placeholder="phone number"/>
         <input  value="{{ old('name') }}" name="name" class="@error('name') invalid @enderror" type="text" placeholder="name"/>
         <input  value="{{ old('fullname') }}" name="fullname" class="@error('fullname') invalid @enderror" type="text" placeholder="fullname"/>
         <input  value="{{ old('email') }}" type="email" class="@error('email') invalid @enderror" name="email" placeholder="email"/>
         <input name="password" class="@error('password') invalid @enderror" type="password" placeholder="password">
         <input name="confirm" class="@error('confirm') invalid @enderror" type="password" placeholder="confirm password">


         <button id="register-btn" type="submit">Register</button>
        </form>
        <div class="alternative">
            <p>Already have account? <a href="{{ route("auth.login.view") }}">login</a></p>
         </div>
    </section>
</div>

@endsection

@section("js")

@endsection