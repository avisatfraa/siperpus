<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Support\Facades\Storage;
use PDF;

class BookController extends Controller
{
    public function index()
    {
        $data['books'] = Book::with('bookshelf')->get();
        return view('book.index', $data);
    }

    public function create()
    {
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('book.form', $data);
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:75',
            'quantity' => 'required|numeric',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);

        if ($req->hasFile('cover')) {
            $path = $req->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_'.time() . '.' . $req->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        Book::create($validated);
        $notification = array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if($req->save == true) {
            return redirect()->route('book.index')->with($notification);
        } else {
            return redirect()->route('book.create')->with($notification);
        }
    }

    public function edit(String $id)
    {
        $data['book'] = Book::findOrFail($id);
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');

        return view('book.form', $data);
    }

    public function update(Request $req, String $id)
    {
        $book = Book::find($id);
        $validated = $req->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:75',
            'quantity' => 'required|numeric',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);

        if ($req->hasFile('cover')) {
            if($book->cover !== null){
                Storage::delete('public/cover_buku/'.$req->old_cover);
            }

            $path = $req->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_'.time() . '.' . $req->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        Book::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data buku berhasil diperbaharui',
            'alert-type' => 'success'
        );

        return redirect()->route('book.index')->with($notification);
    }

    public function delete(String $id)
    {
        $book = Book::findOrFail($id);

        Storage::delete('public/cover_buku/'.$book->cover);
        $book->delete();

        $notification = array(
            'message' => 'Data buku berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('book')->with($notification);
    }

    public function print()
    {
        $books = Book::all();
        $pdf = PDF::loadview('book.print', ['books' => $books]);
        return $pdf->download('data_buku.pdf');
    }
}
