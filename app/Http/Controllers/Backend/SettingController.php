<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function SmtpSettings(){
        $smtp = SmtpSetting::find(1);
        return view('admin.backend.setting.smtp_update',compact('smtp'));
    }

    public function SmtpUpdate(Request $request){
        $smtp_id = $request->id;

        SmtpSetting::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = array(
            'message' => 'SMTP settings updated successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function SiteSettings(){
        $site = SiteSetting::find(1);
        return view('admin.backend.setting.site_update',compact('site'));
    }

    public function SiteUpdate(Request $request){
        $site = SiteSetting::find(1);
        $site_id = $request->id;

        if ($request->file('logo')){
            if (file_exists($site->logo)){
                unlink($site->logo);
            }
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(100,100)->save('upload/logo/'.$name_gen);
            $save_url = 'upload/logo/'.$name_gen;


            SiteSetting::find($site_id)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'logo' => $save_url
            ]);

            $notification = array(
                'message' => 'Setting Updated Successfully.',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }else{
            SiteSetting::find($site_id)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
            ]);

            $notification = array(
                'message' => 'Setting Updated Successfully.',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
    }
}
