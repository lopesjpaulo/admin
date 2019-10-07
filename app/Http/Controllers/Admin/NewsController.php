<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsFormRequest;
use App\Models\News;
use App\User;
use Illuminate\Support\Facades\App;

class NewsController extends Controller
{
    protected $news;
    protected $title;
    protected $module;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(News $news)
    {
        $this->news = $news;
        $this->title = "Notícias";
        $this->module = "news";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = $this->news->orderBy('id', 'desc')->paginate(10);
        $data = ['lista' => $news, 'title' => $this->title, 'module' => $this->module];

        return view('admin.news.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Criar notícia'];
        return view('admin.news.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsFormRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);

        if(valid_file($request))
        {
            $upload = upload($request, 'news');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $create = $this->news->create($dataForm);

        if(!$create) return redirect('/admin/news')->with('fail', 'Houve um problema ao criar a notícia!');

        return redirect('/admin/news')->with('success', 'Notícia criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = $this->news->find($id);

        return view('adimn.news.form', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = $this->news->find($id);
        $data = ['lista' => $news, 'title' => $this->title, 'subtitle' => 'Editar notícia'];

        return view('admin.news.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsFormRequest $request, $id)
    {
        $news = $this->news->find($id);

        $dataForm = $request->all();
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);

        if(valid_file($request))
        {
            $upload = upload($request, 'news');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $update = $news->update($dataForm);

        if(!$update) return redirect('admin/news')->with('fail', 'Houve um erro ao atualizar a notícia!');

        return redirect('/admin/news')->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->news->destroy($id);

        if(!$destroy) return redirect('admin/news')->with('fail', 'Houve um erro ao excluir a notícia!');

        return redirect('/admin/news')->with('success', 'Notícia excluída com sucesso!');
    }
}
