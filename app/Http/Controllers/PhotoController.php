<?php

namespace App\Http\Controllers;

use App\Http\Resources\TemplateCollectionResource;
use App\Models\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

  private $service;

  public function __construct(PhotoService $service)
  {
    $this->service = $service;
  }

    public function index(Request $request)
    {
      return new TemplateCollectionResource($this->service->all($request), 0, "Photos successfully listed", Photo::PATH_RESOURCE);
    }
}
