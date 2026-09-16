<div class="space-y-6">

    {{-- Peringatan jika belum ada mood --}}
    @if ($moods->isEmpty())

        <div class="rounded-3xl border border-[#e8a87c] bg-[#f6e6da] px-5 py-4 text-[#9b4d2c]">

            <p class="font-semibold">
                Belum ada mood tersedia.
            </p>

            <p class="mt-1 text-sm">
                Produk wajib memiliki mood.
                Silakan tambahkan mood terlebih dahulu.
            </p>

            <a href="{{ route('admin.moods.create') }}" class="mt-3 inline-block rounded-full bg-[#c46b3c] px-5 py-2 text-sm font-semibold text-white transition hover:bg-[#a9542d]">
                Tambah Mood
            </a>

        </div>

    @endif


    {{-- Nama Produk --}}
    <div>

        <label for="name" class="block text-sm font-semibold text-[#2d1b14]">
            Nama Produk
        </label>

        <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Contoh: Choco Calm" class="mt-2 block w-full rounded-2xl border-[#e4d3c6] bg-[#fffaf6] shadow-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>

        @error('name')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Mood --}}
    <div>

        <label for="mood_id" class="block text-sm font-semibold text-[#2d1b14]">
            Mood
        </label>

        <select name="mood_id" id="mood_id" class="mt-2 block w-full rounded-2xl border-[#e4d3c6] bg-[#fffaf6] shadow-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>

            <option value="">
                -- Pilih Mood --
            </option>

            @foreach ($moods as $mood)

                <option value="{{ $mood->id }}" @selected(old('mood_id', $product->mood_id ?? '') == $mood->id)>
                    {{ $mood->icon }} {{ $mood->name }}
                </option>

            @endforeach

        </select>

        @error('mood_id')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Deskripsi --}}
    <div>

        <label for="description" class="block text-sm font-semibold text-[#2d1b14]">
            Deskripsi
        </label>

        <textarea name="description" id="description" rows="4" placeholder="Ceritakan tentang produk ini...">{{ old('description', $product->description ?? '') }}</textarea>

        @error('description')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Harga & Stok --}}
    <div class="grid gap-6 sm:grid-cols-2">

        {{-- Harga --}}
        <div>

            <label for="price" class="block text-sm font-semibold text-[#2d1b14]">
                Harga (Rp)
            </label>

            <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" min="0" step="500" placeholder="25000" class="mt-2 block w-full rounded-2xl border-[#e4d3c6] bg-[#fffaf6] shadow-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>

            @error('price')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Stok --}}
        <div>

            <label for="stock" class="block text-sm font-semibold text-[#2d1b14]">
                Stok
            </label>

            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0" class="mt-2 block w-full rounded-2xl border-[#e4d3c6] bg-[#fffaf6] shadow-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>

            @error('stock')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>


    {{-- Gambar --}}
    <div>

        <label for="image" class="block text-sm font-semibold text-[#2d1b14]">
            Gambar Produk
        </label>


        {{-- Preview gambar lama saat edit --}}
        @if (isset($product) && $product->image)

            <div class="mt-3 flex items-center gap-4">

                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-24 w-24 rounded-2xl object-cover">

                <p class="text-sm text-[#7d6559]">
                    Gambar saat ini.
                    <br>
                    Biarkan kosong jika tidak ingin mengganti.
                </p>

            </div>

        @endif


        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" class="mt-3 block w-full text-sm text-[#6b5145] file:mr-4 file:rounded-full file:border-0 file:bg-[#f6e6da] file:px-5 file:py-2.5 file:text-sm file:font-semibold file:text-[#9b4d2c] hover:file:bg-[#f1d2bc] file:cursor-pointer cursor-pointer" {{ isset($product) ? '' : 'required' }}>

        <p class="mt-2 text-sm text-[#7d6559]">
            Format JPG, PNG, atau WebP. Maksimal 2MB.
        </p>

        @error('image')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Status --}}
    <div>

        <label for="is_active" class="block text-sm font-semibold text-[#2d1b14]">
            Status
        </label>

        <select name="is_active" id="is_active" class="mt-2 block w-full rounded-2xl border-[#e4d3c6] bg-[#fffaf6] shadow-sm focus:border-[#c46b3c] focus:ring-[#c46b3c]" required>

            <option value="1" @selected(old('is_active', $product->is_active ?? 1) == 1)>
                Aktif
            </option>

            <option value="0" @selected(old('is_active', $product->is_active ?? 1) == 0)>
                Tidak Aktif
            </option>

        </select>

        <p class="mt-2 text-sm text-[#7d6559]">
            Produk tidak aktif tidak akan ditampilkan kepada pelanggan.
        </p>

        @error('is_active')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Tombol --}}
    <div class="flex flex-wrap items-center gap-3 pt-4">

        <button type="submit" class="rounded-full bg-[#c46b3c] px-7 py-3 font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#a9542d]">
            {{ $submitLabel }}
        </button>


        <a href="{{ route('admin.products.index') }}" class="rounded-full border border-[#d8c2b4] px-7 py-3 font-semibold text-[#2d1b14] transition hover:bg-[#f6e6da]">
            Batal
        </a>

    </div>

</div>