@if(!empty($users_responsible_sing))
    <div class="line-sing" style="text-align: center;">
        <h1 class="line-sing-text">_________________________________________</h1>
        <h1 class="line-sing-text">{{ $users_responsible_sing->name  }}</h1>
        @if(!empty($users_responsible_sing->crm))
            <span class="text-line-sing" style="margin-top: -5px;"><strong>CRM: {{ $users_responsible_sing->crm }}</strong> /</span>
        @endif<span class="text-line-sing-crm"><strong>@if(!empty($specialty_users = auth()->user()->specialty_users($users_responsible_sing->IdUsers)))@foreach($specialty_users as $val_specialty){{ $val_specialty->title }}
                @endforeach
            @endif
        </strong></span>
    </div>
@endif