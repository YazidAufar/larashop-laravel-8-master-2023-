<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\BookCollection as BookCollectionResource;
use App\Http\Resources\Books as BookResourceCollection;

class APIBookController extends Controller
{
    public function cetak($judul)
    {
        return $judul;
    }

    public function index()
    {
        // $books = DB::select('select * from books');
        $books = new BookCollectionResource(Book::paginate());
        return $books;
    }

    public function view($id)
    {
        // $book = DB::select('select * from books where id = :id', ['id' => $id]);
        $book = new BookResource(Book::find($id));
        return $book;
    }

    public function top($count)
    {
        $criteria = Book::select('*')
            ->orderBy('views', 'DESC')
            ->limit($count)
            ->get();
        return new BookResourceCollection($criteria);
    }
}
