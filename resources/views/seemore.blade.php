@extends('master')

@section('content')
{{-- @dd($data) --}}
<div class="m-5">
    <div class="row">
        <div class="col-6 offset-3 shadow-sm">
            <div class="m-2">
                <a href="{{route('customer#create')}}" class=" text-decoration-none text-white btn btn-dark btn-sm mb-5">&lt; back</a>
                @if ($data['image'])
                @if (Storage::get('public/'.$data['image']))
                <img src="{{asset('storage/'.$data['image'])}}" class="img-thumbnail" alt="no image found">
                @else
                    <img src="{{asset('storage/'.'img_not_found.png')}}" class="img-thumbnail" alt="">
                @endif
                @endif
                <h4 class="mt-2">{{$data['title']}}</h4>
                <p class=" text-muted mb-5 mt-3">{{$data['description']}}</p>
                <div class=" d-flex justify-content-between">
                <p class="text-muted">{{$data->updated_at->format('d-m-Y')}}</p>
                <form action="{{route('post#edit',$data['id'])}}" method="get">
                    @csrf
                    <input type="submit" value="edit" class="btn btn-small btn-dark float-end mb-3">
                </form>
            </div>
            </div>
        </div>

    </div>
</div>
@endsection

