<!-- table -- start -->
<div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border">

        @if(!empty($rooms_beds['data']->total()) AND ($rooms_beds['data']->total() > 0))
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort pe-1 white-space-nowrap">Quarto/Leito</th>
                    <th class="sort pe-1 text-center" width="20%">Paciente</th>
                    <th class="sort pe-1 text-center" width="15%">Acomodação</th>
                    <th class="sort pe-1 text-center" width="10%">Última Atualização</th>
                    <th class="sort pe-1 text-center" width="10%">Status</th>
                    <th class="no-sort text-end" width="5%">Ações</th>
                </tr>
            </thead>
            <tbody class="list list-table" id="table-customers-body">

                @foreach($rooms_beds['data'] as $val)

                    <tr class="btn-reveal-trigger" id="{{$val->IdRoomsBeds}}-table">
                        <td class="border email py-2"><strong>
                            {{ $val->rooms }} • {{ $val->title }} {{  "• {$val->note}" ?? "" }} •
                            <span class="badge bg-primary" title="Sexo Determinante">
                                @if($val->determining_sex == "m")
                                    MASCULINO
                                @elseif($val->determining_sex == "f")
                                    FEMININO
                                @else
                                    INDIFERENTE
                                @endif
                            </span>
                        </strong></td>
                        <td class="border email py-2 text-center"><strong>
                            @if(!empty($val->name))
                                {{ $val->name }}  • <span class="badge bg-primary" title="Sexo Paciente">
                                    @if($val->sex == "m")
                                        MASCULINO
                                    @elseif($val->sex == "f")
                                        FEMININO
                                    @else
                                        INDIFERENTE
                                    @endif
                                </span>
                            @endif
                        </strong></td>
                        <td class="border email py-2 text-center"><strong>{{ $val->accommodations }}</strong></td>
                        <td class="border email py-2 text-center"><strong>@if(!empty($val->last_update)) {{ date('d-m-Y H:i', strtotime($val->last_update)) }} @endif</strong></td>

                        <td class="border phone white-space-nowrap py-2 border text-center" width="5%">
                            @if($val->status == "d")
                                <span class="badge badge rounded-pill d-block p-2 badge-soft-success"> DISPONÍVEL
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span> 
                                </span>
                            @elseif($val->status == "l")
                                <span class="badge badge rounded-pill p-2 d-block badge-soft-primary"> LIMPEZA
                                    <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span> 
                                </span>
                            @elseif($val->status == "o")
                                <span class="badge badge rounded-pill p-2 d-block badge-soft-info"> OCUPADO
                                    <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span> 
                                </span>
                            @elseif($val->status == "b")
                                <span class="badge badge rounded-pill p-2 d-block badge-soft-danger"> Bloqueado
                                    <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span> 
                                </span>
                            @endif
                        </td>

                        <td class="border white-space-nowrap py-2 text-end">
                            <div class="dropdown font-sans-serif position-static">
                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--1"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                                    <div class="bg-white py-2">

                                        <!-- interning -->
                                        @if($val->status == "d")
                                            <button class="dropdown-item" 
                                            type="button" title="Internar" 
                                            iframe-form=" {{route('central_beds.interning', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}" 
                                            iframe-create="{{ route('central_beds.interning.create', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)]) }}"><span class="fas fa-bed me-1"></span><span> <strong>Internar</strong></span></button>
                                        @endif

                                        <!-- transferir paciente -->
                                        @if($val->status == "o")
                                            <button class="dropdown-item" 
                                            type="button" title="Transferir Paciente" 
                                            iframe-form=" {{route('central_beds.transfer', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}" 
                                            iframe-create="{{ route('central_beds.transfer.create', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)]) }}"><span class="fas fa-exchange-alt me-1"></span><span> <strong>Transferir Paciente</strong></span></button>
                                        @endif

                                        <!-- cleaning -->
                                        @if($val->status != "l" AND $val->status != 'b')
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" 
                                            type="button" title="Limpar Leito" 
                                            iframe-form=" {{route('central_beds.cleaning', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}" 
                                            iframe-create="{{ route('central_beds.cleaning.create', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)]) }}"><span class="fas fa-prescription-bottle-alt me-1"></span><span> <strong>Limpar Leito</strong></span></button>
                                        @endif

                                        @if($val->status == "l")
                                            <!-- cleaning - finish-->
                                            <button class="dropdown-item cleaning-finish" type="button" onclick="cleaning_modal('Finalizar Limpeza', 'Realmente deseja FINALIZAR LIMPEZA do leito', 'primary', '{{route('central_beds.cleaning.finish', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}')">
                                                <span class="fas fa-arrow-alt-circle-left me-1"></span><span> <strong>Finalizar Limpeza</strong></span>
                                            </button>
                                        @endif

                                        @if(($val->status == 'd' OR $val->status == 'l') AND $val->status != 'b') 
                                            <!-- block -->
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item cleaning-finish" type="button" onclick="cleaning_modal('Bloquear Leito', 'Realmente deseja BLOQUEAR esse leito', 'danger', '{{route('central_beds.block', ['IdRooms' => base64_encode($val->IdRooms), 'status' => 'b', 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}')">
                                                <span class="fas fa-ban me-1"></span><span> <strong>Bloquear</strong></span>
                                            </button>
                                        @endif

                                        @if($val->status == 'b')
                                            <button class="dropdown-item cleaning-finish" type="button" onclick="cleaning_modal('Desbloquear Leito', 'Realmente deseja DESBLOQUEAR esse leito', 'primary', '{{route('central_beds.block', ['IdRooms' => base64_encode($val->IdRooms), 'status' => 'd', 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}')">
                                                <span class="fas fa-ban me-1"></span><span> <strong>Desbloquear</strong></span>
                                            </button>
                                        @endif
                                        
                                        <!-- transfer beds -->
                                        @if($val->status == "d")
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item" 
                                            type="button" title="Transferir Leito" 
                                            iframe-form=" {{route('central_beds.transfer.beds', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)])}}" 
                                            iframe-create="{{ route('central_beds.transfer.beds.create', ['IdRooms' => base64_encode($val->IdRooms), 'IdRoomsBeds' => base64_encode($val->IdRoomsBeds)]) }}"><span class="fas fa-exchange-alt me-1"></span><span> <strong>Transferir Leito</strong></span></button>
                                        </button>
                                        @endif
            
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <tbody>
                    <tr>
                        <td><div class="alert alert-primary mt-3" role="alert">Nenhum registro encontrado.</div></td>
                    </tr>
                </tbody>
            @endif
    </table>
</div>
<!-- table -- end -->