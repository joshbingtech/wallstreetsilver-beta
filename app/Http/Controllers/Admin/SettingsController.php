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

    public function addSNS(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $service = SocialMedia::create([
            'service' => $request->get('service'),
            'url' => $request->get('url')
        ]);

        if($service) {
            notify()->success("You've added a new service successfully.");
            return response()->json([
                'status' => true,
                'message' => "You've added a new service successfully."
            ]);
        } else {
            notify()->error('Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'message' => 'Unable to add a new service.'
            ]);
        }
    }

    public function editSNS(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        $service_id = $request->get('service_id');
        $service = SocialMedia::find($service_id);

        if($service) {
            $service->service = $request->get('service');
            $service->url = $request->get('url');
            $service->save();

            notify()->success("You've edited the service successfully.");
            return response()->json([
                'status' => true,
                'message' => "You've edited the service successfully."
            ]);
        } else {
            notify()->error('Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'message' => 'Unable to edit the service.'
            ]);
        }
    }

    public function deleteSNS(Request $request) {
        $validator = Validator::make($request->all(), [
            'service_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first());
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        $service_id = $request->get('service_id');
        $service = SocialMedia::where('id', $service_id)->delete();
        if($service) {
            notify()->success("You've deleted the service successfully.");
            return response()->json([
                'status' => true,
                'message' => "You've deleted the service successfully."
            ]);
        } else {
            notify()->error('Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    public function manageSponsors()
    {

    }

    public function manageOtherSettings()
    {

    }
}
