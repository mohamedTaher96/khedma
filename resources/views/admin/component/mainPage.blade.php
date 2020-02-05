<!DOCTYPE html>
<html lang="en">
<head>
    @include('./admin/component/head')
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        @include('./admin/component/nav')
        @include('./admin/component/header')
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer >
            @include('admin/component/footer')
        </footer>
    </div>
    @include('./admin/component/script')
    @yield('script')
</body>
</html>
