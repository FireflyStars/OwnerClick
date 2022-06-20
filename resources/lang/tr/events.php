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

    'contract_created_title' => '<strong>:propertyName</strong>/:unitName',
    'contract_created_message' => '<strong>:start_date-:end_date</strong> tarihleri arasında <strong>:rental_price:rental_currency</strong> tutarında <strong>:payment_period</strong> ödemeli sözleşme oluşturuldu.',
    'contract_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'contract_deleted_message' =>'<strong>:start_date-:end_date</strong> tarihleri arasında <strong>:rental_price:rental_currency</strong> ödemeli sözleşme silindi.',
    'contract_renewed_title' => '<strong>:propertyName</strong>/:unitName',
    'contract_renewed_message' => '<strong>:start_date</strong> tarihinde başlatılan sözleşme <strong>:end_date</strong> tarihine uzatılarak <strong>:rental_price:rental_currency</strong> tutarındaki sözleşme <strong>:payment_period</strong> ödemeli sözleşme yenilendi.',
    'contract_terminated_title' => '<strong>:propertyName</strong>/:unitName',
    'contract_terminated_message' =>  '<strong>:start_date-:end_date</strong> tarihleri arasında <strong>:rental_price:rental_currency</strong> tutarındaki <strong>:payment_period</strong> ödemeli sözleşme sonlandırıldı.',
    'contract_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'contract_updated_message' => '<strong>:start_date-:end_date</strong> tarih aralığındaki sözleşme güncellendi.',
    'detail_created_title' => '<strong>:propertyName</strong>/:unitName',
    'detail_created_message' => '<strong>:detail</strong> detay bilgisi <strong>:value</strong> olarak oluşturuldu.',
    'detail_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'detail_deleted_message' => '<strong>:detail</strong> detay bilgisi silindi.',
    'detail_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'detail_updated_message' => '<strong>:detail</strong> detay bilgisi <strong>:value</strong> olarak güncellendi.',
    'file_deleted_title' => '<strong>Dosya silindi.</strong>',
    'file_deleted_message' => ':name',
    'file_uploaded_title' => '<strong>Dosya yüklendi</strong>',
    'file_uploaded_message' => ':name',
    'fixture_created_title' => '<strong>:propertyName</strong>/:unitName',
    'fixture_created_message' => '<strong>:name</strong> demirbaş olarak eklendi.',
    'fixture_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'fixture_deleted_message' =>  '<strong>:name</strong> demirbaşı silindi.',
    'fixture_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'fixture_updated_message' => '<strong>:name</strong> demirbaşı güncellendi.',
    'note_created_title' => '<strong>:propertyName</strong>/:unitName',
    'note_created_message' => '<strong>:title</strong> başlıklı not eklendi.',
    'note_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'note_deleted_message' => '<strong>:title</strong> başlıklı not silindi.',
    'note_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'note_updated_message' => '<strong>:title</strong> başlıklı not güncellendi.',
    'outgoing_created_title' => '<strong>:propertyName</strong>/:unitName',
    'outgoing_created_message' => '<strong>:payment_type_id</strong> kateogrisine ait <strong>:amount:currency</strong> tutarındaki <strong>:name</strong> gider oluşturuldu.',
    'outgoing_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'outgoing_deleted_message' =>  '<strong>:payment_type_id</strong> kateogrisine ait <strong>:amount:currency</strong> tutarındaki <strong>:name</strong> gider silindi.',
    'outgoing_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'outgoing_updated_message' =>  '<strong>:payment_type_id</strong> kateogrisine ait <strong>:amount:currency</strong> tutarındaki <strong>:name</strong> gider güncellendi.',
    'payment_created_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_created_message' => '<strong>:payment_dept_due_date</strong> son ödeme tarihli <strong>:payment_dept_amount:payment_dept_currency</strong> tutarındaki <strong>:payment_dept_payment_type_id</strong> alacağına <strong>:amount:currency</strong> ödeme yapılarak <strong>:payment_dept_status_id</strong> bildirilmiştir.',
    'payment_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_deleted_message' => '<strong>:payment_dept_due_date</strong> son ödeme tarihli <strong>:payment_dept_amount:payment_dept_currency</strong> tutarındaki <strong>:payment_dept_payment_type_id</strong> alacağına <strong>:amount:currency</strong> yapılan ödeme silinmiştir.',
    'payment_dept_activated_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_dept_activated_message' => '<strong>:due_date</strong> son ödeme tarihli <strong>:amount:currency</strong> tutarında <strong>:payment_type_id</strong> kategorisindeki alacak aktifleştirildi.',
    'payment_dept_created_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_dept_created_message' => '<strong>:due_date</strong> son ödeme tarihli <strong>:amount:currency</strong> tutarında <strong>:payment_type_id</strong> kategorisinde alacak oluşturuldu.',
    'payment_dept_deactivated_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_dept_deactivated_message' => '<strong>:due_date</strong> son ödeme tarihli <strong>:amount:currency</strong> tutarında <strong>:payment_type_id</strong> kategorisindeki alacak pasifleştirildi.',
    'payment_dept_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_dept_deleted_message' => '<strong>:due_date</strong> son ödeme tarihli <strong>:amount:currency</strong> tutarında <strong>:payment_type_id</strong> kategorisinde alacak silindi.',
    'payment_dept_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_dept_updated_message' => '<strong>:due_date</strong> son ödeme tarihli <strong>:amount:currency</strong> tutarında <strong>:payment_type_id</strong> kategorisinde alacak güncellendi.',
    'payment_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'payment_updated_message' => '<strong>:payment_dept_due_date</strong> son ödeme tarihli <strong>:payment_dept_amount:payment_dept_currency</strong> tutarındaki <strong>:payment_dept_payment_type_id</strong> alacağına <strong>:amount:currency</strong> yapılan ödeme güncellenmiştir.',
    'person_created_title' => '<strong>:name</strong>',
    'person_created_message' => '<strong>:name</strong> kişisi oluşturuldu.',
    'person_deleted_title' => '<strong>:name</strong>',
    'person_deleted_message' => '<strong>:name</strong> kişisi silindi.',
    'person_updated_title' => '<strong>:name</strong>',
    'person_updated_message' =>'<strong>:name</strong> kişisine ait bilgiler güncellendi.',
    'property_created_title' => '<strong>:propertyName</strong>/:unitName',
    'property_created_message' => '<strong>:address</strong> adresinde <strong>:type_id</strong> tipindeki mülk oluşturuldu.',
    'property_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'property_deleted_message' => '<strong>:address</strong> adresinde <strong>:type_id</strong> tipindeki mülk silindi.',
    'property_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'property_updated_message' => '<strong>:address</strong> adresinde <strong>:type_id</strong> tipindeki mülk güncellendi.',
    'unit_created_title' => '<strong>:propertyName</strong>/:unitName',
    'unit_created_message' => '<strong>:propertyName</strong> mülküne <strong>:name</strong> bölümü eklendi.',
    'unit_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'unit_deleted_message' => '<strong>:propertyName</strong> mülküne ait <strong>:name</strong> bölümü silindi.',
    'unit_person_created_title' => '<strong>:propertyName</strong>/:unitName',
    'unit_person_created_message' => '<strong>:personName</strong> kişisi <strong>:share</strong> oranında <strong>:type_id</strong> olarak atandı.',
    'unit_person_deleted_title' => '<strong>:propertyName</strong>/:unitName',
    'unit_person_deleted_message' => '<strong>:personName</strong> kişisinin <strong>:type_id</strong> ataması kaldırıldı.',
    'unit_person_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'unit_person_updated_message' => '<strong>:personName</strong> kişisinin <strong>:type_id</strong> atama bilgileri güncellendi.',
    'unit_updated_title' => '<strong>:propertyName</strong>/:unitName',
    'unit_updated_message' =>'<strong>:propertyName</strong> mülküne ait <strong>:name</strong> bölümü güncellendi.',

];
