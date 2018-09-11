<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uid' => $this->uid,
            'title' => $this->title,
            'description'=>$this->description,
            'production'=> [
                'title' => $this->production->title,
                'slug' => $this->production->slug,
                'header_img'=>$this->production->header_img,
                'description'=>$this->production->description,
                'excerpt'=>$this->production->excerpt,
            ],
            'times' => [
                'start'=>$this->start_time->toIso8601String(),
                'end'=>$this->end_time->toIso8601String()
            ],
            'links' => [
                'self' => route('api.events.show',['uid'=>$this->uid]),
                'production' => route('api.productions.show',['id'=>$this->production->slug])
            ]
        ];
    }
}
