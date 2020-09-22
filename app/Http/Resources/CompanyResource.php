<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    protected $showSensitiveFields = false;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (!$this->showSensitiveFields) {
            $this->resource->makeHidden('users_id');
        }
        $data = parent::toArray($request);
        return $data;
    }
    public function showSensitiveFields()
    {
        $this->showSensitiveFields = true;
        return  $this;
    }
}
