<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateObjectResource extends JsonResource
{
    /**
     * @var string
     */
    private $msg;

    /**
     * @var int
     */
    private $coderro;

    /**
     * @var string, array
     */
    private $pathResource = null;

    public function __construct($resource, int $coderro, string $msg, $pathResource = null)
    {
        parent::__construct($resource);
        $this->msg = $msg;
        $this->coderro = $coderro;
        $this->pathResource = $pathResource;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        $data = [
            'erro' => $this->coderro,
            'msg' => $this->msg
        ];

        if($this->pathResource){
            $data['data'] = new $this->pathResource($this);
        }else{
            $data['data'] = parent::toArray($request);
        }

        return $data;
    }   
}