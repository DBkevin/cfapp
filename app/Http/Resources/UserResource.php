<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (!$this->showSensitiveFields) {
            $this->resource->makeHidden(['phone', 'email']);
        }
        $data = parent::toArray($request);
        $data['bound_phoen'] = $this->resource->phone ? true : false;
        $data['bound_wechat'] = $this->resource->is_bind_weixin;
        return $data;
    }
    public function showSensitiveFields()
    {
        $this->showSensitiveFields = true;
        return  $this;
    }
}
