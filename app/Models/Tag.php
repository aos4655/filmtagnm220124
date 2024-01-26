<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'color'];

    //Relacion NM
    public function films(): BelongsToMany{
        return $this->BelongsToMany(Film::class);
    }

    //Acessors y muttators
    public function nombre():Attribute{
        return Attribute::make(
            get: fn($v) => '#'.$v,
            set: fn($v) => ucfirst($v),
        );
    }
}
