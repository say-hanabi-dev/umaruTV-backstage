<!-- Left side column. contains the logo and sidebar -->

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset(setting('avatar'))}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ ucfirst(auth()->user()->name)  }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">WEB SITE</li>
            {{--            Anime start--}}
            {{-- <li class="active treeview menu-open">--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Animation</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backstage.anime.index') }}"><i class="fa fa-circle-o"></i> Show all</a></li>
                    <li><a href="{{ route('backstage.anime.create') }}"><i class="fa fa-circle-o"></i> Create a new</a></li>
                    <li><a href="{{ route('backstage.anime.timeline') }}"><i class="fa fa-calendar"></i> Timeline</a></li>
                </ul>
            </li>
            {{--            Anime end--}}
        <!-- Tag start -->
            <li>
                <a href="{{ route('backstage.tag.index') }}">
                    <i class="fa fa-tag"></i> <span>Animation Tag</span>
                    <span class="pull-right-container">
{{--                        <small class="label pull-right bg-green">new</small>--}}
                        {{--  <i class="fa fa-angle-left pull-right"></i>--}}
                    </span>
                </a>
                <!-- Tag end -->
            </li>
            @can('root')
                <li class="header">BACKSTAGE MANAGE</li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i> Show all</a></li>
                        <li><a href="{{ route('backstage.anime.create') }}"><i class="fa fa-circle-o"></i> Create a new</a></li>
                    </ul>
                </li>
                <!-- Setting start -->
                <li>
                    <a href="{{ route('admin.setting.index') }}">
                        <i class="fa fa-gears"></i> <span>Setting</span>
                        <span class="pull-right-container">
{{--                        <small class="label pull-right bg-green">new</small>--}}
                            {{--                        <i class="fa fa-angle-left pull-right"></i>--}}
                    </span>
                    </a>
                    <!-- Setting end -->
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Layout Options</span>
                        <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                        <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                        <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                        <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="pages/widgets.html">
                        <i class="fa fa-th"></i> <span>Widgets</span>
                        <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                    </a>
                </li>

                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
            @endcan
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>