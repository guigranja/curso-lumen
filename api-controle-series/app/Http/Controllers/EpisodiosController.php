<?php

namespace App\Http\Controllers;

use App\Episodio;
use Illuminate\Support\Facades\Auth;

class EpisodiosController extends BaseController
{
    public function __construct()
    {
        $this->classe = Episodio::class;
    }

    public function epPorSerie(int $serie_id)
    {
        return Episodio::query()
            ->where('serie_id', $serie_id)
            ->paginate();
    }
}
