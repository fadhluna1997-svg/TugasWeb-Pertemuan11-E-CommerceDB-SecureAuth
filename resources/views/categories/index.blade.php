<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('categories.create') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded">
                    + Tambah Kategori
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="p-4 text-left">Nama</th>
                            <th class="p-4 text-left">Deskripsi</th>
                            <th class="p-4 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b">
                                <td class="p-4">{{ $category->name }}</td>
                                <td class="p-4">{{ $category->description ?? '-' }}</td>
                                <td class="p-4">
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="text-blue-600 mr-3">
                                        Edit
                                    </a>

                                    <form action="{{ route('categories.destroy', $category) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600"
                                                onclick="return confirm('Hapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-4 text-center">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</x-app-layout>