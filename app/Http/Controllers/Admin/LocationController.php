<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Location;
use App\BusinessSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('created_at', 'desc')->get();
        $sectionTitleRecord = BusinessSetting::where('type', 'locations_section_title')->first();
        $sectionTitle = $sectionTitleRecord ? $sectionTitleRecord->value : 'Our Comprehensive Courses - Available In Your Locations';

        return view('admin.locations.index', compact('locations', 'sectionTitle'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'map_link' => 'required|url',
            'status' => 'required|in:active,inactive',
            'is_homepage' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Location::create($request->only(['name', 'map_link', 'status', 'is_homepage']));

        return redirect()->back()->with('success', 'Location added successfully!');
    }

    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'map_link' => 'required|url',
            'status' => 'required|in:active,inactive',
            'is_homepage' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $location->update($request->only(['name', 'map_link', 'status', 'is_homepage']));

        return redirect()->back()->with('success', 'Location updated successfully!');
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->back()->with('success', 'Location deleted successfully!');
    }

    public function sectionTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        BusinessSetting::updateOrCreate(
            ['type' => 'locations_section_title'],
            ['value' => $request->section_title]
        );

        return redirect()->back()->with('success', 'Section title updated successfully!');
    }
}