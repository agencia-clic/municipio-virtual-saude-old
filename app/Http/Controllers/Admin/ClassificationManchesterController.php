<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ClassificationManchester;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\EmergencyServices;
use DB;

class ClassificationManchesterController extends Controller
{
    protected $classification_manchester;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->classification_manchester = new ClassificationManchester();
        $this->mask = new Mask();
        $this->emergency_services = new EmergencyServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $classification_manchester = $this->classification_manchester->list($IdEmergencyServices, $request->input('type'));
        return view('admin.classification_manchester.list', [
            'mask' => $this->mask,
            'classification_manchester' => $classification_manchester
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdEmergencyServices)
    {
        $data = $request->all();
        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));

        $validator = Validator::make($data, [
            'IdCid10' => ['required', 'string', 'max:11'],
            'traffic_accident' => ['required', 'string', 'max:1'],
            'work_related' => ['required', 'string', 'max:1'],
            'violent_attack' => ['required', 'string', 'max:1'],
            'notifiable_disease' => ['required', 'string', 'max:1'],
            'main_diagnosis' => ['required', 'string', 'max:1'],
            'diagnostics' => ['required', 'string', 'max:1'],
            'respiratory_symptomatic' => ['required', 'string', 'max:1'],
        ]);

        if(!empty($data['date'])):
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        endif;

        if($validator->fails()):
            return redirect(route('classification_manchester.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        ClassificationManchester::create([
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'IdUsers' => $emergency_services->IdUsers,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdCid10' => $data['IdCid10'],
            'traffic_accident' => $data['traffic_accident'],
            'work_related' => $data['work_related'],
            'violent_attack' => $data['violent_attack'],
            'notifiable_disease' => $data['notifiable_disease'],
            'diagnostics' => $data['diagnostics'],
            'main_diagnosis' => $data['main_diagnosis'],
            'respiratory_symptomatic' => $data['respiratory_symptomatic'],
            'date' => $data['date'],
        ]);


        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdClassificationManchester = null)
    {
        $classification_manchester = $this->classification_manchester->list_current(base64_decode($IdClassificationManchester));
        return view('admin.classification_manchester.form', [
            'classification_manchester' => $classification_manchester
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdEmergencyServices, $id)
    {
        $classification_manchester = ClassificationManchester::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdCid10' => ['required', 'string', 'max:11'],
            'traffic_accident' => ['required', 'string', 'max:1'],
            'work_related' => ['required', 'string', 'max:1'],
            'violent_attack' => ['required', 'string', 'max:1'],
            'notifiable_disease' => ['required', 'string', 'max:1'],
            'main_diagnosis' => ['required', 'string', 'max:1'],
            'diagnostics' => ['required', 'string', 'max:1'],
            'respiratory_symptomatic' => ['required', 'string', 'max:1'],
        ]);
        
        if(!empty($data['date'])):
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        endif;

        if($validator->fails()):
            return redirect(route('classification_manchester.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        $classification_manchester->IdCid10 = $data['IdCid10'];
        $classification_manchester->traffic_accident = $data['traffic_accident'];
        $classification_manchester->work_related = $data['work_related'];
        $classification_manchester->violent_attack = $data['violent_attack'];
        $classification_manchester->notifiable_disease = $data['notifiable_disease'];
        $classification_manchester->diagnostics = $data['diagnostics'];
        $classification_manchester->main_diagnosis = $data['main_diagnosis'];
        $classification_manchester->respiratory_symptomatic = $data['respiratory_symptomatic'];
        $classification_manchester->date = $data['date'];
        $classification_manchester->save();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClassificationManchester::find(base64_decode($id))->delete();
    }
}
