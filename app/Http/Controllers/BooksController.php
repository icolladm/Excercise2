<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Books::all();

        return view('viewbooks', [ 'books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('createbooks');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $book = new Books([
            'title' => $request->title,
            'author' => $request->author,
            'publish_year' => $request->publish_year,
            'genre' => $request->genre,
            'available' => $request->available,
        ]);

        $book->save();

        $books = Books::all();

        return view('viewbooks', ['books' => $books]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Books::find($id);

        return view('viewonebook', ['book' => $book]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Books::find($id);

        return view('editbooks', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $book = Books::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publish_year = $request->publish_year;
        $book->genre = $request->genre;
        $book->available = $request->available;

        $book->save();

        $books = Books::all();

        return view('viewbooks', ['books' => $books]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Books::destroy($id);

        return view('welcome');
    }

}
