<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class TurkeyStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turkiye = Country::query()->where('iso3','TUR')->get(['id','iso2'])->first();
        City::query()->where('country_id','=',$turkiye->id)->delete();
        State::query()->where('country_id','=',$turkiye->id)->delete();

        State::query()->insert([
            0 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 1,
                'iso2' => 1,
                'name' => 'Adana',
            ],
            1 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 2,
                'iso2' => 2,
                'name' => 'Adıyaman',
            ],
            2 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 3,
                'iso2' => 3,
                'name' => 'Afyonkarahisar',
            ],
            3 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 4,
                'iso2' => 4,
                'name' => 'Ağrı',
            ],
            4 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 5,
                'iso2' => 5,
                'name' => 'Amasya',
            ],
            5 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 6,
                'iso2' => 6,
                'name' => 'Ankara',
            ],
            6 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 7,
                'iso2' => 7,
                'name' => 'Antalya',
            ],
            7 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 8,
                'iso2' => 8,
                'name' => 'Artvin',
            ],
            8 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 9,
                'iso2' => 9,
                'name' => 'Aydın',
            ],
            9 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 10,
                'iso2' => 10,
                'name' => 'Balıkesir',
            ],
            10 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 11,
                'iso2' => 11,
                'name' => 'Bilecik',
            ],
            11 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 12,
                'iso2' => 12,
                'name' => 'Bingöl',
            ],
            12 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 13,
                'iso2' => 13,
                'name' => 'Bitlis',
            ],
            13 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 14,
                'iso2' => 14,
                'name' => 'Bolu',
            ],
            14 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 15,
                'iso2' => 15,
                'name' => 'Burdur',
            ],
            15 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 16,
                'iso2' => 16,
                'name' => 'Bursa',
            ],
            16 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 17,
                'iso2' => 17,
                'name' => 'Çanakkale',
            ],
            17 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 18,
                'iso2' => 18,
                'name' => 'Çankırı',
            ],
            18 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 19,
                'iso2' => 19,
                'name' => 'Çorum',
            ],
            19 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 20,
                'iso2' => 20,
                'name' => 'Denizli',
            ],
            20 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 21,
                'iso2' => 21,
                'name' => 'Diyarbakır',
            ],
            21 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 22,
                'iso2' => 22,
                'name' => 'Edirne',
            ],
            22 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 23,
                'iso2' => 23,
                'name' => 'Elazığ',
            ],
            23 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 24,
                'iso2' => 24,
                'name' => 'Erzincan',
            ],
            24 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 25,
                'iso2' => 25,
                'name' => 'Erzurum',
            ],
            25 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 26,
                'iso2' => 26,
                'name' => 'Eskişehir',
            ],
            26 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 27,
                'iso2' => 27,
                'name' => 'Gaziantep',
            ],
            27 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 28,
                'iso2' => 28,
                'name' => 'Giresun',
            ],
            28 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 29,
                'iso2' => 29,
                'name' => 'Gümüşhane',
            ],
            29 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 30,
                'iso2' => 30,
                'name' => 'Hakkari',
            ],
            30 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 31,
                'iso2' => 31,
                'name' => 'Hatay',
            ],
            31 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 32,
                'iso2' => 32,
                'name' => 'Isparta',
            ],
            32 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 33,
                'iso2' => 33,
                'name' => 'Mersin',
            ],
            33 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 34,
                'iso2' => 34,
                'name' => 'İstanbul',
            ],
            34 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 35,
                'iso2' => 35,
                'name' => 'İzmir',
            ],
            35 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 36,
                'iso2' => 36,
                'name' => 'Kars',
            ],
            36 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 37,
                'iso2' => 37,
                'name' => 'Kastamonu',
            ],
            37 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 38,
                'iso2' => 38,
                'name' => 'Kayseri',
            ],
            38 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 39,
                'iso2' => 39,
                'name' => 'Kırklareli',
            ],
            39 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 40,
                'iso2' => 40,
                'name' => 'Kırşehir',
            ],
            40 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 41,
                'iso2' => 41,
                'name' => 'Kocaeli',
            ],
            41 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 42,
                'iso2' => 42,
                'name' => 'Konya',
            ],
            42 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 43,
                'iso2' => 43,
                'name' => 'Kütahya',
            ],
            43 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 44,
                'iso2' => 44,
                'name' => 'Malatya',
            ],
            44 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 45,
                'iso2' => 45,
                'name' => 'Manisa',
            ],
            45 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 46,
                'iso2' => 46,
                'name' => 'Kahramanmaraş',
            ],
            46 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 47,
                'iso2' => 47,
                'name' => 'Mardin',
            ],
            47 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 48,
                'iso2' => 48,
                'name' => 'Muğla',
            ],
            48 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 49,
                'iso2' => 49,
                'name' => 'Muş',
            ],
            49 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 50,
                'iso2' => 50,
                'name' => 'Nevşehir',
            ],
            50 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 51,
                'iso2' => 51,
                'name' => 'Niğde',
            ],
            51 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 52,
                'iso2' => 52,
                'name' => 'Ordu',
            ],
            52 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 53,
                'iso2' => 53,
                'name' => 'Rize',
            ],
            53 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 54,
                'iso2' => 54,
                'name' => 'Sakarya',
            ],
            54 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 55,
                'iso2' => 55,
                'name' => 'Samsun',
            ],
            55 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 56,
                'iso2' => 56,
                'name' => 'Siirt',
            ],
            56 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 57,
                'iso2' => 57,
                'name' => 'Sinop',
            ],
            57 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 58,
                'iso2' => 58,
                'name' => 'Sivas',
            ],
            58 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 59,
                'iso2' => 59,
                'name' => 'Tekirdağ',
            ],
            59 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 60,
                'iso2' => 60,
                'name' => 'Tokat',
            ],
            60 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 61,
                'iso2' => 61,
                'name' => 'Trabzon',
            ],
            61 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 62,
                'iso2' => 62,
                'name' => 'Tunceli',
            ],
            62 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 63,
                'iso2' => 63,
                'name' => 'Şanlıurfa',
            ],
            63 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 64,
                'iso2' => 64,
                'name' => 'Uşak',
            ],
            64 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 65,
                'iso2' => 65,
                'name' => 'Van',
            ],
            65 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 66,
                'iso2' => 66,
                'name' => 'Yozgat',
            ],
            66 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 67,
                'iso2' => 67,
                'name' => 'Zonguldak',
            ],
            67 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 68,
                'iso2' => 68,
                'name' => 'Aksaray',
            ],
            68 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 69,
                'iso2' => 69,
                'name' => 'Bayburt',
            ],
            69 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 70,
                'iso2' => 70,
                'name' => 'Karaman',
            ],
            70 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 71,
                'iso2' => 71,
                'name' => 'Kırıkkale',
            ],
            71 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 72,
                'iso2' => 72,
                'name' => 'Batman',
            ],
            72 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 73,
                'iso2' => 73,
                'name' => 'Şırnak',
            ],
            73 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 74,
                'iso2' => 74,
                'name' => 'Bartın',
            ],
            74 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 75,
                'iso2' => 75,
                'name' => 'Ardahan',
            ],
            75 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 76,
                'iso2' => 76,
                'name' => 'Iğdır',
            ],
            76 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 77,
                'iso2' => 77,
                'name' => 'Yalova',
            ],
            77 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 78,
                'iso2' => 78,
                'name' => 'Karabük',
            ],
            78 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 79,
                'iso2' => 79,
                'name' => 'Kilis',
            ],
            79 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 80,
                'iso2' => 80,
                'name' => 'Osmaniye',
            ],
            80 => [
                'country_id'  =>  $turkiye->id,
                'country_code' => $turkiye->iso2,
                'fips_code' => 81,
                'iso2' => 81,
                'name' => 'Düzce',
            ],
        ]);
    }
}