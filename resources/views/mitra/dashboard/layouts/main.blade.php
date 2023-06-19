<!DOCTYPE html>
<html lang="en">
    <head>
        @include('mitra.dashboard.layouts.head')
        
    </head>
    @if ( in_array(Route::current()->getName(), array('dashboardlogin', 'dashboardregister', 'dashboardforgorpassword'), true) )
        @yield('content')
        @include('mitra.dashboard.layouts.script')
    @else
        <body>
            <div id="page-top">
                <div id="wrapper">
                    @include('mitra.dashboard.layouts.sidebar')
                    <div id="content-wrapper" class="d-flex flex-column">
                        @include('mitra.dashboard.layouts.top-bar')
                        <div id="content">
                            @yield('content')
                        </div>
                        @include('mitra.dashboard.layouts.footer')
                        @include('mitra.dashboard.layouts.scroll-to-top')
                        @include('mitra.dashboard.layouts.logout-modal')
                    </div>
                </div>
            </div>
            @include('mitra.dashboard.layouts.script')
        </body>
    @endif
</html>