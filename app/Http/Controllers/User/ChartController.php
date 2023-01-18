<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function spotGold()
    {
        return view('user/chart/spotGold');
    }

    public function liveGoldPrice()
    {
        return view('user/chart/liveGoldPrice');
    }

    public function goldPricePerOunce()
    {
        return view('user/chart/goldPricePerOunce');
    }

    public function goldPricePerGram()
    {
        return view('user/chart/goldPricePerGram');
    }

    public function goldPricePerKilo()
    {
        return view('user/chart/goldPricePerKilo');
    }

    public function goldPriceHistory()
    {
        return view('user/chart/goldPriceHistory');
    }

    public function goldSilverRatio()
    {
        return view('user/chart/goldSilverRatio');
    }

    public function spotSilver()
    {
        return view('user/chart/spotSilver');
    }

    public function liveSilverPrice()
    {
        return view('user/chart/liveSilverPrice');
    }

    public function silverPricePerOunce()
    {
        return view('user/chart/silverPricePerOunce');
    }

    public function silverPricePerGram()
    {
        return view('user/chart/silverPricePerGram');
    }

    public function silverPricePerKilo()
    {
        return view('user/chart/silverPricePerKilo');
    }

    public function silverPriceHistory()
    {
        return view('user/chart/silverPriceHistory');
    }

    public function silverGoldRatio()
    {
        return view('user/chart/silverGoldRatio');
    }
}
