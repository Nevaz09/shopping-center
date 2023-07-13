<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:  #42b815;">
  <div class="container-fluid">
    <div class="col-auto">
      <a class="navbar-brand">
        <img src="{{asset('assets/document/logo.png')}}" alt="WebStore" class="brand-image img-circle elevation-3"
             style="opacity: .8" width="90px" height="110px">
        <!-- <span style="color:#000000;" class="brand-text font-weight-bold">Shopping <small class="font-weight-light">Center</small></span> -->
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

    </div>
    
    <div class="collapse navbar-collapse nav-content" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{Request::is('dashboard')?'active':''}}" aria-current="page" href="{{asset('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('dashboard')?'active':''}}" href="{{asset('category')}}">Category</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <div class="search-bar">
          <div class="input-group">
              <input class="form-control me-2" id="search_product" type="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
              <span class="input-group-text" id="basic-addon1">Search</span>
          </div>
      </div>
      <ul class="navbar-nav  mb-2 mb-lg-0">  
        @guest
            @if (Route::has('login'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
            @endif
                                
            @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
            @endif
        @else
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user fa-lg"></i>
                    {{ Auth::user()->name }}
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li>
                          <a class="dropdown-item" href="#">My Profile</a>
                      </li>
                      <li>
                          <a class="dropdown-item {{Request::is('my-orders')?'active':''}}" href="{{asset('my-orders')}}">Pesanan Saya
                            <span class="badge badge-pill bg-info pesanan-count">0</span>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item {{Request::is('wishlist')?'active':''}}" href="{{asset('wishlist')}}">Wishlist
                            <span class="badge badge-pill bg-info wishlist-count">0</span>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                      </li>
                  </ul>
            </li>
            @endguest
            <li class="nav-item">
              <a class="nav-link {{Request::is('cart')?'active':''}}" href="{{asset('cart')}}"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
                <span class="badge badge-pill bg-info cart-count">0</span>
              </a>
            </li>
        </ul>
      <!-- <div class="col-md-3 mt-1">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </div> -->
    </div>
  </div>
</nav>