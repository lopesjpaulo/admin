<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hosting;
use App\Models\Client;
use App\Models\Host;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailUser;
use App\Mail\SendMailHosting;

class HostingsController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostings = Hosting::orderBy('id', 'desc')->get();

        return view('admin.hostings.index', compact('hostings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $hosts = Host::all();

        return view('admin.hostings.form', compact('clients', 'hosts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'signed_at' => 'required',
            'password'  => 'required|confirmed'
        ]);

        $hosting = $request->only(['client_id', 'signed_at', 'expired_at', 'host_id', 'amount', 'type', 'login', 'password']);

        $hosting['amount'] = str_replace(',', '.', $request->amount);

        $hosting_id = Hosting::create($hosting);

        return redirect('/admin/hostings')->with('success', 'Hospedagem criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hosting = Hosting::with(['client', 'host'])->findOrFail($id);

        return view('admin.hostings.show', compact('hosting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hosting = Hosting::findOrFail($id);

        $clients = Client::all();
        $hosts = Host::all();

        return view('admin.hostings.form', compact('hosting', 'clients', 'hosts'));
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
        $this->validate($request, [
            'signed_at' => 'required'
        ]);

        $hosting = $request->only(['client_id', 'signed_at', 'expired_at', 'host_id', 'amount', 'type', 'login', 'password']);

        $hosting['amount'] = str_replace(',', '.', $request->amount);

        if($hosting['password'] == ''){
            unset($hosting['password']);
        }

        $hosting_id = Hosting::find($id);

        $hosting_id->update($hosting);

        return redirect('/admin/hostings')->with('success', 'Hospedagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hosting = Hosting::find($id)->delete();

        return redirect('/admin/hostings')->with('success', 'Hospedagem deletada com sucesso');
    }

    /**
     * Envia um e-mail de alerta de hospedagem para um e-mail cadastrado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mail($id)
    {
        $hosting = Hosting::with(['client'])->find($id);

        Mail::to($hosting->client->contact_email)->send(new SendMailHosting($hosting));

        return redirect('/admin/hostings')->with('success', 'Hospedagem deletada com sucesso');
    }
}
