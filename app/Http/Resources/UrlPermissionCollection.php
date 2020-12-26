<?php

namespace App\Http\Resources;

use App\UrlPermission;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UrlPermissionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (UrlPermission $urlPermission){
            return new UrlPermissionResource($urlPermission);
        });

        return parent::toArray($request);
    }

    public static function toArrayOfObjects($obj)
    {

        $obj->transform(function (UrlPermission $urlPermission){
            return UrlPermissionResource::toObject($urlPermission);
        });

        return $obj;
    }

}
