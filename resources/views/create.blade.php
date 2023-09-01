@extends('master')
@section('content')
{{-- {{$data->links()}} --}}

<h3 class="text-center m-2"> <i class="fa fa-brands fa-page4"></i> &nbsp;Welcome From News World</h3>
<hr>



<div class="m-5">
    <div class="row">
        <div class="col-5">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif --}}
            <h3 class="text-center m-2">Total Post - {{$datas->total()}}</h3>
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
            <form action="{{ route('post#create')}}" method="POST">
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
                <input type="submit" value="Create" class="btn btn-danger mt-3">
            </form>
        </div>
        <div class="col-7">
            {{-- @for ($i = 0; $i< 3; $i++)
                <div class="card mb-2">
                    <div class="card-body">
                        <h2 class="card-title">{{$data[$i]['title']}}</h2>
                        <p>{{$data[$i]['description']}}</p>
                        <div class="d-flex justify-content-end">
                            <div class="mx-1">
                                <a href="#" class="btn bg-danger"><i class="text-white fa fa-trash-can"></i></a>
                            </div>
                            <div class="mx-1">
                                <a href="#" class="btn bg-primary"><i class="text-white fa fa-file-lines"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor --}}
            @foreach ($datas as $data)
            {{-- @dd(($data)->first()->created_at) --}}
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{$data->title}}</h3>
                            {{-- @$data->crated_atdd($data->first()->created_at) --}}
                            <div>{{$data->first()->created_at->format('d-m-Y')}}</div>
                        </div>
                        <p>{{ Str::words($data->description, 25, ' . . . .')}}</p>
                        <div class="d-flex justify-content-end">
                                {{-- <a href="{{route('post#delete',$data['id'])}}" class="btn bg-danger"><i class="text-white fa fa-trash-can"></i></a> --}}
                                <form action="{{route('post#delete',$data->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger text-white mx-1">Delete<i class="fa fa-trash"></i></button>
                                </form>
                                <form action="{{route('post#seemore',$data->id)}}" method="get">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="Read more&gt;&gt;">
                                </form>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$datas->links()}}
        </div>
    </div>
</div>

<p class="text-muted text-end">&reg; created by tzs&trade; | copyright at 2023&copy; </p>
@endsection




{{-- <div class="col-md-6">
    <label for="validationServer03" class="form-label">City</label>
    <input type="text" class="form-control is-invalid" id="validationServer03" aria-describedby="validationServer03Feedback" required>
    <div id="validationServer03Feedback" class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div> --}}
