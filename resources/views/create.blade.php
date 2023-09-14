@extends('master')
@section('content')

{{-- @dd($datas->items()[0]['image']) --}}
{{-- {{asset()}} --}}
{{-- @dd(asset('storage').'/app/Images/'.$datas->items()[0]['image']) --}}
{{-- @dd(storage_path().'/app/Images/'.$datas->items()[0]['image']) --}}
<h3 class="text-center m-2 text-danger"> <i class="fa fa-brands fa-page4"></i> &nbsp;Welcome From Personal Blog</h3>
<hr>
{{-- start create section --}}
{{-- <img src="{{asset('storage').'/app/Images/'.$datas->items()[0]['image']}}" alt="" title=""> --}}
<div class="m-4">
    <div class="row">
        <div class="col-5">
            <h3 class="mb-3 text-primary">Create Post</h3>
            @if (session('insertSuccess'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{session('insertSuccess')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('updateSuccess'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{session('updateSuccess')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('post#create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="form-label" for="postTitle">Post postTitle</label>
                <input type="text" name="postTitle" id="postTitle" class="form-control @error('postTitle') is-invalid @enderror" value="{{old('postTitle')}}" placeholder="Enter Post Title...">
                @error('postTitle')
                    <small class="invalid-feedback">{{$message}}</small>
                @enderror
                <label class="form-label mt-3" for="postDescription">Post postDescription</label>
                <textarea name="postDescription" id="postDescription" cols="30" rows="10" class="form-control @error('postDescription') is-invalid @enderror" placeholder="Enter Post Description...">{{old('postDescription')}}</textarea>
                @error('postDescription')
                    <small class="invalid-feedback">{{$message}}</small>
                @enderror
                <label class="form-label mt-3" for="image">Upload Image</label>
                <input type="file" name="postImage" class="form-control @error('postImage') is-invalid @enderror" id="image">
                @error('postImage')
                    <small class="invalid-feedback">{{$message}}</small>
                @enderror
                <input type="submit" value="Create" class="btn btn-danger mt-3">
            </form>
        </div>
{{-- end create section --}}
{{-- start post view --}}
        <div class="col-7">
            <div class="d-flex justify-content-between mb-3">
                <h3 class="text-center m-2 text-primary">Total Post - {{$datas->total()}}</h3>
                <form action="{{route('customer#create')}}" method="get">
                    <div class="input-group">
                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}">
                        <button class="btn bg-danger" type="submit"><i class="fa fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            @if(count($datas)==0)
            <h3 class="text-danger text-center m-4">no post found!</h3>
            @else
            @foreach ($datas as $data)
                <div class="card mb-2 border">
                    @if($data->image)
                    <div class="row g-0">
                        <div class="col-md-5">
                        @if (Storage::get('public/'.$data->image))
                            <img src="{{asset('storage/'.$data->image)}}" class="img-fluid rounded-start" alt="" title="">
                        @else
                            <img src="{{asset('storage/'.'img_not_found.png')}}" class="img-fluid rounded-start" alt="">
                        @endif
                        </div>
                    {{-- test end --}}
                    <div class="col-md-7">
                    @endif
                    <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">{{$data->title}}</h4>
                                <div>{{$data->first()->created_at->format('d-m-Y')}}</div>
                            </div>
                        <p class="card-text">{{ Str::words($data->description, 25, ' . . . .')}}</p>
                    </div>

                        <div class="d-flex justify-content-between p-3 align-items-end">
                            <form action="{{route('post#seemore',$data->id)}}" method="get">
                                @csrf
                                <input type="submit" class="btn btn-sm btn-primary" value="see more&gt;&gt;">
                            </form>
                            <form action="{{route('post#delete',$data->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger text-white mx-1"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>

                    @if ($data->image)
                        </div>
                        </div>
                    @endif
            </div>
            @endforeach
            {{$datas->appends(request()->query())->links()}}
            @endif
        </div>
    </div>
</div>
{{-- end post view --}}
{{-- footer section --}}
<p class="text-muted text-start m-0 p-0"><i>copyright</i> &copy; 2023 , <i>created by <b>Thetzinsoe</b></i></p>
{{-- end footer section --}}

@endsection
