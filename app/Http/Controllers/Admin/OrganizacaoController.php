<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catorganizacao;
use App\Models\Organizacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizacaoController extends Controller
{
    protected $organizacao;
    protected $title;

    public function __construct(Organizacao $organizacao)
    {
        $this->organizacao = $organizacao;
        $this->title = 'Organizações';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizacoes = $this->organizacao->orderBy('id', 'desc')->paginate(10);

        $data = ['organizacoes' => $organizacoes, 'title' => $this->title];

        return view('admin.organizacoes.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar organização'];

        return view('admin.organizacoes.form')->with($data);
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

        $organizacao = $this->organizacao->create($dataForm);

        if(!$organizacao) return redirect('admin/organizacoes')->with('fail', 'Houve um problema ao cadastrar a organizacao!');

        return redirect('admin/organizacoes')->with('success', 'Organização cadastrada com sucesso!');
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
        $organizacao = $this->organizacao->findOrFail($id);

        $data = ['organizacao' => $organizacao, 'title' => $this->title, 'subtitle' => 'Editar organização'];

        return view('admin.organizacoes.form')->with($data);
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
        $organizacao = $this->organizacao->findOrFail($id);
        $updated = $organizacao->update($dataForm);

        if(!$organizacao) return redirect('admin/organizacoes')->with('fail', 'Houve um problema ao editar a organizacao!');

        return redirect('admin/organizacoes')->with('success', 'Organização editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->organizacao->destroy($id);

        if(!$deleted) return redirect('admin/organizacoes')->with('fail', 'Houve um problema ao excluir a organizacao!');

        return redirect('admin/organizacoes')->with('success', 'Organização excluída com sucesso!');
    }

    public function findCatorganizacao(Request $request)
    {
        $dataForm = $request->all();

        $catorganizacao = Catorganizacao::where('organizacao_id', $dataForm['organizacao'])->orderBy('title', 'desc')->get();

        return response()->json($catorganizacao);
    }
}
