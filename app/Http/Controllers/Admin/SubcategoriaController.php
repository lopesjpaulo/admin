<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoriaFormRequest;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    protected $subcategoria;
    protected $title;

    public function __construct(Subcategoria $subcategoria)
    {
        $this->subcategoria = $subcategoria;
        $this->title = 'Subcategoria';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorias = $this->subcategoria->orderBy('id', 'desc')->paginate(10);

        $data = ['subcategorias' => $subcategorias, 'title' => $this->title];

        return view('admin.subcategorias.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        $data = ['categorias' => $categorias, 'title' => $this->title, 'subtitle' => 'Criar Subcategoria'];

        return view('admin.subcategorias.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoriaFormRequest $request)
    {
        $dataForm = $request->all();

        $created = $this->subcategoria->create($dataForm);

        if(!$created) return redirect('admin/subcategorias')->with('fail', 'Houve um problema ao cadastrar a subcategoria!');

        return redirect('admin/subcategorias')->with('success', 'Subcategoria cadastrada com sucesso!');
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
        $subcategoria = $this->subcategoria->findOrFail($id);
        $categorias = Categoria::all();

        $data = ['subcategoria' => $subcategoria, 'categorias' => $categorias, 'title' => $this->title, 'subtitle' => 'Editar subcategoria'];

        return view('admin.subcategorias.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoriaFormRequest $request, $id)
    {
        $dataForm = $request->all();

        $subcategoria = $this->subcategoria->findOrFail($id);

        $updated = $subcategoria->update($dataForm);

        if(!$updated) return redirect('admin/subcategorias')->with('fail', 'Houve um problema ao editar a subcategoria');

        return redirect('admin/subcategorias')->with('success', 'Subcategoria editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->subcategoria->destroy($id);

        if(!$deleted) return redirect('admin/subcategorias')->with('fail', 'Houve um problema ao excluir a subcategoria');

        return redirect('admin/subcategorias')->with('success', 'Subcategoria excluída com sucesso');
    }
}
