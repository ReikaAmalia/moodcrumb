@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('page-title', 'Edit Produk')

@section('content')

    <div class="max-w-3xl">

        <div
            class="bg-white
            rounded-3xl
            border border-[#eadfd6]
            p-8"
        >

            <form
                method="POST"
                action="{{ route(
                    'admin.products.update',
                    $product
                ) }}"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')

                @include(
                    'admin.products._form',
                    [
                        'product' => $product,
                        'submitLabel' => 'Perbarui Produk',
                    ]
                )

            </form>

        </div>

    </div>

@endsection