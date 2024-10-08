<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}" />
        <title>MLP To-Do</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        @yield('css')
    </head>
    <body>
        <div class="container py-4">
            @yield('content')
            <div class="d-flex justify-content-center mt-5">
                <small class="mt-5">Copyright© {{Carbon\Carbon::now()->format('Y')}} All Rights Reserved.</small>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/3e2c09d816.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
        <script src="{{asset('js/app.js')}}"></script>
        @yield('js')
    </body>
    @yield('modals')
</html>
