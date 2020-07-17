<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];

    /*
     * Adicona um item a mais.
     * Passa quais propriedades o Eloquent pode adicionar
     * A cada serie ele tenta adicionar o "links"
     * */
    protected $appends = ['links'];

    /*
     * Passando a quantidade de itens mostrados por pagina.
     * default = 15
     * */
    protected $perPage = 5;

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    /*
     * Adicionado links para navegar entre os recursos
     * */
    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/series/' . $this->id,
            'episodios' => '/api/series/' . $this->id . '/episodios'
        ];
    }
}
