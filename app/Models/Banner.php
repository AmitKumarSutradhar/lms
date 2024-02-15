<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $guarded = [];
    private static $banner, $image, $imageName, $directory, $imageUrl;

    private static function getImageUrl($request){
        self::$image   = $request->file('image_url');
        self::$imageName        = uniqid().self::$image->getClientOriginalName();
        self::$directory        = "upload/banner/";
        self::$image->move(self::$directory,self::$imageName);
        self::$imageUrl         = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function addNewBanner($request){

        self::$imageUrl = $request->file('image_url') ? self::getImageUrl($request) : '';

        self::$banner                     = new Banner();
        self::$banner->title_one          = $request->title_one;
        self::$banner->title_two          = $request->title_two;
        self::$banner->image_url          = self::$imageUrl;
        self::$banner->banner_type        = $request->banner_type;
        self::$banner->position           = $request->position;
        self::$banner->description        = $request->description;
        self::$banner->button_one_link    = $request->button_one_link;
        self::$banner->button_one_link    = $request->button_one_link;
        self::$banner->button_one_text    = $request->button_one_text;
        self::$banner->button_two_text    = $request->button_two_text;
        self::$banner->button_two_link    = $request->button_two_link;
        self::$banner->is_active          = $request->is_active;
        self::$banner->save();
    }


    public static function updateBannerInfo($request, $banner){
        if ($request->file('image_url')){
            if (file_exists($banner->image_url)){
                unlink($banner->image_url);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $banner->image;
        }

        $banner->title_one          = $request->title_one;
        $banner->title_two          = $request->title_two;
        $banner->image_url          = self::$imageUrl;
        $banner->banner_type        = $request->banner_type;
        $banner->position           = $request->position;
        $banner->description        = $request->description;
        $banner->button_one_link    = $request->button_one_link;
        $banner->button_one_link    = $request->button_one_link;
        $banner->button_one_text    = $request->button_one_text;
        $banner->button_two_text    = $request->button_two_text;
        $banner->button_two_link    = $request->button_two_link;
        $banner->is_active          = $request->is_active;
        $banner->save();
    }

    public static function deleteBanner($banner){
        if (file_exists($banner->image_url)){
            unlink($banner->image_url);
        }
        $banner->delete();
    }
}
