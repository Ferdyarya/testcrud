<?php

namespace App\Http\Controllers;

use App\Models\Masterbatu;
use App\Models\Mastercustomer;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Masterpegawai;
use App\Models\Pembelianbatu;
use Illuminate\Support\Facades\DB;

class PembelianbatuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $pembelianbatu = Pembelianbatu::join('masterpegawais', 'masterpegawais.id', '=', 'pembelianbatus.id_pegawai')
                ->where('masterpegawais.nama', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $pembelianbatu = Pembelianbatu::with('masterpegawai')->paginate(10);
        }
        return view('pembelianbatu.index', ['pembelianbatu' => $pembelianbatu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $masterpegawai = Masterpegawai::all();
       $masterbatu = Masterbatu::all();
       $mastercustomer = Mastercustomer::all();

        return view('pembelianbatu.create', [
            'masterpegawai' => $masterpegawai,
            'masterbatu' => $masterbatu,
            'mastercustomer' => $mastercustomer,
        ]);
        return view('pembelianbatu.create')->with('success', 'Data Telah ditambahkan');
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

        $data = Pembelianbatu::create($request->all());

        return redirect()->route('pembelianbatu.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Pembelianbatu::find($id);
        // // dd($data);
        // return view('Pembelianbatu.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelianbatu $pembelianbatu)
    {
        $masterpegawai = Masterpegawai::all();
        $masterbatu = Masterbatu::all();
        $mastercustomer = Mastercustomer::all();

        return view('pembelianbatu.edit', [
            'item' => $pembelianbatu,
            'masterpegawai' => $masterpegawai,
            'masterbatu' => $masterbatu,
            'mastercustomer' => $mastercustomer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelianbatu $pembelianbatu)
    {
        $data = $request->all();

        $pembelianbatu->update($data);

        return redirect()->route('pembelianbatu.index')->with('success', 'Data Telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelianbatu $pembelianbatu)
    {
        $pembelianbatu->delete();
        return redirect()->route('pembelianbatu.index')->with('success', 'Data Telah dihapus');
    }

    // public function Pembelianbatupdf() {
    //     $data = Pembelianbatu::all();

    //     $pdf = PDF::loadview('Pembelianbatu/Pembelianbatupdf', ['Pembelianbatu' => $data]);
    //     return $pdf->download('laporan_Pembelianbatu.pdf');
    // }

    // public function Pernamapdf() {
    //     $data = Pembelianbatu::all();

    //     $pdf = PDF::loadview('laporan/pernamapdf', ['Pembelianbatu' => $data]);
    //     return $pdf->download('laporan_pernama.pdf');
    // }

    public function validasi(Request $request, $id)
    {
        $pembelianbatu = Pembelianbatu::find($id);
        // $email= $Pembelianbatu->customermaster->email;
        if ($request->has('validasi')) {
            $pembelianbatu->update([
                'status' => $request->validasi
            ]);

        }
        return redirect()->route('pembelianbatu.index')->with('success', 'Data Telah diupdate');
    }


    public function pernama(Request $request)
    {
        $f = $request->filter ?? null;

        // $data['title'] = "Laporan Penjualan Persales";

        if ($f == '' || $f == 'all') {
            $pembelianbatu['pembelianbatu'] = Pembelianbatu::paginate(10);
        } else {
            $pembelianbatu['pembelianbatu'] = Pembelianbatu::where('id_pegawai', $f)->paginate(10);
        }

        $pembelianbatu['id_pegawai'] = Pembelianbatu::groupBy('id_pegawai')
            ->orderBy('id_pegawai')
            ->select(DB::raw('count(*) as count, id_pegawai'))
            ->get();

         $pembelianbatu['filter'] = $f;

        return view('laporan.pernama', $pembelianbatu);
    }

    public function pernama_pdf($filter)
    {
        $f = $filter ?? null;

        if ($f == '' || $f == 'all') {
            $pembelianbatu['pembelianbatu'] = Pembelianbatu::all();
        } else {
            $pembelianbatu['pembelianbatu'] = Pembelianbatu::where('id_pegawai', $f)->get();
        }

        $pembelianbatu['id_pegawai'] = Pembelianbatu::groupBy('id_pegawai')
            ->orderBy('id_pegawai')
            ->select(DB::raw('count(*) as count, id_pegawai'))
            ->get();

        $pembelianbatu['filter'] = $f;


        // $pdf = PDF::loadview('laporan/pernamapdf', $Pembelianbatu );
        $pdf = PDF::loadview('laporan/pernamapdf', ['pembelianbatu' => $pembelianbatu]);
        return $pdf->download('laporan_penjualbatu.pdf');
    }


    public function cetakpegawaipertanggal()
    {
        $pembelianbatu = Pembelianbatu::Paginate(10);

        return view('laporan.laporanbatu', ['laporanbatu' => $pembelianbatu]);
    }

    public function filterdate(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanbatu = Pembelianbatu::paginate(10);
        } else {
            $laporanbatu = Pembelianbatu::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporan.laporanbatu', compact('laporanbatu'));
    }


    public function laporanbatupdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanbatu = Pembelianbatu::all();
        } else {
            $laporanbatu = Pembelianbatu::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }



        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporan.laporanbatupdf', compact('laporanbatu'));
        return $pdf->download('laporan_laporanbatu.pdf');
    }






}
