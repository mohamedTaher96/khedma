<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <span class="logo-mini"><b>S</b> A</span>
      <span class="logo-lg"><b>Khedma</b> Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                <a href="" >
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-danger">5</span>
                </a>
                </li>
          <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src='{{asset("images/test.jpg")}}' class="user-image" alt="User Image">
                        <span class="hidden-xs">admin </span>
                    </a>
                    <ul class="dropdown-menu">
                <!-- User image -->
                        <li class="user-header">
                            <img src='{{asset("images/test.jpg")}}' class="img-circle" alt="User Image">
                            <p>
                                mtaher
                                {{-- <small>عضو منذ {{ \Carbon\Carbon::parse($admin->created_at)->format(' M Y')}}</small> --}}
                            </p>
                        </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="" class="btn btn-default btn-flat">الصفحة الشخصية</a>
                            </div>
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">تسجيل خروج </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
