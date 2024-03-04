<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\Masterpegawai;

use App\Models\Masterbarang;
use App\Models\Masterbatu;
use App\Models\Mastercustomer;
use App\Models\User;
use App\Models\Mastertoko;
use App\Models\Masterpegawai;
use App\Models\Mastersupplier;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('masterpegawais')->insert([
        //     'kode' => '1111',
        //     'nama' => 'Hendra',
        //     'no_telp' => '081999234478',
        // ]);

        // User Data
        User::create([
            'name' => 'Hyuga',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('1'),
            'roles' => 'manager_oprasional'
        ]);

        User::create([
            'name' => 'Rika',
            'email' => 'rika@gmail.com',
            'password' => bcrypt('2'),
            'roles' => 'admin_finance'
        ]);
        User::create([
            'name' => 'Riko',
            'email' => 'Riko@gmail.com',
            'password' => bcrypt('3'),
            'roles' => 'admin_timbang'
        ]);


        //MasterData
        Masterpegawai::create([
            'posisi' => 'Manager',
            'nama' => 'Hyuga',
            'no_telp' => '082555223'
        ]);
        Masterpegawai::create([
            'posisi' => 'admin finance',
            'nama' => 'Rika',
            'no_telp' => '082555224'
        ]);
        Masterpegawai::create([
            'posisi' => 'admin timbang',
            'nama' => 'Riko',
            'no_telp' => '082555225'
        ]);

        Masterbatu::create([
            'jenisbatu' => 'Batu Abu',
            'hargabatu' => '160000'
        ]);
        Masterbatu::create([
            'jenisbatu' => 'Batu 1/2',
            'hargabatu' => '200000'
        ]);
        Masterbatu::create([
            'jenisbatu' => 'Batu 1/3',
            'hargabatu' => '200000'
        ]);
        Masterbatu::create([
            'jenisbatu' => 'Batu 2/3',
            'hargabatu' => '200000'
        ]);
        Masterbatu::create([
            'jenisbatu' => 'Batu 3/5',
            'hargabatu' => '200000'
        ]);

        Mastersupplier::create([
            'namapt' => 'PT GUNUNG MULIA',
            'alamat' => 'asam-asam',
            'email' => 'ptgm@gmail.com',
            'no_telp' => '082200000'
        ]);
        Mastersupplier::create([
            'namapt' => 'PT SRG',
            'alamat' => 'asam-asam',
            'email' => 'ptsrg@gmail.com',
            'no_telp' => '082200000'
        ]);
        Mastersupplier::create([
            'namapt' => 'PT AGB',
            'alamat' => 'asam-asam',
            'email' => 'ptagb@gmail.com',
            'no_telp' => '082200000'
        ]);
        Mastersupplier::create([
            'namapt' => 'PT LINTAS DUNIA',
            'alamat' => 'asam-asam',
            'email' => 'ptld@gmail.com',
            'no_telp' => '082200000'
        ]);
        Mastersupplier::create([
            'namapt' => 'PT RAJAWALI',
            'alamat' => 'asam-asam',
            'email' => 'ptrajawali@gmail.com',
            'no_telp' => '082200000'
        ]);

        Mastercustomer::create([
            'namacust' => 'PT PSG',
            'alamat' => 'Muara Teweh',
            'no_telp' => '08122312',
            'email' => 'pt[sg@gmail.com'
        ]);


    }
}
