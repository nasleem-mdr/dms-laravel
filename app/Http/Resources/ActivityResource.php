<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::with('employee')->where('id', $this->user_id)->first();
        return [
            'aktivitas' => $this->activity,
            'waktu' => $this->created_at->format('G:i:s'),
            'pengguna' => $user->username,
            'unit' => $user->employee->agency->name,
        ];
    }
}
