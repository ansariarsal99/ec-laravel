<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UrlPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $obj = self::toObject($this);
        return $obj;
    }

    public static function toObject($obj, $lang = 'en')
    {
        return [
            "id" => $obj->id,
            "name" => $obj->name,
            "role" => $obj->role->name,
            "urls" => implode(",\n", explode(',', $obj->urls)),
            "created_at" => $obj->created_at->format('Y-m-d'),
            "updated_at" => $obj->updated_at->format('Y-m-d'),
        ];
    }
}
