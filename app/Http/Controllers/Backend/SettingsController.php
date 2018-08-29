<?php

namespace App\Http\Controllers\Backend;

use App\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AppMeta;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * institute setting section content manage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function institute(Request $request)
    {
        //for save on POST request
        if ($request->isMethod('post')) {
            //validate form
            $messages = [
                'logo.max' => 'The :attribute size must be under 1MB.',
                'logo.dimensions' => 'The :attribute dimensions must be 230 X 50.',
                'favicon.max' => 'The :attribute size must be under 1MB.',
                'favicon.dimensions' => 'The :attribute dimensions must be 32 X 32.',
            ];
            $this->validate(
                $request, [
                'name' => 'required|min:5|max:255',
                'short_name' => 'required|min:3|max:255',
                'logo' => 'mimes:jpeg,jpg,png|max:1024|dimensions:min_width=230,min_height=50,max_width=230,max_height=50',
                'favicon' => 'mimes:png|max:512|dimensions:min_width=32,min_height=32,max_width=32,max_height=32',
                'establish' => 'min:4|max:255',
                'website_link' => 'max:255',
                'email' => 'nullable|email|max:255',
                'phone_no' => 'required|min:8|max:255',
                'address' => 'required|max:500',
                'academic_year' => 'required|integer',
                'language' => 'required|min:2',
                'attendance_notification' => 'required|integer',
                ]
            );

            if($request->hasFile('logo')) {
                $storagepath = $request->file('logo')->store('public/logo');
                $fileName = basename($storagepath);
                $data['logo'] = $fileName;
            }
            else{
                $data['logo'] = $request->get('oldLogo','');
            }
            if($request->hasFile('favicon')) {
                $storagepath = $request->file('favicon')->store('public/logo');
                $fileName = basename($storagepath);
                $data['favicon'] = $fileName;
            }
            else{
                $data['favicon'] = $request->get('oldFavicon','');
            }

            $data['name'] = $request->get('name');
            $data['short_name'] = $request->get('short_name');
            $data['establish'] = $request->get('establish');
            $data['website_link'] = $request->get('website_link');
            $data['email'] = $request->get('email');
            $data['phone_no'] = $request->get('phone_no');
            $data['address'] = $request->get('address');

            //now crate
            AppMeta::updateOrCreate(
                ['meta_key' => 'institute_settings'],
                ['meta_value' => json_encode($data)]
            );
            AppMeta::updateOrCreate(
                ['meta_key' => 'academic_year'],
                ['meta_value' => $request->get('academic_year', 0)]
            );
            AppMeta::updateOrCreate(
                ['meta_key' => 'frontend_website'],
                ['meta_value' => $request->has('frontend_website') ? 1 : 0]
            );
            AppMeta::updateOrCreate(
                ['meta_key' => 'language'],
                ['meta_value' => $request->get('language', '')]
            );
            AppMeta::updateOrCreate(
                ['meta_key' => 'disable_language'],
                ['meta_value' => $request->has('disable_language') ? 1 : 0]
            );
            AppMeta::updateOrCreate(
                ['meta_key' => 'attendance_notification'],
                ['meta_value' => $request->get('attendance_notification', 0)]
            );
            Cache::forget('app_settings');
            return redirect()->route('settings.institute')->with('success', 'Setting updated!');
        }

        //for get request
        $settings = AppMeta::where('meta_key', 'institute_settings')->first();
        $info = null;
        if($settings) {
            $info = json_decode($settings->meta_value);
        }
        $settings = AppMeta::whereIn(
            'meta_key', [
            'academic_year',
            'frontend_website',
            'language',
            'disable_language',
            'attendance_notification',
            ]
        )->get();

        $metas = [];
        foreach ($settings as $setting){
            $metas[$setting->meta_key] = $setting->meta_value;
        }


        $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->pluck('title', 'id');
      
        $academic_year = isset($metas['academic_year']) ? $metas['academic_year'] : 0;
        $frontend_website = isset($metas['frontend_website']) ? $metas['frontend_website'] : 0;
        $language = isset($metas['language']) ? $metas['language'] : 0;
        $disable_language = isset($metas['disable_language']) ? $metas['disable_language'] : 0;
        $attendance_notification = isset($metas['attendance_notification']) ? $metas['attendance_notification'] : 0;

        return view(
            'backend.settings.institute', compact(
                'info',
                'academic_years',
                'academic_year',
                'frontend_website',
                'disable_language',
                'attendance_notification',
                'language'
            )
        );
    }
}
