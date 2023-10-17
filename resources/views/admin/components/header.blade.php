 <header id="header"
     class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
     <div class="navbar-nav-wrap">
         <div class="navbar-brand-wrapper">
             <!-- Logo -->
             <a class="navbar-brand" href="/admin" aria-label="Front">
                 <img class="navbar-brand-logo"
                     src="https://dulichmedia.dalat.vn//Images/VLG/superadminportal.vlg/Logo/logongangvinhlong214x74_vlg_636838381478241361.png"
                     alt="Logo">
                 <img class="navbar-brand-logo-mini"
                     src="https://dulichmedia.dalat.vn//Images/VLG/superadminportal.vlg/Logo/logongangvinhlong214x74_vlg_636838381478241361.png"
                     alt="Logo">
             </a>
             <!-- End Logo -->
         </div>

         <div class="navbar-nav-wrap-content-left">
             <!-- Navbar Vertical Toggle -->
             <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                 <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                     data-placement="right" title="Collapse"></i>
                 <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                     data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                     data-toggle="tooltip" data-placement="right" title="Expand"></i>
             </button>
             <!-- End Navbar Vertical Toggle -->
         </div>

         <!-- Secondary Content -->
         <div class="navbar-nav-wrap-content-right">
             <!-- Navbar -->
             <ul class="navbar-nav align-items-center flex-row">
                 <li class="nav-item">
                     <!-- Account -->
                     <div class="hs-unfold">
                         <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                             data-hs-unfold-options='{
                 "target": "#accountNavbarDropdown",
                 "type": "css-animation"
               }'>
                             <div class="avatar avatar-sm avatar-circle">
                                 <img class="avatar-img"
                                     src="https://banner2.cleanpng.com/20180329/zue/kisspng-computer-icons-user-profile-person-5abd85306ff7f7.0592226715223698404586.jpg"
                                     alt="Image Description">
                                 <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                             </div>
                         </a>

                         <div id="accountNavbarDropdown"
                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account"
                             style="width: 16rem;">
                             <div class="dropdown-item-text">
                                 <div class="media align-items-center">
                                     <div class="avatar avatar-sm avatar-circle mr-2">
                                         <img class="avatar-img"
                                             src="https://banner2.cleanpng.com/20180329/zue/kisspng-computer-icons-user-profile-person-5abd85306ff7f7.0592226715223698404586.jpg"
                                             alt="Image Description">
                                     </div>
                                     <div class="media-body">
                                         <span class="card-title h5">Nothing</span>
                                         <span class="card-text">Nothing</span>
                                     </div>
                                 </div>
                             </div>

                             <div class="dropdown-divider"></div>

                             <a class="dropdown-item" href="#">
                                 <span class="text-truncate pr-2" title="Sign out">Sign out</span>
                             </a>
                         </div>
                     </div>
                     <!-- End Account -->
                 </li>
             </ul>
             <!-- End Navbar -->
         </div>
         <!-- End Secondary Content -->
     </div>
 </header>
 <aside
     class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
     <div class="navbar-vertical-container">
         <div class="navbar-vertical-footer-offset">
             <div class="navbar-brand-wrapper justify-content-between">
                 <!-- Logo -->
                 <a class="navbar-brand" href="/admin" aria-label="Front">
                     <img class="navbar-brand-logo"
                         src="https://dulichmedia.dalat.vn//Images/VLG/superadminportal.vlg/Logo/logongangvinhlong214x74_vlg_636838381478241361.png"
                         alt="Logo">
                     <img class="navbar-brand-logo-mini"
                         src="https://dulichmedia.dalat.vn//Images/VLG/superadminportal.vlg/Logo/logongangvinhlong214x74_vlg_636838381478241361.png"
                         alt="Logo">
                 </a>
                 <!-- End Logo -->

                 <!-- Navbar Vertical Toggle -->
                 <button type="button"
                     class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                     <i class="tio-clear tio-lg"></i>
                 </button>
                 <!-- End Navbar Vertical Toggle -->
             </div>

             <!-- Content -->
             <div class="navbar-vertical-content">
                 <ul class="navbar-nav navbar-nav-lg nav-tabs">
                     <li
                         class="navbar-vertical-aside-has-menu {{ request()->is('admin') || request()->is('admin/') ? 'show' : '' }}">
                         <a class="js-navbar-vertical-aside-menu-link nav-link {{ request()->is('admin') || request()->is('admin/') ? 'active' : '' }}"
                             href="/admin" title="Dashboards">
                             <i class="tio-home-vs-1-outlined nav-icon"></i>
                             <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Thống kê</span>
                             <span class="badge badge-primary badge-pill ml-1">★</span></span>
                         </a>
                     </li>
                     <!-- Dashboards -->
                     <li class="navbar-vertical-aside-has-menu {{ request()->is('admin/place') ? 'show' : '' }}">
                         <a class="js-navbar-vertical-aside-menu-link nav-link {{ request()->is('tintuc') ? 'active' : '' }}"
                             href="/admin/place" title="Place">
                             <i class="tio-car nav-icon"></i>
                             <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Điểm
                                 du lịch</span>
                         </a>
                     </li>
                     <!-- End Dashboards -->

                     <!-- News -->
                     <li class="navbar-vertical-aside-has-menu {{ request()->is('admin/news') ? 'show' : '' }}">
                         <a class="js-navbar-vertical-aside-menu-link nav-link" href="/admin/news" title="News">
                             <i class="tio-new-message nav-icon"></i>
                             <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Tin
                                 tức</span>
                         </a>

                     </li>
                     <!-- End News -->

                     <!-- User -->
                     <li class="navbar-vertical-aside-has-menu {{ request()->is('admin/users') ? 'show' : '' }}">
                         <a class="js-navbar-vertical-aside-menu-link nav-link" href="/admin/users" title="Users">
                             <i class="tio-user-outlined nav-icon"></i>
                             <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Người
                                 dùng</span>
                         </a>
                     </li>

                     <li class="nav-item">
                         <div class="nav-divider"></div>
                     </li>

                     <li class="nav-item">
                         <small class="nav-subtitle" title="Documentation">Thiết lập</small>
                         <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                     </li>

                     <li class="nav-item ">
                         <a class="js-nav-tooltip-link nav-link" href="documentation\typography.html"
                             title="Components" data-placement="left">
                             <i class="tio-sign-out nav-icon"></i>
                             <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Đăng
                                 xuất</span>
                         </a>
                     </li>

                     <li class="nav-item">
                         <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                     </li>

                     {{-- <!-- Front Builder -->
                     <li class="nav-item nav-footer-item ">
                         <a class="d-none d-md-flex js-hs-unfold-invoker nav-link nav-link-toggle" href="javascript:;"
                             data-hs-unfold-options='{
                 "target": "#styleSwitcherDropdown",
                 "type": "css-animation",
                 "animationIn": "fadeInRight",
                 "animationOut": "fadeOutRight",
                 "hasOverlay": true,
                 "smartPositionOff": true
               }'>
                             <i class="tio-tune nav-icon"></i>
                         </a>
                         <a class="d-flex d-md-none nav-link nav-link-toggle" href="javascript:;">
                             <i class="tio-tune nav-icon"></i>
                         </a>
                     </li>
                     <!-- End Front Builder --> --}}

                     {{-- <!-- Language -->
                     <li class="navbar-vertical-aside-has-menu nav-footer-item ">
                         <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:;"
                             title="Language">
                             <img class="avatar avatar-xss avatar-circle"
                                 src="assets\vendor\flag-icon-css\flags\1x1\us.svg" alt="United States Flag">
                             <span
                                 class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Language</span>
                         </a>

                         <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                             <li class="nav-item">
                                 <a class="nav-link" href="#" title="English (US)">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="assets\vendor\flag-icon-css\flags\1x1\us.svg" alt="Flag">
                                     English (US)
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="#" title="English (UK)">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="assets\vendor\flag-icon-css\flags\1x1\gb.svg" alt="Flag">
                                     English (UK)
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="#" title="Deutsch">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="assets\vendor\flag-icon-css\flags\1x1\de.svg" alt="Flag">
                                     Deutsch
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="#" title="Dansk">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="assets\vendor\flag-icon-css\flags\1x1\dk.svg" alt="Flag">
                                     Dansk
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="#" title="Italiano">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="assets\vendor\flag-icon-css\flags\1x1\it.svg" alt="Flag">
                                     Italiano
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="#" title="中文 (繁體)">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="assets\vendor\flag-icon-css\flags\1x1\cn.svg" alt="Flag">
                                     中文 (繁體)
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <!-- End Language --> --}}
                 </ul>
             </div>
             <!-- End Content -->

             <!-- Footer -->
             <div class="navbar-vertical-footer">
                 <ul class="navbar-vertical-footer-list">
                     {{-- <li class="navbar-vertical-footer-list-item">
                         <!-- Other Links -->
                         <div class="hs-unfold">
                             <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                 href="javascript:;"
                                 data-hs-unfold-options='{
                  "target": "#otherLinksDropdown",
                  "type": "css-animation",
                  "animationIn": "slideInDown",
                  "hideOnScroll": true
                 }'>
                                 <i class="tio-help-outlined"></i>
                             </a>

                             <div id="otherLinksDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu navbar-vertical-footer-dropdown">
                                 <span class="dropdown-header">Help</span>
                                 <a class="dropdown-item" href="#">
                                     <i class="tio-book-outlined dropdown-item-icon"></i>
                                     <span class="text-truncate pr-2" title="Resources &amp; tutorials">Resources
                                         &amp; tutorials</span>
                                 </a>
                                 <a class="dropdown-item" href="#">
                                     <i class="tio-command-key dropdown-item-icon"></i>
                                     <span class="text-truncate pr-2" title="Keyboard shortcuts">Keyboard
                                         shortcuts</span>
                                 </a>
                                 <a class="dropdown-item" href="#">
                                     <i class="tio-alt dropdown-item-icon"></i>
                                     <span class="text-truncate pr-2" title="Connect other apps">Connect
                                         other apps</span>
                                 </a>
                                 <a class="dropdown-item" href="#">
                                     <i class="tio-gift dropdown-item-icon"></i>
                                     <span class="text-truncate pr-2" title="What's new?">What's new?</span>
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <span class="dropdown-header">Contacts</span>
                                 <a class="dropdown-item" href="#">
                                     <i class="tio-chat-outlined dropdown-item-icon"></i>
                                     <span class="text-truncate pr-2" title="Contact support">Contact
                                         support</span>
                                 </a>
                             </div>
                         </div>
                         <!-- End Other Links -->
                     </li> --}}

                     <li class="navbar-vertical-footer-list-item">
                         <!-- Language -->
                         <div class="hs-unfold">
                             <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                 href="javascript:;"
                                 data-hs-unfold-options='{
                  "target": "#languageDropdown",
                  "type": "css-animation",
                  "animationIn": "slideInDown",
                  "hideOnScroll": true
                 }'>
                                 <img class="avatar avatar-xss avatar-circle"
                                     src="\..\assets\vendor\flag-icon-css\flags\1x1\vn.svg" alt="United States Flag">
                             </a>

                             <div id="languageDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu navbar-vertical-footer-dropdown">
                                 <span class="dropdown-header">Select language</span>
                                 <a class="dropdown-item" href="#">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="\..\assets\vendor\flag-icon-css\flags\1x1\vn.svg" alt="Flag">
                                     <span class="text-truncate pr-2" title="English">Việt Nam</span>
                                 </a>
                                 <a class="dropdown-item" href="#">
                                     <img class="avatar avatar-xss avatar-circle mr-2"
                                         src="\..\assets\vendor\flag-icon-css\flags\1x1\us.svg" alt="Flag">
                                     <span class="text-truncate pr-2" title="English">English (US)</span>
                                 </a>
                             </div>
                         </div>
                         <!-- End Language -->
                     </li>
                 </ul>
             </div>
             <!-- End Footer -->
         </div>
     </div>
 </aside>
