<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'tweet_content' => $this->tweet_content,
            'image' => $this->image,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
            'writer' => $this->whenLoaded('writer'),

        ];        
    }
}
