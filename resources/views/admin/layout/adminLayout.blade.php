<!doctype html>
@include('admin.include.head')
<body>
    <!-- Left Panel -->
    @include('admin.include.sidebar')    
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
         @include('admin.include.loader')
        <!-- Header-->
        @include('admin.include.header')            
        <!-- /#header -->
        <!-- Content -->
        @yield('content')
        
        @include('admin.include.footer')
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
        @include('admin.include.scripts')
        @yield('script')
</body>
</html>
