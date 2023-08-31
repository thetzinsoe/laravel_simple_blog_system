<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        $datas = Post::orderBy('updated_at','desc')->paginate(3);
        // dd($datas->total());
        // dd($datas);
        return view('create',compact('datas'));
    }
    public function postCreate(Request $request)
    {
        // dd($request->all());
        $this->checkFormInput($request);
        $data = $this->getPostData($request);
        // dd($request);

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
        $data = Post::where('id',$id)->first()->toarray();
        // dd($data['title']);
        return view('seemore',compact('data'));
    }
    public function postUpdate(Request $request)
    {
        // Validator::make($request->all(), [
        //     'postTitle' => 'required',
        //     'postDescription' => 'required',
        // ])->validate();
        // dd($request->all());
        $this->checkFormInput($request);
        $id = $request['postId'];
        $updateData = $this->getPostData($request);
        Post::where('id',$id)->update($updateData);
        return redirect()->route('customer#create')->with(['updateSuccess'=> 'Post updating successful!']);
    }

    private function getPostData($data)
    {
        return [
            'title' => $data->postTitle,
            'description' => $data->postDescription
        ];
    }


    // for form validation
    private function checkFormInput($data)
    {
        echo "i am valildator.....";
        // dd(($data)->all());
        // $validationRule = [
        //     'postTitle' => 'required|min:5|unique:posts,title',
        //     'postDescription' => 'required|min:5',
        // ];
        // $validationMessage = [
        //     'postTitle.unique' => 'ခေါင်းစဥ် တူနေပါသည်။ ထပ်မံ၍ ကြိုးစားပါ။'
        // ];
        // Validator::make($data->all(),$validationRule, $validationMessage)->validate();
        Validator::make($data->all(), [
            'postTitle' => 'required',
            'postDescription' => 'required',
        ])->validate();
    }
}

