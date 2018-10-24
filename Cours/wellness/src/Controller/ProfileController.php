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
     * @Route("/profile", name="profile")
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
    public function new(ProfileRepository $repo,Request $request)
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $profile->getImageUrl();


            \Cloudinary::config(array(
                "cloud_name" => "jgsqware",
                "api_key" => "494237192176474",
                "api_secret" => "HScTltgPPqJmmO7F0kSySMM8adw"
            ));

            $result = \Cloudinary\Uploader::upload($file);
            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $profile->setImageUrl($result["url"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile); 
            $em->flush();
            // ... persist the $product variable or any other work

            return $this->redirect($this->generateUrl('profile'));
        }

        return $this->render('profile/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
