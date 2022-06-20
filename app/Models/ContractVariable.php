<?php

namespace App\Models;

class ContractVariable
{

    const DAIRE = 'city';
    const MAHALLE = 'state';
    const ADDRESS = 'address';
    const DAIRE_NO = 'apartment_no';
    const GAYRIMENKUL_TIP = 'type';
    const KIRAYA_VERENIN_ADI = 'Kiraya Verenin Adı';
    const KIRAYA_VERENIN_TC = 'Kiraya Verenin TC Numarası';
    const KIRAYA_VERENIN_ADRES = 'kiraya Verenin Adresi';
    const KIRACININ_ADI = 'Kiraya Verenin Adı';
    const KIRACININ_TC = 'Kiraya Verenin TC Numarası';
    const KIRACININ_ADRES = 'kiraya Verenin Adresi';
    const KEFIL_ADI = 'Kiraya Verenin Adı';
    const KEFIL_TC = 'Kiraya Verenin TC Numarası';
    const KEFIL_ADRES = 'kiraya Verenin Adresi';
    const YILLIK_KIRA_MIKTARI_RAKAM = 'kiraya Verenin Adresi';


    static function getVariables()
    {
        $state = [
            self::DAIRE => ['title' => 'İl', 'name' => '', 'value'],
            self::MAHALLE => ['title' => 'Mahalle', 'name' => '', 'value'],
            self::ADDRESS => ['title' => 'Adres', 'name' => '', 'value'],
            self::DAIRE_NO => ['title' => 'Kapı No', 'name' => '', 'value'],
            self::GAYRIMENKUL_TIP => ['title' => 'Gayrimenkul Tipi', 'name' => '', 'value'],
            self::KIRAYA_VERENIN_ADI => ['title' => 'Kiraya Verenin Adı', 'name' => '', 'value'],
            self::KIRAYA_VERENIN_TC => ['title' => 'Kiraya Verenin TC', 'name' => '', 'value'],
            self::KIRAYA_VERENIN_ADRES => ['title' => 'Kiraya Verenin Adresi', 'name' => '', 'value'],
            self::KIRACININ_ADI => ['title' => 'Kiracının Adı', 'name' => '', 'value'],
            self::KIRACININ_TC => ['title' => 'Kiracının TC Numarası', 'name' => '', 'value'],
            self::KIRACININ_ADRES => ['title' => 'Kiracının Adresi', 'name' => '', 'value'],
            self::KEFIL_ADI => ['title' => 'Kefil Adı', 'name' => '', 'value'],
            self::KEFIL_TC => ['title' => 'Kefilin TC Numarası', 'name' => '', 'value'],
            self::KEFIL_ADRES => ['title' => 'kefilin Adresi', 'name' => '', 'value'],
            self::YILLIK_KIRA_MIKTARI_RAKAM => ['title' => 'Yıllık Kira Miktarı', 'name' => '', 'value'],

        ];
        return $state;
    }


}
