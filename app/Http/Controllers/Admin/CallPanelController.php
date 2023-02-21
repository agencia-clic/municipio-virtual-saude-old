<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CallPanel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class CallPanelController extends Controller
{
    protected $call_panel;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->call_panel = new CallPanel();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $call_panel = $this->call_panel->list($request);
        return view('admin.call_panel.list', [
            'call_panel' => $call_panel,
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
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('call_panel.form'))->withErrors($validator)->withInput();
        endif;

        CallPanel::create([
            'title' => $data['title'],
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('call_panel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdCallPanel = null)
    {
        $call_panel = $this->call_panel->list_current(base64_decode($IdCallPanel));

        return view('admin.call_panel.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'call_panel' => $call_panel
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
        $call_panel = CallPanel::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('call_panel.form', ['IdCallPanel' => base64_encode($call_panel->IdCallPanel)]))->withErrors($validator)->withInput();
        endif;

        $call_panel->title = $data['title'];
        $call_panel->status = $data['status'];
        
        $call_panel->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('call_panel');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json(Request $request)
    {
        $data = CallPanel::where('status', 'a')->get();
        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CallPanel::find(base64_decode($id))->delete();
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro deltado com sucesso.', 'color' => 'bg-primary']));
    }
}
