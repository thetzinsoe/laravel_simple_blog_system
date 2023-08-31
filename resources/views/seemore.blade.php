@extends('master')

@section('content')
{{-- @dd($data['description']) --}}
<div class="m-5">
    <div class="row">
        <div class="col-6 offset-3 shadow-sm">
            <div class="m-4">
                <a href="{{route('customer#create')}}" class=" text-decoration-none text-white btn btn-dark btn-sm">&lt; back</a>
                <h3 class="mt-3">{{$data['title']}}</h3>
                <p class=" text-muted">{{$data['description']}}</p>
                <form action="{{route('post#edit',$data['id'])}}" method="POST">
                    @csrf
                    <input type="submit" value="edit" class="btn btn-small btn-dark float-end mb-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

