<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('author')->latest()->paginate(5);

        return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function order()
    {
        $books = Book::latest()->where('quantity', '<=', 0)->paginate(5);

        return view('books.order', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|min:5|max:25',
           'pages' => 'required|integer|gt:0|lt:1000',
           'quantity' => 'required|integer|gte:0|lt:100',
           'author_id' => 'nullable|integer|exists:authors,id'
        ]);

        // $book = new Book();
        // $book->title = $request->title;
        // $book->pages = $request->pages;
        // $book->quantity = $request->quantity;
        // $book->save();
        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success','Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::where('id', $id)->firstOrFail();
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
           'title' => 'required|min:5|max:25',
           'pages' => 'required|integer|gt:0|lt:1000',
           'quantity' => 'required|integer|gte:0|lt:100',
           'author_id' => 'nullable|integer|exists:authors,id'
        ]);
        
        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }
}
