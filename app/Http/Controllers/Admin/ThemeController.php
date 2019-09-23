<?php

namespace App\Http\Controllers\Admin;

use App\Models\Discipline;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    protected $theme;
    protected $title;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
        $this->title = 'Temas';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temas = $this->theme->orderBy('id', 'desc')->paginate(10);
        $data = ['temas' => $temas, 'title' => $this->title];

        return view('admin.themes.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplinas = Discipline::all();
        return view('admin.themes.form')->with('title', $this->title)->with('subtitle', 'Adicionar tema')->with('disciplinas', $disciplinas);
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
            $upload = upload($request, 'temas');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $this->theme->create($dataForm);

        return redirect('/admin/themes')->with('success', 'Tema criado com sucesso!');
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
        $theme = $this->theme->find($id);
        $disciplinas = Discipline::all();

        return view('admin.themes.form')->with('title', $this->title)->with('theme', $theme)->with('subtitle', 'Editar tema')->with('disciplinas', $disciplinas);
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
        $tema = $this->theme->find($id);
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'temas');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $tema->update($dataForm);

        return redirect('/admin/themes')->with('success', 'Tema atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = $this->theme->destroy($id);

        if($theme){
            return redirect('/admin/themes')->with('success', 'Tema excluído com sucesso!');
        }else{
            return redirect('admin/themes')->with('fail', 'Houve um erro ao excluir o tema!');
        }
    }
}
