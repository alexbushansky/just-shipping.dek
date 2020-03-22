<?php


namespace App\Services;


use App\Models\User;
use App\Services\Interfaces\AvatarServiceInterface;

use Image;

class AvatarService implements AvatarServiceInterface
{

    private $fullWidthPath;
    private $thumbnailsPath;



    public function __construct()
    {
        $this->fullWidthPath = public_path(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);
        $this->thumbnailsPath = public_path(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR);

    }

    public function makeAvatar($file, User $user): string
    {


        //delete old picture
        if (!empty($user->thumbnail)) {
            $this->deleteOldPicture($user->thumbnail);
        }
        //create Dir
        $this->createDirForPicture();

        // создаем название файла
        $filename = time() . '-' . str_random(4) . '.jpg';
        // большой файл
        // изменить размер изображения до ширины 1200 и ограничить пропорции (автоматическая высота)
        Image::make($file)->resize(1200, null, function ($constraint) {

            $constraint->aspectRatio();
            // предотвратить увеличение
            $constraint->upsize();
        })->save($this->fullWidthPath . $filename);

        // миниатюра
        //fit - поместиться
        Image::make($file)->fit(200, 200, function ($constraint) {
            $constraint->upsize();
        })->save($this->thumbnailsPath . $filename);
        return $filename;
    }

    public function deleteOldPicture($file): bool
    {
        if (file_exists($this->fullWidthPath . $file)) {

            unlink($this->fullWidthPath . $file);

        }

        if (file_exists($this->thumbnailsPath . $file)) {

            unlink($this->thumbnailsPath . $file);
        }


        return !file_exists($this->thumbnailsPath . $file) && !file_exists($this->fullWidthPath . $file);
    }

    private function createDirForPicture()
    {
        if (!is_dir($this->fullWidthPath)) {
            mkdir($this->fullWidthPath, 0777);
        }

        if (!is_dir($this->thumbnailsPath)) {
            mkdir($this->thumbnailsPath, 0777);
        }
    }






}
