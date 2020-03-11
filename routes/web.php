<?php

use App\Http\Models\Devs;
use App\Http\Models\Posts;

Route::get('/', function () {
    /* return view('welcome'); */
    $a = request('a');
    $a = request()->only(['a', 'b', 'c']);
    // dd($a); // echo $a;
    return  json_encode($a) . '<br> Home inicial - blog';
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('users/{id}/{nome}', function ($id, $nome) {
        return $id . ' ' . $nome;
    })->where(['id' => '[0-9]+', 'nome' => '[A-Za-z]+']);
    Route::post('devs', function () {
        return 'devs';
    });
    Route::match(['get', 'post'], 'devs2', function () {
        return 'devs';
    });
});

Route::get('dev', 'DevController@index');

Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('dev', 'DevController')->parameters(['dev' => 'id'])->except(['index']);
    Route::resource('dev-tech', 'DevTechsController')->parameters(['dev-tech' => 'id'])->middleware('dev-tech');
});

Route::resource('post', 'PostsController')->parameters(['post' => 'id']);

/* Rotinas abaixo ignoradas para utilizar o controller *?

/*Route::get('devs', function () {*/
Route::post('devs', function () {
    /* $json = request()->json()->all();
    DB::enableQueryLog();
    $devs = Devs::create($json); */
    /*[
       'nome' => 'Douglas',
       'github_username' => 'douglas.datamais']      
    ); 
    */
    /*
    $devs->save();
    dd(DB::getQueryLog()); */
});

Route::get('devs', function () {
    /* metodo inserido em controller */
    /*
    $devs = Devs::all();
    $devs->makeHidden(['updated_at']);
    //    $devs->makeVisible(['created_at']);
    return $devs;
    */
});

Route::put('devs/{id}', function ($id) {
    /* metodo inserido em controller */
    /*    $json = request()->json()->all();
    //$json = request()->only(['nome','github_username']);
    //dd(request()->json());
    //dd(request();
    $devs = Devs::find($id);
    if (!$devs) {
        return response()->json(['error' => 'No exists'], 404);
    }
    $devs->update($json);
    $devs->save();
    //  return $devs;
    return response()->json([$devs, 210]);
    */
});

Route::delete('devs/{id}', function ($id) {
    /* metodo inserido em controller */
    /* $devs = Devs::find($id);
    if (!$devs) {
        return response()->json(['error' => 'No exists'], 404);
    }
    $devs->delete();
    //return $devs;
    return response()->json(['Ok' => 'registro apagado com sucesso'], 200); */
});
