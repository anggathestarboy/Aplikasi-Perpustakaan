<?php

// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    // Menambah buku baru (untuk admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'stock' => 'required|integer|min:1',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    // Mengupdate data buku (untuk admin)
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->all());

        return response()->json($book);
    }

    // Menghapus buku (untuk admin)
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}

