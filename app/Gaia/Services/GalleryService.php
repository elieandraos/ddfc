<?php namespace Gaia\Services;

class GalleryService
{
	
	/**
	 * Handles the image upload for the news
	 * @param type $news 
	 * @return type
	 */
	public function uploadImage($gallery, $uploaded_image)
	{
		$gallery->removeMediaCollection($gallery->getMediaCollectionName());
		
		$file = $uploaded_image;
		$tempDirectory = storage_path('temp');
		$fileName = $file->getClientOriginalName();

		$file->move($tempDirectory, $fileName);

		$collectionName = $gallery->getMediaCollectionName();
		$gallery->addMedia($tempDirectory . '/' . $fileName, $collectionName);
	}


	/**
	 * Removes the news image
	 * @param type $news 
	 * @return type
	 */
	public function removeImage($gallery)
	{
		$gallery->removeMediaCollection($gallery->getMediaCollectionName());
	}

}

?>