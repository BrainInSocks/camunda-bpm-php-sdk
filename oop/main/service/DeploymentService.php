<?php

namespace org\camunda\php\sdk\service;

use Exception;
use org\camunda\php\sdk\entity\request\DeploymentRequest;
use org\camunda\php\sdk\entity\response\Deployment;

class DeploymentService extends RequestService {

  /**
   * Retrieves a single process definition according to the
   * ProcessDefinition interface in the engine.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get
   *
   * @param String $id ID of the requested definition
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\ProcessDefinition $this Requested definition
   */
  public function create(DeploymentRequest $request) {
    $this->setRequestUrl('/deployment/create');
    
    try {
        $response = $this->deploymentRequest($request);
        $deployment = new Deployment();
        return $deployment->cast($response);
    } catch (Exception $e) {
        throw $e;
    }
  }
  
    private function deploymentRequest(DeploymentRequest $request) {
        $requestFilePath = $request->getFile();
        if($requestFilePath == null) {
            throw new Exception('No file to deploy');
        }
        
        $this->restApiUrl = preg_replace('/\/$/', '', $this->restApiUrl);
        
        $postData = array();
        foreach($request->iterate() as $name => $value) {
            if($value != null && !empty($value)) {
                $postData[$name] = $value;
            }
        }
        $postData['file'] = new \CURLFile($requestFilePath);
        
        
        $ch = curl_init($this->restApiUrl.$this->requestUrl);
        curl_setopt($ch, CURLOPTPOST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->addAuthIfAvailable($ch);

        $response = curl_exec($ch);
        $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if(preg_match('/(^10|^20)[0-9]/', $this->http_status_code)) {
            $this->reset();
            return json_decode($response);
        } else {
            $this->reset();
            if($response != null && $response != "" && !empty($response)) {
                $error = json_decode($response);
            } else {
              $error = new \stdClass();
              $error->type = "Not found!";
              $error->message = "No Message!";
            }
            
            throw new \Exception("Error! HTTP Status Code: " .$this->http_status_code. " -- ErrorType: ". $error->type . " --
            Error Message: ". $error->message);
        }
    }
}
