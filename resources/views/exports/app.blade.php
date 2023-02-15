<html>
<head>
    <style>
        @page { margin: 90px 10px; }
        header { position: fixed; left: 0px; top: -90px; right: 0px; height: 80px; text-align: center; }
        footer { 
            position: fixed; left: 0px; bottom: -90px; right: 0px; height: 20px; width: 100%; font-weight: normal; line-height: 1.3em;font-family: Verdana, Geneva, sans-serif; font-size: 10px;
        }
    </style>

    <!-- Head -->
    @yield('head')
    @section('head')
    @stop
</head>

    <body>
    <header>
        <table>
            <tr>
                <td style="width: 233px;">
                    <img src="{{ Storage::url('assets/sus.png') }}" width="65%" style="margin-top: -20px;"/>
                </td>
                <td style="text-align: center; width: 300px; height: 80px;">
                
                    <h1 style="font-size: 16px; margin-button: 0;">Ficha de Atendimento Ambulatorial</h1>
                    <p style="margin-top: -10px;">{{ auth()->user()->units_current()->name ?? "" }}</p>
        
                </td>
                <td style="width: 233px; height: 80px;">
                    <img src="{{ Storage::url('assets/brasao-araxa-oficial.png') }}" height="95%" style="float: right; margin-right: 5px;"/>
                </td>
            </tr>
        </table>
        <div style='height: 2px; background-color: rgb(197, 197, 197); margin-top: 0px; margin-bottom: 0px;'></div>
    </header>

    <footer>
        <div style='height: 2px; background-color: rgb(197, 197, 197); margin-top: 0px; margin-bottom: 0px;'></div>
        <table cellspacing='0' cellpadding='0' style='border-spacing: 0;' style="width: 100%">	
        <tr>
            <td>	
                Gerado por <strong>{{ auth()->user()->name ?? "" }}</strong> em <strong> {{ date('d-m-Y H:i:s') }}</strong>	
            </td>
            
            <td style="text-align: right; width: 50%">	
                {{ (!empty($title)) ? $title: env('APP_NAME'); }}
            </td>
        </tr>
        </table>

    </footer>

    <div id="content">
        @yield('content')
        @section('content')
        @stop
    </div>

    <!-- Scripts -->
    @yield('scripts')
    @section('scripts')
    @stop

</body>
</html>