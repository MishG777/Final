@extends('layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="cox-header with-border">
            <h3 class="box-title">edit post</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{route('post.update', $post->id)}}">
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Post title</label>
                    <input type="text" class="form-control" placeholder="name" name="name" value="{{old('name', $post->name)}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Post text</label>
                    <input type="text" class="form-control" placeholder="text" name="text" value="{{old('text', $post->text)}}">
                </div>
{{--                <div class="input-group">--}}
{{--                    <div class="custom-file">--}}
{{--                        <input type="file" class="custom-file-input" name="image" value="{{old('image', $post->image)}}">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <input type="hidden" name="_token" id="csrf_token" value="{{csrf_token()}}">
            <div class="box-footer">title
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
