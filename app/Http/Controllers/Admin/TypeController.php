<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;

class TypeController extends Controller
{
    protected $type;
    protected $title;

    public function __construct(Type $type)
    {
        $this->type = $type;
        $this->title = 'Tipos';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = $this->type->orderBy('id', 'desc')->paginate(10);
        return view('admin.types.index')->with('types', $types)->with('title', $this->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temas = Theme::all();
        return view('admin.types.form')->with('title', $this->title)->with('subtitle', 'Criar tipo')->with('temas', $temas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'tipos');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $this->type->create($dataForm);

        return redirect('/admin/types')->with('success', 'Tipo criado com sucesso!');
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
        $type = $this->type->find($id);
        $temas = Theme::all();

        return view('admin.types.form')->with('type', $type)->with('title', $this->title)->with('subtitle', 'Editar tipo')->with('temas', $temas);
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
        $tipo = $this->type->find($id);
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'tipos');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $tipo->update($dataForm);

        return redirect('/admin/types')->with('success', 'Tipo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = $this->type->destroy($id);

        if($type)
        {
            return redirect('/admin/types')->with('success', 'Tipo excluído com sucesso!');
        } else {
            return redirect('/admin/types')->with('fail', 'Houve um erro ao excluir o registro!');
        }
    }
}
