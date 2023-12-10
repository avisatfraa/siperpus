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
                    <div class="flex justify-between mb-10">
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
                            <x-primary-button tag="a" href="{{route('bookshelf.create')}}">Tambah </x-primary-button>
                            <x-primary-button tag="a" href="{{ route('bookshelf.print')}}" target='blank'>Cetak</x-primary-button>
                            <x-primary-button tag="a" href="{{ route('bookshelf.export')}}" target="_blank">Export Excel</x-primary-button>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'import-book')">Import Excel</x-primary-button>
                        </div>
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr>
                                <th>#</th>
                                <th>Kode Rak</th>
                                <th>Nama Rak</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot>

                        @php $num=1; @endphp
                        @foreach($bookshelves as $bookshelf)
                        <tr>
                            <td>{{ $num++ }} </td>
                            <td>{{ $bookshelf->code }}</td>
                            <td>{{ $bookshelf->name }}</td>
                            <td>
                                <div class="flex gap-3">
                                    <x-primary-button tag="a" href="{{route('bookshelf.edit', $bookshelf->id)}}">Edit</x-primary-button>

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

                                <x-primary-button class="ml-3">
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
