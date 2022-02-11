@php
$urlAdmin=config('fast.admin_prefix');
@endphp

@can('dashboard')
@php
$isDashboardActive = Request::is($urlAdmin);
$isOpenMenu = Request::is($urlAdmin) || Request::is('admin/order') || Request::is('admin/schedules') || Request::is('admin/advanced_search');
@endphp
<li class="nav-item {{ $isOpenMenu ?'menu-open':''}} ">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-shield-virus"></i>
        <p>
            @lang('menu.orders.index')
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('dashboard.createOrder') }}" class="nav-link {{ Request::is('admin/order') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>@lang('menu.orders.create')</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ $isDashboardActive ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>@lang('menu.queues')</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dashboard.schedules') }}" class="nav-link {{ Request::is('schedule*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>@lang('menu.schedules')</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('dashboard.advanced_search') }}" class="nav-link {{ Request::is('admin/advanced_search') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>@lang('menu.advanced_search')</p>
            </a>
        </li>
    </ul>
</li>
@endcan
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('reports*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>@lang('menu.reports')</p>
    </a>
</li>
