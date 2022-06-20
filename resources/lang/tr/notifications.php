<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Kimlik kontrol metinleri
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki metinler kimlik doğrulama (giriş) sırasında kullanıcılara
    | gösterilebilecek mesajlardır. Bu metinleri uygulamanızın
    | gereksinimlerine göre düzenlemekte özgürsünüz.
    |
    */

    'dashboard' => 'Gösterge Ekranı',
    'payment_delayed_title' => 'Ödeme Gecikmesi - :day gün',
    'payment_delayed_message' => '<strong>:propertyName :unitName</strong> bölümüne ait <strong>:payment_dept_due_date</strong> son tarihli <strong>:payment_dept_amount :payment_dept_currency</strong> tutarındaki ödeme <strong>:delayDay gün</strong> gecikmiştir.',
    'near_contract_expires_title'=>' :propertyName / :unitName',
    'near_contract_expires_message'=> '<strong> :start_date - :end_date </strong> tarihleri arasında <strong>:rental_price:rental_currency</strong> tutarında <strong>:payment_period</strong> ödemeli sözleşmenin süresi :delayDay gün sonra sonra erecektir.',
    'reminder_title'=> 'Hatırlatıcı - :title',
    'reminder_message_prefix'=>'<strong>:property - :unit</strong> bölümüne ait not:',



];
