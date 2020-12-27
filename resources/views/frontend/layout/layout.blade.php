<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2">
        <title>@yield('title','') - {{PROJECT_NAME}}</title>
        <!-- masterCss -->
        @include('frontend.include.masterCss')
        <!-- masterCss ends -->
    </head>
    <body>
        @include('frontend.include.loader')
        <!-- Header -->
        @include('frontend.include.header')
        <!-- Header ends -->        
        <div class="wrapper_shala @if(Auth::check()) innerPages @endif ">
            @yield('content')
            <!-- footer starts -->
            @include('frontend.include.footer')
            <!-- footer ends -->
        </div>
        @include('frontend.include.firebase')
        <!-- include -->
        @include('frontend.include.scripts')
        <!-- include --> 
        @stack('modals-script')
        @yield('script')      

    </body>
</html>