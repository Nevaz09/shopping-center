<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="col-auto">
      <a class="navbar-brand">
        <img src="{{asset('assets/document/logo.png')}}" alt="WebStore" class="brand-image img-circle elevation-3"
             style="opacity: .8" width="90px" height="110px">
        <span class="brand-text font-weight-bold">Shopping <small class="font-weight-light">Center</small></span>
      </a>
    </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{Request::is('dashboard')?'active':''}} ">
            <a class="nav-link" href="{{url('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('categories')?'active':''}} ">
            <a class="nav-link" href="{{url('categories')}}">
              <i class="material-icons">apps</i>
              <p>Categories</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('products')?'active':''}} ">
            <a class="nav-link" href="{{url('products')}}">
              <i class="fa-solid fa-box"></i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('orders')?'active':''}} ">
            <a class="nav-link" href="{{asset('orders')}}">
              <i class="material-icons">event_note</i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('users')?'active':''}} ">
            <a class="nav-link" href="{{asset('users')}}">
              <i class="fa-solid fa-users"></i> 
              <p>Users</p>
            </a>
          </li>
          
        </ul>
    </div>
</div>