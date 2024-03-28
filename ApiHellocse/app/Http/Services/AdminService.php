<?php

namespace App\Http\Services;

use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use Illuminate\Support\Facades\Storage;

class AdminService {

    /**
     * Handle the profile creation and edit requests
     *
     * @param Profil $profil : The profile to create/update
     * @param ProfilRequest $request : The request with the validation rules
     * @return mixed
     */
    public function handleRequestData(Profil $profil, ProfilRequest $request): mixed {
        $data = $request->validated();
        /** @var UploadedFile $image */
        $image = $request->validated('image');
        /**
         * If there is no image, no need to delete the old one
         * and store the new one
         */
        if($image === null || $image->getError())
            return $data;
        else if($profil->image){
            // Delete the unused pictures
            Storage::disk('public')->delete($profil->image);
        }
        $data['image'] = $image->store('profil', 'public');

        return $data;
    }

}