<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Country;

class TestCodeController extends Controller
{


    public function searchByCountry($countryName){

        $countryResults = Country::where('country', $countryName)->get();

        if(count($countryResults)){
            return "find this country in localdata base";

        }else{
            $this->saveUniversitiesByCountry($countryName);
 
        }       
    }

    public function getRandTime(){
        return rand(5*60, 15*60);
    }

    public function ifCountryExist($countryName){
        $countryResults = Country::where('country', $countryName)->get();
        if(count($countryResults)){ 
            return true;
        }
        return false;
    }

    public function createNewCountry($countryName, $alpha_two_code){
        return Country::create(['country'=> $countryName, 'alphaCode'=>$alpha_two_code ])->id;
    }



    public function saveUniversitiesByCountry($countryName){
        $response = Http::get('http://universities.hipolabs.com/search?country=' . $countryName);

        //check if get >= 1 reslult, if no result return.
        if(!count(json_decode($response)))
            {
                return 'true';
            }else{
                // return 'false';
            }
        $resultArr = json_decode($response, true);
        
        if(!$this->ifCountryExist($countryName)){
            $callCreateNewCountry = True;
        }else{
            $callCreateNewCountry = false;
        }


        foreach($resultArr as $reslut){
            //set default value
            $alpha_two_code = $country = $name = $domains = $web_pages ='';

            // get value
            $alpha_two_code = $reslut["alpha_two_code" ];
            $country = $reslut["country" ];       
            $name = $reslut["name" ];
            if($callCreateNewCountry){
                $newCountryId = $this->createNewCountry($country, $alpha_two_code);
                $callCreateNewCountry = false;
            }

            foreach($reslut["domains"] as $domain ){
                $domains .= $domain . ' ';
            }
            foreach($reslut["web_pages"] as $webpage ){
                $web_pages .= $webpage . ' ';
            }
            University::create(['ttl' => $this->getRandTime(), 'name' => $name, 'webpages'=> $web_pages,  'domains' => $domains, 'country_id'=>$newCountryId]);

        }

    }
    









    // //search universities by Country Name
    // public function index($countryName)
    // {

    //     // function getRandTime(){
    //     //     return rand(5*60, 15*60);
    //     // }

    //     $response = Http::get('http://universities.hipolabs.com/search?country=' . $countryName);
            
    //         //check if get >= 1 reslult, if no result return.
    //         if(!count(json_decode($response)))
    //         {
    //             return 'true';
    //         }else{
    //             // return 'false';
    //         }


    //         $resultArr = json_decode($response, true);
            
    //         foreach($resultArr as $reslut){
    //             //set default value
    //             $alpha_two_code = $country = $name = $domains = $web_pages ='';

    //             // get value
    //             $alpha_two_code = $reslut["alpha_two_code" ];
    //             $country = $reslut["country" ];
                
    //             $name = $reslut["name" ];

    //             foreach($reslut["domains"] as $domain ){
    //                 $domains .= $domain . ' ';
    //             }
    //             foreach($reslut["web_pages"] as $webpage ){
    //                 $web_pages .= $webpage . ' ';
    //             }

    //             // save value to database
    //             $countryResults = Country::where('country', $country)->get();
    //             $universityResults = University::where('name', $name)->get();
               
    //             if(count($countryResults)){ // Country exist
    //                 if(count($universityResults)){
                        
    //                     $universityResults[0]->update([ 'ttl' => getRandTime(), 'webpages'=>$web_pages,  'domains' => $domains]);
    //                     $universityResults[0]->touch();
    //                 }else{
    //                     $countryResults[0]->universities()->create([ 'ttl' => getRandTime(), 'name' => $name, 'webpages'=>$web_pages,  'domains' => $domains]);
    //                 }
    //             }else{ // Country not exist
    //                 if(count($universityResults)){
    //                     $newCountry = Country::create(['country'=> $country, 'alphaCode'=>$alpha_two_code ])->id;
    //                     $universityResults[0]->update(['ttl' => getRandTime(), 'name' => 'test Name', 'webpages'=> $web_pages,  'domains' => $domains, 'country_id'=>$newCountry]);
    //                     $universityResults[0]->touch();
                    
    //                 }else{
    //                     $newCountry = Country::create(['country'=> $country, 'alphaCode'=>$alpha_two_code ])->id;
    //                     University::create(['ttl' => getRandTime(), 'name' => $name, 'webpages'=> $web_pages,  'domains' => $domains, 'country_id'=>$newCountry]);
    //                 }                   
    //             }

                
                
    //         }

    //         return 'done';

            
           









    

    // }
}
