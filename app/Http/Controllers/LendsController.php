<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Lending;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LendsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $lends = Lending::all();

        return view('viewlends', [ 'lends' => $lends]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('createlends');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $book = Books::find($request-> book_id);

        if ($book-> available == 'yes'){
            $lend = new Lending([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'lending_date' => $request->lending_date,
                'recover_date' => $request->recover_date
            ]);

            $lend -> save();

            //Update Book
            $book -> available = 'false';
            $book -> save();

            $lends = Lending::all();

            return view('viewlends', [ 'lends' => $lends]);
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $lend = Lending::find($id);

        return view('viewonelend', ['lend' => $lend]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $lend = Lending::find($id);

        return view('editlends', ['lend' => $lend]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $lend = Lending::find($id);

        $lend -> recover_date = today();
        $lend -> save();

        $book = Books::find($lend -> book_id);
        $book -> available = 'yes';
        $book -> save();

        $lends = Lending::all();

        return view('viewlends', [ 'lends' => $lends]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Lending::destroy($id);

        return view('welcome');
    }
}
