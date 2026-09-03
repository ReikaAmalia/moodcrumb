@extends('admin.layouts.app')

@section('title', 'Edit Mood')

@section('page-title', 'Edit Mood')

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
                action="{{ route(
                    'admin.moods.update',
                    $mood
                ) }}"
            >

                @csrf

                @method('PUT')

                @include(
                    'admin.moods._form',
                    [
                        'mood' => $mood,
                        'submitLabel' => 'Update Mood',
                    ]
                )

            </form>

        </div>

    </div>

@endsection