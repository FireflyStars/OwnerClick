<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    public function register()
    {
        $this->renderable(function (UnitOwnersException $e, $request) {
            $data = [
                'success' => false,
                'icon' => 'warning',
                'type' => 'warning',
                'title' => 'Malikler tanımlanmamış',
                'message' => 'Sözleşme oluşturabilmek için malikler ekranından mülk sahiplerini eklemeniz gerekmektedir.',
            ];
            return response()->json($data, 200);
        });
        $this->renderable(function (HttpException $e, $request) {
            if ($e->getMessage() === 'Your email address is not verified.') {
                $data = [
                    'success' => false,
                    'icon' => 'warning',
                    'type' => 'warning',
                    'timer'=>false,
                    'title' => __('alert.email_not_verified_title'),
                    'message' => __('alert.email_not_verified_message'),
                    'showConfirmButton'=>false,
                    'showCloseButton'=> true,
                    'html' => "<p>".__('dashboard.please_click_verification_link')."</p><p><strong>".__('dashboard.if_verification_mail_not_recived')."</strong></p>".'   <form  method="POST" data-action="'.route('verification.resend') .'" action="'.route('verification.resend') .'">
                                    '.csrf_field().'
                                        <input class="btn btn-block  swal2-confirm btn-outline-danger" type="submit" value="'.__('dashboard.send_email_again').'" >
                                    </form>',
                    'position'=>"center center",
                    'toast' =>false,
                    'backdrop'=>true

                ];
                } else {
                $data = [
                    'success' => false,
                    'icon' => 'warning',
                    'type' => 'warning',
                    'title' => $e->getHeaders(),
                    'message' => $e->getMessage(),
                    'showConfirmButton'=>false,
                    'timer'=>4000,
                    'position'=>'top-right',
                    'toast'=>true,
                ];
            }
            return response()->json($data, 200);
        });
    }
}
