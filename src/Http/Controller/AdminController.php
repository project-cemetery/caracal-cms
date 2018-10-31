<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    public function index(): Response
    {
        return $this->render('admin.html.twig');
    }
}
