<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Video;
use App\Visitor;
use App\Gallery;
use App\Spost;
use App\Jobpost;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
      $Post=Post:: where('status',1)->count();
      $Video=Video:: where('status',1)->count();
      $gellary=Gallery:: where('status',1)->count();
      $Spost=Spost:: where('status',1)->count();
      $activeUser=Visitor:: where('status',1)->where('is_approve',1)->count();
      $pandingUser=Visitor:: where('status',1)->where('is_approve',0)->count();
      $totaluser=Visitor:: where('status',1)->count();
      $jobpost=Jobpost:: where('status',1)->count();
    	return view('admin.home',compact('Post','Video','Spost','gellary','activeUser','pandingUser','totaluser','jobpost'));
    }
    
    

    public function approve($id){
      $approve=Post:: where('status',1)->where('is_apporve',2)->where('id',$id)->update([
        'is_apporve'=> 1,
      ]);
      if ($approve) {
        return back();
      }else {
        return back();
      }
    }
    public function panding($id){
      $panding=Post:: where('status',1)->where('is_apporve',1)->where('id',$id)->update([
        'is_apporve'=> 2,
      ]);
      if ($panding) {
        return back();
      }else {
        return back();
      }
    }












    // Predefined social media types (hardcoded)
    private function getSocialTypes()
    {
        return ['facebook', 'twitter', 'instagram', 'youtube'];
    }

    public function socialMediaView()
    {
        $socialTypes = $this->getSocialTypes();
        
        // Get the single setting using Query Builder (cached)
        
            $row = DB::table('business_settings')
                ->where('type', 'social_media_links')
                ->first(['value']);

            if ($row) {
                $settingsArray =  json_decode($row->value, true) ?? [];
            }else{
                $settingsArray = [];
            }
       
        
        // Build assoc array from the array of objects (link_type as key)
        $settings = [];
        foreach ($settingsArray as $item) {
            if (isset($item['link_type'])) {
                $settings[$item['link_type']] = $item['link'] ?? '';
            }
        }
        
        // Merge defaults (ensure all types exist, even if empty)
        foreach ($socialTypes as $type) {
            if (!isset($settings[$type])) {
                $settings[$type] = '';
            }
        }

        return view('admin.Social.social-media', compact('socialTypes', 'settings'));
    }

    public function socialMediaUpdate(Request $request)
    {
        $request->validate([
            'links' => 'required|array',
            'links.*' => 'required|url', // Each link must be a valid URL or empty? Adjust if allowing empty.
        ]);

        $socialTypes = $this->getSocialTypes();
        $newArray = [];

        foreach ($socialTypes as $type) {
            $link = $request->links[$type] ?? '';
            $newArray[] = [
                'link_type' => $type,
                'link' => $link,
            ];
        }

        $valueJson = json_encode($newArray);

        // Upsert the single row using Query Builder
        DB::table('business_settings')
            ->updateOrInsert(
                ['type' => 'social_media_links'],
                ['value' => $valueJson]
            );

        

        return redirect()->back()->with('success', 'Social media links updated successfully!');
    }



















    private function getSettingTypes(): array
    {
        return ['site_logo', 'site_description', 'site_phone', 'site_email'];
    }

    public function siteSettingShow()
    {
        $types = $this->getSettingTypes();
        
        // Get existing settings using Query Builder (cached)
            $settings = DB::table('business_settings')
                ->whereIn('type', $types)
                ->get(['type', 'value'])
                ->keyBy('type')
                ->map(function ($item) {
                    // Handle logo as string path, others as string
                    return $item->value;
                })
                ->toArray();

        
        
        foreach ($types as $type) {
            if (!isset($settings[$type])) {
                $settings[$type] = '';
            }
        }

        return view('admin.setting.site-settings', compact('types', 'settings'));
    }

    public function siteSettingUpdate(Request $request)
    {
        $request->validate([
            'site_description' => 'nullable|string|max:500',
            'site_phone' => 'nullable|string|max:20',
            'site_email' => 'nullable|email|max:100',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB
        ]);

        DB::transaction(function () use ($request) {
            // Handle logo upload
            if ($request->hasFile('site_logo')) {
                // Delete old logo if exists
                if (!empty($request->old_logo)) {
                    Storage::delete('public/' . $request->old_logo);
                }
                $logoPath = $request->file('site_logo')->store('logos', 'public');
                DB::table('business_settings')
                    ->updateOrInsert(['type' => 'site_logo'], ['value' => $logoPath]);
            }

            // Update text fields
            $textFields = ['site_description', 'site_phone', 'site_email'];
            foreach ($textFields as $field) {
                $value = $request->input($field, '');
                DB::table('business_settings')
                    ->updateOrInsert(['type' => $field], ['value' => $value]);
            }
        });

        

        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }
}