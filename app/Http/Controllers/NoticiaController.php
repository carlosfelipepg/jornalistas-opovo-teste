<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Noticia;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function me()
    {
        $user = auth()->user();

        $noticias = Noticia::with('jornalista')
            ->where('jornalista_id', $user['id'])
            ->get();
        return response()->json($noticias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = auth()->user();

        if(!$user) {
            return response()->json(['Usuário não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'corpo' => 'required|string',
            'imagem' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $noticia = new Noticia();
        $noticia->fill(array_merge(
            $validator->validated(),
            ['jornalista_id' => $user['id']]
        ));
        $noticia->save();

        return response()->json($noticia, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $noticia = Noticia::find($id);

        if(!$noticia) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $noticia->fill($request->all());
        $noticia->save();

        return response()->json($noticia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);

        if(!$noticia) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $noticia->delete();

        return response()->json('Deletado');
    }
}
