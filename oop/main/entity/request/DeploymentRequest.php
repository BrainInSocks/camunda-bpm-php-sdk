<?php

namespace org\camunda\php\sdk\entity\request;

class DeploymentRequest extends Request {
    
    private $paramsTransformMap = array(
        'deploymentName' => 'deployment-name',
        'enableDuplicateFiltering' => 'enable-duplicate-filtering',
        'deployChangedOnly' => 'deploy-changed-only',
        'deploymentSource' => 'deployment-source',
        'tenatId' => 'tenant-id',
    );
    
    private $deploymentName;
    private $enableDuplicateFiltering;
    private $deployChangedOnly;
    private $deploymentSource;
    private $tenatId;
    private $filePath;
    
    
    public function setDeploymentName($name) {
        $this->deploymentName = $name;
    }
    
    public function setDuplicateFiltering($isDuplicateFiltering) {
        $this->enableDuplicateFiltering = $isDuplicateFiltering;
    }
    
    public function setDeployChangedOnly($isDeployChangedOnly) {
        $this->deployChangedOnly = $isDeployChangedOnly;
    }
    
    public function setDeploymnetSouce($deploymnetSource) {
        $this->deploymentSource = $deploymnetSource;
    }
    
    public function setTenatId($tenatId) {
        $this->tenatId = $tenatId;
    }
    
    public function setFile($filePath) {
        $this->filePath = $filePath;
    }
    
    public function iterate() {
        $tmp = array();
        foreach($this AS $index => $value) {
            $parameterName = $this->getRequestParameterName($index);
            if($parameterName != null) {
                $tmp[$index] = $value;
            }
        }

        return $tmp;
    }
    
    public function getFile() {
        return $this->filePath;
    }
    
    private function getRequestParameterName($property) {
        $parameterName = null;
        if(array_key_exists($property, $this->paramsTransformMap)) {
            $parameterName = $this->paramsTransformMap[$property];
        }
        
        return $parameterName;
    }
}
