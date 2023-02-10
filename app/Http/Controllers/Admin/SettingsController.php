<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\SocialMedia;
use App\Models\Supporter;

class SettingsController extends Controller
{
    public function manageSNS()
    {
        $data = [
            'services' => SocialMedia::all(),
            'current_nav_tab' => 'settings',
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

    public function manageSupporters()
    {
        $data = [
            'supporters' => Supporter::all(),
            'current_nav_tab' => 'settings',
        ];
        return view('admin/settings/manageSupporters', $data);
    }

    public function addSupporter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:gif,jpeg,webp,bmp,png',
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        try {
            $logo = $request->file('logo');
            $data['logo'] = time().'.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('/images/supporters'), $data['logo']);
            $data['name'] = $request->input('name');
            $data['url'] = $request->input('url');

            $supporter = Supporter::create($data);
            if($supporter) {
                notify()->success("You've added a new supporter successfully.");
                return response()->json([
                    'status' => true,
                    'message' => "You've added a new supporter successfully."
                ]);
            } else {
                notify()->error('Something went wrong. Please try again later.');
                return response()->json([
                    'status' => false,
                    'message' => 'Unable to add a new supporter.'
                ]);
            }
        } catch(\Exception $e) {
            notify()->error('Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'message' => 'Unable to add a new supporter.'
            ]);
        }
    }

    public function editSupporter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supporter_id' => 'required|numeric',
            'logo' => 'image|mimes:gif,jpeg,webp,bmp,png',
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        try {
            $logo = $request->file('logo');
            if($logo) {
                $logo_name = time().'.'.$logo->getClientOriginalExtension();
                $logo->move(public_path('/images/supporters'), $logo_name);
                $supporter = DB::table('supporters')->where('id', $request->input('supporter_id'))
                    ->update(['logo' => $logo_name, 'name' => $request->input('name'), 'url' => $request->input('url')]);
            } else {
                $supporter = DB::table('supporters')->where('id', $request->input('supporter_id'))
                    ->update(['name' => $request->input('name'), 'url' => $request->input('url')]);
            }
            if($supporter) {
                notify()->success("You've edited the supporter successfully.");
                return response()->json([
                    'status' => true,
                    'message' => "You've edited the supporter successfully."
                ]);
            } else {
                notify()->error('Something went wrong. Please try again later.');
                return response()->json([
                    'status' => false,
                    'message' => 'Unable to edit the supporter.'
                ]);
            }
        } catch(\Exception $e) {
            notify()->error('Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'message' => 'Unable to edit the supporter.'
            ]);
        }
    }

    public function deleteSupporter(Request $request) {
        $validator = Validator::make($request->all(), [
            'supporter_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first());
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        $supporter_id = $request->get('supporter_id');
        $supporter = Supporter::where('id', $supporter_id)->delete();
        if($supporter) {
            notify()->success("You've deleted the supporter successfully.");
            return response()->json([
                'status' => true,
                'message' => "You've deleted the suppoter successfully."
            ]);
        } else {
            notify()->error('Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    public function manageOtherSettings()
    {

    }
}
