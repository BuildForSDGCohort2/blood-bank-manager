<?php
namespace App\Controller;

use App\Entity\BloodProductStockSearch;
use App\Repository\BloodProductStockRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="app_search")
     */
    public function search(Request $request, BloodProductStockRepository $bloodProductStocks)
    {
        $page = (int) $request->query->get('page');
        if ($page < 1) { $page = 1; }

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $query */
        $query = $request->query;
        $search = new BloodProductStockSearch;
        $search
            ->setTypeId($query->get('product_type_id'))
            ->setBloodGroup($query->get('product_group'))
            ->setVolume($query->get('product_volume'))
            ->setQuantity($query->get('quantity'))
            ;

        $results = $bloodProductStocks->findByQuery($search);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse($results);
        }
        
    }
}
