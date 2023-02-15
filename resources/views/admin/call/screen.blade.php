@extends('layouts.admin.app')

@section('content')

@csrf <!--token--> 

<style>
    body{
        background: #FFF;
    }
</style>

<div class="row">
    <div class="col-md-6 text-center" style="height: 29vh; background-color: rgb(0,112,193)">
        <table style="height: 29vh; width: 100%;">
            <tbody>
              <tr>
                <td class="border align-middle" width="100%" id="current-patient"></td>
              </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-6 text-center" style="height: 29vh; border: 1px solid rgb(0,112,193);">
        <table style="height: 29vh; width: 100%;">
            <tbody>
              <tr>
                <td class="border align-middle" width="100%">
                    <h1 class="align-middle" style="font-size: 8vh; color: rgb(0,112,193)">Sala</h1>
                    <span class="text-secondary h1 align-middle" style="font-size: 6vh" id="sala-call"></span>
                </td>
              </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-12">
        
        <table style="width: 100%;" class="mt-3">
            <tbody>
                <tr>
                    <td class="border align-middle text-center" width="100%">
                        <span class="text-secondary align-middle" style="font-size: 5vh">Histórico de Chamados</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%;" class="mt-3">

            <thead>
                <tr>
                  <th class="text-left" width="25%"><span class="align-middle" style="margin-left: 20%; font-size: 4vh; color: rgb(0,112,193)">Paciente</span></th>
                  <th class="text-center" width="25%"><span class="align-middle" style="font-size: 4vh; color: rgb(0,112,193)">Sala</span></th>
                  <th class="text-center" width="25%"><span class="align-middle" style="font-size: 4vh; color: rgb(0,112,193)">Horário Chamada</span></th>
                </tr>
            </thead>

            <tbody id="historic-table" url="{{ route('call.historic') }}" url-call="{{ route('call') }}" data-id="{{ auth()->user()->units_current()->IdServiceUnits }}"></tbody>
        </table>
    </div>
</div>

<footer class="footer button-sound-footer">

    <button type="button" class="btn btn-secondary mb-1 button-sound hide" data-audio="{{ Storage::disk('s3')->url('C149qYpO2MEz8IdZobioumLZ7XK3oYuO1rnOJv1F.mp3') }}">
        <span class="fas fa-bell fs-1" data-fa-transform="down-2"></span>
    </button>

    <div class="row">
        <div class="col-md-2 text-center" style="height: 10vh; background-color: #35456c">
            <table style="height: 10vh; width: 100%;">
                <tbody>
                  <tr>
                    <td class="border align-middle" width="100%">
                        <div class="row" id="date-time"></div>
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
   
        <div class="col-md-8 text-center" style="height: 10vh; background-color: rgb(0,112,193)">
            <table style="height: 10vh; width: 100%;">
                <tbody>
                  <tr>
                    <td class="border align-middle" width="100%">
                        <span class="text-white h1 align-middle ml-1" style="font-size: 4.5vh">{{ auth()->user()->units_current()->name }}</span>
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-2 text-center" style="height: 10vh; background-color: rgb(0,112,193)">
            <table style="height: 10vh; width: 100%;">
                <tbody>
                  <tr>
                    <td class="border align-middle" width="100%">
                        <img class="img-fluid" src="{{asset('admin/img/logo-araxa.png')}}" width="80%">
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
       
    </div>

</footer>

@endsection

<!-- scripts -->
@section('scripts')
<script src="{{ asset('admin/js/scripts.js') }}"></script>
<script src="{{ asset('admin/js/modules/call.js') }}"></script>
@endsection