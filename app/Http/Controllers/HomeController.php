<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  

        if (Auth::user()->hasRole('librarian')) {

            $totalBooks = Book::count();
            $totalBorrowedBooks = Borrow::where('returned_at', null)->count();
            $booksDueToday = Borrow::whereDate('due_at', Carbon::today())->count();
            
            $membersWithOverdueBooks = DB::table('borrows')
                ->join('users', 'borrows.user_id', '=', 'users.id')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->select('users.fullname as name',DB::raw('count(*) as overdueBooksCount'))
                ->where('borrows.due_at', '<', Carbon::today())
                ->where('borrows.returned_at', null)
                ->groupBy('users.fullname')
                ->get();

            return view('home', compact('totalBooks', 'totalBorrowedBooks', 'booksDueToday', 'membersWithOverdueBooks'));
        } elseif (Auth::user()->hasRole('member')) {

            $borrowedBooks = DB::table('borrows')
                ->join('users', 'borrows.user_id', '=', 'users.id')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->select('borrows.*', 'users.fullname as user_fullname', 'users.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn')
                ->where('borrows.user_id', '=', Auth::user()->id)
                ->get();
            $totalBorrowedBooks = ($borrowedBooks->count()) ? $borrowedBooks->count() : 0;

            $overdueBooks = DB::table('borrows')
                ->join('users', 'borrows.user_id', '=', 'users.id')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->select('borrows.*', 'users.fullname as user_fullname', 'users.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn')
                ->where('borrows.user_id', '=', Auth::user()->id)
                ->where('borrows.due_at', '<', Carbon::today())
                ->where('borrows.returned_at', null)
                ->get();

            $relationOverdueBooks = [
                'overdue' => ($overdueBooks->count()) ? $overdueBooks->count() : 0,
                'NotOverdue' => ($totalBorrowedBooks - $overdueBooks->count()) ? $totalBorrowedBooks - $overdueBooks->count() : 0
            ];

            $totalReturnedBooks = DB::table('borrows')
                ->join('users', 'borrows.user_id', '=', 'users.id')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->select('borrows.*')
                ->where('borrows.user_id', '=', Auth::user()->id)
                ->where('borrows.returned_at', '!=', null)
                ->get()
                ->count();

            return view('home', compact('borrowedBooks', 'totalBorrowedBooks', 'overdueBooks', 'relationOverdueBooks'));
        }
        

        // return view('home');
    }
}
