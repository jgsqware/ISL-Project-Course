<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image", name="image")
     */
    public function index()
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    public function upload(){
        \Cloudinary::config(array(
            "cloud_name" => "jgsqware",
            "api_key" => "494237192176474",
            "api_secret" => "HScTltgPPqJmmO7F0kSySMM8adw"
        ));
    }
}
