<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MapFormRequest;
use App\Models\Map;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    protected $map;
    protected $title;

    public function __construct(Map $map)
    {
        $this->map = $map;
        $this->title = 'Mapa mental';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = $this->map->orderBy('id', 'desc')->paginate(10);
        $data = ['maps' => $maps, 'title' => $this->title];

        return view('admin.maps.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temas = Theme::all();
        $data = ['temas' => $temas, 'title' => $this->title, 'subtitle' => 'Criar mapa mental'];

        return view('admin.maps.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MapFormRequest $request)
    {
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'maps');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $this->map->create($dataForm);

        return redirect('/admin/maps')->with('success', 'Mapa mental criado com sucesso!');
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
        $map = $this->map->find($id);
        $temas = Theme::all();

        $data = ['map' => $map, 'temas' => $temas, 'title' => $this->title, 'subtitle' => 'Editar mapa mental'];

        return view('admin.maps.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MapFormRequest $request, $id)
    {
        $map = $this->map->find($id);
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload($request, 'maps');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $map->update($dataForm);

        return redirect('/admin/maps')->with('success', 'Mapa mental editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $map = $this->map->destroy($id);

        if($map){
            return redirect('/admin/maps')->with('success', 'Mapa mental excluído com sucesso!');
        } else {
            return redirect('/admin/maps')->with('fail', 'Houve um erro ao excluir o registro!');
        }
    }
}
