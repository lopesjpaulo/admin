<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Models\File;
use App\Models\Log;
use App\Models\Month;
use App\Models\Subcategoria;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FolderController extends Controller
{

    /*public function index()
    {
        $title = 'Anos';
        $class = 'years-folder';

        $folders = Year::all();

        return view('admin.folder.index', compact('title', 'folders', 'class'));
    }

    public function showMonths()
    {
        $title = 'Meses';
        $class = 'months-folders';

        $folders = Month::all();

        return view('admin.folder.index', compact('title', 'folders', 'class'));
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Categorias';
        $class = 'categoria-folder';

        $folders = Categoria::all();

        return view('admin.folder.index', compact('title', 'folders', 'class'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSubcategorias($id)
    {
        $title = 'Subcategorias';
        $class = 'subcategoria-folder';

        $folders = Subcategoria::where('categoria_id', $id)->get();

        return view('admin.folder.index', compact('title', 'folders', 'class'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFiles($id)
    {
        $title = 'Arquivos';

        if(count(Auth::user()->organizations) > 0){
            $where = [
                ['subcategoria_id', $id],
                ['organizacao_id', Auth::user()->organizations[0]->id],
                ['users.id', '=',  Auth::id()]
            ];

            $files = File::whereHas('users', function ($q) use ($where) {
                $q->where($where);
            })->orderBy('id', 'desc')->get();

            /*$files= File::where('subcategoria_id', $id)
                ->where('organizacao_id', Auth::user()->organizations[0]->id)
                ->get();*/
        } else {
            $files= File::where('subcategoria_id', $id)
                ->get();
        }

        return view('admin.folder.index', compact('title', 'files'));
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

        $archive = public_path()."/storage/files/".$file->file;

        Log::create(['register_id' => $id, 'user_id' => Auth::id(), 'user_ip' => \Illuminate\Support\Facades\Request::ip(), 'method' => 'GET', 'url' => '/admin/folder/download/'.$id]);

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->file($archive, $file->file, $headers);
    }
}
