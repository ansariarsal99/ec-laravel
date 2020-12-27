<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            "type" => $obj->type,
            "first_name" => $obj->first_name,
            "last_name" => $obj->last_name,
            "email" => $obj->email,
            "phone_no" => $obj->phone_no,
            "address" => $obj->address,
            //"remember_token"=> $obj->remember_token,
            "status" => $obj->status,            
        ];
    }
}

