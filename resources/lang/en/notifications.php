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

    'dashboard' => 'Dashboard',
    'payment_delayed_title' => 'Overdue Payment  - :day days',
    'payment_delayed_message' => 'The payment of <strong>:payment_dept_amount :payment_dept_currency</strong> for <strong>:propertyName :unitName</strong> with a due date <strong>:payment_dept_due_date</strong> has been delayed by <strong>:delayDay days</strong>.',
    'near_contract_expires_title'=>' :propertyName / :unitName',
    'near_contract_expires_message'=> 'Between <strong> :start_date - :end_date </strong>, the <strong>:payment_period</strong> of <strong>:rental_price:rental_currency</strong> lease will end in :delayDay days.',
    'reminder_title'=> 'Reminder - :title',
    'reminder_message_prefix'=>'Notes for <strong>:property - :unit</strong>',



];
