

@if($topics)

    @foreach ($topics as $val)
        <div class='accordion-item'>
            <h2 class='accordion-header'>
                <button class='accordion-button text-secondary' type='button' data-bs-toggle='collapse' data-bs-target='#collapse-{{$val->IdTopics}}' aria-expanded='true' aria-controls='collapse-{{$val->IdTopics}}'>{{$val->title}}</button>
            </h2>
            <div class='accordion-collapse collapse' id='collapse-{{$val->IdTopics}}' data-bs-parent='{{$val->IdTopics}}'>
                <div class='accordion-body'>

                    @if(!empty($checks = $val->topics_checks()->where('title', 'LIKE', "%".app('request')->input('topics_sinais')."%")->select('title', 'IdTopicsChecks', 'classification')->get()))
                        @foreach ($checks as $value)
                            <div class='form-check form-switch'>
                                <input class='form-check-input' id='{{$value->IdTopicsChecks}}-checks' value='{{$value->IdTopicsChecks}}' type='checkbox'/>
                                <label class='form-check-label' for='{{$value->IdTopicsChecks}}-checks'>
                                    
                                    @if($value->classification == "zero_priority")
                                        <span class="badge badge-soft-danger">
                                    @elseif($value->classification == "one_priority")
                                        <span class="badge very_urgent">
                                    @elseif($value->classification == "two_priority")
                                        <span class="badge badge-soft-success">
                                    @else
                                        <span class="badge badge-soft-primary">
                                    @endif

                                    {{$value->title}}</span></label>
                            </div>
                        @endforeach
                    @endif
                </div>
                
                @if(!empty($val->description))
                    <div class='row d-flex justify-content-center'>
                        <div class='col-11'>
                            <div class='mt-1 alert alert-danger'>{{$val->description}}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

@else

<tbody>
    <tr>
        <td><div class='alert alert-primary mt-1' role='alert'>Nenhum registro encontrado.</div></td>
    </tr>
</tbody>

@endif