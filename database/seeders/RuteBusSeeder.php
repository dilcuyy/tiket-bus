<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RuteBus;

class RuteBusSeeder extends Seeder
{
    public function run(): void
    {
        $kota = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        $merkBusList = ['PO Haryanto', 'Sinar Jaya', 'Rosalia Indah', 'Primajasa', 'Gunung Harta', 'ALS', 'Lorena', 'Kramat Djati'];
        $tipeBusList = ['Eksekutif', 'Bisnis', 'Sleeper', 'VIP', 'Super Eksekutif'];
        $hariRange = 60;
        $entriPerRutePerHari = 5;

        for ($hari = 0; $hari < $hariRange; $hari++) {
            $tanggal = now()->addDays($hari)->format('Y-m-d');

            foreach ($kota as $asal) {
                foreach ($kota as $tujuan) {
                    if ($asal !== $tujuan) {
                        for ($i = 0; $i < $entriPerRutePerHari; $i++) {
                            RuteBus::create([
                                'asal' => $asal,
                                'tujuan' => $tujuan,
                                'tanggal_berangkat' => $tanggal,
                                'merk_bus' => $merkBusList[array_rand($merkBusList)],
                                'tipe_bus' => $tipeBusList[array_rand($tipeBusList)],
                                'harga' => rand(25000, 120000),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
