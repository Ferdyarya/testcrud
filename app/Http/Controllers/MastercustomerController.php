<?php

namespace App\Http\Controllers;

use App\Models\Mastercustomer;
use Illuminate\Http\Request;

class MastercustomerController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $mastercustomer = Mastercustomer::where('namacust', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $mastercustomer = Mastercustomer::paginate(10);
        }
        return view('mastercustomer.index',[
            'mastercustomer' => $mastercustomer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mastercustomer.create');
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

        Mastercustomer::create($data);

        return redirect()->route('mastercustomer.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = mastertoko::find($id);
        // // dd($data);
        // return view('mastertoko.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mastercustomer $mastercustomer)
    {
        return view('mastercustomer.edit', [
            'item' => $mastercustomer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mastercustomer $mastercustomer)
    {
        $data = $request->all();

        $mastercustomer->update($data);

        //dd($data);

        return redirect()->route('mastercustomer.index')->with('success', 'Data Telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mastercustomer $mastercustomer)
    {
        $mastercustomer->delete();
        return redirect()->route('mastercustomer.index')->with('success', 'Data Telah dihapus');
    }
}
