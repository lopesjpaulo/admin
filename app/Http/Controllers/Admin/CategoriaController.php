<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaFormRequest;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $categoria;
    protected $title;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->title = 'Categorias';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->categoria->orderBy('id', 'desc')->paginate(10);

        $data = ['categorias' => $categorias, 'title' => $this->title];

        return view('admin.categorias.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar categoria'];

        return view('admin.categorias.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaFormRequest $request)
    {
        $dataForm = $request->all();

        $created = $this->categoria->create($dataForm);

        if(!$created) return redirect('admin/categorias')->with('fail', 'Houve um problema ao cadastrar a categoria!');

        return redirect('admin/categorias')->with('success', 'Categoria cadastrada com sucesso!');
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
        $categoria = $this->categoria->findOrFail($id);

        $data = ['categoria' => $categoria, 'title' => $this->title, 'subtitle' => 'Editar categoria'];

        return view('admin.categorias.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $categoria = $this->categoria->findOrFail($id);

        $updated = $categoria->update($dataForm);

        if(!$updated) return redirect('admim/categorias')->with('fail', 'Houve um problema ao editar a categoria!');

        return redirect('admin/categorias')->with('success', 'Categoria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->categoria->destroy($id);

        if(!$deleted) return redirect('admin/categorias')->with('fail', 'Houve um problema ao excluir a categoria!');

        return redirect('admin/categorias')->with('success', 'Categoria excluída com sucesso!');
    }

    public function findSubcategoria(Request $request)
    {
        $dataForm = $request->all();

        $subcategoria = Subcategoria::where('categoria_id', $dataForm['categoria'])->orderBy('title', 'desc')->get();

        return response()->json($subcategoria);
    }
}
