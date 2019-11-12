<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GalleryFormRequest;
use App\Http\Requests\GalleryUpdateRequest;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    protected $gallery;
    protected $title;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->title = "Galerias";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galerias = $this->gallery->orderBy('id', 'desc')->paginate(10);

        $data = ['galerias' => $galerias, 'title' => $this->title];

        return view('admin.galleries.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar fotos'];

        return view('admin.galleries.new')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryFormRequest $request)
    {
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload_file($request, 'photos');

            if($upload){
                $dataForm['cover_image'] = $upload;
                unset($dataForm['file']);
            }
        }

        $gallery = $this->gallery->create($dataForm);

        if(!$gallery) return redirect('/admin/gallery')->with('fail', 'Falha ao criar a Galeria!');

        return redirect('/admin/gallery')->with('success', 'Galeria criada com sucesso!');

        /*return response()->json([
            'status' => 'ok',
            'path' => 'teste'
        ]);*/
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
        $gallery = $this->gallery->findOrFail($id);

        $data = ['gallery' => $gallery, 'title' => $this->title, 'subtitle' => 'Editar galeria'];

        return view('admin.galleries.new')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, $id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $dataForm = $request->all();
        if(valid_file($request))
        {
            $upload = upload_file($request, 'photos');

            if($upload){
                $dataForm['cover_image'] = $upload;
                unset($dataForm['file']);
            }
        }

        $updated = $gallery->update($dataForm);

        if(!$updated) return redirect('/admin/gallery')->with('fail', 'Falha ao editar a Galeria!');

        return redirect('/admin/gallery')->with('success', 'Galeria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->gallery->destroy($id);

        if(!$deleted) return redirect('/admin/gallery')->with('fail', 'Falha ao excluir a Galeria!');

        return redirect('/admin/gallery')->with('success', 'Galeria excluida com sucesso!');
    }

    public function photos($id)
    {
        $photos = Photo::where(['gallery_id' => $id])->get();
        $data = ['photos' => $photos, 'title' => 'Fotos', 'subtitle' => 'Adicionar fotos'];

        return view('admin.galleries.form')->with($data);
    }

    public function storephotos(Request $request, $id)
    {
        $dataForm = [];

        if(valid_file($request))
        {
            $upload = upload_file($request, 'photos');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }

        if($dataForm['file']){
            $dataForm['gallery_id'] = $id;
            $photo = Photo::create($dataForm);
            return response()->json(['status' => 'ok', 'file' => $dataForm['file']]);
        } else {
            throw new RuntimeException('Failed to move uploaded file.');
        }
    }

    public function deletephotos($id)
    {
        $gallery_id = Photo::findOrFail($id)->gallery_id;
        $deleted = Photo::destroy($id);

        if(!$deleted) return redirect('/admin/gallery/'.$id.'/photos')->with('fail', 'Falha ao excluir a Foto!');

        return redirect('/admin/gallery/'.$gallery_id.'/photos')->with('success', 'Foto excluida com sucesso!');
    }
}
