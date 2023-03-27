<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureSevice{


    private $params;
    public function __construct(ParameterBagInterface $params ){
        $this->params = $params;
    }

    public function add(UploadedFile $picture, ?string $folder= "", ?int $width =150, ?int $height= 150){
        //On donne un nouveau nom à l'image 
        $fichier = md5(uniqid(rand() , true)) .'.webp';
        //on va recup les infos de l'image 
        $picture_infos = getimagesize($picture);
        if($picture_infos === false){
            throw new \Exception('format d\'image incorrect');
        }
        //on vérifie le format de l'image
        switch($picture_infos['mime']){
            case 'image/png':
                $picture_source = imagecreatefrompng($picture);
                break;
            case 'image/jpeg':
                $picture_source = imagecreatefromjpeg($picture);
                break;
            case 'image/webp':
                $picture_source = imagecreatefromwebp($picture);
                break;
            default: new \Exception('Format d\'image incorrect');
        }

        //on recadre l'image
        $imageWidth = $picture_infos[0];
        $imageHeight = $picture_infos[1];

        //on vérifie l'orientation de l'image
        switch ($imageWidth <=> $imageHeight) {
            case -1:
                // largeur inférieur à la hauteur = protrait
                    $squareSize = $imageWidth;
                    $scr_x =0;
                    $scr_y= ($imageHeight - $squareSize) / 2;
                    break;
            case 0:
                //  carrée
                    $squareSize = $imageWidth;
                    $scr_x =0;
                    $scr_y= 0;
                    break;
            case 1:
                // largeur supérieur à la hauteur = paysage
                    $squareSize = $$imageHeight;
                    $scr_x = ($imageWidth - $squareSize) / 2;
                    $scr_y= 0;
                    break;
        }

        //on crée une nouvelle image "vierge"
        $resized_picture = imagecreatetruecolor($width, $height);
        imagecopyresampled($resized_picture, $picture_source, 0,  0, $scr_x, $scr_y, $width, $height, $squareSize, $squareSize);
        
        $path = $this->params->get('image_directory') . $folder;

        //on crée le dossier de destination s'il nexiste pas 

        if(!file_exists($path. "/avatar/")){
            mkdir($path . '/avatar/' , 0755, true);

        }

        imagewebp($resized_picture , $path . '/avatar/' . $width . 'x' . $height . '-' .$fichier );

        $picture->move($path. '/' , $fichier);

        return $fichier;

    }


    public function delete(string $fichier, ?string $folder = '',?int $width = 150, ?int $height = 150){
        if($fichier !== "default.webp"){
            $success = false;
            $path = $this->params->get('image_directory') . $folder;
            $avatar = $path . '/avatar/' . $width . 'x' . $height . '-' . $fichier;
            if(file_exists($avatar)){
                unlink($avatar);
                $success = true;
            }

            $original = $path . '/' . $fichier;

            if (file_exists($original)) {
                unlink($avatar);
                $success = true;
            }
            return $success;
        }
        return false;
    }
}