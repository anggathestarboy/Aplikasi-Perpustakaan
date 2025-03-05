<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    // Menangani peminjaman buku
    public function borrow(Request $request, $bookId)
    {
        // Validasi token, pastikan user sudah login
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validasi input
        $book = Book::find($bookId);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // Mengecek apakah stok buku masih ada
        if ($book->stock <= 0) {
            return response()->json(['message' => 'No stock available'], 400);
        }

        // Mengurangi stok buku
        $book->stock -= 1;
        $book->save();

        // Menetapkan waktu pengembalian (7 hari)
        $dueDate = Carbon::now()->addDays(7);

        // Mencatat peminjaman buku
        $borrowing = Borrowing::create([
            'book_id' => $book->id,
            'user_id' => $request->user()->id,
            'borrowed_at' => Carbon::now(),
            'due_at' => $dueDate,
        ]);

        return response()->json([
            'message' => 'Book borrowed successfully',
            'due_at' => $dueDate,
            'borrowing' => $borrowing
        ]);
    }

    // Menangani pengembalian buku
    public function returnBook(Request $request, $bookId)
    {
        // Pastikan pengguna telah login
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Mencari peminjaman buku berdasarkan bookId dan userId
        $borrowing = Borrowing::where('book_id', $bookId)
            ->where('user_id', $request->user()->id)
            ->whereNull('returned_at') // Pastikan buku belum dikembalikan
            ->first();

        // Jika peminjaman tidak ditemukan
        if (!$borrowing) {
            return response()->json(['message' => 'No active borrowing record found'], 404);
        }

        // Mencatat waktu pengembalian
        $borrowing->returned_at = Carbon::now();
        $borrowing->save();

        // Menambah stok buku setelah dikembalikan
        $book = Book::find($bookId);
        if ($book) {
            $book->stock += 1;
            $book->save();
        }

        return response()->json(['message' => 'Book returned successfully']);
    }
}
