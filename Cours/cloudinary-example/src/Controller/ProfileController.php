<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProfileRepository;
use App\Entity\Profile;
use App\Form\ProfileType;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile")
     */
    public function index(ProfileRepository $repo)
    {
        $profiles = $repo->findAll();
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'profiles' => $profiles,
        ]);
    }

        /**
     * @Route("/profile/new", name="profile_new")
     */
    public function new(Request $request)
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $profile->getImageUrl();
            $image_url=$this->upload($file);
            $profile->setImageUrl($image_url);

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile); 
            $em->flush();
            return $this->redirect($this->generateUrl('profile'));
        }

        return $this->render('profile/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function upload(String $file): string {
        

        \Cloudinary::config(array(
            "cloud_name" => getenv('CLOUDINARY_CLOUD'),
            "api_key" => getenv('CLOUDINARY_API_KEY'),
            "api_secret" => getenv('CLOUDINARY_SECRET_KEY')
        ));

        $result = \Cloudinary\Uploader::upload($file);

        return $result["url"];
    }
}
