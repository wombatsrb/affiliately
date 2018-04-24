<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="index.html"><span class="fa fa-area-chart"></span> Glance<span class="dashboard_text">Design dashboard</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              @foreach($menus as $menu)
                @if($menu->menu_parent == null)
                <li class="treeview">
                    <a href="{{route($menu->url)}}">
                    <i class="{{$menu->menu_icon}}"></i> <span>{{$menu->menu_name}}</span>
                    </a>
                        
                        @foreach($menus as $menu2)
                            @if($loop->first)
                                <ul class="treeview-menu menu-open" style="display: block;">
                            @endif
                            @if($menu->id_menu == $menu2->menu_parent)
                              <li><a href="{{route($menu2->url)}}"><i class="{{$menu2->menu_icon}}"></i> {{$menu2->menu_name}}</a></li>
                            @endif
                            @if($loop->last)
                                </ul>
                            @endif                            
                        @endforeach

                </li>
                @endif
              @endforeach
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
