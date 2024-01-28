<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    
    <link rel="shortcut icon" href="{{asset('assets/logo.png')}}" type="image/x-icon">    
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('assets/compiled/css/iconly.css')}}">   
</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <a href="#">
                        <div class="d-inline-flex">
                            <img style="height: 2rem" class="my-auto" src="{{asset('assets/logo.png')}}" alt="Logo" srcset="">                                
                            <h6 class="ms-2 my-auto">DINAS PUPR <br> KABUPATEN TEGAL</h6>                      
                        </div>
                    </a>
                    <p class="text-muted" style="font-size: 0.8rem">Sistem Informasi Penyelenggaraan Bangunan Gedung</p>           
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">                                              
                        <li
                            class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>                            
                        </li>                        
                        <li
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Components</span>
                            </a>
                            
                            <ul class="submenu ">
                                
                                <li class="submenu-item  ">
                                    <a href="component-accordion.html" class="submenu-link">Accordion</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-alert.html" class="submenu-link">Alert</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-badge.html" class="submenu-link">Badge</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-breadcrumb.html" class="submenu-link">Breadcrumb</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-button.html" class="submenu-link">Button</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-card.html" class="submenu-link">Card</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-carousel.html" class="submenu-link">Carousel</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-collapse.html" class="submenu-link">Collapse</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-dropdown.html" class="submenu-link">Dropdown</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-list-group.html" class="submenu-link">List Group</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-modal.html" class="submenu-link">Modal</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-navs.html" class="submenu-link">Navs</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-pagination.html" class="submenu-link">Pagination</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-progress.html" class="submenu-link">Progress</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-spinner.html" class="submenu-link">Spinner</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-toasts.html" class="submenu-link">Toasts</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="component-tooltip.html" class="submenu-link">Tooltip</a>
                                    
                                </li>
                                
                            </ul>
                            

                        </li>                                                                
                        <li
                            class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Layouts</span>
                            </a>
                            
                            <ul class="submenu active">
                                
                                <li class="submenu-item  ">
                                    <a href="layout-default.html" class="submenu-link">Default Layout</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="layout-vertical-1-column.html" class="submenu-link">1 Column</a>
                                    
                                </li>
                                
                                <li class="submenu-item active ">
                                    <a href="layout-vertical-navbar.html" class="submenu-link">Vertical Navbar</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="layout-rtl.html" class="submenu-link">RTL Layout</a>
                                    
                                </li>
                                
                                <li class="submenu-item  ">
                                    <a href="layout-horizontal.html" class="submenu-link">Horizontal Menu</a>
                                    
                                </li>
                                
                            </ul>
                            

                        </li>                                                                      
                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                      
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="theme-toggle d-flex gap-2  align-items-center mt-2 ms-auto me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                            opacity=".3"></path>
                                        <g transform="translate(-210 -1)">
                                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                            <circle cx="220.5" cy="11.5" r="4"></circle>
                                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="form-check form-switch fs-6">
                                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                    <label class="form-check-label"></label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">John Ducky</h6>
                                            <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="./assets/compiled/jpg/1.jpg">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, John!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                            Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                            Settings</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                                            Wallet</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">                
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Vertical Layout with Navbar</h3>
                                <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">About Vertical Navbar</h4>
                            </div>
                            <div class="card-body">
                                <p>Vertical Navbar is a layout option that you can use with Mazer. </p>

                                <p>In case you want the navbar to be sticky on top while scrolling, add <code>.navbar-fixed</code> class alongside with <code>.layout-navbar</code> class.</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Dummy Text</h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In mollis tincidunt tempus. Duis vitae facilisis enim, at rutrum lacus. Nam at nisl ut ex egestas placerat sodales id quam. Aenean sit amet nibh quis lacus pellentesque venenatis vitae at justo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse venenatis tincidunt odio ut rutrum. Maecenas ut urna venenatis, dapibus tortor sed, ultrices justo. Phasellus scelerisque, nibh quis gravida venenatis, nibh mi lacinia est, et porta purus nisi eget nibh. Fusce pretium vestibulum sagittis. Donec sodales velit cursus convallis sollicitudin. Nunc vel scelerisque elit, eget facilisis tellus. Donec id molestie ipsum. Nunc tincidunt tellus sed felis vulputate euismod.
                                </p>
                                <p>
                                    Proin accumsan nec arcu sit amet volutpat. Proin non risus luctus, tempus quam quis, volutpat orci. Phasellus commodo arcu dui, ut convallis quam sodales maximus. Aenean sollicitudin massa a quam fermentum, et efficitur metus convallis. Curabitur nec laoreet ipsum, eu congue sem. Nunc pellentesque quis erat at gravida. Vestibulum dapibus efficitur felis, vel luctus libero congue eget. Donec mollis pellentesque arcu, eu commodo nunc porta sit amet. In commodo augue id mauris tempor, sed dignissim nulla facilisis. Ut non mattis justo, ut placerat justo. Vestibulum scelerisque cursus facilisis. Suspendisse velit justo, scelerisque ac ultrices eu, consectetur ac odio.
                                </p>                
                                <p>
                                    In pharetra quam vel lobortis fermentum. Nulla vel risus ut sapien porttitor volutpat eu ac lorem. Vestibulum porta elit magna, ut ultrices sem fermentum ut. Vestibulum blandit eros ut imperdiet porttitor. Pellentesque tempus nunc sed augue auctor eleifend. Sed nisi sem, lobortis eget faucibus placerat, hendrerit vitae elit. Vestibulum elit orci, pretium vel libero at, imperdiet congue lectus. Praesent rutrum id turpis non aliquam. Cras dignissim, metus vitae aliquam faucibus, elit augue dignissim nulla, bibendum consectetur leo libero a tortor. Vestibulum non tincidunt nibh. Ut imperdiet elit vel vehicula ultricies. Nulla maximus justo sit amet fringilla laoreet. Aliquam malesuada diam in augue mattis aliquam. Pellentesque id eros dignissim, dapibus sem ac, molestie dolor. Mauris purus lacus, tempor sit amet vestibulum vitae, ultrices eu urna. 
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/compiled/js/app.js')}}"></script>
        
</body>
</html>