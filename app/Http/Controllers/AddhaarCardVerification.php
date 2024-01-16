<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;


class AddhaarCardVerification extends Controller
{

    public function verify(Request $request){
        $data = $request->all();
        // if ($request->hasFile('adhaar_card_img')) {
        //     $imagePath = $this->getImagePath($request->adhaar_card_img);
        //     $data['adhaar_card_img'] = $imagePath;
        // }
        $ocr = new TesseractOCR();
        $ocr->image($data['adhaar_card_img']);
        $output = (new TesseractOCR($data['adhaar_card_img']))->psm(6)->oem(3)
        ->run();
        $patterns = [
            'Name' => '/\b([a-zA-Z]+ [a-zA-Z]+(?: [a-zA-Z]+)?)\b/',
            'dob' =>  '/(\d{2}\/\d{2}\/\d{4})/',
            'gender' => '/\b(?:Male|Female)\b/i',
            'adhaar_number' => '/(\d{4}\ \d{4}\ \d{4})/'
        ];

        foreach($patterns as $key=>$value){
            if (preg_match($value, $output, $matches)) {
                    dump($key." : ".$matches[0]);
            }
        }

        dd($output);
        return response()->json(['success' => $output]);
    }
    
    // public function getImagePath($adhaar_card_img){
    //     $img_name = 'img_'.time().'.'.$adhaar_card_img->getClientOriginalExtension();
    //     $adhaar_card_img->move(public_path('upload_img/'), $img_name);
    //     $imagePath = '\upload_img/'.$img_name;
    
    //     return $imagePath;
    // }
}
