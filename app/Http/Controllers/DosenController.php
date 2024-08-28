<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $dosen = Dosen::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $dosen = Dosen::paginate(10);
        }
        return view('dosen.index',[
            'dosen' => $dosen
        ]);
    }


    public function create()
    {
        return view('dosen.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Dosen::create($data);

        return redirect()->route('dosen.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', [
            'item' => $dosen
        ]);
    }


    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->all();

        $dosen->update($data);

        //dd($data);

        return redirect()->route('dosen.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data Telah dihapus');
    }
}
