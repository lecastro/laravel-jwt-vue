<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //esse query pesquisa por filtros
    public function getResults($name = null)
    {
        if (!$name) {
            return $this->get();
        } else {
            return $this->where('name', 'LIKE', "%{$name}%")->get();
        }
    }

}
