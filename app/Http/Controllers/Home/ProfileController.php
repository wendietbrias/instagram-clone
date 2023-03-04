<?php 

namespace App\Http\Controllers\Home;

//library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;


//models
use App\Models\User;
use App\Models\Posts;

class ProfileController extends Controller {
    public function showProfile() {
        $find_user = User::find(Auth::id());
        $find_post = Posts::where('userid' , Auth::id())->get();

        return view("home.profile" , [
            "profile"=>$find_user,
            "posts"=>$find_post
        ]);
    }

    public function updateAvatar(Request $request) {
        $today = Carbon::now();
        $find_user = User::where("id" ,Auth::id());
        $fname_profile = null;

        if($find_user->first()){
            if($request->hasFile("image")){
                $storage = Storage::disk("profile_image");
                
                $fname_profile = $today->format('Ymd_Hms') . '_' . Str::random(5) . '_' . Str::slug(Auth::id(),'_','end') . '.' . $request->file('image')->getClientOriginalExtension();;

                $storage->putFileAs(null,$request->file("image") , $fname_profile, []);
            }

            $updated = $find_user->update([
                "avatar"=>$fname_profile
            ]);

            if($updated) {
                return response()->json(['message'=>$fname_profile]);
            }

        }
    }

    public function update(Request $request) {
        $find_user = User::where('id' , Auth::id());

        if($find_user) {
             $updated = $find_user->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "phone_number"=>$request->phone_number
             ]);

             if($updated) {
                return response()->json(['message'=>'success updated'], 200);
             }
        }

        return response()->json(['message'=>'upsss user is not found', 404]);
    }
}