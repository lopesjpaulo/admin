<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Test;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    protected $test;
    protected $title;

    public function __construct(Test $test)
    {
        $this->test = $test;
        $this->title = 'Simulados';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = $this->test->orderBy('id', 'desc')->paginate(10);
        $data = ['tests' => $tests, 'title' => $this->title];

        return view('admin.tests.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $themes = Theme::all();
        $data = ['temas' => $themes, 'title' => $this->title, 'subtitle' => 'Criar simulado'];

        return view('admin.tests.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->except(['theme_id', 'question_id']);
        $questions = $request->only(['question_id']);

        $test = $this->test->create($dataForm);

        foreach($questions['question_id'] as $value)
        {
            $question = Question::find($value);
            $test->questions()->attach($question);
        }

        if($test){
            return redirect('/admin/tests')->with('success', 'Simulado criado com sucesso!');
        }else {
            return redirect('/admin/tests')->with('fail', 'Falha ao criar o simulado!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $test = $this->test->with(['questions'])->find($id);
         $themes = Theme::all();

         $data = ['test' => $test, 'temas' => $themes, 'title' => $this->title, 'subtitle' => 'Editar simulado'];

         return view('admin.tests.form')->with($data);
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
        $dataForm = $request->except(['theme_id', 'question_id']);
        $questions = $request->only(['question_id']);
        $test = $this->test->find($id);

        $test->questions()->detach();

        foreach($questions['question_id'] as $value)
        {
            $question = Question::find($value);
            $test->questions()->attach($question);
        }

        if($test->update($dataForm)){
            return redirect('/admin/tests')->with('success', 'Simulado editado com sucesso!');
        }else{

            return redirect('/admin/tests')->with('fail', 'Falha ao editar simulado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = $this->test->find($id);
        $this->test->destroy($id);
        $test->questions()->detach();

        return redirect('/admin/tests')->with('success', 'Simulado excluído com sucesso!');
    }

    public function findQuestion(Request $request)
    {
        $dataForm = $request->all();

        $questions = Question::where('theme_id', $dataForm["theme"])->orderBy('title', 'desc')->get();

        return response()->json($questions);
    }
}
