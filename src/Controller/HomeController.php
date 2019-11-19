<?php

namespace App\Controller;

use App\Service\ExtractManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/index")
     * @param ExtractManager $extractManager
     */
    public function index(ExtractManager $extractManager)
    {
        dd($extractManager);
    }
}