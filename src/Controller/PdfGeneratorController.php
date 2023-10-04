<?php
 
namespace App\Controller;
 
use Dompdf\Dompdf;
use App\Entity\Stagiaire;
use App\Repository\StagiaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class PdfGeneratorController extends AbstractController
{
    #[Route('/pdf/generator/{id}', name: 'app_pdf_generator')]
    public function index(StagiaireRepository $stagiaireRepository, Stagiaire $stagiaire): Response
    {
        $currentDate = date('l-d-m-Y');

        $stagiaire = $stagiaireRepository->findOneBy([]);
        // return $this->render('pdf_generator/index.html.twig', [
        //     'controller_name' => 'PdfGeneratorController',
        // ]);
        $data = [
            'currentDate' => $currentDate,
            'stagiaire' => $stagiaire
        ];

        $html =  $this->renderView('pdf_generator/index.html.twig', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
         
        return new Response (
            $dompdf->stream('resume', ["Attachment" => false]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    }
 
}