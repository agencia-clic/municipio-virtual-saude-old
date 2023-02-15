<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TopicsChecks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;

class TopicsChecksController extends Controller
{
    protected $topics_checks;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->topics_checks = new TopicsChecks();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdTopics)
    {
        $IdTopics = base64_decode($IdTopics);
        return view('admin.topics_checks.list', [
            'mask' => $this->mask,
            'topics_checks' => $this->topics_checks->list($IdTopics)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdTopics)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string'],
            'classification' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('topics_checks.form', ['IdTopics' => $IdTopics]))->withErrors($validator)->withInput();
        endif;

        TopicsChecks::create([
            'title' => $data['title'],
            'classification' => $data['classification'],
            'IdTopics' => base64_decode($IdTopics),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdTopics, $IdTopicsChecks = null)
    {
        $topics_checks = $this->topics_checks->list_current(base64_decode($IdTopicsChecks));
        return view('admin.topics_checks.form', [
            'topics_checks' => $topics_checks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdTopics, $id)
    {
        $topics_checks = TopicsChecks::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string'],
            'classification' => ['required', 'string'],
        ]);
        
        if($validator->fails()):
            return redirect(route('topics_checks.form', ['IdTopics' => $IdTopics]))->withErrors($validator)->withInput();
        endif;

        $topics_checks->title = $data['title'];
        $topics_checks->classification = $data['classification'];
        $topics_checks->IdTopics = base64_decode($IdTopics);
        $topics_checks->save();

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
        TopicsChecks::find(base64_decode($id))->delete();
    }
}
