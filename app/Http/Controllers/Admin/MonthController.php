<?php

namespace App\Http\Controllers\Admin;

use App\Models\Month;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonthController extends Controller
{
    protected $month;
    protected $title;

    public function __construct(Month $month)
    {
        $this->month = $month;
        $this->title = "Meses";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $months = $this->month->orderBy('id', 'desc')->paginate(10);
        $data = ['months' => $months, 'title' => $this->title];

        return view('admin.months.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar mês'];

        return view('admin.months.form')->with($data);
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

        $month = $this->month->create($dataForm);

        if(!$month) return redirect('admin/months')->with('fail', 'Houve um problema ao cadastrar o mês!');

        return redirect('admin/months')->with('success', 'Mês cadastrado com sucesso!');
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
        $month = $this->month->findOrFail($id);
        $data = ['month' => $month, 'title' => $this->title, 'subtitle' => 'Editar mês'];

        return view('admin.months.form')->with($data);
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
        $month = $this->month->findOrFail($id);
        $dataForm = $request->all();

        $updated = $month->update($dataForm);

        if(!$updated) return redirect('admin/months')->with('fail', 'Houve um problema ao editar o mês!');

        return redirect('admin/months')->with('success', 'Mês editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->month->destroy($id);

        if(!$deleted) return redirect('admin/months')->with('fail', 'Houve um problema ao excluir o mês!');

        return redirect('admin/months')->with('success', 'Mês excluido com sucesso!');
    }
}
