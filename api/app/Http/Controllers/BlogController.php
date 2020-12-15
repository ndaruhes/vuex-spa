<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            return Blog::latest()->get();
        } else if (Auth::user()->role == 'Member') {
            return Blog::where('user_id', '=', Auth::user()->id)->latest()->get();
        }
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
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'judul' => 'required|min:3',
                'content' => 'required|min:3'
            ],
            [
                'cover.required' => 'cover wajib diisi',
                'cover.image' => 'format yang diterima cuma jpeg, png, jpg, gif, svg',
                'judul.required' => 'Judul tidak boleh kosong',
                'judul.min' => 'Judul minimal 3 huruf',
                'content.required' => 'Content tidak boleh kosong',
                'content.min' => 'Content minimal 3 huruf',
            ]
        );
        // if ($validator->fails()) {
        //     // return response()->json([
        //     //     'error' => 'Harap isi data dengan benar',
        //     //     'data' => $validator->errors()
        //     // ], 400);
        //     // return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        // } 

        // try{
        //     $files = $request->file('cover');
        //     $filename = $files->getClientOriginalName();
        //     $Image = Str::random(10) . "-" . date('YmdHis') . "-" . $filename;
        //     $files->storeAs('public/images/blogs', $Image);

        //     $path = public_path('storage/images/blogs/' . $Image);
        //     $img = Image::make($path)->resize(300, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        //     $img->save($path);

        //     Blog::create([
        //         'cover' => $Image,
        //         'judul' => $request->judul,
        //         'content' => $request->content,
        //         'user_id' => Auth::user()->id
        //     ]);
        //     $response = [
        //         'message' => 'Blog berhasil ditambah'
        //     ];

        //     return response()->json($response, Response::HTTP_CREATED);
        // }catch(QueryException $e){
        //     return response()->json([
        //         'message' => 'Failed '.$e->errorInfo
        //     ]);
        // }

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Harap isi data dengan benar',
                'data' => $validator->errors()
            ], 400);
        } else {
            $files = $request->file('cover');
            $filename = $files->getClientOriginalName();
            $Image = Str::random(10) . "-" . date('YmdHis') . "-" . $filename;
            $files->storeAs('public/images/blogs', $Image);

            $path = public_path('storage/images/blogs/' . $Image);
            $img = Image::make($path)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);

            Blog::create([
                'cover' => $Image,
                'judul' => $request->judul,
                'content' => $request->content,
                'user_id' => Auth::user()->id
            ]);

            return response()->json('Blog berhasil ditambah');
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'judul' => 'required|min:3',
                'content' => 'required|min:3'
            ],
            [
                // 'cover.required' => 'cover wajib diisi',
                'cover.image' => 'format yang diterima cuma jpeg, png, jpg, gif, svg',
                'judul.required' => 'Judul tidak boleh kosong',
                'judul.min' => 'Judul minimal 3 huruf',
                'content.required' => 'Content tidak boleh kosong',
                'content.min' => 'Content minimal 3 huruf',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Isi datany yg bener dong',
                'data' => $validator->errors()
            ], 400);
        } else {
            $files = $request->file('cover');
            $filename = $files->getClientOriginalName();
            $Image = Str::random(10) . "-" . date('YmdHis') . "-" . $filename;
            $files->storeAs('public/images/blogs', $Image);

            $path = public_path('storage/images/blogs/' . $Image);
            $img = Image::make($path)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);
            // dd($img);

            $blog = Blog::findOrFail($id);
            if (Storage::exists('public/images/blogs/' . $blog->cover)) {
                Storage::delete('public/images/blogs/' . $blog->cover);
            }
            $blog->update([
                'cover' => $Image,
                'judul' => $request->judul,
                'content' => $request->content
            ]);
            return response()->json('Blog berhasil diubah');
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            if (Storage::exists('public/images/blogs/' . $blog->cover)) {
                Storage::delete('public/images/blogs/' . $blog->cover);
            }
            $blog->delete();
            return response()->json('Blog Berhasil dihapus');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
