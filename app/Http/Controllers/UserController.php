<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('privacy');
    }
    
    public function store(Request $request) 
    { 
        $request->validate([
            'fastname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required',
            'email' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'city' => 'required',
            'line1' => 'required',
            'phone' => 'required',
        ],
        [
            'required' => ':attribute は必須です。',
        ],
        [
            'fastname' => '苗字',
            'lastname' => '名前',
            'birthday' => '生年月日',
            'email' => 'メールアドレス',
            'zipcode' => '郵便番号',
            'city' => '都道府県',
            'line1' => '市区町村',
            'phone' => '電話番号',
        ]);

        $request->old([
            'fastname',
            'lastname',
            'birthday',
            'email',
            'zipcode',
            'state',
            'city',
            'line1',
            'phone',
        ]);
    }

    
}
