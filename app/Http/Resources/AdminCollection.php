<?php

namespace App\Http\Resources;

use App\Admin;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
 
    public function toArray($request)
    {
        $this->collection->transform(function (Admin $Admin){
            return new AdminResource($Admin);
        });

        return parent::toArray($request);
    }

    public static function toArrayOfObjects($obj)
    {

        $obj->transform(function (Admin $Admin){
            return AdminResource::toObject($Admin);
        });

        return $obj;
    }

}
