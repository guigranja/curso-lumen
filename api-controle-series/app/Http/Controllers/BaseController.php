<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected $classe;

    public function index()
    {
        return $this->classe::all();
    }

    /*
     * Inseri uma nova series/episodios
     * Status 201 -> created (retorna status positivo e especifico para criado)
     * */
    public function store(Request $request)
    {
        return response()
            ->json(
                $this->classe::create($request->all()),
                201
            );
    }

    /*
     * Pegando uma serie/episodios pelo $id
     * Status 204 -> Requisição foi ok ! Porem o dado $id indormado, não foi encontrado
     * */
    public function getSerie(int $id)
    {
        $recurso = $this->classe::find($id);

        if (is_null($recurso)) {
            return \response()
                        ->json('', 204);
        }

        return response()
            ->json($recurso);
    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);

        if (is_null($recurso)) {
            return response()
                ->json([
                    'error' => 'Serie não encontrada !!'
                ], 404);
        }

        /*
         * Pegando a serie/episodios, preenche com os dados que vou passar por parametro
         * No caso, pegando todos os dados da requisição ( $request->all() )
         * */
        $recurso->fill($request->all());
        $recurso->save();

        return $recurso;
    }

    public function destroy(int $id)
    {
        /*
         * metodo "destroy" retorna a qtd de series/episodios que ele conseguiu remover
         * */
        $qtdRecursosRemovidos = $this->classe::destroy($id);

        if ($qtdRecursosRemovidos === 0) {
            return response()
                ->json([
                    'error' => 'Serie não encontrada !'
                ], 404);
        }

        return response()
            ->json('', 204);
    }
}
