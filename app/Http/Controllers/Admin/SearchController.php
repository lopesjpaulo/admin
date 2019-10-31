<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Models\File;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Pesquisa por arquivo";
        $categorias = Categoria::all();
        $tags = Tag::all();
        return view('admin.search.index', compact('categorias', 'tags', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = 'Arquivos';
        $dataForm = $request->all();
        $where = [];

        if($dataForm['title']){
            array_push($where, ['files.title', 'like', '%'.$dataForm['title'].'%']);
        }

        if($dataForm['resumo']){
            array_push($where, ['files.resumo', 'like', '%'.$dataForm['resumo'].'%']);
        }

        if($dataForm['categoria_id']){
            array_push($where, ['files.categoria_id', '=', $dataForm['categoria_id']]);
        }

        if(($dataForm['subcategoria_id']) != 0){
            array_push($where, ['files.subcategoria_id', '=', $dataForm['subcategoria_id']]);
        }

        if(isset($dataForm['tags'])){
            array_push($where, ['tags.id', '=', $dataForm['tags']]);

            $files = $this->file->whereHas('tags', function ($q) use ($where) {
                $q->where($where);
            })->get();
        }else{
            $files = $this->file->where($where)->get();
        }

        return view('admin.folder.index', compact('files', 'title'));
    }
}
