@extends('layouts.app')
@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            @foreach($user->posts as $post)
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
                            <a  href="{{route('post.show', $post->id)}}" >
                                @foreach(@json_decode($post->image, true) as $img)
                                    <img class="h-25 w-25" src=" {{asset('uploads/post/'.$img)}}" alt="">
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
                </div>
            @endforeach
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.btn-delete', function (e){
                e.preventDefault();
                $this=$(this);
                $.ajax({
                    type: 'DELETE',
                    url: $this.attr('url'),
                    success: function (){
                        $this.closest('.post').remove()
                    }
                });
            });

        });

    </script>
@endsection
