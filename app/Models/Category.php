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
        return $this->parent_id === null;
    }

    public function hasChildren()
    {
        return count($this->children) > 0;
    }
}
