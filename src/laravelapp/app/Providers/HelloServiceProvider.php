<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Validator;
use App\Http\Validators\HelloValidator;

class HelloServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 手軽だが汎用性なし 1つのコントローラーで使用ようする場合などに活用
        // $validator::extend('hello', function($attribute, $value, $parameters, $validator) {
        //     return $value % 2 == 0;
        // });
        // $validator = $this->app['validator'];
        // $validator->resolver(function($translator, $data, $rules, $messages) {
        //     return new HelloValidator($translator, $data, $rules, $messages);
        // });
        //
        // View::composer(
        //     'hello.index', 'App\Http\Composers\HelloComposer'
        // );
    }
}
