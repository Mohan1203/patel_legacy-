<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialIcons = settings::all();

        return view("admin.settings.settings",compact("socialIcons"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $request->validate([
                'social_name' => 'required',
                'social_icon' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'social_link' => 'required'
            ]);
      
            $imageName = time() . '.' . $request->social_icon->extension();
            $request->social_icon->move(public_path('socialIcons'), $imageName);
            $url = 'socialIcons/' . $imageName;
            $settings = new settings();
            $settings->name = $request->social_name;
            $settings->icon = $url;
            $settings->url_link = $request->social_link;
            $settings->save();
            return redirect()->back()->with("success","Settings Created Successfully");    
        }catch(\Exception $e){
            dd($e);
            return redirect()->back()->with("error","Something went wrong");
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $socialIcon = settings::find($id);
        return view("admin.settings.editSettings",compact("socialIcon"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'social_name' => 'required',
            'social_link' => 'required'
        ]);
        $settings = settings::find($id);
        if($request->hasFile('social_icon')){
            $imageName = time() . '.' . $request->social_icon->extension();
            $request->social_icon->move(public_path('socialIcons'), $imageName);
            $url = 'socialIcons/' . $imageName;
            $settings->icon = $url;
        }
        $settings->name = $request->social_name;
        $settings->url_link = $request->social_link;
        $settings->save();
        return redirect()->back()->with("success","Settings Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socialIcon = settings::find($id);
        if($socialIcon){
            $socialIcon->delete();
            return redirect()->back()->with("success","Settings Deleted Successfully");
        }else{
            return redirect()->back()->with("error","Something went wrong");
        }
    }
}
