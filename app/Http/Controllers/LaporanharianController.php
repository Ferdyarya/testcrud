<?php

namespace App\Http\Controllers;

use App\Models\Laporanharian;
use App\Models\Masterbatu;
use App\Models\Masterpegawai;
use Illuminate\Http\Request;
use PDF;

class LaporanharianController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $laporanharian = Laporanharian::where('jenibatu', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $laporanharian = Laporanharian::paginate(10);
        }
        return view('laporanharian.index',[
            'laporanharian' => $laporanharian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $masterbatu = Masterbatu::all();

        return view('laporanharian.create', [
            'masterbatu' => $masterbatu,
        ]);
        return view('laporanharian.create')->with('success', 'Data Telah ditambahkan');
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

        $data = Laporanharian::create($request->all());

        return redirect()->route('laporanharian.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Laporanharian::find($id);
        // // dd($data);
        // return view('Laporanharian.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporanharian $laporanharian)
    {
        $masterbatu = Masterbatu::all();
        return view('laporanharian.edit', [
            'item' => $laporanharian,
            'masterbatu' => $masterbatu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporanharian $laporanharian)
    {
        $data = $request->all();

        $laporanharian->update($data);

        return redirect()->route('laporanharian.index')->with('success', 'Data Telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporanharian $laporanharian)
    {
        $laporanharian->delete();
        return redirect()->route('laporanharian.index')->with('success', 'Data Telah dihapus');
    }

    public function Laporanharianpdf() {
        $data = Laporanharian::all();

        $pdf = PDF::loadview('laporanharian/laporanharianpdf', ['laporanharian' => $data]);
        return $pdf->download('laporan_laporanharian.pdf');
    }

    // Laporan Harian Filter
    public function cetakharianpertanggal()
    {
        $laporanharian = Laporanharian::Paginate(10);

        return view('laporan.laporanharianjual', ['laporanharian' => $laporanharian]);
    }

    public function filterdateharian(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanharianjual = Laporanharian::paginate(10);
        } else {
            $laporanharianjual = Laporanharian::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporan.laporanharianjual', compact('laporanharianjual'));
    }


    public function laporanharianjualpdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanharianjual = Laporanharian::all();
        } else {
            $laporanharianjual = Laporanharian::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporan.laporanharianjualpdf', compact('laporanharianjual'));
        return $pdf->download('laporan_laporanharianjual.pdf');
    }
}
