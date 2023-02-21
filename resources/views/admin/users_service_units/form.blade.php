@csrf <!--token--> 

<!-- units -->
<div class="card mb-3 {{ !empty($users_service_units) ? "hide" : ""}}">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Unidades</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            <div class="form-group">
                <select name="IdServiceUnits" class="form-control form-control-sm @error('IdServiceUnits') is-invalid @enderror" required>
                    <option value="">...</option>
                    @if(!empty($service_units))
                        @foreach($service_units as $val)
                            <option value="{{ $val->IdServiceUnits }}" @if(old('IdServiceUnits') == $val->IdServiceUnits OR (!empty($users_service_units) AND ($val->IdServiceUnits == $users_service_units->IdServiceUnits)))selected @endif>{{$val->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>

<!-- units -->
@if($users->level == 'u')
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Permissões</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - users -->
                <label>Usuários:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="users" type="checkbox" value='users' {{ (((old('route')) && (in_array('users', old('route')))) || (($users_service_units) && in_array('users',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="users">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="users-create" type="checkbox" value='users.create' {{ (((old('route')) && (in_array('users.create', old('route')))) || (($users_service_units) && in_array('users.create',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="users-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="users-update" type="checkbox" value='users.update' {{ (((old('route')) && (in_array('users.update', old('route')))) || (($users_service_units) && in_array('users.update',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="users-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="users-delete" type="checkbox" value='users.delete' {{ (((old('route')) && (in_array('users.delete', old('route')))) || (($users_service_units) && in_array('users.delete',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="users-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - doctors -->
                <label>Médicos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="doctors" type="checkbox" value='doctors' {{ (((old('route')) && (in_array('doctors', old('route')))) || (($users_service_units) && in_array('doctors',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="doctors">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="doctors-create" type="checkbox" value='doctors.create' {{ (((old('route')) && (in_array('doctors.create', old('route')))) || (($users_service_units) && in_array('doctors.create',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="doctors-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="doctors-update" type="checkbox" value='doctors.update' {{ (((old('route')) && (in_array('doctors.update', old('route')))) || (($users_service_units) && in_array('doctors.update',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="doctors-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="doctors-delete" type="checkbox" value='doctors.delete' {{ (((old('route')) && (in_array('doctors.delete', old('route')))) || (($users_service_units) && in_array('doctors.delete',$users_service_units->roles()))) ? "checked" : ""}}/>
                        <label class="form-check-label" for="doctors-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - specialists -->
                <label>Especialistas:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="specialists" type="checkbox" value='specialists' {{ (((old('route')) && (in_array('specialists', old('route')))) || (($users_service_units) && in_array('specialists',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="specialists">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="specialists-create" type="checkbox" value='specialists.create' {{ (((old('route')) && (in_array('specialists.create', old('route')))) || (($users_service_units) && in_array('specialists.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="specialists-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="specialists-update" type="checkbox" value='specialists.update' {{ (((old('route')) && (in_array('specialists.update', old('route')))) || (($users_service_units) && in_array('specialists.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="specialists-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="specialists-delete" type="checkbox" value='specialists.delete' {{ (((old('route')) && (in_array('specialists.delete', old('route')))) || (($users_service_units) && in_array('specialists.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="specialists-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medication_classifications -->
                <label>Classificações Medicamentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_classifications" type="checkbox" value='medication_classifications' {{ (((old('route')) && (in_array('medication_classifications', old('route')))) || (($users_service_units) && in_array('medication_classifications',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_classifications">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_classifications-create" type="checkbox" value='medication_classifications.create' {{ (((old('route')) && (in_array('medication_classifications.create', old('route')))) || (($users_service_units) && in_array('medication_classifications.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_classifications-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_classifications-update" type="checkbox" value='medication_classifications.update' {{ (((old('route')) && (in_array('medication_classifications.update', old('route')))) || (($users_service_units) && in_array('medication_classifications.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_classifications-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_classifications-delete" type="checkbox" value='medication_classifications.delete' {{ (((old('route')) && (in_array('medication_classifications.delete', old('route')))) || (($users_service_units) && in_array('medication_classifications.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_classifications-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medication_administrations -->
                <label>Administração Medicamentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_administrations" type="checkbox" value='medication_administrations' {{ (((old('route')) && (in_array('medication_administrations', old('route')))) || (($users_service_units) && in_array('medication_administrations',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_administrations">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_administrations-create" type="checkbox" value='medication_administrations.create' {{ (((old('route')) && (in_array('medication_administrations.create', old('route')))) || (($users_service_units) && in_array('medication_administrations.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_administrations-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_administrations-update" type="checkbox" value='medication_administrations.update' {{ (((old('route')) && (in_array('medication_administrations.update', old('route')))) || (($users_service_units) && in_array('medication_administrations.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_administrations-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_administrations-delete" type="checkbox" value='medication_administrations.delete' {{ (((old('route')) && (in_array('medication_administrations.delete', old('route')))) || (($users_service_units) && in_array('medication_administrations.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_administrations-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medication_groups -->
                <label>Grupos Medicamentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_groups" type="checkbox" value='medication_groups' {{ (((old('route')) && (in_array('medication_groups', old('route')))) || (($users_service_units) && in_array('medication_groups',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_groups">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_groups-create" type="checkbox" value='medication_groups.create' {{ (((old('route')) && (in_array('medication_groups.create', old('route')))) || (($users_service_units) && in_array('medication_groups.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_groups-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_groups-update" type="checkbox" value='medication_groups.update' {{ (((old('route')) && (in_array('medication_groups.update', old('route')))) || (($users_service_units) && in_array('medication_groups.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_groups-update">Editar</label>
                    </div>
        
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_groups-delete" type="checkbox" value='medication_groups.delete' {{ (((old('route')) && (in_array('medication_groups.delete', old('route')))) || (($users_service_units) && in_array('medication_groups.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_groups-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medication_types -->
                <label>Tipos Medicamentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_types" type="checkbox" value='medication_types' {{ (((old('route')) && (in_array('medication_types', old('route')))) || (($users_service_units) && in_array('medication_types',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_types">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_types-create" type="checkbox" value='medication_types.create' {{ (((old('route')) && (in_array('medication_types.create', old('route')))) || (($users_service_units) && in_array('medication_types.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_types-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_types-update" type="checkbox" value='medication_types.update' {{ (((old('route')) && (in_array('medication_types.update', old('route')))) || (($users_service_units) && in_array('medication_types.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_types-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_types-delete" type="checkbox" value='medication_types.delete' {{ (((old('route')) && (in_array('medication_types.delete', old('route')))) || (($users_service_units) && in_array('medication_types.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_types-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medication_units -->
                <label>Unidades Medicamentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_units" type="checkbox" value='medication_units' {{ (((old('route')) && (in_array('medication_units', old('route')))) || (($users_service_units) && in_array('medication_units',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_units">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_units-create" type="checkbox" value='medication_units.create' {{ (((old('route')) && (in_array('medication_units.create', old('route')))) || (($users_service_units) && in_array('medication_units.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_units-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_units-update" type="checkbox" value='medication_units.update' {{ (((old('route')) && (in_array('medication_units.update', old('route')))) || (($users_service_units) && in_array('medication_units.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_units-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medication_units-delete" type="checkbox" value='medication_units.delete' {{ (((old('route')) && (in_array('medication_units.delete', old('route')))) || (($users_service_units) && in_array('medication_units.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medication_units-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medicines -->
                <label>Medicamentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medicines" type="checkbox" value='medicines' {{ (((old('route')) && (in_array('medicines', old('route')))) || (($users_service_units) && in_array('medicines',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medicines">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medicines-create" type="checkbox" value='medicines.create' {{ (((old('route')) && (in_array('medicines.create', old('route')))) || (($users_service_units) && in_array('medicines.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medicines-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medicines-update" type="checkbox" value='medicines.update' {{ (((old('route')) && (in_array('medicines.update', old('route')))) || (($users_service_units) && in_array('medicines.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medicines-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medicines-delete" type="checkbox" value='medicines.delete' {{ (((old('route')) && (in_array('medicines.delete', old('route')))) || (($users_service_units) && in_array('medicines.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medicines-delete">Deletar</label>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - cid10 -->
                <label>CID10:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="cid10" type="checkbox" value='cid10' {{ (((old('route')) && (in_array('cid10', old('route')))) || (($users_service_units) && in_array('cid10',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="cid10">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="cid10-create" type="checkbox" value='cid10.create' {{ (((old('route')) && (in_array('cid10.create', old('route')))) || (($users_service_units) && in_array('cid10.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="cid10-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="cid10-update" type="checkbox" value='cid10.update' {{ (((old('route')) && (in_array('cid10.update', old('route')))) || (($users_service_units) && in_array('cid10.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="cid10-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="cid10-delete" type="checkbox" value='cid10.delete' {{ (((old('route')) && (in_array('cid10.delete', old('route')))) || (($users_service_units) && in_array('cid10.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="cid10-delete">Deletar</label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - exams -->
                <label>Exames:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="exams" type="checkbox" value='exams' {{ (((old('route')) && (in_array('exams', old('route')))) || (($users_service_units) && in_array('exams',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="exams">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="exams-create" type="checkbox" value='exams.create' {{ (((old('route')) && (in_array('exams.create', old('route')))) || (($users_service_units) && in_array('exams.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="exams-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="exams-update" type="checkbox" value='exams.update' {{ (((old('route')) && (in_array('exams.update', old('route')))) || (($users_service_units) && in_array('exams.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="exams-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="exams-delete" type="checkbox" value='exams.delete' {{ (((old('route')) && (in_array('exams.delete', old('route')))) || (($users_service_units) && in_array('exams.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="exams-delete">Deletar</label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - protocols -->
                <label>Protocolos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="protocols" type="checkbox" value='protocols' {{ (((old('route')) && (in_array('protocols', old('route')))) || (($users_service_units) && in_array('protocols',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="protocols">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="protocols-create" type="checkbox" value='protocols.create' {{ (((old('route')) && (in_array('protocols.create', old('route')))) || (($users_service_units) && in_array('protocols.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="protocols-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="protocols-update" type="checkbox" value='protocols.update' {{ (((old('route')) && (in_array('protocols.update', old('route')))) || (($users_service_units) && in_array('protocols.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="protocols-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="protocols-delete" type="checkbox" value='protocols.delete' {{ (((old('route')) && (in_array('protocols.delete', old('route')))) || (($users_service_units) && in_array('protocols.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="protocols-delete">Deletar</label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - emergency_services -->
                <label>Atendimentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="emergency_services" type="checkbox" value='emergency_services' {{ (((old('route')) && (in_array('emergency_services', old('route')))) || (($users_service_units) && in_array('emergency_services',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="emergency_services">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="emergency_services-create" type="checkbox" value='emergency_services.create' {{ (((old('route')) && (in_array('emergency_services.create', old('route')))) || (($users_service_units) && in_array('emergency_services.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="emergency_services-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="emergency_services-update" type="checkbox" value='emergency_services.update' {{ (((old('route')) && (in_array('emergency_services.update', old('route')))) || (($users_service_units) && in_array('emergency_services.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="emergency_services-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="emergency_services-delete" type="checkbox" value='emergency_services.delete' {{ (((old('route')) && (in_array('emergency_services.delete', old('route')))) || (($users_service_units) && in_array('emergency_services.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="emergency_services-delete">Deletar</label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - screenings -->
                <label>Acolhimento Triagens:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="screenings" type="checkbox" value='screenings' {{ (((old('route')) && (in_array('screenings', old('route')))) || (($users_service_units) && in_array('screenings',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="screenings">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="screenings-create" type="checkbox" value='screenings.create' {{ (((old('route')) && (in_array('screenings.create', old('route')))) || (($users_service_units) && in_array('screenings.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="screenings-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="screenings-update" type="checkbox" value='screenings.update' {{ (((old('route')) && (in_array('screenings.update', old('route')))) || (($users_service_units) && in_array('screenings.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="screenings-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="screenings-delete" type="checkbox" value='screenings.delete' {{ (((old('route')) && (in_array('screenings.delete', old('route')))) || (($users_service_units) && in_array('screenings.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="screenings-delete">Deletar</label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - medical_care -->
                <label>Atendimentos Medico:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medical_care" type="checkbox" value='medical_care' {{ (((old('route')) && (in_array('medical_care', old('route')))) || (($users_service_units) && in_array('medical_care',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medical_care">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medical_care-create" type="checkbox" value='medical_care.create' {{ (((old('route')) && (in_array('medical_care.create', old('route')))) || (($users_service_units) && in_array('medical_care.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medical_care-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medical_care-update" type="checkbox" value='medical_care.update' {{ (((old('route')) && (in_array('medical_care.update', old('route')))) || (($users_service_units) && in_array('medical_care.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medical_care-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="medical_care-delete" type="checkbox" value='medical_care.delete' {{ (((old('route')) && (in_array('medical_care.delete', old('route')))) || (($users_service_units) && in_array('medical_care.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="medical_care-delete">Deletar</label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 border mt-1">
                <!-- roles - procedures -->
                <label>Procedimentos:</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="procedures" type="checkbox" value='procedures' {{ (((old('route')) && (in_array('procedures', old('route')))) || (($users_service_units) && in_array('procedures',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="procedures">Acessar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="procedures-create" type="checkbox" value='procedures.create' {{ (((old('route')) && (in_array('procedures.create', old('route')))) || (($users_service_units) && in_array('procedures.create',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="procedures-create">Criar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="procedures-update" type="checkbox" value='procedures.update' {{ (((old('route')) && (in_array('procedures.update', old('route')))) || (($users_service_units) && in_array('procedures.update',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="procedures-update">Editar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="route[]" id="procedures-delete" type="checkbox" value='procedures.delete' {{ (((old('route')) && (in_array('procedures.delete', old('route')))) || (($users_service_units) && in_array('procedures.delete',$users_service_units->roles()))) ? "checked" : "" }}/>
                        <label class="form-check-label" for="procedures-delete">Deletar</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif