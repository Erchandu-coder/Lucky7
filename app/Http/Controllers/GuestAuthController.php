<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



class GuestAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $token = Str::random(60);
        Session::put('guestToken', $token);
        Session::put('guestName', $request->name);
        Session::put('amount', 100);
        
        return response()->json([
            'token' => $token,
            'name' => $request->name,
        ]);
    }

    public function gameBet(){
        
        return view('dashboard');
    }

    public function playGame(Request $request)
    {
        $bet = $request->input('bet');
        $amount = $request->input('amount') - 10;
        $dice1 = rand(1, 6);
        $dice2 = rand(1, 6);
        $sum = $dice1 + $dice2;
        $winAmount = 0;

        if (($bet === 'below7' && $sum < 7) || ($bet === 'above7' && $sum > 7)) {
            $winAmount = 20;
        } elseif ($bet === 'lucky7' && $sum === 7) {
            $winAmount = 30;
        }

        $amount += $winAmount;

        return back()->with(compact('dice1', 'dice2', 'sum', 'winAmount', 'amount'));
    }

}
