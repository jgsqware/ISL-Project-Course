<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    public function getAllServices(ServiceRepository $repo) {
        $services = $repo->findAll();
        return $this->render('service/list.html.twig',
            array('services' => $services)
        );
    }

    /**
     * @Route("/services", name="services")
     */
    public function index(ServiceRepository $repo)
    {
        $services = $repo->findAll();
        return $this->render('service/index.html.twig', [
            'ptitle' => 'Categories de services',
            'services' => $services,
        ]);
    }

    /**
     * @Route("/services/{id}", name="service_show")
     */
    public function show(ServiceRepository $repo, Service $service)
    {
        $services = $repo->findAll();
        return $this->render('service/show.html.twig', [
            'ptitle' => 'Categories de services',
            'service' => $service,
            'services' => $services,
        ]);

    }
}