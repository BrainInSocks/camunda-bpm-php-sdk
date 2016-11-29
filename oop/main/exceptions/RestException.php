<?php

namespace org\camunda\php\sdk\service;

class RestException extends \Exception {
    
    private $httpStatus;
    
    public function setHttpStatus($httpStatus) {
        $this->httpStatus = $httpStatus;
    }
    
    public function getHttpStatus() {
        return $this->httpStatus;
    }

}
