<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionFormRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected $permission;
    protected $title;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->title = 'Permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->orderBy('id', 'desc')->paginate(10);
        $data = ['permissions' => $permissions, 'title' => $this->title];

        return view('admin.permissions.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.form')->with('title', $this->title)->with('subtitle', 'Adicionar Permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionFormRequest $request)
    {
        $dataForm = $request->all();
        $permission = $this->permission->create($dataForm);

        if($permission){
            return redirect('/admin/permissions')->with('success', 'Permission criado com sucesso!');
        }else {
            return redirect('/admin/permissions')->with('fail', 'Falha ao criar o Permission!');
        }
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
        $permission = $this->permission->find($id);
        $data = ['permission' => $permission, 'title' => $this->title, 'subtitle' => 'Editar permissão'];

        return view('admin.permissions.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $permission = $this->permission->find($id);

        if($permission->update($dataForm)){
            return redirect('/admin/permissions')->with('success', 'Permissão alterado com sucesso!');
        }else{
            return redirect('/admin/permissions')->with('fail', 'Falha ao editar a permissão!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->find($id);
        $this->permission->destroy($id);
        $permission->users()->detach();

        if($permission){
            return redirect('/admin/roles')->with('success', 'Permissão excluída com sucesso!');
        }else {
            return redirect('/admin/roles')->with('fail', 'Falha ao excluir a permissão!');
        }
    }
}
