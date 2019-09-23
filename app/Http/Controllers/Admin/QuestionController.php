<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionFormRequest;
use App\Models\Alternative;
use App\Models\Question;
use App\Models\Theme;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    protected $question;
    protected $title;

    public function __construct(Question $question)
    {
        $this->question = $question;
        $this->title = "Questões";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->question->orderBy('id', 'desc')->paginate(10);
        $data = ['questions' => $questions, 'title' => $this->title];

        return view('admin.questions.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temas = Theme::all();

        $data = ['temas' => $temas, 'title' => $this->title, 'subtitle' => 'Adicionar questão'];

        return view('admin.questions.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionFormRequest $request)
    {
        $dataForm = $request->except(['choose', 'title_question']);
        $alternatives = $request->only(['title_question']);
        $choose = $request->only(['choose']);

        $id = $this->question->create($dataForm)->id;

        foreach($alternatives['title_question'] as $key => $value) {
            $alternative = ['title' => $value, 'question_id' => $id];
            if ($key == (int)$choose['choose']) {
                $alternative['choose'] = 1;
            } else {
                $alternative['choose'] = 0;
            }
            Alternative::create($alternative);
        }

        return redirect('/admin/questions')->with('success', 'Questão criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        $temas = Theme::all();
        $alternatives = Alternative::where('question_id', $id)->get();

        $data = ['question' => $question, 'temas' => $temas, 'title' => $this->title, 'alternatives' => $alternatives, 'subtitle' => 'Editar questão'];

        return view('admin.questions.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionFormRequest $request, $id)
    {
        $question = $this->question->find($id);

        $dataForm = $request->except(['choose', 'title_question']);
        $alternatives = $request->only(['title_question']);
        $choose = $request->only(['choose']);

        $question->update($dataForm);
        Alternative::where('question_id', '=', $id)->delete();

        foreach($alternatives['title_question'] as $key => $value) {
            $alternative = ['title' => $value, 'question_id' => $id];
            if ($key == (int)$choose['choose']) {
                $alternative['choose'] = 1;
            } else {
                $alternative['choose'] = 0;
            }
            Alternative::create($alternative);
        }

        return redirect('/admin/questions')->with('success', 'Questão atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->question->destroy($id);
        Alternative::where('question_id', '=', $id)->delete();

        return redirect('admin/questions')->with('success', 'Questão apagada com sucesso!');
    }

    public function findType(Request $request)
    {
        $dataForm = $request->all();

        $tipo = Type::where('theme_id', $dataForm['theme'])->orderBy('title', 'desc')->get();

        return response()->json($tipo);
    }
}
