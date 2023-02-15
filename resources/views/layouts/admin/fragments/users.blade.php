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
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>Nome:</strong></span>
                        <div class="text-secondary">{{$users->name}}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>Nome da mãe:</strong></span>
                        <div class="text-secondary">{{ $users->mother }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>CPF:</strong></span>
                        <div class="text-secondary">{{ $mask->cpf_cnpj($users->cpf_cnpj) }}</div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Código:</strong></span>
                        <div class="text-secondary">{{ $users->IdUsers }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Nascimento:</strong></span>
                        <div class="text-secondary">{{  date('d-m-Y', strtotime($users->date_birth)) }}</div>
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
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>Raça/Cor:</strong></span>
                        <div class="text-secondary">
                            @if((!empty($users) AND ($users->breed == "B")))BRANCA @endif
                            @if((!empty($users) AND ($users->breed == "N")))NEGRA @endif
                            @if((!empty($users) AND ($users->breed == "P")))PARDA @endif
                            @if((!empty($users) AND ($users->breed == "A")))AMARELA @endif
                            @if((!empty($users) AND ($users->breed == "I")))INDIGENA @endif
                            @if((!empty($users) AND ($users->breed == "O")))OUTROS @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>Sexo:</strong></span>
                        <div class="text-secondary">
                            @if($users->sex == "m")
                                Masculino
                            @elseif($users->sex == "f"):
                                Feminino
                            @else
                                Outros
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>País de origem:</strong></span>
                        <div class="text-secondary">{{$users->origin }}</div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Naturalidade:</strong></span>
                        <div class="text-secondary">{{ $users->naturalness }}/{{ $users->uf_naturalness }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Tel. residencial:</strong></span>
                        <div class="text-secondary">{{  $mask->phone($users->phone) }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Celular:</strong></span>
                        <div class="text-secondary">{{  $mask->phone($users->cell) }}</div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Email:</strong></span>
                        <div class="text-secondary">{{ $users->email }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Tipo sanguíneo:</strong></span>
                        <div class="text-secondary">
                            @if((!empty($users) AND ($users->sanguine == "A+")))A+ @endif
                            @if((!empty($users) AND ($users->sanguine == "A-")))A- @endif
                            @if((!empty($users) AND ($users->sanguine == "B+")))B+ @endif
                            @if((!empty($users) AND ($users->sanguine == "AB+")))AB+ @endif
                            @if((!empty($users) AND ($users->sanguine == "AB-")))AB- @endif
                            @if((!empty($users) AND ($users->sanguine == "O-")))O- @endif
                            @if((!empty($users) AND ($users->sanguine == "O+")))O+ @endif
                            @if((!empty($users) AND ($users->sanguine == "N")))Nenhum @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Estado Civil:</strong></span>
                        <div class="text-secondary">
                            @if((!empty($users) AND ($users->schooling == "ca")))Classe Alfabetizada @endif
                            @if((!empty($users) AND ($users->schooling == "c")))Creche @endif
                            @if((!empty($users) AND ($users->schooling == "ef")))Ensino Fundamental @endif
                            @if((!empty($users) AND ($users->schooling == "efc")))Ensino Fundamental Completo @endif
                            @if((!empty($users) AND ($users->schooling == "t")))Ensino Tecnico @endif
                            @if((!empty($users) AND ($users->schooling == "si")))Ensino Superior Incompleto @endif
                            @if((!empty($users) AND ($users->schooling == "s")))Ensino Superior @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Escolaridade:</strong></span>
                        <div class="text-secondary">
                            @if((!empty($users) AND ($users->schooling == "ca")))Classe Alfabetizada @endif
                            @if((!empty($users) AND ($users->schooling == "c")))Creche @endif
                            @if((!empty($users) AND ($users->schooling == "ef")))Ensino Fundamental @endif
                            @if((!empty($users) AND ($users->schooling == "efc")))Ensino Fundamental Completo @endif
                            @if((!empty($users) AND ($users->schooling == "t")))Ensino Tecnico @endif
                            @if((!empty($users) AND ($users->schooling == "si")))Ensino Superior Incompleto @endif
                            @if((!empty($users) AND ($users->schooling == "s")))Ensino Superior @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Ocupação:</strong></span>
                        <div class="text-secondary">{{ $users->occupation }}</div>
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
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin">
                        <span class="common-label"><strong>CEP:</strong></span>
                        <div class="text-secondary">{{$users->zip_code }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Bairro:</strong></span>
                        <div class="text-secondary">{{ $users->district }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Endereço:</strong></span>
                        <div class="text-secondary">{{  $users->address }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Numero:</strong></span>
                        <div class="text-secondary">{{  $users->number }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Complemento:</strong></span>
                        <div class="text-secondary">{{ $users->complement }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Cidade:</strong></span>
                        <div class="text-secondary">{{ $users->city }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 no-margin mt-1">
                        <span class="common-label"><strong>Estado:</strong></span>
                        <div class="text-secondary">{{ $users->uf }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>