<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= DB::table('category')->get();
        return $categories;
    }

    public function categoryHome()
    {
        $categories= DB::table('category')->get();
        return $categories;
    }

    public function booksInCategory(Request $request)
    {
        $id = $request->categoryId;
        $name = DB::table('category')->where('id', $id)->select('name')->get();
        $books = DB::table('book_category')
        ->join('book', 'book.id', '=', 'book_category.book_id')
        ->join('book_profile', 'book_profile.book_id', '=', 'book_category.book_id')
        ->where('book_category.category_id', $id)
        ->select( 'book.id','book.name','book_profile.pic')
        ->paginate(10);

        return response()->json([
            'success' => true,
            'name' => $name,
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $name = $request->name;

        $category = DB::table('category')
            ->insert([
                'name' => $name,
                'created_at' =>\Carbon\Carbon::now()->toDateTimeString()
            ]);
        return response()->json([
            'success' => true,
            'data' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
