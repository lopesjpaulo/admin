<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleFormRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $role;
    protected $title;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->title = 'Grupos';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->orderBy('id', 'desc')->paginate(10);
        $data = ['roles' => $roles, 'title' => $this->title];

        return view('admin.roles.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.form')->with('title', $this->title)->with('subtitle', 'Adicionar grupo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        $dataForm = $request->all();
        $role = $this->role->create($dataForm);

        if($role){
            return redirect('/admin/roles')->with('success', 'Grupo criado com sucesso!');
        }else {
            return redirect('/admin/roles')->with('fail', 'Falha ao criar o grupo!');
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
        $role = $this->role->find($id);
        $data = ['role' => $role, 'title' => $this->title, 'subtitle' => 'Editar grupo'];

        return view('admin.roles.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $role = $this->role->find($id);

        if($role->update($dataForm)){
            return redirect('/admin/roles')->with('success', 'Grupo alterado com sucesso!');
        }else{
            return redirect('/admin/roles')->with('fail', 'Falha ao editar o grupo!');
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
        $role = $this->role->find($id);
        $this->role->destroy($id);
        $role->users()->detach();

        if($role){
            return redirect('/admin/roles')->with('success', 'Grupo excluído com sucesso!');
        }else {
            return redirect('/admin/roles')->with('fail', 'Falha ao excluir o grupo!');
        }
    }
}
