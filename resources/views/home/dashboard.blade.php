@extends("layouts.layout")

@section("packages")

<link rel="stylesheet" type="text/css" href="{{ url("style/home/dashboard.css") }}">
<link rel="stylesheet" href="sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">


@endsection

@section("content")

<div class="container">
    @include("layouts.sidebar")

    @if($posts != null && count($posts) > 0)
    <section class="main">
      <input type="hidden" value="{{ Auth::user()->id }}" id="userid">
    </section>
    @else 
    <section class="alert">
      <h2>No posts yet</h2>
    </section>
    @endif 

</div>

@endsection 


@section("js")

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $(document).ready(function() {

    //menampilkan seluruh postingan user

    function showAllPosts() {

       $.ajax({
           type:"GET",
           url:"http://127.0.0.1:8000/ajax/all",
           dataType:'json',
           contentType:false,
           cache:false,
           success:function(data) {
               let temp = '';

               data.map((post,index) => {

                 let checkIfLiked = post.likes.find(like=>like.userid === Number($("#userid").val()));


                   temp += `
                   <div class="post-items">
        <div class="user-posts">
          <div class="user-profile">
            ${
              post.user.avatar != null ?
             `<img style="width:40px; height:40px; border-radius:50%;" src="http://127.0.0.1:8000/storage/profile_image/${post.user.avatar}" alt="${post.user.name}">` : `
              <span style="
            width:34px;
            height:34px;
            color:#fff;
            font-weight:600;
            text-transform:600;
            background-color:#5BC0F8;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
          " class="initial">${post.user.name.charAt(0)}</span>
              `
            }
       

            <p>${post.user.name}</p>
          </div> 
          ${
            $("#userid").val() == post.user.id ? `  <button
               data-id="${post.id}"  
               class="delete-post-btn">
              <i class="ri-delete-bin-7-line"></i>
            </button>` : ""
          }
          
        </div>
        <img src="http://127.0.0.1:8000/storage/posts_image/${post.image}" alt="${post.title}" />
        <div class="caption">
          <ul class="action-post-btn">
            <li>
              <button class="like-post-btn" data-info="${post.id},${$('#userid').val()}">
                ${checkIfLiked ? '<i class="ri-heart-3-fill"  style="color:red;"></i>' : '<i class="ri-heart-line"></i>'}
              </button>
            </li>
            <li>
              <button>
                <i class="ri-chat-3-line"></i>
              </button>
            </li>
            <li>
              <button>
                <i class="ri-send-plane-line"></i>
              </button>
            </li>
          </ul>
          <p style="font-weight:500; font-size:0.95rem; margin-top:8px;">${post.likes.length > 0 ? post.likes.length + " likes" : ""}</p>
          <div class="title">
            <h5>${post.user.name}</h5>
            <h5>${post.title}</h5>
          </div>
          <p>${post.caption}</p>
        </div>
      </div>
                   `
               });

               $(".main").html(temp);
           }
       });
      } 

      showAllPosts();

 
       $(document).on("click"  , ".delete-post-btn"  ,function() {
            $.ajax({
              type:"DELETE",
              url:`http://127.0.0.1:8000/ajax/delete/${$(this).attr("data-id")}`,
              cache:false,
              dataType:"json",
              data:{
                 _token:"{{ csrf_token() }}"
              },
              processData:false,
              beforeSend:function() {
                  Swal.fire({
                      title:'Loading',
                      html:"Your request is being proceed",
                      icon:"info"
                  });
              },
              success:function(data){
                Swal.fire({
                   title:'Success',
                   html:'Success delete post',
                   icon:'success'
                })
                .then(() => {
                  return showAllPosts();
                });
              }
            });
       });

       $(document).on('click' , '.like-post-btn' , function() {

            const info = $(this).attr('data-info');

            $.ajax({
              type:"POST",
              url:`http://127.0.0.1:8000/ajax/like`,
              dataType:"json",
              data:{
                postid:`${info.split(",")[0]}`,
                userid:`${info.split(",")[1]}`
              },
              beforeSend:function() {
                  Swal.fire({
                      title:'Loading',
                      html:"Your request is being proceed",
                      icon:"info"
                  });
              },
              success:function(data) {
                  Swal.fire({
                    title:'Success',
                   html:data.message,
                   icon:'success'
                  })
                  .then(()=> showAllPosts());
              }
            })
       });


  });

</script>


@endsection