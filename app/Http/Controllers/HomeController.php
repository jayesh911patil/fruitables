<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganicveggiesModel;
use App\Models\FeaturesModel;
use App\Models\OurorganicproductsModel;
use App\Models\FacilityModel;
use App\Models\FreshorganicvegetablesModel;
use App\Models\BestsellerproductsModel;
use App\Models\CountersModel;
use App\Models\OurclientsayingModel;



class HomeController extends Controller
{
    public function Home()
    {
        $organicveggiesdata = OrganicveggiesModel::latest()->get();
        $featuresdata = FeaturesModel::latest()->get();
        $ourorganicproductsdata = OurorganicproductsModel::latest()->get();
        $facilitydata = FacilityModel::latest()->get();
        $freshorganicvegetables = FreshorganicvegetablesModel::latest()->get();
        $bestsellerproducts = BestsellerproductsModel::latest()->get();
        $counters = CountersModel::latest()->get();
        $Ourclientsaying = OurclientsayingModel::latest()->get();

        return view('index', compact('organicveggiesdata', 'featuresdata', 'ourorganicproductsdata', 'facilitydata', 'freshorganicvegetables', 'bestsellerproducts', 'counters', 'Ourclientsaying'));
    }
}
