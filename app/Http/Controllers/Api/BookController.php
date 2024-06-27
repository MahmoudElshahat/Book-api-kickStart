<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
   
    public function index()
    {
        try {

            $books = Book::select('title', 'author', 'price')->get();

            return Controller::success_response($books);
             
        } catch (Exception $e) {

            return Controller::error_response($e);

        }
    }

    // ********************************************
    // ********************************************

    public function show($id)
    {
        try {
            
            $books = Book::select('title', 'author', 'price', 'isbn')->find($id);
    
            if (!$books) {
                return Controller::error_message('Book not found',404);
            }
            
            return Controller::success_response($books);

        } catch (\Exception $e) {

            return Controller::error_exception($e,__class__);

        }
    }
    

    // ********************************************
    // ********************************************

   public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'isbn' => 'required|string|max:13|unique:books,isbn',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $books = Book::create($request->all());

            return  Controller::success_response($books,'Book added successfully');
            
        } catch (Exception $e) {

            return Controller::error_exception($e,__class__);
        }
    }

}
