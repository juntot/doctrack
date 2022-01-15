<nav class="">
  <div class="container d-flex align-items-center">
    <a href="{{ URL::to('/') }}" class="flex-grow-1">
      <img src="{{URL::to('/public/img/JarbLogo.png')}}" class="comp-logo">
    </a>
    <ul>
      <!-- stff -->
      @if(Session::has('auth.email'))
          <li><a href="{{ URL::to('/') }}" class="active home">Home</a></li>
          @if(Session::get('auth.type') == "staff")
          <li><a href="{{ URL::to('/docs') }}">Send Docs</a></li>
          <li><a href="{{ URL::to('/docs-res') }}">Review Docs</a></li>
          @elseif(Session::get('auth.type') == "admin")
          <li><a href="{{ URL::to('/get-users') }}">Users</a></li>
          <li><a href="{{ URL::to('/get-department') }}">Department</a></li>
          @else
          <li><a href="{{ URL::to('/docs') }}">Send Documents</a></li>
          @endif
          <li><a href="#" data-toggle="modal" data-target="#myModalChangePass">Change Pass</a></li>
          <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
          <!-- <li><a href="{{ URL::to('/login') }}">Login</a></li> -->
          <!-- @{{ Session::get('error')}} -->
      @else
        <li><a href="{{ URL::to('/login') }}">Login</a></li>
        
      @endif
      <!-- adm -->
      <!-- usr -->
    </ul>
    <!-- <ul class="">
      <li class="flex-grow-1"></li>
      @if(Session::has('auth.email'))
          <li><a href="{{ URL::to('/') }}" class="active home">Home</a></li>
          <li><a href="{{ URL::to('/docs') }}">Send Documents</a></li>
          <li><a href="{{ URL::to('/docs-res') }}">Recieved Documents</a></li>
          <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
      @else
        <li><a href="{{ URL::to('/login') }}">Login</a></li>      
      @endif
    </ul> -->
    <div class="mobile-btn">
      @if(Session::has('auth.email'))
      <a href="#">
        <div class="mobile-nav"></div>
      </a>
      @else
      <a href="{{ URL::to('/login') }}" style="text-decoration: none; color: var(--accent-gray-color)">Login</a>
      @endif
    </div>
  </div>
</nav>
