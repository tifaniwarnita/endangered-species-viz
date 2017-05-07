<?php

namespace App\Model\Extension;

use Illuminate\Database\Eloquent\Collection;

trait TreeTrait
{

    /**
     * BelongsTo Parent Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), $this->getTreeForeignKey());
    }

    /**
     * HasMany child relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(get_class($this), $this->getTreeForeignKey());
    }

    /**
     * check whether has child or not
     * @return boolean
     */
    public function hasChild()
    {
        if (isset($this->childs)) {
            return $this->childs->count() == true;
        }
        return $this->childs()->count() > 0;
    }

    /**
     * Get all child model based until specified depth
     * @param  array   $select
     * @param  integer $depth
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllChilds(array $select = ['*'], $depth = 30)
    {
        if ($depth <= 0) {
            return new Collection();
        }

        if (!in_array([$this->getKeyName(), '*'], $select)) {
            $select = array_merge($select, [$this->getKeyName()]);
        }

        $childs = new Collection;
        $currentChilds = $this->childs()->select()->get();
        foreach ($currentChilds as $child) {
            $childs->push($child);
            $childs = $childs->merge($child->getAllChilds($select, $depth-1));
        }

        return $childs;
    }

    /**
     * get foregin key field name
     * @return string
     */
    protected function getTreeForeignKey()
    {
        if (isset($this->treeForeignKey)) {
            return $this->treeForeignKey;
        }
        return 'parent_id';
    }

    /**
     * Scope to get row without parent (foreign key is null)
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromRoot($query)
    {
        return $query->whereNull($this->getTreeForeignKey());
    }

    /**
     * Scope to get row with specified parent foreign key value
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $parent
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromParent($query, $parent)
    {
        return $query->where($this->getTreeForeignKey(), $parent);
    }

    /**
     * Scope to get row except current model. If withChilds is true, also added exception for its childs
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  boolean $withChilds
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotThis($query, $withChilds = false)
    {
        $query = $query->where($this->getKeyName(), '<>', $this->getKey());

        if ($withChilds) {
            $childs = $this->getAllChilds([$this->getKeyName()])->lists($this->getKeyName());
            if (count($childs) > 0) {
                $query->whereNotIn($this->getKeyName(), $childs);
            }
        }

        return $query;
    }

    /**
     * Scope to eagerloading its childs until specified depth
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array   $select
     * @param  closure  $callback
     * @param  integer $depth
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithChilds($query, array $select = ['*'], $callback = null, $depth = 5)
    {
        if ($depth > 0) {
            if (!in_array([$this->getKeyName(), '*'], $select)) {
                $select = array_merge($select, [$this->getKeyName()]);
            }

            if (!in_array([$this->getTreeForeignKey(), '*'], $select)) {
                $select = array_merge($select, [$this->getTreeForeignKey()]);
            }
            $query->with(['childs' => function ($query) use ($select, $depth, $callback) {
                $query->withChilds($select, $callback, $depth - 1)->select($select);
                if ($callback !== null) {
                    $callback($query);
                }
            }]);
        }
    }
}
