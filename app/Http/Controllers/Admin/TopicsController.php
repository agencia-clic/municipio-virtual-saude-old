<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Topics;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class TopicsController extends Controller
{
    protected $topics;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->topics = new Topics();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = $this->topics->list($request);

        return view('admin.topics.list', [
            'topics' => $topics,
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
            return redirect(route('topics.form'))->withErrors($validator)->withInput();
        endif;

        $topics = Topics::create([
            'title' => $data['title'],
            'status' => $data['status'],
            'description' => $data['description'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('topics.form', ['IdTopics' => base64_encode($topics->IdTopics)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdTopics = null)
    {
        $topics = $this->topics->list_current(base64_decode($IdTopics));

        return view('admin.topics.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'topics' => $topics
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
        $user = Topics::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('topics.form', ['IdTopics' => base64_encode($user->IdTopics)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        $user->description = $data['description'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('topics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Topics::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $request
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request)
    {
        return view('layouts.admin.fragments.topics', [

            'topics' => Topics::where('topics.title', 'LIKE', "%{$request['topics']}%")->where('topics_checks.title', 'LIKE', "%{$request['topics_sinais']}%")->

            select('topics.IdTopics', 'topics.description', 'topics.title')->leftjoin('topics_checks', 'topics.IdTopics', '=', 'topics_checks.IdTopics')->groupBy('IdTopics')->paginate(env('PAGE_NUMBER'))

        ]);
    }
}
