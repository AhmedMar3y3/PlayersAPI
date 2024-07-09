<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>(string)$this->id,
            "attributes" => 
            [
               "name"=>$this->name,
               "player_num"=>(string)$this->player_num,
               "player_position"=>$this->player_position,
               "created_at"=>$this->created_at,
               "updated_at"=>$this->updated_at
            ],
            "relationships"=>
            [
                'id' =>(string)$this->player_id,
                'player name' =>$this->name,
                'player email' =>$this->email,
            ]
    
           ];
           
        
    }
}
