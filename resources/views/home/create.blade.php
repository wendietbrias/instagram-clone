@extends("layouts.layout")

@section("packages")

<link rel="stylesheet" type="text/css" href="{{ url("style/home/create.css") }}">
<link rel="stylesheet" href="sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

@endsection 

@section("content")

<div class="container">
    @include("layouts.sidebar")
    <section class="main">
        <div class="form-container">
            <h2>Create Your Posts</h2>
            <form id="form-post" action="{{ route("home.create") }}">
                @csrf 

                <div class="form-control">
                 <input placeholder="Title" type="text" name="title" id="title">
                </div>
                <div class="form-control">
                    <textarea type="text" id="caption" placeholder="caption" name="caption"></textarea>
                   </div>
                   <div class="form-control">
                    <input  type="file" name="image" id="image" enctype="multipart/formdata">
                   </div>
                   <button id="submit-post" type="submit">Create Post</button>
            </form>
        </div>
    </section>
</div>

@endsection 

@section("js")

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    'use-strict';

    
    $(document).ready(function() {
 
        function createPostHandler(e){
 
            e.preventDefault();

            // const formData = {
            //    title:$('#title').val(),
            //    caption:$('#caption').val(),
            //    image:imageBase64,
            //    "_token":"{{ csrf_token() }}"
            // }

            $.ajax({
               type:"POST",
               url:$('#form-post').attr('action'),
               data:new FormData(this),
               dataType:'json',
               cache:false,
               contentType: false,
               processData: false,
               beforeSend:function() {
                Swal.fire(
               'Loading',
               'Your data is being proceed',
               'question'
              )
               },
               success:function(data){
                  window.location.href = "http://127.0.0.1:8000/";
               },
            })
        }
 
        $("#form-post").on("submit" , createPostHandler);
    })


</script>

@endsection