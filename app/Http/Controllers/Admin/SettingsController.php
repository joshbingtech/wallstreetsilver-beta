<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\SocialMedia;

class SettingsController extends Controller
{
    public function manageSNS()
    {
        $data = [
            'current_nav_tab' => 'settings',
            'services' => SocialMedia::all(),
        ];
        return view('admin/settings/manageSNS', $data);
    }

    public function manageSponsors()
    {

    }

    public function manageOtherSettings()
    {

    }
}
