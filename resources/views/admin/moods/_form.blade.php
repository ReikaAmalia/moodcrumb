<div class="space-y-6">

    {{-- Name --}}
    <div>

        <label
            for="name"
            class="block text-sm font-medium text-gray-700"
        >
            Mood Name
        </label>

        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $mood->name ?? '') }}"
            class="mt-2 block w-full
            rounded-lg
            border-gray-300
            shadow-sm
            focus:border-gray-900
            focus:ring-gray-900"
            required
        >

        @error('name')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Icon --}}
    <div>

        <label
            for="icon"
            class="block text-sm font-medium text-gray-700"
        >
            Icon
        </label>

        <input
            type="text"
            name="icon"
            id="icon"
            value="{{ old('icon', $mood->icon ?? '') }}"
            placeholder="😊"
            class="mt-2 block w-full
            rounded-lg
            border-gray-300
            shadow-sm
            focus:border-gray-900
            focus:ring-gray-900"
        >

        <p class="mt-2 text-sm text-gray-500">
            Example: 😊 😢 😍 😌
        </p>

        @error('icon')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Description --}}
    <div>

        <label
            for="description"
            class="block text-sm font-medium text-gray-700"
        >
            Description
        </label>

        <textarea
            name="description"
            id="description"
            rows="4"
            class="mt-2 block w-full
            rounded-lg
            border-gray-300
            shadow-sm
            focus:border-gray-900
            focus:ring-gray-900"
        >{{ old('description', $mood->description ?? '') }}</textarea>

        @error('description')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Button --}}
    <div
        class="flex items-center gap-3 pt-4"
    >

        <button
            type="submit"
            class="px-5 py-2.5
            bg-gray-900
            text-white
            rounded-lg
            hover:bg-gray-800"
        >
            {{ $submitLabel }}
        </button>


        <a
            href="{{ route('admin.moods.index') }}"
            class="px-5 py-2.5
            border border-gray-300
            text-gray-700
            rounded-lg
            hover:bg-gray-50"
        >
            Cancel
        </a>

    </div>

</div>