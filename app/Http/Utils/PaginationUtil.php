<?php

namespace App\Http\Utils;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PaginationUtil
{

  public static function startPagination($data, $perPage = 7)
  {
    // nueva coleccionar para aceder a los metodos    
    $items = Collection::make($data);
    // pagian actual
    $page = LengthAwarePaginator::resolveCurrentPage('page');
    
    return new LengthAwarePaginator(
      $items->forPage($page, $perPage), 
      $items->count(), 
      $perPage, 
      $page, 
      [
        'path' => LengthAwarePaginator::resolveCurrentPath(),
        'pageName' => 'page'
      ]
    );
  }

}
