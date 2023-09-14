<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        $datas = Post::when(request('key'),function($p){
            $searchKey = request('key');
            $p->orwhere('title','like','%'.$searchKey.'%')
            ->orwhere('description','like','%'.$searchKey.'%');
        })->orderBy('updated_at','desc')->paginate(3);
        // dd($datas['image']);
        // dd(count($datas));
        // dd($datas->toarray());
        // $datas = Post::orderBy('updated_at','desc')->paginate(3);
        // dd($datas->first());
        // dd(($datas)->first()->created_at);
        return view('create',compact('datas'));
    }
    public function postCreate(Request $request)
    {
        $this->checkFormInput($request);
        $data = $this->getPostData($request);
        if($request->hasFile('postImage'))
        {
            $imgName = uniqid().'_'.$request->file('postImage')->getClientOriginalName();
            // dd($imgName);
            $request->file('postImage')->storeAs('public',$imgName);
            $data['image'] = $imgName;
            // var_dump($request->file('postImage'));
            // dd('store success');
        }else
        {
            // dd('no photo found');
        }
        // dd($data);
        // dd($request->file('postImage'));
        // dd($request->hasFile('postImage')?'yes':'no');
        // dd($request->all());

        Post::create($data);
        return back()->with(['insertSuccess' => 'Post creation successful!']);
    }
    public function postDelete($id)
    {
        Post::where('id',$id)->delete();
        // Post::find($id)->delete();
        return back();
    }
    public function postEdit($id)
    {
        $data = Post::where('id',$id)->first()->toarray();
        return view('edit',compact('data'));
    }

    public function postSeemore($id)
    {
        $data = Post::where('id',$id)->first();
        // dd($data['title']);
        return view('seemore',compact('data'));

    }
    public function postUpdate(Request $request)
    {

        // old image delete
        $oldImgName = Post::where('id',$request->postId)->first()->image;
        if($oldImgName)
        {
            Storage::delete('public/'.$oldImgName);
        }
        Validator::make($request->all(), [
            'postTitle' => 'required|min:5',
            'postDescription' => 'required|min:5|unique:posts,description',
        ])->validate();
        $id = $request['postId'];
        $updateData = $this->getPostData($request);
        if($request->postImage)
        {
            $imgName = uniqid().'_'.$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$imgName);
            $updateData['image'] = $imgName;
        }
        Post::where('id',$id)->update($updateData);
        return redirect()->route('customer#create')->with(['updateSuccess'=> 'Post updating successful!']);
    }

    private function getPostData($data)
    {
        return [
            'title' => $data->postTitle,
            'description' => $data->postDescription,
            // 'image' => uniqid().$data->file('postImage')->getClientOriginalName(),
        ];
    }
    // for form validation
    private function checkFormInput($data)
    {
        $validationRule = [
            'postTitle' => 'required|min:5|unique:posts,title',
            'postDescription' => 'required|min:5',
            'postImage' => 'mimes:jpg,jpeg,png',
        ];
        $validationMessage = [
            'postTitle.unique' => 'ခေါင်းစဥ် တူနေပါသည်။ ထပ်မံ၍ ကြိုးစားပါ။'
        ];
        Validator::make($data->all(),$validationRule, $validationMessage)->validate();
        // Validator::make($data->all(), [
        //     'postTitle' => 'required',
        //     'postDescription' => 'required',
        // ])->validate();
    }
}
