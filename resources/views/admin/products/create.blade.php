@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('page-title', 'Tambah Produk')

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
                action="{{ route('admin.products.store') }}"
                enctype="multipart/form-data"
            >

                @csrf

                @include(
                    'admin.products._form',
                    [
                        'submitLabel' => 'Simpan Produk',
                    ]
                )

            </form>

        </div>

    </div>

@endsection