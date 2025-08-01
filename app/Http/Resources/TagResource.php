<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
                        'description' =>$this->description,

           
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}