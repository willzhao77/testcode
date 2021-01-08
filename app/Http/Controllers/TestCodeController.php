<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Country;

class TestCodeController extends Controller
{
    //search universities by Country Name
    public function index($countryName)
    {
        $response = Http::get('http://universities.hipolabs.com/search?country=' . $countryName);



        $country = new Country;
        $country->country = "New Zealand";
        $country->alphaCode = "nz";
        $new = $country->save();




        $newcountry = Country::where('country', $countryName);

        $university = new University;
        $university->name = "test name";
        $university->webpages = 'www.google.com';
        $university->domains = 'www.testdomain.com';
        $university->ttl = 300;
        $newcountry = $university->save();
   
        $newcountry->country()->associate($newcountry);


       
 
        
       




        return $response;


    }
}
