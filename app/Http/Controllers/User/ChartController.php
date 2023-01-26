<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function spotGold()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/spotGold', $data);
    }

    public function liveGoldPrice()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/liveGoldPrice', $data);
    }

    public function goldPricePerOunce()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/goldPricePerOunce', $data);
    }

    public function goldPricePerGram()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/goldPricePerGram', $data);
    }

    public function goldPricePerKilo()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/goldPricePerKilo', $data);
    }

    public function goldPriceHistory()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/goldPriceHistory', $data);
    }

    public function goldSilverRatio()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/goldSilverRatio', $data);
    }

    public function spotSilver()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/spotSilver', $data);
    }

    public function liveSilverPrice()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/liveSilverPrice', $data);
    }

    public function silverPricePerOunce()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/silverPricePerOunce', $data);
    }

    public function silverPricePerGram()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/silverPricePerGram', $data);
    }

    public function silverPricePerKilo()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/silverPricePerKilo', $data);
    }

    public function silverPriceHistory()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/silverPriceHistory', $data);
    }

    public function silverGoldRatio()
    {
        $data = [
            'current_nav_tab' => 'charts',
        ];
        return view('user/chart/silverGoldRatio', $data);
    }
}
