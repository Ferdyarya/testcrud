<?php

namespace App\Http\Controllers;

use App\Models\Masterbatu;
use Illuminate\Http\Request;

class MasterbatuController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masterbatu = Masterbatu::where('jenisbatu', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masterbatu = Masterbatu::paginate(10);
        }
        return view('masterbatu.index',[
            'masterbatu' => $masterbatu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterbatu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Masterbatu::create($data);

        return redirect()->route('masterbatu.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Masterbarang::find($id);
        // // dd($data);
        // return view('Masterbarang.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Masterbatu $masterbatu)
    {
        return view('masterbatu.edit', [
            'item' => $masterbatu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masterbatu $masterbatu)
    {
        $data = $request->all();

        $masterbatu->update($data);

        return redirect()->route('masterbatu.index')->with('success', 'Data Telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masterbatu $masterbatu)
    {
        $masterbatu->delete();
        return redirect()->route('masterbatu.index')->with('success', 'Data Telah dihapus');
    }
}
