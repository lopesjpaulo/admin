<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DisciplineFormRequest;
use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisciplineController extends Controller
{
    private $discipline;
    private $title;

    public function __construct(Discipline $discipline)
    {
        $this->discipline = $discipline;
        $this->title = 'Disciplinas';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplines = $this->discipline->orderBy('id', 'desc')->paginate(10);
        $data = ['disciplines' => $disciplines, 'title' => $this->title];

        return view('admin.disciplines.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.disciplines.form')->with('title', $this->title)->with('subtitle', 'Adicionar disciplina');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplineFormRequest $request)
    {
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'disciplinas');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $this->discipline->create($dataForm);

        return redirect('/admin/disciplines')->with('success', 'Notícia criada com sucesso!');
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
        $discipline = $this->discipline->find($id);

        return view('admin.disciplines.form')->with('title', $this->title)->with('disciplines', $discipline)->with('subtitle', 'Editar disciplina');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DisciplineFormRequest $request, $id)
    {
        $discipline = $this->discipline->find($id);
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'disciplinas');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $update = $discipline->update($dataForm);

        if($update){
            return redirect('/admin/disciplines')->with('success', 'Matéria atualizada com sucesso!');
        }else{
            return redirect('/admin/disciplines')->with('fail', 'Houve um erro ao atualizar a matéria!');
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
        $discipline = $this->discipline->destroy($id);

        if($discipline){
            return redirect('/admin/disciplines')->with('success', 'Disciplina excluída com sucesso!');
        }else{
            return redirect('admin/disciplines')->with('fail', 'Houve um erro ao excluir a disciplina!');
        }
    }
}
