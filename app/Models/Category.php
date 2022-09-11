<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    protected $fillable = ['title', 'parent_id'];

    public function isRoot()
    {
        $root = Category::where('parent_id', null)->first();
        return $this->parent_id === $root->id;
    }
}
