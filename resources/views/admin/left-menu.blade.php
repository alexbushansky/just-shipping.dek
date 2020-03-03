




<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{asset('adminpanel/assets/brand/coreui.svg#full')}}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{asset('adminpanel/assets/brand/coreui.svg#signet')}}"></use>
        </svg>
    </div>
    <!--SuperAdminOnly-->
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="index.html">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/adminpanel/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> Dashboard</a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/home">
            Сайт</a>
        </li>
        <li class="c-sidebar-nav-title">{{__('admin.edit')}}</li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/adminpanel/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                </svg> {{__('admin.settings')}}</a>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('car-types.index')}}">
                        <span class="c-sidebar-nav-icon"></span>
                        {{__('admin.all_cars_types')}}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span>
                        {{__('admin.all_city')}}
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span>
                        {{__('admin.all_region')}}
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span>
                        {{__('admin.all_country')}}
                    </a>
                </li>

            </ul>

        </li>
    </ul>
    <!--End-->

</div>
