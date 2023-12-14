<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Book;

class Bookshelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name'
    ];

    public static function getDataBookshelves()
    {
        $booksshelf = Bookshelf::all();
        $booksshelf_filter = [];

        $no = 1;
        for ($i=0; $i < $booksshelf->count(); $i++) {
            $booksshelf_filter[$i]['no'] = $no++;
            $booksshelf_filter[$i]['code'] = $booksshelf[$i]->code;
            $booksshelf_filter[$i]['name'] = $booksshelf[$i]->name;
        }
        return $booksshelf_filter;
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
