<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use FileUploadTrait;

    function index() : View {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(Request $request) {
        $validatedData = $request->validate([
            'site_name' => ['required', 'max:255'],
            'site_email' => ['nullable', 'max:255'],
            'site_phone' => ['nullable', 'max:255']
        ]);

        foreach($validatedData as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();

    }

    function updateLogoSetting(Request $request) : RedirectResponse {
        $validatedData = $request->validate([
            'logo' => ['nullable', 'image', 'max:1000'],
            'footer_logo' => ['nullable', 'image', 'max:1000'],
            'favicon' => ['nullable', 'image', 'max:1000'],
        ]);

        foreach($validatedData as $key => $value){
            $imagePatch = $this->uploadImage($request, $key);
            if (!empty($imagePatch)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $imagePatch]
                );
            }
        }


        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();

    }

    function UpdateAppearanceSetting(Request $request) : RedirectResponse {
        $validatedData = $request->validate([
            'site_color' => ['required'],
        ]);

        foreach($validatedData as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    function UpdateSeoSetting(Request $request) : RedirectResponse {
        $validatedData = $request->validate([
            'seo_title' => ['required', 'max:200'],
            'seo_description' => ['nullable', 'max:600'],
            'seo_keywords' => ['nullable']

        ]);

        foreach($validatedData as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }
}
