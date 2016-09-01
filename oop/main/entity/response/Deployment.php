<?php

namespace org\camunda\php\sdk\entity\response;

use org\camunda\php\sdk\helper\CastHelper;

class Deployment extends CastHelper {
    
    protected $id;
    protected $name;
    protected $source;
    protected $tenantId;
    protected $deploymentTime;
    protected $links;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getSource() {
        return $this->source;
    }

    function getTenantId() {
        return $this->tenantId;
    }

    function getDeploymentTime() {
        return $this->deploymentTime;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSource($source) {
        $this->source = $source;
    }

    function setTenantId($tenantId) {
        $this->tenantId = $tenantId;
    }

    function setDeploymentTime($deploymentTime) {
        $this->deploymentTime = $deploymentTime;
    }
    
    function getLinks() {
        return $this->links;
    }

    function setLinks($links) {
        $this->links = $links;
    }
}
