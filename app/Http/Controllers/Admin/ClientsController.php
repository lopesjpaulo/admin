<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Attendance;
use App\User;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $clients = Client::with(['attendance'])->orderBy('id', 'desc')->get();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attendances = Attendance::all();

        return view('admin.clients.form', compact('attendances'));
;    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->type);
        $this->validate($request, [
            'title' => 'required'
        ]);

        $client = $request->all();

        $client['type'] = implode(',', $request->type);

        $client_id = Client::create($client);
        
        return redirect('/admin/clients')->with('success', 'Cliente criado com sucesso!');
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
        $client = Client::findOrFail($id);

        $attendances = Attendance::all();

        return view('admin.clients.form', compact('client', 'attendances'));
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
        $client = $request->all();

        $client['type'] = implode(',', $request->type);

        $client_id = Client::find($id);

        $client_id->update($client);

        return redirect('/admin/clients')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Client::destroy($id);
        $client = Client::find($id)->delete();

        return redirect('/admin/clients')->with('success', 'Cliente deletado com sucesso');
    }
}
