<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="{{url('/')}}"><span class="logo-style">Rovers</span></a>
      
      <form method="POST" action="{{url('/searchproduct')}}" class="d-flex" role="search">
        @csrf
        <input class="form-control me-2" name="product_name" type="search" id="searchproduct"  
        placeholder="Search Product" aria-label="Search" required>
        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>



      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{Request::is('/')?'custom-active':''}}" aria-current="page" href="">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('category')?'custom-active':''}}" href="{{url('category')}}">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('wishlist')?'custom-active':''}}" href="{{url('wishlist')}}">
              <div class="text-success position-relative">
                <i class="fa-solid fa-bag-shopping fa-2x text-primary">
                </i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger wishlist-count">0
                </span>
              </div>
               
            
            </a>

            
            
          </li>
          <a class="nav-link {{Request::is('cart')?'custom-active':''}}" href="{{url('cart')}}">
              
            <div class="text-success position-relative">
              <i class="mt-3 fa-solid fa-cart-shopping fa-lg"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">0
              </span>
            </div>
            </a>
          @if (Route::has('login'))
            @auth
                
           
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
               
                  {{ Auth::user()->name }}
              </a>
             
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="">My Profile</a>
                  <a class="dropdown-item" href="{{url('my-orders')}}">My orders</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
          
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
       
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{url('login')}}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('register')}}">Register</a>
              </li>
              @endauth
          @endif
         
        </ul>
      </div>
    </div>
  </nav>