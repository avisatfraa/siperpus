<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bookshelf;
use App\Exports\BookshelvesExport;
use App\Imports\BookshelvesImport;

use PDF;
use Excel;

class BookshelfController extends Controller
{
    public function index(Request $req)
    {
        $data['bookshelves'] = Bookshelf::where('code', 'like', '%'.$req->search.'%')
            ->orWhere('name', 'like', '%'.$req->search.'%')
            ->get();
        $data['search'] = $req->search ?? '';
        return view('bookshelf.index', $data);
    }

    public function create()
    {
        return view('bookshelf.form');
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'code' => 'required|max:15|unique:bookshelves,code',
            'name' => 'required|max:255'
        ]);

        Bookshelf::create($validated);
        $notification = array(
            'message' => 'Data rak buku berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if($req->save == true) {
            return redirect()->route('bookshelf.index')->with($notification);
        } else {
            return redirect()->route('bookshelf.create')->with($notification);
        }
    }

    public function edit(String $id)
    {
        $data['bookshelf'] = Bookshelf::findOrFail($id);
        return view('bookshelf.form', $data);
    }

    public function update(Request $req, String $id)
    {
        $validated = $req->validate([
            'code' => 'required|max:15|unique:bookshelves,code,'.$req->code.',code',
            'name' => 'required|max:255'
        ]);

        Bookshelf::where('id', $id)->update($validated);
        $notification = array(
            'message' => 'Data rak buku berhasil diperbaharui',
            'alert-type' => 'success'
        );

        return redirect()->route('bookshelf.index')->with($notification);
    }

    public function delete(String $id)
    {
        $bookshelf = Bookshelf::findOrFail($id);
        $bookshelf->delete();

        $notification = array(
            'message' => 'Data rak buku berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('bookshelf.index')->with($notification);
    }

    public function print()
    {
        $bookshelves = Bookshelf::all();
        $pdf = PDF::loadview('bookshelf.print', ['bookshelves' => $bookshelves]);
        return $pdf->download('data_rak_buku.pdf');
    }

    public function export()
    {
        return Excel::download(new BookshelvesExport, 'bookshelves.xlsx');
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        Excel::import(new BookshelvesImport, $req->file('file'));

        $notification = array(
            'message' => 'Import data berhasil dilakukan',
            'alert-type' => 'success'
        );

        return redirect()->route('bookshelf.index')->with($notification);
    }
}
