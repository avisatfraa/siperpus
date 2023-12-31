<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bookshelves') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm-px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-10">
                        <form action="{{route('bookshelf.index')}}" class="w-1/2">
                                <div class="flex items-center gap-3">
                                <x-input-label for="search" value="Cari Rak Buku" />
                                <x-text-input
                                    id="search" type="text" name="search" class="mt-1 block w-1/2"
                                    value="{{ $search }}"
                                    placeholder="Cari kode atau nama rak buku..."
                                />
                                <x-primary-button>Cari</x-primary-button>
                            </div>
                        </form>

                        <div class="flex gap-3">
                            <x-primary-button class="h-9" tag="a" href="{{route('bookshelf.create')}}">
                                <span class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                    </svg>
                                </span>
                                Tambah
                            </x-primary-button>
                            <x-primary-button class="h-9" tag="a" href="{{ route('bookshelf.print')}}" target='blank'>
                                <span class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                    </svg>
                                </span>
                                Cetak
                            </x-primary-button>
                            <x-primary-button class="h-9" tag="a" href="{{ route('bookshelf.export')}}" target="_blank">
                                <span class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                        <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg>
                                </span>
                                Export
                            </x-primary-button>
                            <x-primary-button class="h-9" x-data="" x-on:click.prevent="$dispatch('open-modal', 'import-book')">
                                <span class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                        <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg>
                                </span>
                                Import
                            </x-primary-button>
                        </div>
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr>
                                <th>#</th>
                                <th>Kode Rak</th>
                                <th>Nama Rak</th>
                                <th>Jumlah Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot>

                        @php $num=1; @endphp
                        @foreach($bookshelves as $bookshelf)
                        <tr>
                            <td>{{ $num++ }} </td>
                            <td>{{ $bookshelf->code }}</td>
                            <td>{{ $bookshelf->name }}</td>
                            <td>{{ $bookshelf->books->count() }}</td>
                            <td>
                                <div class="flex gap-3">
                                    <x-primary-button class="h-9" tag="a" href="{{route('book.index', ['bookshelf' => $bookshelf->code])}}">Lihat Daftar Buku</x-primary-button>
                                    <x-primary-button class="h-9" tag="a" href="{{route('bookshelf.edit', $bookshelf->id)}}">Edit</x-primary-button>

                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-bookshelf-deletion')"
                                        x-on:click="$dispatch('set-action', '{{route('bookshelf.delete', $bookshelf->id) }}')">
                                        {{__('Delete') }}
                                    </x-danger-button>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </x-table>

                    <x-modal name="confirm-bookshelf-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @csrf
                            @method('delete')
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    Batal
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    Ya, Hapus
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal name="import-book" focusable maxWidth="xl">
                        <form method="post" action="{{ route('bookshelf.import') }}" class="p-6" enctype="multipart/form-data">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5">
                                {{ __('Import Data Rak Buku') }}
                            </h2>
                            <div class="max-w-xl">
                                <x-input-label for="cover" class="sr-only" value="FileImport"/>
                                <x-file-input id="cover" name="file" class="mt-1 block wfull" required/>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="h-9" class="ml-3">
                                    {{ __('Upload') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
