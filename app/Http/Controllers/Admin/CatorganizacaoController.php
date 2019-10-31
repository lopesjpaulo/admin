<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catorganizacao;
use App\Models\Organizacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatorganizacaoController extends Controller
{
    protected $catorganizacao;
    protected $title;

    public function __construct(Catorganizacao $catorganizacao)
    {
        $this->catorganizacao = $catorganizacao;
        $this->title = 'Categoria de organização';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catorganizacoes = $this->catorganizacao->orderBy('id', 'desc')->paginate(10);
        $data = ['catorganizacoes' => $catorganizacoes, 'title' => $this->title];

        return view('admin.catorganizacoes.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizacoes = Organizacao::all();
        $data = ['organizacoes' => $organizacoes, 'title' => $this->title, 'subtitle' => 'Adicionar categoria de organização'];

        return view('admin.catorganizacoes.form')->with($data);
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
        $catorganizacao = $this->catorganizacao->create($dataForm);

        if(!$catorganizacao) return redirect('admin/catorganizacoes')->with('fail', 'Houve um problema ao cadastrar a categoria!');

        return redirect('admin/catorganizacoes')->with('success', 'Categoria cadastrada com sucesso!');
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
        $catorganizacao = $this->catorganizacao->findOrFail($id);
        $organizacoes = Organizacao::all();
        $data = ['catorganizacao' => $catorganizacao, 'organizacoes' => $organizacoes, 'title' => $this->title, 'subtitle' => 'Editar categoria'];

        return view('admin.catorganizacoes.form')->with($data);
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
        $dataForm = $request->all();
        $catorganizacao = $this->catorganizacao->findOrFail($id);
        $updated = $catorganizacao->update($dataForm);

        if(!$updated) return redirect('admin/catorganizacoes')->with('fail', 'Houve um problema ao editar a categoria!');

        return redirect('admin/catorganizacoes')->with('success', 'Categoria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->catorganizacao->destroy($id);

        if(!$deleted) return redirect('admin/catorganizacoes')->with('fail', 'Houve um problema ao deletar a categoria!');

        return redirect('admin/catorganizacoes')->with('success', 'Categoria deletada com sucesso!');
    }
}
