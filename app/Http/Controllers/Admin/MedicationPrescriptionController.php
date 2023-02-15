<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicationPrescription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class MedicationPrescriptionController extends Controller
{
    protected $medication_prescription;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->mask = new Mask();
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'unique:medication_prescriptions']
        ]);

        if($validator->fails()):
            return "error";
        endif;

        MedicationPrescription::create([
            'title' => $request->input('title'),
        ]);

        return "success";
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $medicines = MedicationPrescription::limit(env('PAGE_NUMBER'));

        if(!empty($data) AND (!empty($data['title']))):
            $medicines = $medicines->where('title', 'LIKE', "{$data['title']}%");
        endif;

        if(!empty($data) AND (!empty($data['IdMedicines']))):
            $medicines = $medicines->where('IdMedicines', $data['IdMedicines']);
        endif;

        return json_encode($medicines->get());
    }
}
