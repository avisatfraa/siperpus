<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Bookshelf;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $bookshelf = Bookshelf::where('code', $row['kode_rak'])->first();
        return new Book([
            'title' => $row['judul'],
            'author' => $row['penulis'],
            'year' => $row['tahun'],
            'publisher' => $row['penerbit'],
            'city' => $row['kota'],
            'quantity' => $row['kuantitas'],
            'bookshelf_id' => $bookshelf->id,
        ]);
    }
}
