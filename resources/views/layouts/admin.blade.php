<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name')}}</title>

  <!-- TOken -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Jquery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/admin-lte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/admin-lte/dist/css/adminlte.min.css">
  

  <style>
    .li-container{
      justify-content: space-between;
      display: flex; 
      width: 100%;
      
    }
    .li-container > div{
      flex: 1;      

    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    
  <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <div style="height: 80px; width: 850px;">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item">
                <div>
                      <form action="{{ Request::url() }}" method="GET">
                      <div class="input-group" style="width: 255%;">
                        <input class="form-control form-control-sidebar" name="term" id="term" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                          <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                
                </div>
            </li>
          </ul>
          <ul class="navbar-nav">
              <div class="li-container" style="">
                <div>
                  <li class="nav-item d-none d-inline-block">
                      <a href="{{ route('admin.home') }}" class="nav-link {{ Request::url() == route('admin.home') ? 'active' : '' }}">Home</a>
                  </li>
                </div>
                <div>
                  <li class="nav-item d-none d-inline-block">
                      <a href="#" class="nav-link">Offers</a>
                  </li>
                </div>
                <div>
                  <li class="nav-item d-none d-inline-block">
                      <a href="#" class="nav-link">Updates</a>
                  </li>
                </div>
                <div>
                  <li class="nav-item d-none d-inline-block">
                      <a href="#" class="nav-link">Calendar</a>
                  </li>
                </div>
                <div>
                  <li class="nav-item d-none d-inline-block">
                      <a href="#" class="nav-link">Spiels</a>
                  </li>
                </div>
                <div>
                  <li class="nav-item d-none d-inline-block">
                      <a href="#" class="nav-link">Administration</a>
                  </li>
                </div>
                
              </div>
          </ul>
        </div>

        <hr>

        <div>
          <ul class="navbar-nav ml-auto dropdown user user-menu">
            
              <li>
                <div class="info" >
                      <a data-toggle="dropdown" aria-expanded="true" class="d-block nav-link" style=" margin-right: -5px;" disable>{{ auth()->user()->name }}</a>
                </div> 
              </li>
              <li>
                  <div class="image">
                        <a class="dropdown" data-toggle="dropdown" href="#"><img src="/admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" style="width: 40px;"></a>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Messages</a>
                        <a class="dropdown-item" href="#">Payslip</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </a>
                        </div>
                  </div>
                    
              </li>
          </ul>
        </div>
    </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
      <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">UK System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('diamond.index') }}" class="nav-link {{ Request::url() == route('diamond.index') ? 'active' : '' }}">
              
              <i class="far fa-gem"></i>
              <p>
                Diamonds
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('reseller.index') }}" class="nav-link {{ Request::url() == route('reseller.index') ? 'active' : '' }}">
              
            <i class="fas fa-users"></i>
              <p>
                Reseller
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pilot.index') }}" class="nav-link {{ Request::url() == route('pilot.index') ? 'active' : '' }}">
              
            <i class="fas fa-headset"></i>
              <p>
                Pilot Service
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('normal.index') }}" class="nav-link {{ Request::url() == route('normal.index') ? 'active' : '' }}">
              
            <i class="fas fa-gift"></i>
              <p>
                Normal Gifting
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('skin.index') }}" class="nav-link {{ Request::url() == route('skin.index') ? 'active' : '' }}">
              
            <ion-icon name="invert-mode-outline"></ion-icon>
              <p>
                Pre Order Skin
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('order_diamond.index') }}" class="nav-link {{ Request::url() == route('order_diamond.index') ? 'active' : '' }}">
              
            <i class="fas fa-gem"></i>
              <p>
                Pre Order Diamonds
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('starlight.index') }}" class="nav-link {{ Request::url() == route('starlight.index') ? 'active' : '' }}">
              
            <i class="fas fa-star"></i>
              <p>
                Pre Order Starlight
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('vip.index') }}" class="nav-link {{ Request::url() == route('vip.index') ? 'active' : '' }}">
              
              <i class="far fa-gem"></i>
              <p>
                VIP Diamonds
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pre_diamond.index') }}" class="nav-link {{ Request::url() == route('pre_diamond.index') ? 'active' : '' }}">
              
            <i class="far fa-star"></i>
              <p>
                Premium Diamonds
                
              </p>
            </a>
          </li>
          <?php if(Request::url() == route('pilot.index')|| Request::url() == route('normal.index')){?>
            <li class='nav-header'>
                Tools
            </li>

            <li class="nav-item">
                  <a href="{{ route('calculator') }}" class="nav-link ">
                
                    <i class="fas fa-calculator"></i>
                    <p>
                      Rank Calculator
                      
                    </p>
                  </a>
                </li>
          <?php } ?>

          <?php if(Request::url() == route('calculator')){?>
            <li class='nav-header'>
                Tools
            </li>

            <li class="nav-item">
                  <a href="#" class="nav-link {{ Request::url() == route('pilot.calculator') ? 'active' : '' }}">
                
                    <i class="fas fa-calculator"></i>
                    <p>
                      Rank Calculator
                      
                    </p>
                  </a>
                </li>
          <?php } ?>

    
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
            @yield('content')

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/admin-lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin-lte/dist/js/adminlte.min.js"></script>

<!-- Ionic -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
