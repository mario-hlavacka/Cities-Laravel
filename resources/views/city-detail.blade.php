<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <title>{{ $city->name }}</title>
    </head>
    <body>
        <x-header/>

        <div class="border-top">
            <div class="container">
                <div class="row">
                    <h2 class="text-center my-3  text-thin">Detail obce</h2>
                </div>

                <div class="row g-0">
                    <div class="d-flex border-top border-2 border-light-gray mb-5 justify-content-between box-shadow mt-3">
                        <div class="w-50 mr-2 bg-light-gray table-pad">
                            <table id="city-details" class="w-100">
                                <tr>
                                    <td class="fw-bold w-50">Meno starostu:</td>
                                    <td class="w-50">{{ $city->mayor_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Adresa obecného úradu:</td>
                                    <td>{{ $city->city_hall_address }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Telefón:</td>
                                    <td>{{ $city->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Fax:</td>
                                    <td>{{ $city->fax }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email:</td>
                                    <td>{{ $city->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Web:</td>
                                    <td>{{ $city->web_address }}</td>
                                </tr>
                                @if(isset($city->lat) && isset($city->lon))
                                <tr>
                                    <td class="fw-bold">Zemepisné súradnice:</td>
                                    <td>{{ $city->lat }}, {{ $city->lon }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-50 me-2 p-5">
                            <div class="vertical-center">
                                <div class="text-center mx-auto">
                                    @if(isset($city->coat_of_arms_path))
                                        <img alt="erb" src="{{ $city->coat_of_arms_path }}"><br/>
                                    @endif
                                    <h2 class="text-primary fw-bold pt-3">{{ $city->name }}</h2>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <x-footer/>
    </body>
</html>
