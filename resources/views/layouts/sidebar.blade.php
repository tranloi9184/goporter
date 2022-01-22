<aside class="main-sidebar elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{url('images/logo.png')}}"
             alt="{{ config('app.name') }} Logo"
             class="brand-image elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
