@extends('layouts.app')

@section('content')
    @php
    /** @var \App\Models\BlogCategory $item */
    /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    @if($item->exists)
        <form method="post" action="{{ route('blog.admin.categories.update', $item->id) }}">
            @method('PATCH')
            @else
                <form method="post" action="{{ route('blog.admin.categories.store') }}">
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.category.includes.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.category.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>



@endsection
