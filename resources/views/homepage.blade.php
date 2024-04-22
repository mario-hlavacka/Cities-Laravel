<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Scripts -->
        <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                $("#search").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/search',
                            dataType: 'json',
                            data: {
                                query: request.term
                            },
                            success: function(data) {
                                response($.map(data.slice(0, 10), function(item) {
                                    return {
                                        label: item.name,
                                        value: item.id
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        var selectedValue = ui.item.value;
                        window.location.replace('/city/' + selectedValue);
                        return false;
                    },
                });
            });
        </script>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <title>Vyhľadávanie</title>
    </head>
    <body>
        <x-header/>

        <div class="gradient" style="height: 500px">
            <div class="jumbotron vertical-center">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-8 mx-auto text-center align-items-center">
                            <h1 class="text-white text-thin display-3">Vyhľadať v databáze obcí</h1>
                            <div>
                                <input type="text" id="search" class="mx-auto mt-4 px-4 py-2 form-control form-control-md w-65" placeholder="Zadajte názov">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <x-footer/>
    </body>
</html>
