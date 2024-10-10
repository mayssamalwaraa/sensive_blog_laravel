<!DOCTYPE html>
<html lang="en">
    @include('theme.partials.head')

<body>
  <!--================Header Menu Area =================-->
  @include('theme.partials.header')
  
  <!--================Header Menu Area =================-->
  

    <!--================Main content begin =================-->
    @yield('content')
     <!--================Main content end =================-->

  <!--================ Start Footer Area =================-->
  @include('theme.partials.footer')
 
  <!--================ End Footer Area =================-->
  @include('theme.partials.scripts')
  
</body>
</html>