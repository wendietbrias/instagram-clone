<?php

namespace App\Http\Controllers\Home;

//library
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


//models
use App\Models\User;
use App\Models\Posts;
use App\Models\Likes;

class PostsController extends Controller {
    public function getAllPosts() {
        $allPosts = Posts::with(['user', 'likes'])->get();

        return response()->json($allPosts,200);
    }



 

    public function create(Request $request) {
        $today = Carbon::now();
        $fname_dokumen = null;

            $validate = $request->validate([
                "title"=>['required' , 'min:8'],
                "caption"=>['required'],
                'image'=>['required']
            ]);

            if($request->hasFile('image')){
                $storage_dokumen = Storage::disk('posts_image');
                $fname_dokumen = $today->format('Ymd_Hms') . '_' . Str::random(5) . '_' . Str::slug($request->title,'_','end') . '.' . $request->file('image')->getClientOriginalExtension();
                $storage_dokumen->putFileAs(null,$request->file('image'),$fname_dokumen,[]);
            }

            if($fname_dokumen != null) {
                
                $created = Posts::create([
                    "title"=>$request->title ,
                    "caption"=>$request->caption,
                    "image"=>$fname_dokumen,
                    "userid"=>Auth::id()
                ]);          

                if($created) {
                    return response()->json(['message'=>'success create posts!']);
                }
                          
            }

            return response()->json([array_merge($validate)] , 200);
    }

    public function delete($id) {
        $find_post_and_delete = Posts::where('id', $id)->delete();

        if($find_post_and_delete) {
            return response()->json(['message'=>'success delete data']);
        }
    }

    public function like(Request $request) {
         $duplicate_like = Likes::where(['postid'=>$request->postid , 'userid'=>$request->userid]);

         if(count($duplicate_like->get()) > 0) {
             $deleted = $duplicate_like->delete();

             if($deleted) {
                return response()->json(['message'=>'unlike']);
             }
         }

         $created = Likes::create([
            "userid"=>$request->userid,
            "postid"=>$request->postid
         ]);

         if($created) {
            return response()->json(['message'=>'liked']);
         }
    }

    public function comment(Request $request) {

    }
}