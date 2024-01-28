<ul class="menu">                                              
    <li class="sidebar-item {{ (request()->routeIs('home')) ? 'active' : null }}">
        <a href="{{route('home')}}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>                            
    </li>                        

    <li class="sidebar-item {{ (request()->routeIs('document.index')) ? 'active' : null }}">
        <a href="{{route('document.index')}}" class='sidebar-link'>
            <i class="bi bi-files"></i>
            <span>Dokumen</span>
        </a>                            
    </li>
    
    <li class="sidebar-item has-sub {{ (Request::segment(1)) == 'master' ? 'active' : null }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-grid-fill"></i> 
            <span>Master</span>
        </a>            
        <ul class="submenu submenu-{{ (Request::segment(1)) == 'master' ? 'open' : 'closed' }}" style="--submenu-height: 86px;">                 

            <li class="submenu-item has-sub">
                <a href="#" class="submenu-link">Account</a>                
                <ul class="submenu submenu-level-2 submenu-{{ (Request::segment(2)) == 'account' ? 'open' : 'closed' }}" style="--submenu-height: 106px;">                    
                    <li class="submenu-item {{ (request()->routeIs('permission.index')) ? 'active' : null }}">
                        <a href="{{route('permission.index')}}"  class="submenu-link">Permission</a>
                    </li>                    
                    <li class="submenu-item {{ (request()->routeIs('role.index')) ? 'active' : null }}">
                        <a href="{{route('role.index')}}"  class="submenu-link">Role</a>
                    </li> 
                    <li class="submenu-item {{ (request()->routeIs('user.index')) ? 'active' : null }}">
                        <a href="{{route('user.index')}}"  class="submenu-link">User</a>
                    </li>                    
                </ul>                
            </li>

            <li class="submenu-item has-sub">
                <a href="#" class="submenu-link">Dokumen</a>                
                <ul class="submenu submenu-level-2 submenu-{{ (Request::segment(2)) == 'dokumen' ? 'open' : 'closed' }}" style="--submenu-height: 63px;">                    
                    <li class="submenu-item ">
                        <a href="{{route('formulir.index')}}"  class="submenu-link {{ (request()->routeIs('formulir.index')) ? 'active' : null }}">Formulir</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('letter.index')}}"  class="submenu-link {{ (request()->routeIs('letter.index')) ? 'active' : null }}">Surat</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('header.index')}}"  class="submenu-link {{ (request()->routeIs('header.index')) ? 'active' : null }}">Header</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('footer.index')}}"  class="submenu-link {{ (request()->routeIs('footer.index')) ? 'active' : null }}">Footer</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('title.index')}}"  class="submenu-link {{ (request()->routeIs('title.index')) ? 'active' : null }}">Title</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('item.index')}}"  class="submenu-link {{ (request()->routeIs('item.index')) ? 'active' : null }}">Item</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('sub.index')}}"  class="submenu-link {{ (request()->routeIs('sub.index')) ? 'active' : null }}">Sub</a>
                    </li>                                            
                </ul>                
            </li>
            
        </ul>            
    </li>
</ul>
