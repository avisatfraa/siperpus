<?php

namespace App\Exports;

use App\Models\Bookshelf;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BookshelvesExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return Bookshelf::getDataBookshelves();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Rak Buku',
            'Nama Rak Buku'
        ];
    }
}
