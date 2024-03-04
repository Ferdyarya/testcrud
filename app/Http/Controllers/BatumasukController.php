<?php

namespace App\Http\Controllers;

use App\Models\Batumasuk;
use App\Models\Brgmasuk;
use App\Models\Mastersupplier;
use Illuminate\Http\Request;
use PDF;

class BatumasukController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $batumasuk = Batumasuk::where('jenisbatu', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $batumasuk = Batumasuk::paginate(10);
        }
        return view('batumasuk.index',[
            'batumasuk' => $batumasuk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $mastersupplier = Mastersupplier::all();
        return view('batumasuk.create', [
            'mastersupplier' => $mastersupplier,
        ]);
        return view('batumasuk.create')->with('success', 'Data Telah ditambahkan');
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

        $data = Batumasuk::create($request->all());

        return redirect()->route('batumasuk.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Brgmasuk::find($id);
        // // dd($data);
        // return view('Brgmasuk.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Batumasuk $batumasuk)
    {
         $mastersupplier = Mastersupplier::all();

        return view('batumasuk.edit', [
            'item' => $batumasuk,
            'mastersupplier' => $mastersupplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batumasuk $batumasuk)
    {
        $data = $request->all();

        $batumasuk->update($data);

        return redirect()->route('batumasuk.index')->with('success', 'Data Telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batumasuk $batumasuk)
    {
        $batumasuk->delete();
        return redirect()->route('batumasuk.index')->with('success', 'Data Telah dihapus');
    }

    public function batumasukpdf() {
        $data = Batumasuk::all();

        $pdf = PDF::loadview('batumasuk/batumasukpdf', ['batumasuk' => $data]);
        return $pdf->download('laporan_Batu_masuk.pdf');
    }


    // Laporan Barang Filter
    public function cetakbatupertanggal()
    {
        $batumasuk = Batumasuk::Paginate(10);

        return view('laporan.laporanbatumasuk', ['laporanbatumasuk' => $batumasuk]);
    }

    public function filterdatebatu(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanbatumasuk = Batumasuk::paginate(10);
        } else {
            $laporanbatumasuk = Batumasuk::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporan.laporanbatumasuk', compact('laporanbatumasuk'));
    }


    public function laporanbatumasukpdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanbatumasuk = Batumasuk::all();
        } else {
            $laporanbatumasuk = Batumasuk::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporan.laporanbatumasukpdf', compact('laporanbatumasuk'));
        return $pdf->download('laporan_laporanbatumasukpdf.pdf');
    }
}
