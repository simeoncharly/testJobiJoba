<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 *
 */
class GetPEOffers extends AbstractController
{
  function getToken($url){
    $params = http_build_query(
      ['grant_type'   => 'client_credentials',
      'client_id'     => 'PAR_testtechniquejobijoba_9dbecab527b1c7d2173f764d93902fca0170fe59b08aeebc8870626194bc6ba4',
      'client_secret' => 'e40a9e12ba00f3c7fce861fd83c17b1786512e51fe119c98092eeea90b7fb9b4',
      'scope'         => 'api_offresdemploiv2 o2dsoffre application_PAR_testtechniquejobijoba_9dbecab527b1c7d2173f764d93902fca0170fe59b08aeebc8870626194bc6ba4'
      ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $serverOutput = json_decode(curl_exec($ch));
    if (curl_error($ch))
     return (false);
    curl_close($ch);
    return (isset($serverOutput->access_token) ? $serverOutput->access_token : false);
  }

  function getOffers(){

    $token        = $this->getToken('https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=%2Fpartenaire');
    if ($token === false)
      return (false);
    $url          = 'https://api.emploi-store.fr/partenaire/offresdemploi/v2/offres/search?range=0-10&commune=33063';
    $ch           = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

    $serverOutput = json_decode(curl_exec($ch));
    if (curl_error($ch))
     return (false);
    curl_close($ch);
    return($serverOutput);
  }

  function treatApiResults(){
    $Rawdata = $this->getOffers();
    if ($Rawdata === false){
      return new Response(
        '<html><body><h1> Cannot Connect to api</h1></body></html>'
      );
    }
    $results[] = [
      'offerName',
      'description',
      'place',
      'typeContract',
      'company'
    ];
    $i = 0;
    foreach ($Rawdata->resultats as $key => $value) {
      $results[$i]['offerName']    = $value->appellationlibelle;
      $results[$i]['description']  = $value->description;
      $results[$i]['place']        = $value->lieuTravail->libelle;
      $results[$i]['typeContract'] = $value->typeContratLibelle;
      @$results[$i]['company']     = $value->contact->nom;
      $i++;
    }
    unset($results[0]);
    return $this->render('GetPEOffers.html.twig',[
      'results' => $results,
    ]);

  }
}


 ?>
