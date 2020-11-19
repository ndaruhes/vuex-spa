<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::latest()->get();
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json(compact('blog'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required|min:3',
                'content' => 'required|min:3'
            ],
            [
                'judul.required' => 'Judul tidak boleh kosong',
                'judul.min' => 'Judul minimal 3 huruf',
                'content.required' => 'Content tidak boleh kosong',
                'content.min' => 'Content minimal 3 huruf',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Harap isi data dengan benar',
                'data' => $validator->errors()
            ], 400);
        } else {
            Blog::create([
                'judul' => $request->judul,
                'content' => $request->content
            ]);

            return response()->json('Blog berhasil ditambah');
        }
    }

    public function destroy($id)
    {
        Blog::where('id', '=', $id)->delete();
        return response()->json('Blog Berhasil dihapus');
    }
}
