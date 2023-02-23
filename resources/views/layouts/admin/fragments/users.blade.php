<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Dados gerais</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            
            <div class="list-group-item list-group-item-action">
                <div class="row mt-1">
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Nome:</strong></span>
                        <td class="text-secondary">{{$users->name}}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Nome da mãe:</strong></span>
                        <td class="text-secondary">{{ $users->mother }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>CPF:</strong></span>
                        <td class="text-secondary">

                            @if(strlen($users->cpf_cnpj) == 11)
                                {{ Mask::default($users->cpf_cnpj, '###.###.###-##') }}
                            @elseif(strlen($users->cpf_cnpj) == 14)
                                {{ Mask::default($users->cpf_cnpj, '##.###.###/####-##') }}
                            @endif

                        </td>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Código:</strong></span>
                        <td class="text-secondary">{{ $users->IdUsers }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Nascimento:</strong></span>
                        <td class="text-secondary">{{  date('d-m-Y', strtotime($users->date_birth)) }}</td>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Dados complementares</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            
            <div class="list-group-item list-group-item-action">
                <div class="row mt-1">
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Raça/Cor:</strong></span>
                        <td class="text-secondary">
                            @if((!empty($users) AND ($users->breed == "B")))BRANCA @endif
                            @if((!empty($users) AND ($users->breed == "N")))NEGRA @endif
                            @if((!empty($users) AND ($users->breed == "P")))PARDA @endif
                            @if((!empty($users) AND ($users->breed == "A")))AMARELA @endif
                            @if((!empty($users) AND ($users->breed == "I")))INDIGENA @endif
                            @if((!empty($users) AND ($users->breed == "O")))OUTROS @endif
                        </td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Sexo:</strong></span>
                        <td class="text-secondary">
                            @if($users->sex == "m")
                                Masculino
                            @elseif($users->sex == "f"):
                                Feminino
                            @else
                                Outros
                            @endif
                        </td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>País de origem:</strong></span>
                        <td class="text-secondary">{{$users->origin }}</td>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Naturalidade:</strong></span>
                        <td class="text-secondary">{{ $users->naturalness }}/{{ $users->uf_naturalness }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Tel. residencial:</strong></span>
                        <td class="text-secondary">{{ Mask::default($users->phone, '(34) 9999-9999')}}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Celular:</strong></span>
                        <td class="text-secondary">{{ Mask::default($users->phone, '(34) 9 9999-9999')}}</td>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Email:</strong></span>
                        <td class="text-secondary">{{ $users->email }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Tipo sanguíneo:</strong></span>
                        <td class="text-secondary">
                            @if((!empty($users) AND ($users->sanguine == "A+")))A+ @endif
                            @if((!empty($users) AND ($users->sanguine == "A-")))A- @endif
                            @if((!empty($users) AND ($users->sanguine == "B+")))B+ @endif
                            @if((!empty($users) AND ($users->sanguine == "AB+")))AB+ @endif
                            @if((!empty($users) AND ($users->sanguine == "AB-")))AB- @endif
                            @if((!empty($users) AND ($users->sanguine == "O-")))O- @endif
                            @if((!empty($users) AND ($users->sanguine == "O+")))O+ @endif
                            @if((!empty($users) AND ($users->sanguine == "N")))Nenhum @endif
                        </td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Estado Civil:</strong></span>
                        <td class="text-secondary">
                            @if((!empty($users) AND ($users->schooling == "ca")))Classe Alfabetizada @endif
                            @if((!empty($users) AND ($users->schooling == "c")))Creche @endif
                            @if((!empty($users) AND ($users->schooling == "ef")))Ensino Fundamental @endif
                            @if((!empty($users) AND ($users->schooling == "efc")))Ensino Fundamental Completo @endif
                            @if((!empty($users) AND ($users->schooling == "t")))Ensino Tecnico @endif
                            @if((!empty($users) AND ($users->schooling == "si")))Ensino Superior Incompleto @endif
                            @if((!empty($users) AND ($users->schooling == "s")))Ensino Superior @endif
                        </td>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Escolaridade:</strong></span>
                        <td class="text-secondary">
                            @if((!empty($users) AND ($users->schooling == "ca")))Classe Alfabetizada @endif
                            @if((!empty($users) AND ($users->schooling == "c")))Creche @endif
                            @if((!empty($users) AND ($users->schooling == "ef")))Ensino Fundamental @endif
                            @if((!empty($users) AND ($users->schooling == "efc")))Ensino Fundamental Completo @endif
                            @if((!empty($users) AND ($users->schooling == "t")))Ensino Tecnico @endif
                            @if((!empty($users) AND ($users->schooling == "si")))Ensino Superior Incompleto @endif
                            @if((!empty($users) AND ($users->schooling == "s")))Ensino Superior @endif
                        </td>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Ocupação:</strong></span>
                        <td class="text-secondary">{{ $users->occupation }}</td>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Endereço</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            
            <div class="list-group-item list-group-item-action">
                <div class="row mt-1">
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>CEP:</strong></span>
                        <td class="text-secondary">{{$users->zip_code }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Bairro:</strong></span>
                        <td class="text-secondary">{{ $users->district }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Endereço:</strong></span>
                        <td class="text-secondary">{{  $users->address }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Número:</strong></span>
                        <td class="text-secondary">{{  $users->number }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Complemento:</strong></span>
                        <td class="text-secondary">{{ $users->complement }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Cidade:</strong></span>
                        <td class="text-secondary">{{ $users->city }}</td>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1" style="margin-bottom: 10px; margin-top: 5px;">
                        <span class="common-label"><strong>Estado:</strong></span>
                        <td class="text-secondary">{{ $users->uf }}</td>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>