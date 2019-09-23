<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClasseFormRequest;
use App\Models\Classe;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClasseController extends Controller
{
    protected $classe;
    protected $title;

    public function __construct(Classe $classe)
    {
        $this->classe = $classe;
        $this->title = 'Pré-aula';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = $this->classe->orderBy('id', 'desc')->paginate(10);
        $data = ['classes' => $classes, 'title' => $this->title];

        return view('admin.classes.index')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temas = Theme::all();
        return view('admin.classes.form')->with('title', $this->title)->with('subtitle', 'Criar pré-aula')->with('temas', $temas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseFormRequest $request)
    {
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'classes');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $this->classe->create($dataForm);

        return redirect('/admin/classes')->with('success', 'Pré-aula criada com sucesso!');
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
        $classe = $this->classe->find($id);
        $temas = Theme::all();

        $data = ['classe' => $classe, 'temas' => $temas, 'title' => $this->title, 'subtitle' => 'Editar pré-aula'];

        return view('admin.classes.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseFormRequest $request, $id)
    {
        $classe = $this->classe->find($id);

        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'classes');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $classe->update($dataForm);

        return redirect('/admin/classes')->with('success', 'Pré-aula criada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = $this->classe->destroy($id);

        if($classe)
        {
            return redirect('/admin/classes')->with('success', 'Pré-aula excluída com sucesso!');
        } else {
            return redirect('/admin/classes')->with('fail', 'Houve um erro ao excluir o registro!');
        }
    }
}
