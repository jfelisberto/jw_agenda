<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}@hasSection('headTitle') | @yield('headTitle')@endif</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert/css/sweetalert2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('plugins/datatables_bootstrap/datatables.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/main.min.css') }}" />

        {{-- Carregamento do CSS personalizado de cada template --}}
        @hasSection('stylesheet')@yield('stylesheet')@endif
    </head>

    <body>
        @include('components.messages')

        @yield('content')

        @include('components.form_ajax')

        <footer class="footer fixed-bottom border-top ms-sm-auto bg-light">
            <div class="container-fluid">
                <nav class="text-center">
                    &copy; 2022, by JEF Web
                </nav>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables_bootstrap/datatables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/fontawesome.min.js') }}"></script>

        <script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap_notify/bootstrap-notify.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/sweetalert/js/sweetalert2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        var basePath = '{{ asset('') }}';

        var urlBase = '{{ asset('') }}'

        var table = '';
        $(document).ready(function() {
            $('#tblData tfoot .text').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Pesquisar" />')
            });

            table = $('#tblData').DataTable({
                "processing": true,
                "order": [[ 0, "asc" ]],
                "columnDefs": [
                    {
                        targets: [2],
                        sortable: false
                    }
                ]
            });

            table.buttons(0, null).container().appendTo(table.table().container(), '#tblData_wrapper .col-md-3:eq(0)');

        });
        </script>

        <script src="{{ asset('js/main.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/datatables.min.js') }}" type="text/javascript"></script>
        {{-- Carregamento do JS personalizado de cada template --}}
        @hasSection('javascript')@yield('javascript')@endif
        @hasSection('javascriptForm')@yield('javascriptForm')@endif
        @hasSection('javascriptMessage')@yield('javascriptMessage')@endif
    </body>
</html>
