<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Spatie\Permission\Models\Role;

class RoleViewCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Role $role){
            return new RoleViewResource($role);
        });

        return parent::toArray($request);
    }

    public static function toArrayOfObjects($obj)
    {

        $obj->transform(function (Role $role){
            return RoleViewResource::toObject($role);
        });

        return $obj;
    }
}
