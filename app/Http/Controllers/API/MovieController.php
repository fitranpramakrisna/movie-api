<?php

namespace App\Http\Controllers\API;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index() {

        $user_id = auth()->user()->id; 

        $data = Movie::where('user_id', $user_id)->get();

        if(count($data) == 0) {
            return response()->json([
                'message'=>'Belum ada list movie yang dibuat!',
         ], 200);
        }

         return response()->json([
                'message'=>'Success! Ini adalah halaman utama!',
                'data'=> $data
         ], 200);
    }

    public function show($id) {

        $data = Movie::find($id);

        
        if($data == null) {
            return response()->json([
                'message'=>'Data yang ditemukan tidak ada!',
         ], 404);
        }

         return response()->json([
                'message'=>'Success! Ini adalah halaman index',
                'data'=> $data
         ], 200);
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rating' => 'required|numeric|between:0,10',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $model = new Movie();

        $model->user_id = auth()->user()->id;
        $model->title = $request->title;
        $model->description = $request->description;
        $model->rating = $request->rating;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = strtolower(Str::random(10))  . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_img'), $imageName);
            $model->image = $imageName;
        }
        $model->save();

        return response()->json([
                'message'=>'Success! Data berhasil dibuat',
         ], 200);
    }

    public function update(Request $request, $id) {

        $model = Movie::find($id);

        $fillableColumns = ['title', 'description', 'rating', 'image'];

        $request->validate([
            'rating' => 'required|numeric|between:0,10',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ($fillableColumns as $column) {

        if ($request->has($column)) {
              if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = strtolower(Str::random(10))  . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploaded_img'), $imageName);
                $model->image = $imageName;
            }

          $model->$column = $request->input($column);
          }
    }    
        
          $model->update($request->all());
          return response()->json(['message' => 'Data update successfully'], 200);
        
        }
    

    public function destroy($id){
        $model = Movie::find($id);
        $model->delete();

        return response()->json([
                'message'=>'Success! Data berhasil dihapus',
         ], 200);
    }
}