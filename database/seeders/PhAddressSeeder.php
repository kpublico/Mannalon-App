<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhAddressSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding Philippine address data (PSGC Dec 2020)...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ph_barangays')->truncate();
        DB::table('ph_cities')->truncate();
        DB::table('ph_provinces')->truncate();
        DB::table('ph_regions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ---- Regions ----
        $regions = [
            ['code' => '010000000', 'name' => 'Region I (Ilocos Region)', 'region_id' => '01'],
            ['code' => '020000000', 'name' => 'Region II (Cagayan Valley)', 'region_id' => '02'],
            ['code' => '030000000', 'name' => 'Region III (Central Luzon)', 'region_id' => '03'],
            ['code' => '040000000', 'name' => 'Region IV-A (CALABARZON)', 'region_id' => '04'],
            ['code' => '170000000', 'name' => 'MIMAROPA Region', 'region_id' => '17'],
            ['code' => '050000000', 'name' => 'Region V (Bicol Region)', 'region_id' => '05'],
            ['code' => '060000000', 'name' => 'Region VI (Western Visayas)', 'region_id' => '06'],
            ['code' => '070000000', 'name' => 'Region VII (Central Visayas)', 'region_id' => '07'],
            ['code' => '080000000', 'name' => 'Region VIII (Eastern Visayas)', 'region_id' => '08'],
            ['code' => '090000000', 'name' => 'Region IX (Zamboanga Peninsula)', 'region_id' => '09'],
            ['code' => '100000000', 'name' => 'Region X (Northern Mindanao)', 'region_id' => '10'],
            ['code' => '110000000', 'name' => 'Region XI (Davao Region)', 'region_id' => '11'],
            ['code' => '120000000', 'name' => 'Region XII (SOCCSKSARGEN)', 'region_id' => '12'],
            ['code' => '130000000', 'name' => 'National Capital Region (NCR)', 'region_id' => '13'],
            ['code' => '140000000', 'name' => 'Cordillera Administrative Region (CAR)', 'region_id' => '14'],
            ['code' => '150000000', 'name' => 'Autonomous Region In Muslim Mindanao (ARMM)', 'region_id' => '15'],
            ['code' => '160000000', 'name' => 'Region XIII (Caraga)', 'region_id' => '16'],
        ];
        DB::table('ph_regions')->insert($regions);
        $this->command->info('Seeded ' . count($regions) . ' regions.');

        // ---- Provinces ----
        $provinces = [
            ['code' => '012800000', 'name' => 'Ilocos Norte', 'region_id' => '01', 'province_id' => '0128'],
            ['code' => '012900000', 'name' => 'Ilocos Sur', 'region_id' => '01', 'province_id' => '0129'],
            ['code' => '013300000', 'name' => 'La Union', 'region_id' => '01', 'province_id' => '0133'],
            ['code' => '015500000', 'name' => 'Pangasinan', 'region_id' => '01', 'province_id' => '0155'],
            ['code' => '020900000', 'name' => 'Batanes', 'region_id' => '02', 'province_id' => '0209'],
            ['code' => '021500000', 'name' => 'Cagayan', 'region_id' => '02', 'province_id' => '0215'],
            ['code' => '023100000', 'name' => 'Isabela', 'region_id' => '02', 'province_id' => '0231'],
            ['code' => '025000000', 'name' => 'Nueva Vizcaya', 'region_id' => '02', 'province_id' => '0250'],
            ['code' => '025700000', 'name' => 'Quirino', 'region_id' => '02', 'province_id' => '0257'],
            ['code' => '030800000', 'name' => 'Bataan', 'region_id' => '03', 'province_id' => '0308'],
            ['code' => '031400000', 'name' => 'Bulacan', 'region_id' => '03', 'province_id' => '0314'],
            ['code' => '034900000', 'name' => 'Nueva Ecija', 'region_id' => '03', 'province_id' => '0349'],
            ['code' => '035400000', 'name' => 'Pampanga', 'region_id' => '03', 'province_id' => '0354'],
            ['code' => '036900000', 'name' => 'Tarlac', 'region_id' => '03', 'province_id' => '0369'],
            ['code' => '037100000', 'name' => 'Zambales', 'region_id' => '03', 'province_id' => '0371'],
            ['code' => '037700000', 'name' => 'Aurora', 'region_id' => '03', 'province_id' => '0377'],
            ['code' => '041000000', 'name' => 'Batangas', 'region_id' => '04', 'province_id' => '0410'],
            ['code' => '042100000', 'name' => 'Cavite', 'region_id' => '04', 'province_id' => '0421'],
            ['code' => '043400000', 'name' => 'Laguna', 'region_id' => '04', 'province_id' => '0434'],
            ['code' => '045600000', 'name' => 'Quezon', 'region_id' => '04', 'province_id' => '0456'],
            ['code' => '045800000', 'name' => 'Rizal', 'region_id' => '04', 'province_id' => '0458'],
            ['code' => '174000000', 'name' => 'Marinduque', 'region_id' => '17', 'province_id' => '1740'],
            ['code' => '175100000', 'name' => 'Occidental Mindoro', 'region_id' => '17', 'province_id' => '1751'],
            ['code' => '175200000', 'name' => 'Oriental Mindoro', 'region_id' => '17', 'province_id' => '1752'],
            ['code' => '175300000', 'name' => 'Palawan', 'region_id' => '17', 'province_id' => '1753'],
            ['code' => '175900000', 'name' => 'Romblon', 'region_id' => '17', 'province_id' => '1759'],
            ['code' => '050500000', 'name' => 'Albay', 'region_id' => '05', 'province_id' => '0505'],
            ['code' => '051600000', 'name' => 'Camarines Norte', 'region_id' => '05', 'province_id' => '0516'],
            ['code' => '051700000', 'name' => 'Camarines Sur', 'region_id' => '05', 'province_id' => '0517'],
            ['code' => '052000000', 'name' => 'Catanduanes', 'region_id' => '05', 'province_id' => '0520'],
            ['code' => '054100000', 'name' => 'Masbate', 'region_id' => '05', 'province_id' => '0541'],
            ['code' => '056200000', 'name' => 'Sorsogon', 'region_id' => '05', 'province_id' => '0562'],
            ['code' => '060400000', 'name' => 'Aklan', 'region_id' => '06', 'province_id' => '0604'],
            ['code' => '060600000', 'name' => 'Antique', 'region_id' => '06', 'province_id' => '0606'],
            ['code' => '061900000', 'name' => 'Capiz', 'region_id' => '06', 'province_id' => '0619'],
            ['code' => '063000000', 'name' => 'Iloilo', 'region_id' => '06', 'province_id' => '0630'],
            ['code' => '064500000', 'name' => 'Negros Occidental', 'region_id' => '06', 'province_id' => '0645'],
            ['code' => '067900000', 'name' => 'Guimaras', 'region_id' => '06', 'province_id' => '0679'],
            ['code' => '071200000', 'name' => 'Bohol', 'region_id' => '07', 'province_id' => '0712'],
            ['code' => '072200000', 'name' => 'Cebu', 'region_id' => '07', 'province_id' => '0722'],
            ['code' => '074600000', 'name' => 'Negros Oriental', 'region_id' => '07', 'province_id' => '0746'],
            ['code' => '076100000', 'name' => 'Siquijor', 'region_id' => '07', 'province_id' => '0761'],
            ['code' => '082600000', 'name' => 'Eastern Samar', 'region_id' => '08', 'province_id' => '0826'],
            ['code' => '083700000', 'name' => 'Leyte', 'region_id' => '08', 'province_id' => '0837'],
            ['code' => '084800000', 'name' => 'Northern Samar', 'region_id' => '08', 'province_id' => '0848'],
            ['code' => '086000000', 'name' => 'Samar', 'region_id' => '08', 'province_id' => '0860'],
            ['code' => '086400000', 'name' => 'Southern Leyte', 'region_id' => '08', 'province_id' => '0864'],
            ['code' => '087800000', 'name' => 'Biliran', 'region_id' => '08', 'province_id' => '0878'],
            ['code' => '097200000', 'name' => 'Zamboanga del Norte', 'region_id' => '09', 'province_id' => '0972'],
            ['code' => '097300000', 'name' => 'Zamboanga del Sur', 'region_id' => '09', 'province_id' => '0973'],
            ['code' => '098300000', 'name' => 'Zamboanga Sibugay', 'region_id' => '09', 'province_id' => '0983'],
            ['code' => '101300000', 'name' => 'Bukidnon', 'region_id' => '10', 'province_id' => '1013'],
            ['code' => '101800000', 'name' => 'Camiguin', 'region_id' => '10', 'province_id' => '1018'],
            ['code' => '103500000', 'name' => 'Lanao del Norte', 'region_id' => '10', 'province_id' => '1035'],
            ['code' => '104200000', 'name' => 'Misamis Occidental', 'region_id' => '10', 'province_id' => '1042'],
            ['code' => '104300000', 'name' => 'Misamis Oriental', 'region_id' => '10', 'province_id' => '1043'],
            ['code' => '112300000', 'name' => 'Davao del Norte', 'region_id' => '11', 'province_id' => '1123'],
            ['code' => '112400000', 'name' => 'Davao del Sur', 'region_id' => '11', 'province_id' => '1124'],
            ['code' => '112500000', 'name' => 'Davao Oriental', 'region_id' => '11', 'province_id' => '1125'],
            ['code' => '118200000', 'name' => 'Davao de Oro', 'region_id' => '11', 'province_id' => '1182'],
            ['code' => '118600000', 'name' => 'Davao Occidental', 'region_id' => '11', 'province_id' => '1186'],
            ['code' => '124700000', 'name' => 'Cotabato', 'region_id' => '12', 'province_id' => '1247'],
            ['code' => '126300000', 'name' => 'South Cotabato', 'region_id' => '12', 'province_id' => '1263'],
            ['code' => '126500000', 'name' => 'Sultan Kudarat', 'region_id' => '12', 'province_id' => '1265'],
            ['code' => '128000000', 'name' => 'Sarangani', 'region_id' => '12', 'province_id' => '1280'],
            ['code' => '133900000', 'name' => 'NCR, City of Manila, First District', 'region_id' => '13', 'province_id' => '1339'],
            ['code' => '137400000', 'name' => 'NCR, Second District', 'region_id' => '13', 'province_id' => '1374'],
            ['code' => '137500000', 'name' => 'NCR, Third District', 'region_id' => '13', 'province_id' => '1375'],
            ['code' => '137600000', 'name' => 'NCR, Fourth District', 'region_id' => '13', 'province_id' => '1376'],
            ['code' => '140100000', 'name' => 'Abra', 'region_id' => '14', 'province_id' => '1401'],
            ['code' => '141100000', 'name' => 'Benguet', 'region_id' => '14', 'province_id' => '1411'],
            ['code' => '142700000', 'name' => 'Ifugao', 'region_id' => '14', 'province_id' => '1427'],
            ['code' => '143200000', 'name' => 'Kalinga', 'region_id' => '14', 'province_id' => '1432'],
            ['code' => '144400000', 'name' => 'Mountain Province', 'region_id' => '14', 'province_id' => '1444'],
            ['code' => '148100000', 'name' => 'Apayao', 'region_id' => '14', 'province_id' => '1481'],
            ['code' => '150700000', 'name' => 'Basilan', 'region_id' => '15', 'province_id' => '1507'],
            ['code' => '153600000', 'name' => 'Lanao del Sur', 'region_id' => '15', 'province_id' => '1536'],
            ['code' => '153800000', 'name' => 'Maguindanao', 'region_id' => '15', 'province_id' => '1538'],
            ['code' => '156600000', 'name' => 'Sulu', 'region_id' => '15', 'province_id' => '1566'],
            ['code' => '157000000', 'name' => 'Tawi-Tawi', 'region_id' => '15', 'province_id' => '1570'],
            ['code' => '160200000', 'name' => 'Agusan del Norte', 'region_id' => '16', 'province_id' => '1602'],
            ['code' => '160300000', 'name' => 'Agusan del Sur', 'region_id' => '16', 'province_id' => '1603'],
            ['code' => '166700000', 'name' => 'Surigao del Norte', 'region_id' => '16', 'province_id' => '1667'],
            ['code' => '166800000', 'name' => 'Surigao del Sur', 'region_id' => '16', 'province_id' => '1668'],
            ['code' => '168500000', 'name' => 'Dinagat Islands', 'region_id' => '16', 'province_id' => '1685'],
        ];
        DB::table('ph_provinces')->insert($provinces);
        $this->command->info('Seeded ' . count($provinces) . ' provinces.');

        // ---- Cities / Municipalities (from CSV) ----
        $citiesCsv = database_path('seeders/data/cities.csv');
        $cityRows = [];
        if (($handle = fopen($citiesCsv, 'r')) !== false) {
            $header = fgetcsv($handle); // skip header
            while (($row = fgetcsv($handle)) !== false) {
                $cityRows[] = [
                    'code'        => $row[0],
                    'name'        => $row[1],
                    'region_id'   => $row[2],
                    'province_id' => $row[3],
                    'city_id'     => $row[4],
                ];
                if (count($cityRows) >= 500) {
                    DB::table('ph_cities')->insert($cityRows);
                    $cityRows = [];
                }
            }
            fclose($handle);
        }
        if (!empty($cityRows)) {
            DB::table('ph_cities')->insert($cityRows);
        }
        $this->command->info('Seeded cities & municipalities from CSV.');

        // ---- Barangays (from CSV) ----
        $barangaysCsv = database_path('seeders/data/barangays.csv');
        $barangayRows = [];
        if (($handle = fopen($barangaysCsv, 'r')) !== false) {
            $header = fgetcsv($handle); // skip header
            while (($row = fgetcsv($handle)) !== false) {
                $barangayRows[] = [
                    'code'        => $row[0],
                    'name'        => $row[1],
                    'region_id'   => $row[2],
                    'province_id' => $row[3],
                    'city_id'     => $row[4],
                ];
                if (count($barangayRows) >= 1000) {
                    DB::table('ph_barangays')->insert($barangayRows);
                    $barangayRows = [];
                }
            }
            fclose($handle);
        }
        if (!empty($barangayRows)) {
            DB::table('ph_barangays')->insert($barangayRows);
        }
        $this->command->info('Seeded barangays from CSV.');

        $this->command->info('Philippine address data seeded successfully!');
    }
}
