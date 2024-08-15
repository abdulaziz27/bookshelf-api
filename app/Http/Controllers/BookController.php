<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::paginate(10);

        return response()->json($books, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'isbn' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'author' => 'nullable|string|max:255',
        'published' => 'nullable|string|max:255',
        'publisher' => 'nullable|string|max:255',
        'pages' => 'nullable|integer',
        'description' => 'nullable|string',
        'website' => 'nullable|string|max:255|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::create([
            'user_id' => Auth::id(),
            'isbn' => $request->isbn,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'author' => $request->author,
            'published' => $request->published,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'website' => $request->website,
        ]);

        return response()->json([
            'message' => 'Book created',
            'book' => $book,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => "No query results for model [App\\Models\\Book] $id"
            ], 404);
        }

        if ($book->user_id !== Auth::id()) {
            return response()->json([
                'message' => "This action is unauthorized."
            ], 403);
        }

        return response()->json($book, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => "No query results for model [App\\Models\\Book] $id"
            ], 404);
        }

        if ($book->user_id !== Auth::id()) {
            return response()->json([
                'message' => "This action is unauthorized."
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'isbn' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'author' => 'nullable|string',
            'published' => 'nullable|string',
            'publisher' => 'nullable|string',
            'pages' => 'nullable|integer',
            'description' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book->update($request->all());

        return response()->json([
            'message' => 'Book updated',
            'book' => $book,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => "No query results for model [App\\Models\\Book] $id"
            ], 404);
        }

        if ($book->user_id !== Auth::id()) {
            return response()->json([
                'message' => "This action is unauthorized."
            ], 403);
        }

        $deletedBook = $book->toArray();

        $book->delete();

        return response()->json([
            'message' => 'Book deleted',
            'book' => $deletedBook,
        ], 200);

    }
}

