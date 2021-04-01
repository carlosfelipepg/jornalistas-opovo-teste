<?php

namespace App\Http\Controllers;

use App\Models\TipoNoticia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Noticia;
use Illuminate\Validation\ValidationException;

class NoticiaController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Criar uma notícia e gerar relação com o jornalista e tipo notícia
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'corpo' => 'required|string',
            'imagem' => 'string',
            'id_tipo_noticia' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tipo_noticia = TipoNoticia::find($request['id_tipo_noticia']);

        if(!$tipo_noticia) {
            return response()->json([
                'error'   => 'Tipo notícia não encontrado',
            ], 404);
        }

        $noticia = new Noticia();
        $noticia->fill(array_merge(
            $validator->validated(),
            ['jornalista_id' => $this->user['id']],
            ['tipo_noticia_id' => $tipo_noticia['id']]
        ));
        $noticia->save();

        return response()->json($noticia, 201);
    }

    /**
     * Atualizar notícia criada
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $noticia = Noticia::find($id);

        if(!$noticia) {
            return response()->json([
                'error'   => 'Record not found',
            ], 404);
        }

        $tipo_noticia = TipoNoticia::find($request['id_tipo_noticia']);

        if(!$tipo_noticia) {
            return response()->json([
                'error'   => 'Tipo notícia não encontrado',
            ], 404);
        }

        $noticia->fill(array_merge(
            $request->all(),
            ['tipo_noticia_id' => $tipo_noticia['id']]
        ));
        $noticia->save();

        return response()->json($noticia);
    }

    /**
     * Deletar notícia criada
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $noticia = Noticia::find($id);

        if(!$noticia) {
            return response()->json([
                'error'   => 'Record not found',
            ], 404);
        }

        $noticia->delete();

        return response()->json(['message' => 'Deletado']);
    }

    /**
     * Listar notícias do jornalista autenticado
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $noticias = Noticia::with(['jornalista', 'tipo_noticia'])
            ->where('jornalista_id', $this->user['id'])
            ->get();
        return response()->json($noticias);
    }

    /**
     * Listar notícias filtrado pelo tipo
     *
     * @param $id_tipo_noticia
     * @return JsonResponse
     */
    public function typeShow($id_tipo_noticia): JsonResponse
    {
        $tipo_noticia = TipoNoticia::find($id_tipo_noticia);

        if(!$tipo_noticia) {
            return response()->json([
                'error'   => 'Tipo noticia não existe',
            ], 404);
        }

        $noticias = Noticia::with(['jornalista', 'tipo_noticia'])
            ->where([
                ['jornalista_id', $this->user['id']],
                ['tipo_noticia_id', $tipo_noticia['id']]
            ])
            ->get();
        return response()->json($noticias);
    }
}
