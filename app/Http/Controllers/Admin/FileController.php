<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileFormRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\Categoria;
use App\Models\Catorganizacao;
use App\Models\File;
use App\Models\Month;
use App\Models\Organizacao;
use App\Models\Tag;
use App\Models\Year;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    protected $file;
    protected $title;

    public function __construct(File $file)
    {
        $this->file = $file;
        $this->title = 'Arquivos';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = $this->file->orderBy('id', 'desc')->paginate(10);

        $data = ['files' => $files, 'title' => $this->title];

        return view('admin.files.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $tags = Tag::all();
        $months = Month::all();
        $years = Year::all();

        $data = [
            'categorias' => $categorias,
            'years' => $years,
            'months' => $months,
            'tags' => $tags,
            'title' => $this->title,
            'subtitle' => 'Adicionar arquivo'
        ];

        return view('admin.files.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileFormRequest $request)
    {
        $dataForm = $request->except(['tags']);
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);
        $tags = $request->only(['tags']);

        if(valid_file($request))
        {
            $upload = upload_file($request, 'files');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }

        $file = $this->file->create($dataForm);
        $file->users()->attach(Auth::user());

        foreach($tags['tags'] as $value)
        {
            $tag = Tag::find($value);
            $file->tags()->attach($tag);
        }

        if(!$file) return redirect('/admin/files')->with('fail', 'Falha ao criar o Arquivo!');

        return redirect('/admin/files')->with('success', 'Arquivo inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::findOrFail($id);

        $archive = public_path()."/storage/files/".$file->file;

        //Log::create(['register_id' => $id, 'user_id' => Auth::id(), 'user_ip' => \Illuminate\Support\Facades\Request::ip(), 'method' => 'GET', 'url' => '/admin/folder/download/'.$id]);

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($archive, $file->title.'.pdf', $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = $this->file->with(['tags'])->find($id);
        $categorias = Categoria::all();
        $tags = Tag::all();
        $months = Month::all();
        $years = Year::all();

        $data = [
            'file' => $file,
            'categorias' => $categorias,
            'years' => $years,
            'months' => $months,
            'tags' => $tags,
            'title' => $this->title,
            'subtitle' => 'Editar arquivo'
        ];

        return view('admin.files.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FileUpdateRequest $request, $id)
    {
        $file = $this->file->findOrFail($id);
        $file->tags()->detach();

        $dataForm = $request->except(['tags']);
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);
        $tags = $request->only(['tags']);

        if(valid_file($request))
        {
            $upload = upload_file($request, 'files');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }

        $updated = $file->update($dataForm);

        foreach($tags['tags'] as $value)
        {
            $tag = Tag::find($value);
            $file->tags()->attach($tag);
        }

        if(!$updated) return redirect('/admin/files')->with('fail', 'Falha ao editar o Arquivo!');

        return redirect('/admin/files')->with('success', 'Arquivo editado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = $this->file->findOrFail($id);
        $file->tags()->detach();
        $deleted = $file->destroy($id);

        if(!$deleted) return redirect('admin/files')->with('fail', 'Houve um problema ao excluir o arquivo');

        return redirect('admin/files')->with('success', 'Arquivo excluído com sucesso');
    }

    public function share($id)
    {
        $file = $this->file->find($id);

        if(count(Auth::user()->organizations) > 0)
        {
            if($file->users->contains(Auth::id())) {
                $where = [];

                array_push($where, ['organizacaos.id', '=',  Auth::user()->organizations[0]->id]);

                $users = User::whereHas('organizations', function ($q) use ($where) {
                    $q->where($where);
                })->orderBy('id', 'desc')->get();
            } else {
                abort(404);
            }
        } else {
            $users = User::all();
        }

        $data = ['title' => $file->title, 'users' => $users, 'file' => $file];

        return view('admin.files.share')->with($data);
    }

    public function storeshare(Request $request)
    {
        $dataForm = $request->all();
        $file = $this->file->findOrFail($dataForm['file_id']);

        $file->users()->detach();

        foreach ($dataForm['users'] as $user) {
            $user = User::find($user);
            $file->users()->attach($user);
        }

        return redirect('admin/files')->with('success', 'Arquivo excluído com sucesso');
    }
}
