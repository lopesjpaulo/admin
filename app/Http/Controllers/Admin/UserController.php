<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $title;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->title = 'Usuários';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->orderBy('id', 'desc')->with(['roles'])->paginate(10);
        $data = ['users' => $users, 'title' => $this->title];

        return view('admin.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.form')->with('roles', $roles)->with('title', $this->title)->with('subtitle', 'Adicionar usuário');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['password'] = Hash::make($dataForm['password']);

        $user = $this->user->create($dataForm);

        $roles = Role::find($dataForm['roles']);
        $user->roles()->attach($roles);

        if($user && $role){
            return redirect('/admin/users')->with('success', 'Usuário criado com sucesso!');
        }else {
            return redirect('/admin/news')->with('fail', 'Falha ao criar a notícia!');
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
        $user = $this->user->with('roles')->find($id);
        $roles = Role::all('id', 'title');

        $formatedRoles = array();
        foreach ($roles as $role) {
            $formatedRoles[$role->id] = $role->title;
        }        
         
        $selectedRoles = array(); 
        foreach ($user->roles as $role) {
            $selectedRoles[] = $role->id;
        }

        $data = ['user' => $user, 'roles' => $formatedRoles, 'selectedRoles' => $selectedRoles, 'title' => $this->title, 'subtitle' => 'Editar usuário'];

        return view('admin.users.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $user = $this->user->find($id);

        if($dataForm['password'] == ''){
            unset($dataForm['password']);
        }

        $user->roles()->detach();

        if (isset($dataForm['roles']) && !is_null($dataForm['roles'])) {
            $role = Role::find($dataForm['roles']);
            $user->roles()->attach($role);
        }

        if($user->update($dataForm)){
            return redirect('/admin/users')->with('success', 'Usuário editado com sucesso!');
        }else{

            return redirect('/admin/users')->with('fail', 'Falha ao editar usuário!');
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
        $user = $this->user->find($id);
        $this->user->destroy($id);
        $user->roles()->detach();

        return redirect('/admin/users')->with('success', 'Usuário excluído com sucesso!');
    }
}
