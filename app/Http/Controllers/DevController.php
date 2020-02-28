<?php

namespace App\Http\Controllers;

use App\Http\Models\Devs;
use App\Http\Requests\ValidarDev;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devs = Devs::select()->with(['posts'])->get();

        //$devs = Devs::all();
        //$devs->makeHidden(['updated_at']);
        ////    $devs->makeVisible(['created_at']);

        return $devs;
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
    public function store(ValidarDev $request)
    {
        /* anteriormente fazia a requisicao direta agora utiliza a classe de validaçao */
        // $json = request()->json()->all();
        // $json = $request->json()->all();
        $json = $request->only(['nome', 'github_username']);
        $json_post = $request->only(['post']);
        //DB::enableQueryLog();
        //dd($json_post);
        $devs = Devs::create($json);
        /*['nome' => 'Douglas','github_username' => 'douglas.datamais']);*/
        //$devs->posts()->create($json_post['post']);
        $devs->posts()->createMany($json_post['post']);

        $devs->save();
        return $devs;
        // dd(DB::getQueryLog());
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
    public function update(ValidarDev $request, $id)
    {
        //     $json = request()->json()->all();
        //$json = request()->only(['nome','github_username']);
        $json = $request->only(['nome', 'github_username']);
        //dd(request()->json());
        //dd(request();
        $devs = Devs::find($id);
        if (!$devs) {
            return response()->json(['error' => 'No exists'], 404);
        }

        $devs->posts()->createMany([
            ['titulo' => 'Titulo de alt', 'descricao' => 'descricao1'],
            ['titulo' => 'Titulo de alt2', 'descricao' => 'descricao2'],
        ]);
        $devs->update($json);
        $devs->save();
        //  return $devs;
        return response()->json([$devs, 210]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devs = Devs::find($id);
        if (!$devs) {
            return response()->json(['error' => 'No exists'], 404);
        }
        try {
            $devs->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::alert($e->getTraceAsString());

            return response()->json(['error' => 'Não foi possível remover o registro'], 500);
        }
        //return $devs;
        return response()->json(['Ok' => 'registro apagado com sucesso'], 200);
    }
}
