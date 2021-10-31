<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
	public static function uploadImage($file, $before_img_name)
	{
		$filename = date('Y-m-d-H:i:s') . '-' . $file->getClientOriginalName();

		$compressedImg =  \InterventionImage::make($file)->resize(160, 100)->encode();
		Storage::put('public/profile_img/' . $filename, $compressedImg);

		if (!is_null($before_img_name)) {
			$targetImg = 'public/profile_img/' . $before_img_name;
			Storage::delete($targetImg);
		}
	}
}
