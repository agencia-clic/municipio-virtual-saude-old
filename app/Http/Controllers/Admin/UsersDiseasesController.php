<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UsersDiseases;
use App\Models\UsersService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\MedicationActivePrinciples;
use App\Models\ServiceUnits;
use DB;

class UsersDiseasesController extends Controller
{
    protected $users_diseases;
    protected $service_units;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->users_diseases = new UsersDiseases();
        $this->service_units = new ServiceUnits();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdUsers)
    {
        $IdUsers = base64_decode($IdUsers);
        $users_diseases = $this->users_diseases->list($IdUsers, $request->input('type'));

        return view('admin.users_diseases.list', [
            'mask' => $this->mask,
            'IdUsers' => $IdUsers,
            'users_diseases' => $users_diseases
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdUsers)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdMedicationActivePrinciples' => 'required_if:type_allergies,m',
            'text' => 'required_if:type_allergies,o',
        ]);

        if($validator->fails()):
            return redirect(route('users_diseases.form', ['type' => $data['type'], 'IdUsers' => $IdUsers]))->withErrors($validator)->withInput();
        endif;

        UsersDiseases::create([
            'text' => $data['text'],
            'IdUsers' => base64_decode($IdUsers),
            'IdMedicationActivePrinciples' => $request->input('IdMedicationActivePrinciples'),
            'type_allergies' => $request->input('type_allergies'),
            'type' => $data['type']
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdUsers, $IdUsersDiseases = null)
    {
        $users_diseases = $this->users_diseases->list_current(base64_decode($IdUsersDiseases));
        return view('admin.users_diseases.form', [
            'IdUsers' => $IdUsers,
            'users_diseases' => $users_diseases
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdUsers, $id)
    {
        $users_diseases = UsersDiseases::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdMedicationActivePrinciples' => 'required_if:type_allergies,m',
            'text' => 'required_if:type_allergies,o',
        ]);
        
        if($validator->fails()):
            return redirect(route('users_diseases.form', ['type' => $data['type'], 'IdUsers' => $IdUsers]))->withErrors($validator)->withInput();
        endif;

        $users_diseases->text = $data['text'];
        $users_diseases->type = $data['type'];
        $users_diseases->IdUsers = base64_decode($IdUsers);
        $users_diseases->save();
        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request, $IdUsers)
    {
        $medication_active_principles = MedicationActivePrinciples::where('medication_active_principles.status', 'a')->limit(env('PAGE_NUMBER'))->whereNotExists(function ($query) use ($IdUsers) {
            $query->select(DB::raw(1))->from('users_diseases')->whereColumn('users_diseases.IdMedicationActivePrinciples', 'medication_active_principles.IdMedicationActivePrinciples')->where('IdUsers', base64_decode($IdUsers));
        });

        if(!empty($request['title'])):
            $medication_active_principles = $medication_active_principles->where('medication_active_principles.title', 'LIKE', "%{$request['title']}%");
        endif;

        if(empty($request['title']) AND !empty($request['IdMedicationActivePrinciples'])):
            $medication_active_principles = $medication_active_principles->where('medication_active_principles.IdMedicationActivePrinciples', $request['IdMedicationActivePrinciples']);
        endif;

        return json_encode($medication_active_principles->get()->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UsersDiseases::find(base64_decode($id))->delete();
    }
}
