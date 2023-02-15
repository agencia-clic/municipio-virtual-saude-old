<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 50px 0px;
            }

            @page {
                font-family: "Poppins",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                background-color: rgba(13,131,221,255);
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 70px; 

                /** Extra personal styles **/
                background-color: rgba(13,131,221,255);
                color: white;
                text-align: center;
                line-height: 35px;
            }

            .line-sing {
                position: fixed; 
                bottom: 40px; 
                left: 0px; 
                right: 0px;
            }

            main{
                margin: 10px 30px;
            }

            .title-page{
                color: rgb(95,108,121);
                font-size: 20px;
                margin-top: 0;
                margin-bottom: 5;
            }

            .footer-text{
                color: rgb(255, 255, 255);
                font-size: 13px;
                margin-top: 0;
            }

            .footer-text-info{
                color: rgb(255, 255, 255);
                font-size: 10px;
                margin-top: -20;
            }

            .text-name{
                color: rgb(112, 118, 123);
                font-size: 13px;
                margin-top: -4;
                margin-bottom: -2;
            }

            .line-sing-text{
                color: rgb(112, 118, 123);
                font-size: 13px;
            }

            .text-line-sing{
                color: rgb(112, 118, 123);
                font-size: 12px;
                margin-top: -9px;
            }

            .text-line-sing-crm{
                color: rgb(112, 118, 123);
                font-size: 12px;
                margin-top: -13px;
            }

            .line-sing-line{
                width: 50%;
            }
        </style>

        @yield('style')
        @section('style')
        @stop
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header></header>

        <footer>
            <div style="text-align: center;">
                <h1 class="footer-text">{{ $service_units->name ?? "" }}</h1>
                <h1 class="footer-text-info">Gerado em {{ env('APP_NAME') }} / Araxá/Mg / {{ date('d-m-y H:s') }}  / {{ env('APP_URL') }}</h1>
                <img class="img-fluid" src="{{ Storage::url('assets/brasao-white-araxa-oficial.png') }}" style="z-index: -1; margin-left: 700px; margin-top: -55px;" width="55px">
            </div>
        </footer>

        <main>
        
            <table style="width: 100%">

                <tr>
                    <td width="100%">
                        <h1 class="title-page">{{ $title }} </h1>
                    </td>
                </tr>

                @if(!empty($users))
                    <tr>
                        <table style="width: 100%">
                            <tr>
                                <td width="90%">
                                    
                                    <table style="width: 100%">
                                        <tr>
                                            <td width="100%">
                                                <h1 class="title-page">
                                                    <p class="text-name"><strong>Nome:</strong> {{ $users->name }}</p>
                                                </h1>
                                            </td>

                                            <td width="100%">
                                                <p class="text-name"><strong>Raça:</strong>
                                                    @if(!empty($users) AND ($users->breed == "B")) BRANCA @endif
                                                    @if(!empty($users) AND ($users->breed == "N")) NEGRA @endif
                                                    @if(!empty($users) AND ($users->breed == "P")) PARDA @endif
                                                    @if(!empty($users) AND ($users->breed == "A")) AMARELA @endif
                                                    @if(!empty($users) AND ($users->breed == "I")) INDIGENA @endif
                                                    @if(!empty($users) AND ($users->breed == "O")) OUTROS @endif
                                                </p>
                                            </td>
                                        </tr>
                                    
                                        <tr>
                                            <td width="100%">
                                                <h1 class="title-page">
                                                    <p class="text-name"><strong>CPF:</strong> {{ $mask->cpf_cnpj($users->cpf_cnpj) }}</p>
                                                </h1>
                                            </td>

                                            <td width="100%">
                                                <p class="text-name"><strong>Naturalidade:</strong> {{ $users->naturalness ? "{$users->naturalness}/{$users->uf_naturalness}": "" }}</p>
                                            </td>
                                        </tr>
                                    
                                        <tr>
                                            <td width="100%">
                                                <h1 class="title-page">
                                                    <p class="text-name"><strong>Data Nascimento:</strong> @if(!empty($users->date_birth)) {{ date('d-m-Y', strtotime($users->date_birth)) }} @endif</p>
                                                </h1>
                                            </td>

                                            <td width="100%">
                                                <p class="text-name"><strong>Email:</strong> {{ $users->email }}</p>
                                            </td>
                                        </tr>
                                    
                                        <tr>
                                            <td width="100%">
                                                <h1 class="title-page">
                                                    <p class="text-name">
                                                        <strong>Escolaridade:</strong>
                                                        @if(!empty($users) AND ($users->schooling == "ca")) Classe Alfabetizada @endif
                                                        @if(!empty($users) AND ($users->schooling == "c")) Creche @endif
                                                        @if(!empty($users) AND ($users->schooling == "ef")) Ensino Fundamental @endif
                                                        @if(!empty($users) AND ($users->schooling == "efc")) Ensino Fundamental Completo @endif
                                                        @if(!empty($users) AND ($users->schooling == "t")) Ensino Tecnico @endif
                                                        @if(!empty($users) AND ($users->schooling == "si")) Ensino Superior Incompleto @endif
                                                        @if(!empty($users) AND ($users->schooling == "s")) Ensino Superior @endif
                                                    </p>
                                                </h1>
                                            </td>
                                            <td width="100%">
                                                <p class="text-name"><strong>Contato:</strong> {{ $mask->phone($users->cell) }} {{ (!empty($users->cell) AND (!empty($users->phone))) ? "/" : "" }} {{ $mask->phone($users->phone) }}</p>
                                            </td>
                                        </tr>
                                    
                                        <tr>
                                            <td width="100%">
                                                <h1 class="title-page">
                                                    <p class="text-name" style="margin-bottom: -5px;"><strong>Mãe:</strong> {{ $users->mother }}</p>
                                                </h1>
                                            </td>
                                        </tr>
                                    </table>

                                </td>

                                <td>
                                    <td style="text-align: right;">
                                        <img src="{{ Storage::url('assets/sus.png') }}" width="150px" style="margin-top: -65px;">
                                    </td>
                                </td>
                            </tr>

                            <tr>
                                <td width="100%" colspan="2">
                                    <h1 class="title-page">
                                        <p class="text-name" style="margin-left: 3.5px; margin-top: -10px;"><strong>Endereço:</strong> {{ $users->address }} {{ $users->number ? " - {$users->number}" : ""}} {{ $users->complement ? " - {$users->complement}" : ""}} {{ $users->district ? " - {$users->district}" : ""}} {{ $users->zip_code ? " - {$users->zip_code}" : ""}} {{ $users->city ? " - {$users->city}" : ""}}</p>
                                    </h1>
                                </td>
                            </tr>
                        </table>
                    </tr>
                @endif
            </table>

            @yield('content')
            @section('content')
            @stop
        </main>

    </body>
</html>