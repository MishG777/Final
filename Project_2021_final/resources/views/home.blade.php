@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <div>
                            <div>
                                <a>სახელი: {{$user->name}}</a>
                            </div>
                            <div>
                                <a>იმეილი: {{$user->email}}</a>
                            </div>
                            @foreach($user->posts as $post)
                                @if(Auth::user()->id==$post->user_id)
                                    <div class="mt-10"><br><br>
                                        <a>პოსტის სახელი: {{$post->name}}</a>
                                    </div>
                                    <div>
                                        <a>პოსტის ტექსტი: {{$post->text}}</a>
                                    </div>
                                    <div>
                                        <a  href="{{route('post.show', $post->id)}}" >
                                            @foreach(@json_decode($post->image, true) as $img)
                                                <img class="h-25 w-25" src="{{asset('uploads/post/'.$img)}}" alt="">
                                            @endforeach
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
