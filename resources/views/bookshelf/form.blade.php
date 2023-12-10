<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             {{ __('Book') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ isset($bookshelf->id) ? route('bookshelf.update', $bookshelf->id) : route('bookshelf.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @if(isset($bookshelf->id))
                            @method('PATCH')
                        @endif

                        <div class="max-w-xl">
                            <x-input-label class="mb-3" for="code" value="Kode Rak Buku" />
                            <x-text-input id="code" type="text" name="code" class="mt-1 block w-full" value="{{ $bookshelf->code ?? old('code') }}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label class="mb-3" for="name" value="Nama Rak Buku" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{  $bookshelf->name ?? old('name')}}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="flex gap-3 pt-7">
                            <x-secondary-button tag="a" href="{{ route('bookshelf.index') }}">Cancel</x-secondary-button>
                            @if(!isset($bookshelf->id))
                                <x-primary-button name="save_and_create" value="true">Save & Create Another</x-primary-button>
                            @endif

                            <x-primary-button name="save" value="true">{{isset($bookshelf->id) ? 'Update' : 'Save'}}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
