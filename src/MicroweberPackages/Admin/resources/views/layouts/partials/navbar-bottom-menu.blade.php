<ul class="navbar-nav-padding nav-item-profile-wrapper">
{{--    <li>--}}
{{--        <div class="nav-item nav-item-profile dropdown">--}}
{{--            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"--}}
{{--               aria-label="Open user menu">--}}

{{--                <div class="mw-admin-sidebar-profile"--}}
{{--                     style="background-image: url('<?php echo user_picture(); ?>'); background-position: center center; background-size: contain; background-repeat: no-repeat;">--}}
{{--                    <span style="font-size: 14px; width: 20px; height: 20px;"> </span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <?php echo get_username_short(); ?>--}}
{{--                </div>--}}


{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
{{--                @include('admin::layouts.partials.navabar-bottom-menu-lang-switch')--}}



{{--                <a href="{{admin_url('user/profile')}}" class="dropdown-item">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>--}}
{{--                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>--}}
{{--                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>--}}
{{--                    </svg>--}}
{{--                    <?php _e('Profile') ?></a>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>--}}
{{--                        <path d="M12 16v.01"></path>--}}
{{--                        <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>--}}
{{--                    </svg>--}}
{{--                    <?php _e('Feedback') ?>--}}
{{--                </a>--}}

{{--                <a href="javascript:mw_admin_toggle_dark_theme()" class="dropdown-item">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brightness-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>--}}
{{--                        <path d="M12 5l0 .01"></path>--}}
{{--                        <path d="M17 7l0 .01"></path>--}}
{{--                        <path d="M19 12l0 .01"></path>--}}
{{--                        <path d="M17 17l0 .01"></path>--}}
{{--                        <path d="M12 19l0 .01"></path>--}}
{{--                        <path d="M7 17l0 .01"></path>--}}
{{--                        <path d="M5 12l0 .01"></path>--}}
{{--                        <path d="M7 7l0 .01"></path>--}}
{{--                    </svg>--}}
{{--                    <?php _e('Theme') ?>--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="<?php print api_url('logout'); ?>" class="dropdown-item">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24"--}}
{{--                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"--}}
{{--                         stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                        <path--}}
{{--                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>--}}
{{--                        <path d="M7 12h14l-3 -3m0 6l3 -3"></path>--}}
{{--                    </svg>--}}

{{--                    <?php _e('Logout') ?></a>--}}




{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
        <li class="nav-item nav-item-profile">



            <a href="{{admin_url('user/profile')}}" class="nav-link fs-3">
                <div class="mw-admin-sidebar-profile">
                    <p class="mb-0 text-uppercase" style="font-size: 14px;"><?php print get_username_short() ?></p>
                </div>

                <?php print user_name(); ?>
            </a>
        </li>
                    <?php event_trigger('mw.admin.sidebar.li.last'); ?>
                    <div class="mt-5">
                        <?php include(modules_path(). DS . 'admin/lang_swich_footer.php'); ?>
                    </div>
</ul>
