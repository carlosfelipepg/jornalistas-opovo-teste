<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\TipoNoticia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TipoNoticiaController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Criar um novo tipo de notícia
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tipo_noticia = new TipoNoticia();
        $tipo_noticia->fill(array_merge(
            $validator->validated(),
            ['jornalista_id' => $this->user['id']]
        ));
        $tipo_noticia->save();

        return response()->json($tipo_noticia, 201);
    }

    /**
     * Atualizar tipo notícia
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $tipo_noticia = TipoNoticia::find($id);

        if(!$tipo_noticia) {
            return response()->json([
                'error'   => 'Record not found',
            ], 404);
        }

        $tipo_noticia->fill($request->all());
        $tipo_noticia->save();

        return response()->json($tipo_noticia);
    }

    /**
     * Deletar tipo notícia
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $tipo_noticia = TipoNoticia::find($id);

        if(!$tipo_noticia) {
            return response()->json([
                'error'   => 'Record not found',
            ], 404);
        }

        $noticia = Noticia::where('tipo_noticia_id', $id)->count();

        if($noticia){
            return response()->json([
                'error'   => 'Existe notícias com esse tipo',
            ], 406);
        }
        $tipo_noticia->delete();

        return response()->json([
            'message' => 'Tipo notícia deletado']
        );
    }

    /**
     * Listar todos os tipos de notícias do jornalista
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $tipo_noticias = TipoNoticia::with('jornalista')
            ->where('jornalista_id', $this->user['id'])
            ->get();
        return response()->json($tipo_noticias);
    }
}
