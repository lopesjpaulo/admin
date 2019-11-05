<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    protected $video;
    protected $title;

    public function __construct(Video $video)
    {
        $this->video = $video;
        $this->title = "Vídeos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->video->orderBy('id', 'desc')->paginate(10);

        $data = ['videos' => $videos, 'title' => $this->title];

        return view('admin.videos.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar notícia'];

        return view('admin.videos.form')->with($data);
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
            $upload = upload_file($request, 'videos');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }

        $video = $this->video->create($dataForm)->id;

        if(!$video) return redirect('/admin/videos')->with('fail', 'Falha ao salvar o vídeo!');

        return redirect('/admin/videos')->with('success', 'Vídeo criado com sucesso!');
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
        $video = $this->video->findOrFail($id);

        $data = ['video' => $video, 'title' => $this->title, 'subtitle' => 'Editar notícias'];

        return view('admin.videos.form')->with($data);
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
        $video = $this->video->findOrFail($id);
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload_file($request, 'videos');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }

        $updated = $video->update($dataForm);

        if(!$updated) return redirect('/admin/videos')->with('fail', 'Falha ao editar o vídeo!');

        return redirect('/admin/videos')->with('success', 'Vídeo editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->video->destroy($id);

        if(!$deleted) return redirect('/admin/videos')->with('fail', 'Falha ao excluir o vídeo!');

        return redirect('/admin/videos')->with('success', 'Vídeo excluído com sucesso!');
    }
}
