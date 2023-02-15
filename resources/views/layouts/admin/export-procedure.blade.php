<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 8px 8px;
            }

            @page {
                font-family: "Poppins",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            }

            main{
                border: solid 2px;
                color: #071e26;
                height: 1100px;
                width: 99.5%;
            }
        </style>

        @yield('style')
        @section('style')
        @stop
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header></header>
        <footer></footer>

        <main>
            @yield('content')
            @section('content')
            @stop
        </main>

    </body>
</html>