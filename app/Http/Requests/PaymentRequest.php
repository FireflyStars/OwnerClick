<?php

namespace App\Http\Requests;

use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->get('ref_payment_id') != null and $this->get('status_id') == PaymentDept::PAYMENT_STATUS_PAID) {
            if ($this->getMethod() == "POST") {
                return [
                    'payment_method_id' => [
                        'required', 'integer'
                    ],
                    'payment_account_id' => [
                      "required_if:payment_method_id,".Payment::PAYMENT_METHOD_BANK_TRANSFER
                    ],
                    'amount' => [
                        'required', 'numeric'
                    ],
                    'comment' => [
                        'string', 'nullable'
                    ],
                    'status_id' => [
                        'integer', 'nullable'
                    ],
                    'ref_payment_id' => [
                        'integer', 'nullable'
                    ]
                ];
            }

        }
        if ($this->get('due_date') == null and $this->getMethod() == "PUT") {
//            var_dump($this->get('amount'));
            return [
                'payment_method_id' => [
                    'required', 'integer'
                ],
                'payment_account_id' => [
                    "required_if:payment_method_id,".Payment::PAYMENT_METHOD_BANK_TRANSFER
                ],
                'amount' => [
                    'required', 'numeric'
                ],
                'comment' => [
                    'string', 'nullable'
                ],
                'status_id' => [
                    'integer', 'nullable'
                ],

            ];
        }

        return [
            'contract_id' => [
                'required', 'integer'
            ],
            'due_date' => [
                'required', 'date_format:' . auth()->user()->date_format
            ],
            'payment_method_id' => [
                'required', 'integer'
            ],
            'payment_account_id' => [
                "required_if:payment_method_id,".Payment::PAYMENT_METHOD_BANK_TRANSFER
            ],
            'payment_type_id' => [
                'required', 'integer'
            ],
            'amount' => [
                'required', 'numeric'
            ],
            'currency' => [
                'required', 'string'
            ],
            'comment' => [
                'string', 'nullable'
            ],
            'status_id' => [
                'integer', 'nullable'
            ]

        ];
    }

    public function attributes()
    {
        return [
            'contract_id' => __('dashboard.contract'),
            'due_date' => __('dashboard.due_date'),
            'payment_method_id' => __('dashboard.payment_method'),
            'payment_type_id' => __('dashboard.payment_type'),
            'payment_account_id' => __('dashboard.payment_account'),
            'amount' => __('dashboard.amount'),
            'currency' => __('dashboard.money_currency'),
            'comment' => __('dashboard.comment'),
            'status_id' => __('dashboard.status'),
            'ref_payment_id' => __('dashboard.ref_payment'),
        ];
    }
}
