<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ env('APP_URL') }}/assets/img/notebook-icon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ env('APP_URL') }}/assets/css/app.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/js/buttons/back.js"></script>
    @yield('scripts')
    <title>
        @yield('title')
    </title>
</head>
<body class="bg-light">
    @include('snippets/toast')

    @yield('content')

    <!-- account scripts -->
    @include('scripts/admin/account/login')
    @include('scripts/admin/account/logoff')
    @include('scripts/admin/account/recover')
    @include('scripts/admin/account/register')

    <!-- admin home scripts -->
    @include('scripts/admin/home/form-card')

    <!-- users scripts -->
    @include('scripts/admin/users/user-card')
    @include('scripts/admin/users/user-detail')

    <!-- fillers scripts -->
    @include('scripts/admin/filler/filler-card')
</body>
</html>