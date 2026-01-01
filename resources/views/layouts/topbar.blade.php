 <!-- partial:../../partials/_navbar.html -->
 <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
     <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
         <div class="me-3">
             <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                 <span class="icon-menu"></span>
             </button>
         </div>
         <div>
             <a class="navbar-brand brand-logo" href="#">
                 <img src="../../assets/images/logodark.png" alt="logo" width="200px" />
             </a>
             <a class="navbar-brand brand-logo-mini" href="../../index.html">
                 <img src="../../assets/images/logo-mini.svg" alt="logo" />
             </a>
         </div>
     </div>
     <div class="navbar-menu-wrapper d-flex align-items-top">
         <ul class="navbar-nav">
             <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                 <h1 class="welcome-text">Good Afternoon, <span
                         class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
                 <h3 class="welcome-sub-text">Your performance summary this week </h3>
             </li>
         </ul>
         <ul class="navbar-nav ms-auto">

             <li class="nav-item dropdown">
                 <a class="nav-link" id="darkModeToggle" href="#" onclick="toggleDarkMode()">
                     <i class="mdi mdi-brightness-6"></i>
                 </a>
             </li>
             <li class="nav-item dropdown">
                 <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                     <i class="icon-bell"></i>
                     @if (auth()->user()->unreadNotifications->count() > 0)
                         <span class="count"></span>
                     @endif
                 </a>
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                     aria-labelledby="notificationDropdown">
                     <div class="dropdown-header d-flex align-items-center justify-content-between py-3 border-bottom">
                         <p class="mb-0 fw-medium">You have {{ auth()->user()->unreadNotifications->count() }} new
                             notifications </p>
                         @if (auth()->user()->unreadNotifications->count() > 0)
                             <a href="{{ route('notifications.markAsRead') }}"
                                 class="badge badge-pill badge-primary">Mark all as read</a>
                         @endif
                     </div>

                     <div style="max-height: 300px; overflow-y: auto;">
                         @forelse(auth()->user()->unreadNotifications as $notification)
                             <a class="dropdown-item preview-item py-3" href="{{ $notification->data['url'] ?? '#' }}">
                                 <div class="preview-thumbnail">
                                     <i class="mdi mdi-bell-outline m-auto text-primary"></i>
                                 </div>
                                 <div class="preview-item-content">
                                     <h6 class="preview-subject fw-normal text-dark mb-1">
                                         {{ $notification->data['title'] ?? 'Notification' }}</h6>
                                     <p class="fw-light small-text mb-0">
                                         {{ $notification->created_at->diffForHumans() }} </p>
                                 </div>
                             </a>
                         @empty
                             <div class="p-3 text-center text-muted">
                                 <small>No newly generated notifications</small>
                             </div>
                         @endforelse
                     </div>
                 </div>
             </li>
             <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                 <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                     <img class="img-xs rounded-circle" src="{{ auth()->user()->profile_picture_url }}"
                         alt="Profile image">
                 </a>
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                     <div class="dropdown-header text-center pb-3">
                         <img class="img-md rounded-circle" src="{{ auth()->user()->profile_picture_url }}"
                             alt="Profile image" style="width: 40px; height: 40px; object-fit: cover;">
                         <p class="mb-1 mt-3 fw-semibold text-dark">{{ auth()->user()->name }}</p>
                         <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                     </div>
                     <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                             class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                     </a>

                     <form method="POST" action="{{ route('logout') }}">
                         @csrf
                         <button type="submit" class="dropdown-item">
                             <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                             Sign Out
                         </button>
                     </form>
                 </div>
             </li>
         </ul>
         <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
             data-bs-toggle="offcanvas">
             <span class="mdi mdi-menu"></span>
         </button>
     </div>
 </nav>
