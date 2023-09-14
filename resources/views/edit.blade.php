@extends('master')

@section('content')

{{-- @dd($data); --}}
<div class="row">
    <div class="col-6 offset-3 shadow-sm">
        <div class="m-4">
            {{-- <form action="{{route('post#seemore'))}}" method="get">
                @csrf
                <input type="submit" class="btn btn-dark btn-sm text-white" value="&lt; back">
            </form> --}}
            <a href="{{route('post#seemore',$data['id'])}}" class="btn btn-dark btn-sm text-white">&lt; back</a>
            <form action="{{route('post#update' )}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="postId" value="{{$data['id']}}">
                <label for="title" class="form-label mt-3">Title</label>
                <input type="text" class="form-control @error('postTitle') is-invalid @enderror" id="title" name="postTitle" placeholder="Enter Title..." value="{{old('postTitle',$data['title'])}}">
                @error('postTitle')
                    <small class="invalid-feedback">{{$message}}</small><br>
                @enderror
                <label for="description" class="form-label mt-3">Description</label>
                <textarea name="postDescription" id="description" cols="30" rows="10" class="form-control @error('postDescription') is-invalid @enderror">{{old('postDescription',$data['description'])}}</textarea>
                @error('postDescription')
                <small class="invalid-feedback">{{$message}}</small>
                @enderror
                @if ($data['image'])
                @if (Storage::get('public/'.$data['image']))
                <img src="{{asset('storage/'.$data['image'])}}" class="mt-3 img-thumbnail" alt="">
                @else
                    <img src="{{asset('storage/'.'img_not_found.png')}}" class="mt-3 img-thumbnail" alt="">
                @endif
                @endif
                <input type="file" name="postImage" class="form-control @error('postImage') is-invalid @enderror" id="image" placeholder="aaa">
                @error('postImage')
                    <small class="invalid-feedback">{{$message}}</small>
                @enderror
                <input type="submit" value="update" class="btn btn-small btn-dark float-end my-3">
            </form>
        </div>{{-- @dd($data); --}}
    </div>
</div>

@endsection
