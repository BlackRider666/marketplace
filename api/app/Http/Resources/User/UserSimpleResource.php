<?php

namespace App\Http\Resources\User;

use App\Core\PathManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSimpleResource extends JsonResource
{

    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'first_name'    =>  $this->first_name,
            $this->mergeWhen($request->user()->isUser(), [
                'second_name'   =>  $this->second_name,
                'surname'       =>  $this->surname,
                'full_name'     =>  $this->first_name.' '.$this->second_name.' '.$this->surname
            ]),
            'email'         =>  $this->email,
            'phone'         =>  $this->phone,
            'file'          =>  $this->file ?
                                (new PathManager())->getFile($this->file, 'user_files') : null,
            'avatar'        =>  $this->avatar ?
                                (new PathManager())->getFile($this->avatar, 'user_avatar')
                                :
                                (new PathManager())->getDefaultPicture(),
            'roles'         =>  $this->roles()->pluck('name'),
            $this->mergeWhen($request->user()->isCompany(), [
                'company'           => $this->company()->first(['code','site','contact_person','company_category_id','desc']),
                'full_name' => $this->first_name
            ]),
        ];
    }
}
