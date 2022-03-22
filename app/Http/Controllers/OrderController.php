<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

class OrderController extends Controller
{

  private $service;

  public function __construct(OrderService $service)
  {
    $this->service = $service;
  }

    public function index()
    {
      return [response()->json($this->service->all())];
    }
}
