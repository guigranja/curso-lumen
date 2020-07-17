<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = false;
    protected $fillable = ['temporada', 'numero', 'assistido', 'serie_id'];

    /*
     * Adicona um item a mais.
     * Passa quais propriedades o Eloquent pode adicionar
     * A cada serie ele tenta adicionar o "links"
     * */
    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    /*
     * Metodo ACCESSOR
     * Fazendo casting da chave "assistido". Passando para Boolean
     * Retornando true ou false
     * */
    public function getAssistidoAttribute($assistido): bool
    {
        return $assistido;
    }

    /*
     * Adicionado links para navegar entre os recursos
     * */
    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/series/' . $this->id,
            'serie' => '/api/series/' . $this->serie_id
        ];
    }
}
