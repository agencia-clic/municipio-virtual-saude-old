<!-- menu --start -->
<ul class="nav nav-pills flex-row custom-nav-header">

    <!-- records -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
            <i class="far fa-plus-square"></i>
            Cadastros 
        </a>
        <ul class="dropdown-menu">
            @if(!empty(auth()->user()->units_current()))
                <li>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('users_patients.list') }}">Pacientes</a>
                </li>
            @endif
            
            <li>
                <a class="dropdown-item link-600 fw-medium" href="{{ route('users') }}">Usuários</a>
            </li>

            <li>
                <a class="dropdown-item link-600 fw-medium" href="{{ route('users', ['module' => 'medical']) }}">Médicos</a>
            </li>

            @if(!empty(auth()->user()->units_current()))
                <!-- leitos - start -->
                <li>
                    <a class="dropdown-item link-600 fw-medium"  href="#">
                        Leito
                        <span class="fas fa-angle-right mt-1" style="float: right;"></span>
                    </a>
                    <ul class="submenu dropdown-menu">
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('beds') }}">Ala</a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('accommodations') }}">Acomodação</a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('type_functional_units') }}">Tipo de Unidade Funcional</a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('clinics') }}">Clínica</a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('functional_units') }}">Unidades Funcionais</a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('rooms') }}">Quarto</a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Medicamentos -->
            @canany(['isSuper', 'isAdmin'])
            <li>
                <a class="dropdown-item link-600 fw-medium"  href="#">
                    Medicamentos
                    <span class="fas fa-angle-right mt-1" style="float: right;"></span>
                </a>
                <ul class="submenu dropdown-menu">

                    @if(!empty(auth()->user()->units_current()))
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medication_entries') }}">Entradas</a>
                        </li>
                    @endif
                    
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medicines') }}">Medicamentos</a>
                    </li>
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medication_administrations') }}">Administrações</a>
                    </li>
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medication_infusao') }}">Infusões</a>
                    </li>
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medication_dilutions') }}">Diluições</a>
                    </li>
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medication_units') }}">Unidades</a>
                    </li>
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medication_active_principles') }}">Princípios Ativos</a>
                    </li>
                </ul>
            </li>
            @endcanany

            <!-- Parâmetros -->
            <li>
                <a class="dropdown-item link-600 fw-medium"  href="#">
                    Parâmetros
                    <span class="fas fa-angle-right mt-1" style="float: right;"></span>
                </a>
                <ul class="submenu dropdown-menu">
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('medical_specialties') }}">Especialidades (<strong>CBO</strong>)</a>
                    </li>
                
                    <li>
                        <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('materials') }}">Materiais</a>
                    </li>

                    <!-- unists -->
                    @canany(['isSuper'])
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('service_units') }}">Unidades</a>
                        </li>
                    @endcanany

                    @if(!empty(auth()->user()->units_current()))
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('call_panel') }}">Painel de Chamada</a>
                        </li>
                    @endif

                    @canany(['isSuper', 'isAdmin'])
                        <!-- cid -->
                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('cid10') }}">CID10</a>
                        </li>

                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('protocols') }}">Protocolos</a>
                        </li>

                        <li>
                            <a class="dropdown-item dropdown-item link-600 fw-medium" href="{{ route('procedures') }}">Procedimentos</a>
                        </li>
                    @endcanany
                </ul>
            </li>
        </ul>
    </li>

    <!-- execution -->
    @if(!empty(auth()->user()->units_current()))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
            <i class="fas fa-poll-h"></i>
            Execução 
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item link-600 fw-medium" href="{{ route('emergency_services.form') }}">Recepeção</a>
            </li>
            <li>
                <a class="dropdown-item link-600 fw-medium" href="{{ route('screenings') }}">Acolhimento</a>
            </li>

            <li>
                <a class="dropdown-item link-600 fw-medium" href="{{ route('emergency_services_procedures.list.run') }}">Procedimentos</a>
            </li>
            <li>
                <a class="dropdown-item link-600 fw-medium" href="{{ route('observation') }}">Observação</a>
            </li>
        
        </ul>
    </li>
    @endif

    <!-- internment -->
    @if(!empty(auth()->user()->units_current()))

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="fas fa-procedures"></i>
                Internação 
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('approve_admissions') }}">Aprovação de Internação</a>
                </li>
                <li>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('central_beds') }}">Central de Leitos</a>
                </li>
                <li>
                    <a class="dropdown-item link-600 fw-medium" href="{{ route('inpatients') }}">Pacientes Internados</a>
                </li>

            </ul>
        </li>
    @endif

</ul>

<ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center custom-nav-header">

    <!-- select units - start -->
    @if(auth()->user()->units()->count > 1)
        <li class="nav-item dropdown px-1">
            <a class="nav-link fa-icon-wait nine-dots p-1 units_button" role="button" data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="43" viewBox="0 0 16 16" fill="none">
                    <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
                    <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
                    <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
                    <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
                    <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
                    <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
                    <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
                    <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
                    <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
                </svg>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-caret-bg units_select" aria-labelledby="navbarDropdownMenu">
                <div class="card shadow-none">
                    <div class="scrollbar-overlay nine-dots-dropdown">
                        <div class="card-body px-3">
                            <div class="row text-center gx-0 gy-0">
                                
                                <!-- units - start -->
                                @foreach (auth()->user()->units()->data as $val)
                                <div class="col-4">
                                    <a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none" href="{{ route('service_units.set', ['IdServiceUnits' => base64_encode($val->IdServiceUnits)]) }}">
                                        <!--<div class="avatar avatar-2xl"> <img class="rounded-circle" src="assets/img/team/3.jpg" alt="" /></div>-->
                                        <div class="avatar avatar-xl">
                                            <div class="avatar-name rounded-circle @if(auth()->user()->units_current()->IdServiceUnits == $val->IdServiceUnits)bg-primary @endif"><span>{{ $mask->AvatarShortName($val->name) }}</span></div>
                                        </div>
                                        <p class="mb-0 fw-medium text-800 text-truncate fs--2">{{ $val->name }}</p>
                                    </a>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endif
    <!-- select units - end -->

    <li class="nav-item dropdown">
        <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-xl">
                <div class="avatar-name rounded-circle">
                    <span>{{ $mask->AvatarShortName(Auth::user()->name) }}</span>
                </div>
                <!--<img class="rounded-circle" src="https://sendlook-producao.s3.sa-east-1.amazonaws.com/pattern/usuario-sem-image.png" alt="" />-->
            </div>
        </a>

        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
            <div class="bg-white dark__bg-1000 rounded-2 py-2">
                <a class="dropdown-item fw-bold text-primary" href="#!">
                    <span class="fas fa-user me-1"></span>
                    <span>{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" id="call-attendance" href="{{ route('call_panel.json') }}">Painel de Chamada</a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0);" class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item fw-bold text-center text-primary" href="#!">
                    <span>{{ auth()->user()->units_current()->name ?? "SEM UNIDADE" }}</span>
                </a>
            </div>
        </div>
    </li>
</ul>