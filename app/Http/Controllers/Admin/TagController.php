<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tag;
    protected $title;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
        $this->title = "Tags";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->orderBy('id', 'desc')->paginate(10);

        $data = ['tags' => $tags, 'title' => $this->title];

        return view('admin.tags.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar Tag'];

        return view('admin.tags.form')->with($data);
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

        $tag = $this->tag->create($dataForm);

        if(!$tag) return redirect('admin/tags')->with('fail', 'Houve um problema ao cadastrar Tag');

        return redirect('admin/tags')->with('success', 'Tag cadastrada com sucesso');
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
        $tag = $this->tag->findOrFail($id);

        $data = ['tag' => $tag, 'title' => $this->title, 'subtitle' => 'Editar tag'];

        return view('admin.tags.form')->with($data);
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
        $tag = $this->tag->findOrFail($id);

        $updated = $tag->update($dataForm);

        if(!$updated) return redirect('admin/tags')->with('fail', 'Houve um problema ao editar Tag');

        return redirect('admin/tags')->with('success', 'Tag editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->tag->destroy($id);

        if(!$deleted) return redirect('admin/tags')->with('fail', 'Houve um problema ao excluir a Tag');

        return redirect('admin/tags')->with('success', 'Tag excluida com sucesso');
    }
}
