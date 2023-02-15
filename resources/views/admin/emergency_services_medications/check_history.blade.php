
@if(!empty($medication_groups))

    @foreach ($medication_groups as $val)
        
        <!-- emergency services historic -->
        <div class="list-group mt-1">
            <a class="list-group-item list-group-item-action bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#collapse{{$val->IdMedicationGroups ?? ""}}" aria-expanded="true" aria-controls="collapse{{$val->IdMedicationGroups ?? ""}}" href="#">
                <span class="far fa-arrow-alt-circle-down"></span> 
                {{ $val->created_at->format('d-m-Y H:i') }} • 

                <strong>{{ $val->responsible }}</strong>
                @if(!empty($specialty_users = $users->specialty_users($val->IdUsersResponsible)))
                    @foreach($specialty_users as $val_specialty)
                    • {{ $val_specialty->title }}
                    @endforeach
                @endif

                @if(!empty($val->note))
                    • {{ $val->note }}
                @endif
            </a>
            
            <div class="accordion-collapse collapse" id="collapse{{$val->IdMedicationGroups ?? ""}}" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="list-group-item list-group-item-action">
                    <div id="table-admin" url="{{ route('emergency_services_medications.check.admin', ['IdEmergencyServices' => base64_encode($val->IdEmergencyServices), 'IdMedicationGroups' => base64_encode($val->IdMedicationGroups)]) }}"></div>
                </div>
            </div>
        </div>

    @endforeach

@else
    <table class="table table-sm table-striped fs--1 mb-0 border overflow-hidden border mt-2">
        <tbody>
            <tr>
                <td><div class="alert alert-primary mt-3" role="alert">Nenhum registro encontrado.</div></td>
            </tr>
        </tbody>
    </table>
@endif

<script type="text/javascript">
$(document).ready(function() {
    reload_html($('#table-admin').attr('url'), $('#table-admin'))
})
</script>