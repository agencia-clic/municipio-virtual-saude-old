<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProtocolsCid10;
use App\Models\ProtocolsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\Cid10;
use DB;

class ProtocolsCid10Controller extends Controller
{
    protected $protocols_cid10;
    protected $cid10;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->protocols_cid10 = new ProtocolsCid10();
        $this->cid10 = new Cid10();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdProtocols)
    {
        $IdProtocols = base64_decode($IdProtocols);
        $protocols_cid10 = $this->protocols_cid10->list($IdProtocols);
        return view('admin.protocols_cid10.list', [
            'mask' => $this->mask,
            'protocols_cid10' => $protocols_cid10
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdProtocols)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdCid10' => ['required', 'int', 'max:11'],
        ]);

        if($validator->fails()):
            return redirect(route('protocols_cid10.form', ['IdProtocols' => $IdProtocols]))->withErrors($validator)->withInput();
        endif;

        ProtocolsCid10::create([
            'IdCid10' => $data['IdCid10'],
            'IdProtocols' => base64_decode($IdProtocols),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdProtocols, $IdProtocolsCid10 = null)
    {
        //select from units
        $cid10 = $this->cid10::whereNotExists(function ($query) use ($IdProtocols) {
            $query->select(DB::raw(1))->from('protocols_cid10')->whereColumn('protocols_cid10.IdCid10', 'cid10.IdCid10')->where('IdProtocols', base64_decode($IdProtocols));
        })->get();

        $protocols_cid10 = $this->protocols_cid10->list_current(base64_decode($IdProtocolsCid10));
        return view('admin.protocols_cid10.form', [
            'cid10' => $cid10,
            'protocols_cid10' => $protocols_cid10
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdProtocols, $id)
    {
        $protocols_cid10 = ProtocolsCid10::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdCid10' => ['required', 'int', 'max:11'],
        ]);
        
        if($validator->fails()):
            return redirect(route('protocols_cid10.form', ['IdProtocols' => $IdProtocols]))->withErrors($validator)->withInput();
        endif;

        $protocols_cid10->IdCid10 = $data['IdCid10'];
        $protocols_cid10->IdProtocols = base64_decode($IdProtocols);
        $protocols_cid10->save();

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
        ProtocolsCid10::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->protocols_cid10->existe_email($request->input('email'), $request->input('email_current')));
    }
}
