@extends("layouts.layout")

@section("packages")

<link rel="stylesheet" type="text/css" href="{{ url("style/home/profile.css") }}">
<link rel="stylesheet" href="sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />


@endsection

@section("content")

 <div class="container">
  <div class="modal" id="ex1">
    <h4>Update Your Profile</h4>
    <form action="{{ route("home.profile.update") }}" id="form-update" class="modal-form">
      @csrf
      <input type="text" name="name" value="{{ Auth::user()->name }}">
      <input type="email" name="email" value="{{ Auth::user()->email }}">
      <input type="text" name="phone_number" value="{{ Auth::user()->phone_number }}">
      <button type="submit">Update</button>
    </form>
  </div>
    @include("layouts.sidebar")
    <section class="main">
      <div class="profile-info">      
        <div class="avatar-container">
          <input type="file" name="image" id="image" style="display:none;">
          <label id="image-preview" for="image">

          @if(Auth::user()->avatar != null)
          <img style="width:100%; height:100%; border-radius:50%;" src="{{ asset("storage/profile_image/" .  Auth::user()->avatar) }}">

          @else 
          <span style="
          width:100%;
          height:100%;
          color:#fff;
          font-weight:600;
          text-transform:600;
          background-color:#5BC0F8;
          border-radius:50%;
          display:flex;
          align-items:center;
          justify-content:center;
          font-size:2rem;
        " class="initial">{{ substr(Auth::user()->name , 0, 1) }}</span>

          @endif 
        </label>

        </div>
          <div class="profile-user">
            <h4>{{ Auth::user()->name }}</h4>
            <a href="#ex1" rel="modal:open" id="open-modal-btn">
              <button>Edit profile</button>
            </a>
            <i class="ri-settings-4-line"></i>
          </div>
          <div class="follow-user">
            <p>11 Posts</p>
            <p>12 Follower</p>
            <p>14 Following</p>
          </div>
      </di>
      <div class="posts-container">
         <h5>Your posts</h5>
         @if(count($posts) > 0)
         <div class="posts">
          @foreach($posts as $post)
       
          <div class="post">
            <img src="{{ asset("storage/posts_image/" . $post->image) }}" alt="{{ $post->title }}">
            <div class="desc">
              <h5>{{ $post->title }}</h5>
            </div>
          </div>

          @endforeach
         </div>

         @else 
         <div class="no-posts"></div>
 
         @endif
      </div>
    </section>
 </div>

@endsection

@section("js")

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $(document).ready(function() {

        $(document).on("change" , '#image' , function() {

          const files = this.files[0];

          const formData = new FormData();

          formData.append('image', this.files[0]);

            $.ajax({
              type:"POST",
               url:"http://127.0.0.1:8000/profile/update/avatar",
               data: formData,
               cache:false,
               contentType:false,
               processData:false,
               dataType:"json",
               beforeSend:function(){},
               success:(response) => {
                    let file = this.files[0];
                    let reader = new FileReader();

                    reader.onloadend = function() {
                       $('#image-preview').html(`
                         <img style="width:100%; height:100%; border-radius:50%;"  src="${reader.result}" alt="avatar">
                       `)
                       console.log(reader.result);
                    }

                    reader.readAsDataURL(file);
               }
            });
        });

        $(document).on("submit"  , "#form-update"  , function(e) {
          e.preventDefault();

              $.ajax({
                type:"POST",
                 url:$(this).attr("action"),
                 data:new FormData(this),
                 cache:false,
                 processData:false,
                 contentType:false,
                 beforeSend:function() {
                   $(".modal").html(`
                   <h5>Loading...</h5>
                   `)
                 },
                 success:function() {
                   $(".modal").html(`
                      <h5>Success update profile</h5>
                      <button onclick="window.location.reload()">Reload for the changes</button>
                   `)
                 }
              })
        });
  });

</script>

@endsection