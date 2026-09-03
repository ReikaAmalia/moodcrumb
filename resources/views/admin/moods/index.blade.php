@extends('admin.layouts.app')

@section('title', 'Mood Management')

@section('page-title', 'Mood Management')

@section('content')

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-lg font-semibold text-gray-900">
                Mood List
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Manage available moods for MoodCrumb products.
            </p>

        </div>


        <a
            href="{{ route('admin.moods.create') }}"
            class="inline-flex items-center px-4 py-2
            bg-gray-900 text-white
            rounded-lg
            hover:bg-gray-800"
        >
            Add Mood
        </a>

    </div>


    <div
        class="bg-white
        rounded-xl
        border border-gray-200
        overflow-hidden"
    >

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">

                <tr>

                    <th
                        class="px-6 py-3 text-left
                        text-xs font-medium
                        text-gray-500 uppercase"
                    >
                        Icon
                    </th>


                    <th
                        class="px-6 py-3 text-left
                        text-xs font-medium
                        text-gray-500 uppercase"
                    >
                        Name
                    </th>


                    <th
                        class="px-6 py-3 text-left
                        text-xs font-medium
                        text-gray-500 uppercase"
                    >
                        Slug
                    </th>


                    <th
                        class="px-6 py-3 text-left
                        text-xs font-medium
                        text-gray-500 uppercase"
                    >
                        Description
                    </th>


                    <th
                        class="px-6 py-3 text-right
                        text-xs font-medium
                        text-gray-500 uppercase"
                    >
                        Action
                    </th>

                </tr>

            </thead>


            <tbody
                class="bg-white divide-y divide-gray-200"
            >

                @forelse ($moods as $mood)

                    <tr>

                        {{-- Icon --}}
                        <td
                            class="px-6 py-4
                            whitespace-nowrap
                            text-2xl"
                        >
                            {{ $mood->icon ?? '😊' }}
                        </td>


                        {{-- Name --}}
                        <td
                            class="px-6 py-4
                            whitespace-nowrap"
                        >

                            <span
                                class="font-medium text-gray-900"
                            >
                                {{ $mood->name }}
                            </span>

                        </td>


                        {{-- Slug --}}
                        <td
                            class="px-6 py-4
                            whitespace-nowrap
                            text-sm text-gray-500"
                        >
                            {{ $mood->slug }}
                        </td>


                        {{-- Description --}}
                        <td
                            class="px-6 py-4
                            text-sm text-gray-600"
                        >
                            {{ $mood->description ?? '-' }}
                        </td>


                        {{-- Action --}}
                        <td
                            class="px-6 py-4
                            whitespace-nowrap
                            text-right
                            text-sm"
                        >

                            <a
                                href="{{ route(
                                    'admin.moods.edit',
                                    $mood
                                ) }}"
                                class="text-blue-600
                                hover:text-blue-800
                                mr-4"
                            >
                                Edit
                            </a>


                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.moods.destroy',
                                    $mood
                                ) }}"
                                class="inline"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600
                                    hover:text-red-800"
                                    onclick="
                                        return confirm(
                                            'Are you sure you want to delete this mood?'
                                        )
                                    "
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-12
                            text-center text-gray-500"
                        >

                            No mood data available.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

@endsection