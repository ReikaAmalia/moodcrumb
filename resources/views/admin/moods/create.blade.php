@extends('admin.layouts.app')

@section('title', 'Add Mood')

@section('page-title', 'Add Mood')

@section('content')

    <div class="max-w-2xl">

        <div
            class="bg-white
            rounded-xl
            border border-gray-200
            p-6"
        >

            <form
                method="POST"
                action="{{ route('admin.moods.store') }}"
            >

                @csrf

                @include(
                    'admin.moods._form',
                    [
                        'submitLabel' => 'Save Mood',
                    ]
                )

            </form>

        </div>

    </div>

@endsection