<?php

namespace App\Traits;

trait TableSorting
{
    public $numpage = 20;

    public $apuntador;

    public $selectsor;

    public $columsort;

    public $indxorder = 'asc';

    public function orderColum($ordercolum, $columname)
    {

        if ($this->indxorder == 'asc') {
            $this->indxorder = 'desc';
        } else {
            $this->indxorder = 'asc';
        }

        $this->columsort = $ordercolum;
        $this->setSortingOrder($columname);
    }

    public function setSortingOrder($strinorder)
    {

        $this->selectsor = $strinorder;
    }

    public function scopeDataOrder(
        $query,
        string $search = null,
        string $columname = null,
        string $indxorder
    ) {

        $columname = is_null($columname) ? $this->columSortName : $columname;

        return $query->orderBy($columname, "$indxorder")
            ->orWhere($columname, 'like',
                '%'.str()->upper($search).'%');
    }

    public function mycolumfind()
    {
        return $this->columsort;
    }

    public function numofpage($pagenum)
    {
        $this->numpage = $pagenum;
    }

    public function dinamicSearch($modelName, $strinsearch, $idcolum = null)
    {

        $model = $this->getDynamicModel($modelName);

        return $model->findMe($strinsearch, $idcolum)->get();

    }

    public function getDynamicModel($modelName)
    {
        $modelClass = app("App\\Models\\{$modelName}");

        return new $modelClass;
    }

    public function updatedSelectsor()
    {
        return $this->columsort = $this->selectsor;
    }
}
