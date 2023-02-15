<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Exams;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;

class ExamsController extends Controller
{
    protected $exams;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->exams = new Exams();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exams = $this->exams->list($request);

        return view('admin.exams.list', [
            'exams' => $exams,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('exams.form'))->withErrors($validator)->withInput();
        endif;

        Exams::create([
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('exams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdExams = null)
    {
        $exams = $this->exams->list_current(base64_decode($IdExams));

        return view('admin.exams.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'exams' => $exams
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Exams::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('exams.form', ['IdExams' => base64_encode($user->IdExams)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('exams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exams::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function list_exams_json(Request $request)
    {
        $page=1;
        if(!empty($request['page'])):
            $page = $request['page'];
        endif;

        $cid10 = Exams::where('title', 'LIKE', "%{$request['q']}%")->where('status', 'a')->forPage($page,env('PAGE_NUMBER'));

        $data = array('pagination' => array('more' => ($cid10->count() > 0)));

        if($cid10->count() > 0):
            foreach ($cid10->get() as $value):
                $data['results'][] = array("id" => $value['IdExams'], 'text' => "{$value['title']}");
            endforeach;
        endif;

        return json_encode($data);
    }
}
