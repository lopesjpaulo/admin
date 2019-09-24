<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VitrineFormRequest;
use App\Models\Vitrine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VitrineController extends Controller
{
    protected $vitrine;
    protected $title;

    public function __construct(Vitrine $vitrine)
    {
        $this->vitrine = $vitrine;
        $this->title = 'Vitrines';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = $this->vitrine->orderBy('id', 'desc')->paginate(20);
        $data = ['lista' => $lista, 'title' => $this->title];

        return view('admin.vitrines.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar vitrine'];
        return view('admin.vitrines.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VitrineFormRequest $request)
    {
        $dataForm = $request->all();

        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);

        if(valid_file($request))
        {
            $upload = upload($request, 'vitrines');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $vitrine = $this->vitrine->create($dataForm);

        if($vitrine){
            return redirect('/admin/vitrines')->with('success', 'Usuário criado com sucesso!');
        }else {
            return redirect('/admin/vitrines')->with('fail', 'Falha ao criar a notícia!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vitrine  $vitrine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vitrine  $vitrine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vitrine = $this->vitrine->find($id);

        $data = ['vitrine' => $vitrine, 'title' => $this->title, 'subtitle' => 'Editar vitrine'];

        return view('admin.vitrines.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vitrine  $vitrine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vitrine  $vitrine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
