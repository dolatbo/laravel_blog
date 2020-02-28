<?php

namespace App\Http\Controllers;

use App\Http\Models\Posts;
use App\Http\Requests\ValidarPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        // $posts->makeHidden(['updated_at']);
        // $posts->makeVisible(['created_at']);
        return $posts;
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
        $json = $request->json()->all();
        $posts = Posts::create($json);
        $posts->save();
        return $posts;
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
    public function update(ValidarPost $request, $id)
    {
        $json = $request->only(['titulo', 'descricao']);
        $posts = Posts::find($id);
        if (!$posts) {
            return response()->json(['error' => 'No exists'], 404);
        }
        $posts->update($json);
        $posts->save();
        //  return $posts;
        return response()->json([$posts, 210]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::find($id);
        if (!$posts) {
            return response()->json(['error' => 'No exists'], 404);
        }
        $posts->delete();
        //return $posts;
        return response()->json(['Ok' => 'registro apagado com sucesso'], 200);
    }
}
