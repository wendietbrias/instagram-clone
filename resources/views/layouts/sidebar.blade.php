
<section class="sidebar">
  <div class="top">
    <h2>
      <a href="{{ route("home.dashboard.view") }}">
          Instagram
      </a>
  </h2>
  <ul class="sidebar-links">
    <a href="{{ route("home.dashboard.view") }}" class="@if(Request::path() == '/') active @endif">
      <i class="ri-home-line"></i>
      <p>Home</p>
    </a>
    <a href="">
      <i class="ri-search-line"></i>
      <p>Search</p>
    </a>
    <a href="">
      <i class="ri-compass-line"></i>
      <p>Explore</p>
    </a>
    <a href="">
      <i class="ri-film-line"></i>
      <p>Reels</p>
    </a>
    <a href="">
      <i class="ri-chat-3-line"></i>
      <p>Messages</p>
    </a>
    <a href="">
      <i class="ri-heart-3-line"></i>
      <p>Notifications</p>
    </a>
    <a href="{{ route('home.create.view') }}" class="@if(Request::path() == 'create') active @endif">
      <i class="ri-add-box-line"></i>
      <p>Create</p>
    </a>
    <a href="{{ route("home.profile.view") }}" class="@if(Request::path() == 'profile') active @endif">
      @if(Auth::user()->avatar != null)
      <img style="width:40px; height:40px; border-radius:50%;" src="{{ asset("storage/profile_image/" . Auth::user()->avatar) }}">

      @else 
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
      " class="initial">{{ substr(Auth::user()->name , 0, 1) }}</span>
      @endif
      <p>{{ Auth::user()->name }}</p>
    </a>
  </ul>
  </div>
<form action="{{ route("auth.logout") }}" method="POST">
  @csrf
  <button class="logout-btn">
    <i class="ri-logout-box-r-line"></i>
    <p>Logout</p>
  </button>
</form>
</section>