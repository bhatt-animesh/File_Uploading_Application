<!--**********************************
    Sidebar start
***********************************-->
<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            @if(auth()->user()->role_id == 1)
                <li>
                    <a href="{{URL::to('/admin/home')}}" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/admin/product')}}" aria-expanded="false">
                        <i class="icon-menu menu-icon"></i><span class="nav-text">Manage Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/admin/users')}}" aria-expanded="false">
                        <i class="fa fa-users"></i><span class="nav-text">Manage Users</span>
                    </a>
                </li>
            @else
                 <li>
                    <a href="{{URL::to('/user/home')}}" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/user/product')}}" aria-expanded="false">
                        <i class="icon-menu menu-icon"></i><span class="nav-text">Manage Products</span>
                    </a>
                </li>
            @endif
            
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->