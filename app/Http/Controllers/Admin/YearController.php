<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YearController extends Controller
{
    protected $year;
    protected $title;

    public function __construct(Year $year)
    {
        $this->year = $year;
        $this->title = 'Anos';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = $this->year->orderBy('id', 'desc')->paginate(10);
        $data = ['years' => $years, 'title' => $this->title];

        return view('admin.years.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar ano'];

        return view('admin.years.form')->with($data);
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

        $created = $this->year->create($dataForm);

        if(!$created) return redirect('admin/years')->with('fail', 'Houve um problema ao cadastrar o ano!');

        return redirect('admin/years')->with('success', 'Ano cadastrado com sucesso!');
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
        $year = $this->year->findOrFail($id);
        $data = ['year' => $year, 'title' => $this->title, 'subtitle' => 'Editar ano'];

        return view('admin.years.form')->with($data);
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
        $year = $this->year->findOrFail($id);
        $dataForm = $request->all();

        $updated = $year->update($dataForm);

        if(!$updated) return redirect('admin/years')->with('fail', 'Houve um problema ao editar o ano!');

        return redirect('admin/years')->with('success', 'Ano editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->year->destroy($id);

        if(!$deleted) return redirect('admin/years')->with('fail', 'Houve um problema ao excluir o ano!');

        return redirect('admin/years')->with('success', 'Ano excluido com sucesso!');
    }
}
