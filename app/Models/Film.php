<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'descripcion', 'imagen'];

    //Relacion NM
    public function tags():BelongsToMany{
        return $this->BelongsToMany(Tag::class);
    } 

    //Acessors y muttators
    public function titulo():Attribute{
        return Attribute::make(
            set: fn($v) => ucfirst($v)
        );
    }
    public function descripcion():Attribute{
        return Attribute::make(
            set: fn($v)=>ucwords($v)
        );
    }
    public function devolverIdTags(){
        $idTags = [];
        foreach ($this->tags as $item) {
            $idTags[] = $item->id;
        }
        return $idTags;
    }
}
