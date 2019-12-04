<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'descripition', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //busca todo resultado e tbm filtrar.
    public function getResults($data, $tot)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['descripition'])) {
            return $this->paginate($tot);
        } else {
            return $this->where(function ($query) use ($data) {
                if (isset($data['filter'])) { //filter busca pelo nome ou pela descrição
                    $filter = $data['filter'];
                    $query->where('name', $filter);
                    $query->orwhere('descripition', 'LIKE', "%{$filter}%");
                } elseif (isset($data['name'])) {
                    $query->where('name', $data['name']);
                } elseif (isset($data['descripition'])) {
                    $descripition = $data['descripition'];
                    $query->orwhere('descripition', 'LIKE', "%{ $descripition}%");
                }
            })->paginate($tot);
        }
    }
}
