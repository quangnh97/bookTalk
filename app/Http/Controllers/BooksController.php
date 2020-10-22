<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Response;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $book = DB::table('book')
            ->join('book_profile', 'book_profile.book_id', '=', 'book.id')
            ->where('book.id', $id)
            ->select( 'book.id','book.name','book.description','book_profile.pic', 'book_profile.author', 'book_profile.totalView','book_profile.fileName')
            ->get();

        $category = DB::table('book_category')
            ->join('category', 'category.id', '=', 'book_category.category_id')
            ->where('book_category.book_id', $id)
            ->select('category.name')
            ->get();

        return response()->json([
            'success' => true,
            'book' => $book,
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readOnline(Request $request)
    {
        $id = $request->id;
        $book = DB::table('book_profile')
            ->where('book_id', $id)
            ->select('fileName')
            ->get();
        return $book;
    }


    public function getDownload(Request $request)
    {
        $id = $request->id;
        $book = DB::table('book_profile')
            ->where('book_id', $id)
            ->select('fileName')
            ->get();
        Log::info($book[0]->fileName);
        $fileName = $book[0]->fileName;
        $file= public_path(). "/file/" . $fileName;
        Log::info($file);
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file,$fileName , $headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Log::info($request->pic);
//        $pic = $request->pic->getClientOriginalName();
        $imageData = base64_decode($request->pic);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('book')
            ->where('id', $id)
            ->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
