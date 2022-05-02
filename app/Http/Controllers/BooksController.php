<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((!$request->author) || (!$request->country) || (!$request->language) || (!$request->link1) || (!$request->link2) || (!$request->pages) || (!$request->title) ||
            (!$request->year) || (!$request->descr) || (!$request->imageLink)
        ) {
            $response = Response::json([
                'message' => 'Tutti i campi sono obbligatori!'
            ], 422);
            return $response;
        }
        $book = new Book(array(
            'author' => trim($request->author),
            'country' => trim($request->country),
            'language' => trim($request->language),
            'link1' => trim($request->link1),
            'link2' => trim($request->link2),
            'pages' => trim($request->pages),
            'title' => trim($request->title),
            'year' => trim($request->year),
            'descr' => trim($request->descr),
            'imageLink' => trim($request->imageLink)
        ));
        $book->save();
        $message = 'Il tuo libro è stato aggiunto con successo!';

        $response = Response::json([
            'message' => $message,
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return Response::json([
                'error' => [
                    'message' => 'Non riesco a trovare il libro!'
                ]
            ], 404);
        }
        return Response::json($book, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((!$request->author) || (!$request->country) || (!$request->language) || (!$request->link1) || (!$request->link2) || (!$request->pages) || (!$request->title) ||
            (!$request->year) || (!$request->descr) || (!$request->imageLink)
        ) {
            $response = Response::json([
                'message' => 'Tutti i campi sono obbligatori!'
            ], 422);
            return $response;
        }

        $book = Book::find($id);
        if (!$book) {
            return Response::json([
                'message' => 'Ops. Non trovo il libro!'
            ], 404);
        }
        $book->author = trim($request->author);
        $book->country = trim($request->country);
        $book->language = trim($request->language);
        $book->link1 = trim($request->link1);
        $book->link2 = trim($request->link2);
        $book->pages = trim($request->pages);
        $book->title = trim($request->title);
        $book->year = trim($request->year);
        $book->descr = trim($request->descr);
        $book->imageLink = trim($request->imageLink);
        $book->save();

        $message = 'Il tuo libro è stato modificato con successo!';

        $response = Response::json([
            'message' => $message,
            'data' => $book
        ], 201);

        return $response;
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
        if (!$book) {
            return Response::json([
                'error' => [
                    'message' => 'Ops. Non trovo il libro!'
                ]
            ], 404);
        }
        $book->delete();

        $message = 'Il libro è stato eliminato con successo!';

        $response = Response::json([
            'message' => $message
        ], 201);
        return $response;
    }
}
