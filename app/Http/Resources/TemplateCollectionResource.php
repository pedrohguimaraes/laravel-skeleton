<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TemplateCollectionResource extends ResourceCollection
{
    /**
     * @var string
     */
    private $msg;

    /**
     * @var string
     */
    private $pathResource;

    /**
     * @var int
     */
    private $coderro;

    private $pagination;


    public function __construct($resource, int $coderro, string $msg, string $pathResource)
    {
        parent::__construct($resource);
        $this->msg = $msg;
        $this->pathResource = $pathResource;
        $this->coderro = $coderro;
        if (method_exists($resource, 'perPage')) {
            $this->pagination = [
                'total' => $resource->total(),
                'per_page' => $resource->perPage(),
                'current_page' => $resource->currentPage(),
                'total_pages' => $resource->lastPage(),
            ];
        }
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $template = $this;
        $data = [
            'erro' => $this->coderro,
            'msg' => $this->msg,
            'data' => $this->collection->map(function($obj) use($template){
                return new $template->pathResource($obj);
            }),
        ];

        (!empty($this->pagination)) ? $data['pagination'] = $this->pagination : null;

        return $data;
    }

    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse['links'],$jsonResponse['meta']);
        $response->setContent(json_encode($jsonResponse));
    }
}
