<?php
namespace Drupal\site_config\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomControllerAPI{

       public function content($api_key, NodeInterface $node){

        //Value to be saved for API Key 
        $api_key_saved_value = \Drupal::config('custom.site.configuration')->get('siteapikey');

        //checking node as page, api_key_value not equals default value and matching given api_key values are same
        if($node->getType() == 'page' && $api_key_saved_value != 'No API Key yet' && $api_key_saved_value == $api_key){
            return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
        }

        //Access denied
        return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
    }
}