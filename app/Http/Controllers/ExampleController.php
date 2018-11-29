<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function toprofile()
    {
        $url = route('profile');

        return redirect()->route('profile', ['id'=>'13567']);
    }


    public function request(\Illuminate\Http\Request $request)
    {
        printf("environment:%s", app()->environment());
    }

    //
}
