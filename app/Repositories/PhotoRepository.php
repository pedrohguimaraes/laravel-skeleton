<?php
namespace App\Repositories;

use App\Abstracts\AbstractModelRepository;

class PhotoRepository extends AbstractModelRepository
{
  public function all(array $colunas = ['*'], ?callable $callback = null)
  {
    return ['teste'];
  }
}
