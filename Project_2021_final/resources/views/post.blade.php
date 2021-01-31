@extends('layouts.app')
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="p-6 post">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a>author: {{$post->user->name}}</a>
                                </div>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="{{route('post.show', $post->id)}}" class="underline text-gray-900 dark:text-white">
                                        name: {{$post->name}}
                                    </a>
                                    @foreach($post->tags as $tag)
                                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                            <a href="{{route('tag', $tag->id)}}" class="underline text-gray-900 dark:text-white">
                                                {{$tag->tag}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="{{route('post.edit', $post->id)}}" class="underline text-gray-900 dark:text-white">
                                        <i class="fa fa-pencil-scuare">edit</i>
                                    </a>
                                </div>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <button type="submit" class="fa fa-trash btn-delete" url="{{route('post.delete',$post->id)}}"></button>
                                </div><br>
                                <div>
                                    <a  href="{{route('post.show', $post->id)}}">
                                        @foreach(@json_decode($post->image, true) as $img)
                                            <img class="h-25 w-25"  src="{{asset('uploads/post/'.$img)}}" alt="">
                                        @endforeach
                                    </a>

                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    text: {{$post->text}}
                                </div>
                            </div>
                            <div class="ml-12">
                                @foreach($post->tags as $tag)
                                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                        {{$tag->name}}
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                @comments(['model' => $post])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
