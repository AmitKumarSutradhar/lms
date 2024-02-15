<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.backend.banner.index',[
            'banners' => Banner::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Banner::addNewBanner($request);

        $notification = array(
            'message'           => 'Banner Added Successfully',
            'alert-type'        => 'success',
        );

        return redirect()->route('banner.index')->with($notification);
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
        $banner = Banner::find($id);
        return view('admin.backend.banner.edit',[
            'banner' => $banner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        Banner::updateBannerInfo($request, $banner);

        $notification = array(
            'message'           => 'Banner Updated Successfully',
            'alert-type'        => 'success',
        );

        return redirect()->route('banner.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        Banner::deleteBanner($banner);

        $notification = array(
            'message'           => 'Banner Deleted Successfully',
            'alert-type'        => 'success',
        );

        return redirect()->back()->with($notification);
    }


}
