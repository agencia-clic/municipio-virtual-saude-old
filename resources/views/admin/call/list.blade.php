@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<div class="card mb-3 mt-5" data-list=''>

    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Registros de Chamadas</h5>
            </div>
            <div class="col-8 col-sm-auto text-end ps-2"></div>
        </div>
    </div>
    
    <!-- table -- start -->
    <div class="card-body p-0">
        <div class="table-responsive scrollbar">
            <table class="table table-sm table-striped fs--1 border mb-0 overflow-hidden">

                @if(!empty($call->total()) AND ($call->total() > 0))
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 white-space-nowrap text-left" width="10%">Data/Hora</th>
                            <th class="sort pe-1 white-space-nowrap text-left">Profissional</th>
                            <th class="sort pe-1 white-space-nowrap text-left" width="15%">Localização</th>
                        </tr>
                    </thead>
                    <tbody class="list list-table" id="table-customers-body">
        
                        @foreach($call as $val)
                            <tr class="btn-reveal-trigger" id="{{$val->IdCall}}-table">
                                <td class="border email py-2">{{ $val->created_at->format('d-m-Y H:i') }}</td>
                                <td class="border email py-2">{{ $val->responsible }}</td>
                                <td class="border email py-2">{{ $val->sala }}</td>
                            </tr>
                        @endforeach
                        
                    @else
                        <tbody>
                            <tr>
                                <td><div class="alert alert-primary mt-1" role="alert">Nenhum registro encontrado.</div></td>
                            </tr>
                        </tbody>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <!-- table -- end -->

    <!-- paginations -- start -->
    {{ $call->appends(app('request')->all())->links() }}
    
</div>

@endsection