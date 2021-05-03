@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\BlogPost $item */
    @endphp
        @include('blog.admin.posts.includes.result_messages')
    <div class="container">

    @if($item->exists)

        <form method="post" action="{{ route('blog.admin.posts.update', $item->id) }}">
            @method('PATCH')
            @else
                <form method="post" action="{{ route('blog.admin.posts.store') }}">
                    @endif


                    @if ($errors->any())
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-danger" role="alert">
                                    <button class="close" type="button" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">
                            x
                        </span>
                                    </button>
                                    {{ $errors->first() }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success" role="alert">
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        </div>
                    @else
                    @endif

                    @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('blog.admin.posts.includes.post_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('blog.admin.posts.includes.post_edit_add_col')
                            </div>
                        </div>
                </form>
        @if($item->exists)
                    <br>
                    <form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
                        @method('DELETE')
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card card-block">
                                    <div class="card-body ml-auto">
                                        <button type="submit" class="btn btn-link">
                                            Удалить
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                    </form>
        @endif


</div
@endsection
