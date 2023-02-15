<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmergencyServicesConducts;
use App\Models\EmergencyServicesDiagnostics;
use Illuminate\Support\Facades\Validator;
use App\Models\HospitalizationObservation;
use App\Models\AdmitPatientRequests;
use App\Http\Controllers\Controller;
use App\Models\EmergencyServices;
use Illuminate\Http\Request;
use App\Models\ServiceUnits;
use App\Models\Screenings;
use App\Helpers\Mask;
use App\Models\User;
use App\Models\Cid10;
use PDF;
use DB;

class EmergencyServicesConductsController extends Controller
{
    protected $emergency_services_conducts;
    protected $emergency_services;
    protected $mask;
    protected $service_units;
    protected $medical_specialties;
    protected $hospitalization_observation;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services = new EmergencyServices();
        $this->emergency_services_conducts = new EmergencyServicesConducts();
        $this->mask = new Mask();
        $this->service_units = new ServiceUnits();
        $this->users = new User();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type, $IdEmergencyServices)
    {
        $data = $request->all();
        $data['IdEmergencyServices'] = base64_decode($IdEmergencyServices);
        $emergency_services = $this->emergency_services->list_current($data['IdEmergencyServices']);

        //select from units
        $service_units = $this->service_units::whereExists(function ($query) {
            $query->select(DB::raw(1))->from('service_units_forwarding')->
            whereColumn('service_units_forwarding.IdServiceUnitsReceive', 'service_units.IdServiceUnits')->
            where('service_units_forwarding.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);
        })->get();

        $this->observation($request, $emergency_services);

        return view('admin.emergency_services_conducts.list', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'type' => $type,
            'emergency_services' => $emergency_services,
            'emergency_services_conducts' => $this->emergency_services_conducts->list($data['IdEmergencyServices']),
            'users' => $this->users->list_current($emergency_services->IdUsers),
            "service_units" => $service_units,
        ]);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function internment($IdEmergencyServices)
    {
        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));

        return view('admin.emergency_services_conducts.internment', [
            'emergency_services_diagnostics' => EmergencyServicesDiagnostics::where('IdEmergencyServices', base64_decode($IdEmergencyServices))->get()->toArray(),
            'emergency_services_conducts' => $this->emergency_services_conducts->list(base64_decode($IdEmergencyServices)),
            'emergency_services' => $emergency_services,
            'users' => $this->users->list_current($emergency_services->IdUsers),
        ]);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type, $IdEmergencyServices)
    {

        echo "teste"; exit;

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_conducts = $this->emergency_services_conducts->list($IdEmergencyServices);
        $emergency_services = $this->emergency_services->list_current($IdEmergencyServices);
        $admit_patient_requests = AdmitPatientRequests::where('IdEmergencyServices', $IdEmergencyServices)->whereIn('status', ['a', 'w', 'h'])->orderBy('IdAdmitPatientRequests', 'DESC')->first();

        $emergency_services_conducts_save = EmergencyServicesConducts::find($emergency_services_conducts->IdEmergencyServicesConducts);
        $emergency_services_conducts_save->IdUsersResponsibleInternment = $request->input('IdUsersResponsibleInternment');
        $emergency_services_conducts_save->admit_patient = $request->input('admit_patient');
        $emergency_services_conducts_save->to_forward = $request->input('to_forward');
        $emergency_services_conducts_save->procedures = $request->input('procedures');
        $emergency_services_conducts_save->observation = $request->input('observation');
        $emergency_services_conducts_save->note_observation = $request->input('note_observation');
        $emergency_services_conducts_save->patient_discharge = $request->input('patient_discharge');
        $emergency_services_conducts_save->declaration_presence = $request->input('declaration_presence');
        $emergency_services_conducts_save->medical_certificate = $request->input('medical_certificate');
        $emergency_services_conducts_save->prescription = $request->input('prescription');
        $emergency_services_conducts_save->social_security = $request->input('social_security');
        $emergency_services_conducts_save->main_signs = $request->input('main_signs');
        $emergency_services_conducts_save->medical_report = $request->input('medical_report');
        $emergency_services_conducts_save->justify_hospitalization = $request->input('justify_hospitalization');
        $emergency_services_conducts_save->main_results = $request->input('main_results');
        $emergency_services_conducts_save->date_initial_diagnosis = (!empty($emergency_services_conducts->date_initial_diagnosis)) ? date('Y-m-d', strtotime($request->input('date_initial_diagnosis'))) : NULL;
        $emergency_services_conducts_save->IdCid10Main = $request->input('IdCid10Main');
        $emergency_services_conducts_save->IdCid10Secondary = $request->input('IdCid10Secondary');
        $emergency_services_conducts_save->IdCid10AssociatedCauses = $request->input('IdCid10AssociatedCauses');
        $emergency_services_conducts_save->traffic_accident = $request->input('traffic_accident');
        $emergency_services_conducts_save->acid_work = $request->input('acid_work');
        $emergency_services_conducts_save->acid_work_path = $request->input('acid_work_path');
        $emergency_services_conducts_save->insurance_company_cnpj = $request->input('insurance_company_cnpj');
        $emergency_services_conducts_save->no_ticket = $request->input('no_ticket');
        $emergency_services_conducts_save->serie = $request->input('serie');
        $emergency_services_conducts_save->insurance_cnpj = $request->input('insurance_cnpj');
        $emergency_services_conducts_save->cnae_company = $request->input('cnae_company');
        $emergency_services_conducts_save->cbor = $request->input('cbor');
        $emergency_services_conducts_save->description_nature_njury = $request->input('description_nature_njury');
        $emergency_services_conducts_save->medical_opinion = $request->input('medical_opinion');
        $emergency_services_conducts_save->note_patient_discharge = $request->input('note_patient_discharge');
        $emergency_services_conducts_save->type_patient_discharge = $request->input('type_patient_discharge');
        $emergency_services_conducts_save->type_observation = $request->input('type_observation');
        $emergency_services_conducts_save->date_time_patient_discharge = (!empty($request->input('date_time_patient_discharge')) AND (!empty($request->input('patient_discharge'))))? date('Y-m-d', strtotime($request->input('date_patient_discharge')))." ".date('H:i', strtotime($request->input('date_time_patient_discharge'))) : NULL;

        $emergency_services_conducts_save->date_time_comparison_statement = (!empty($request->input('date_time_comparison_statement')) AND (!empty($request->input('declaration_presence'))))? date('Y-m-d', strtotime($request->input('date_comparison_statement')))." ".date('H:i', strtotime($request->input('date_time_comparison_statement'))) : NULL;

        $emergency_services_conducts_save->up_until_comparison_statement =  (!empty($request->input('up_until_comparison_statement')) AND (!empty($request->input('declaration_presence')))) ? date('H:i', strtotime($request->input('up_until_comparison_statement'))) : null;

        $emergency_services_conducts_save->note_comparison_statement = $request->input('note_comparison_statement');

        $emergency_services_conducts_save->unit_transfer_reason_reason = $request->input('unit_transfer_reason_reason');
        $emergency_services_conducts_save->unit_transfer = $request->input('unit_transfer');
        $emergency_services_conducts_save->IdServiceUnitsUnitTransfer = $request->input('IdServiceUnitsUnitTransfer');

        $emergency_services_conducts_save->date_medical_certificate = (!empty($request->input('date_medical_certificate')) AND (!empty($request->input('medical_certificate'))))? date('Y-m-d', strtotime($request->input('date_medical_certificate'))) : NULL;
        $emergency_services_conducts_save->number_days_medical_certificate = $request->input('number_days_medical_certificate');
        $emergency_services_conducts_save->period_medical_certificate = $request->input('period_medical_certificate');
        $emergency_services_conducts_save->IdCid10MedicalCertificate = $request->input('IdCid10MedicalCertificate');
        $emergency_services_conducts_save->save();

        if(!empty($request->input('admit_patient') AND (empty($admit_patient_requests)))){
            $this->admit_patient($emergency_services, $emergency_services_conducts_save->IdEmergencyServicesConducts);
        }

        if(!empty($request->input('observation'))){
            $this->observation($request, $emergency_services);
        }

        if(!empty($request->input('patient_discharge'))){
            $this->patient_discharge($emergency_services);
        }

        if(!empty($request->input('unit_transfer'))){
            $this->unit_transfer($request, $emergency_services, $emergency_services_conducts_save->IdEmergencyServicesConducts);
        }

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('emergency_services_conducts', ['type' => $type, 'IdEmergencyServices' => base64_encode($IdEmergencyServices)]);
    }    

     /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function medical_opinion_save(Request $request, $IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_conducts = $this->emergency_services_conducts->list($IdEmergencyServices);
        $emergency_services = $this->emergency_services->list_current($IdEmergencyServices);
       
        $emergency_services_conducts_save = EmergencyServicesConducts::find($emergency_services_conducts->IdEmergencyServicesConducts);
        $emergency_services_conducts_save->IdUsersResponsibleInternment = $request->input('IdUsersResponsibleInternment');
        $emergency_services_conducts_save->medical_opinion = $request->input('medical_opinion');
        $emergency_services_conducts_save->save();
        return 'susccess';
    }
    

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function admit_patient($emergency_services, $IdEmergencyServicesConducts)
    {
        AdmitPatientRequests::create([
            'IdUsers' => $emergency_services->IdUsers,
            'IdEmergencyServicesConducts' => $IdEmergencyServicesConducts,
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'status' => 'w',
        ]);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function observation($request, $emergency_services)
    {
        //bloqueia qualquer registro
        $hospitalization_observation = HospitalizationObservation::where('IdEmergencyServices', $emergency_services->IdEmergencyServices)->where('status', 'a')->whereIn('type', ['o', 'h', 'r'])->first();

        if(empty($hospitalization_observation) and ($emergency_services->status == "a")):
            //new hospitalization observation
            HospitalizationObservation::create([
                'status' => 'a',
                'type' => $request->input('type_observation') ?? "o",
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'IdUsers' => $emergency_services->IdUsers,
                'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
                'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            ]);
        endif;
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function patient_discharge($emergency_services)
    {
        //finalisa o atendimento
        $emergency_saervices_block = EmergencyServices::find($emergency_services->IdEmergencyServices);
        $emergency_saervices_block->status = 'b';
        $emergency_saervices_block->save();   
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function patient_discharge_view($IdEmergencyServices)
    {
        return view('admin.emergency_services_conducts.patient_discharge', [
            'emergency_services_conducts' => $this->emergency_services_conducts->list(base64_decode($IdEmergencyServices)),
        ]);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function unit_transfer($request, $emergency_services, $IdEmergencyServicesConducts)
    {
        //finalisa o atendimento
        $emergency_saervices_block = EmergencyServices::find($emergency_services->IdEmergencyServices);
        $emergency_saervices_block->status = 'b';
        $emergency_saervices_block->save();

        //finalisa a conduta
        $emergency_services_conducts_save = EmergencyServicesConducts::find($IdEmergencyServicesConducts);
        $emergency_services_conducts_save->type_patient_discharge = "en";
        $emergency_services_conducts_save->patient_discharge = "patient-discharge-check-request";
        $emergency_services_conducts_save->note_patient_discharge = $request->input('unit_transfer_reason_reason');
        $emergency_services_conducts_save->save();

        $IdEmergencyServicesOld = array();
        if(!empty($emergency_services->IdEmergencyServicesOld)):
            $IdEmergencyServicesOld = explode(',', $emergency_services->IdEmergencyServicesOld);
        endif;
        $IdEmergencyServicesOld[] = $emergency_services->IdEmergencyServices;
        $IdEmergencyServicesOld = implode(',', $IdEmergencyServicesOld);

        $emergency_services_save = EmergencyServices::create([
            'IdUsers' => $emergency_services->IdUsers,
            'types' => 'pp',
            'status' => 'a',
            'IdServiceUnits' => $request->input('IdServiceUnitsUnitTransfer'),
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'provenance' => 'tu',
            'character' => $emergency_services->character,
            'note' => $request->input('unit_transfer_reason_reason'),
            'escort_name' => $emergency_services->escort_name,
            'escort_phone' => $emergency_services->escort_phone,
            'accident_work' => $emergency_services->accident_work,
            'forwarding' => $emergency_services->forwarding,
            'forwarding_uf' => $emergency_services->forwarding_uf,
            'forwarding_county' => $emergency_services->forwarding_county,
            'forwarding_number' => $emergency_services->forwarding_number,
            'IdEmergencyServicesOld' => $IdEmergencyServicesOld,
        ]);

        //duplica  as triagens para outro atendimento
        $screenings = Screenings::where('IdEmergencyServices', $emergency_services->IdEmergencyServices)->get();

        if(!empty($screenings)):

            foreach ($screenings as $val):

                Screenings::create([
                    'IdEmergencyServices' => $emergency_services_save->IdEmergencyServices,
                    'IdServiceUnits' => $request->input('IdServiceUnitsUnitTransfer'),
                    'IdUsers' => $emergency_services->IdUsers,
                    'IdUsersResponsible' => $val->IdUsersResponsible,
                    'type' => $val->type,
                    'weight' => $val->weight,
                    'heart_rate' => $val->heart_rate,
                    'height' => $val->height,
                    'respiratory_frequency' => $val->respiratory_frequency,
                    'O2_saturation' => $val->O2_saturation,
                    'blood_pressure' => $val->blood_pressure,
                    'ecg' => $val->ecg,
                    'blood_glucose' => $val->blood_glucose,
                    'flowchart' => $val->flowchart,
                    'discriminator' => $val->discriminator,
                    'rule_of_pain' => $val->rule_of_pain,
                    'condition_hypertensive' => $val->condition_hypertensive,
                    'condition_diabetic' => $val->condition_diabetic,
                    'condition_heart_disease' => $val->condition_heart_disease,
                    'condition_pregnant' => $val->condition_pregnant,
                    'gestational_age' => $val->gestational_age,
                    'complaints' => $val->complaints,
                    'classification' => $val->classification,  
                ]);

            endforeach;

        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_pdf($IdEmergencyServices)
    {
        $title = 'Parecer Médico';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_conducts = $this->emergency_services_conducts->list($IdEmergencyServices);

        $pdf = PDF::loadView('admin.emergency_services_conducts.export-medication-option', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'emergency_services_conducts' => $emergency_services_conducts,
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_medical_report($IdEmergencyServices)
    {
        $title = 'Parecer Médico';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_conducts = $this->emergency_services_conducts->list($IdEmergencyServices);

        $pdf = PDF::loadView('admin.emergency_services_conducts.export-medication-medical-report', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'emergency_services_conducts' => $emergency_services_conducts,
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_declaration_certificate($IdEmergencyServices)
    {
        $title = 'Atestado Médico';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_conducts = $this->emergency_services_conducts->list($IdEmergencyServices);

        $pdf = PDF::loadView('admin.emergency_services_conducts.export-medication-declaration-certificate', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'users_paciente' => User::find($emergency_services->IdUsers),
            'emergency_services_conducts' => $emergency_services_conducts,
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_certificate($IdEmergencyServices)
    {
        $title = 'Atestado Médico';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_conducts = $this->emergency_services_conducts->list($IdEmergencyServices);        

        $pdf = PDF::loadView('admin.emergency_services_conducts.export-medication-certificate', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'cid10' => Cid10::find($emergency_services_conducts->IdCid10MedicalCertificate ?? 0),
            'users_paciente' => User::find($emergency_services->IdUsers),
            'emergency_services_conducts' => $emergency_services_conducts,
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}