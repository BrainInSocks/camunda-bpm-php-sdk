<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.06.13
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk;

use org\camunda\php\sdk\service\AuthorizationService;
use org\camunda\php\sdk\service\GroupService;
use org\camunda\php\sdk\service\HistoryService;
use org\camunda\php\sdk\service\IdentityService;
use org\camunda\php\sdk\service\JobService;
use org\camunda\php\sdk\service\ProcessEngineService;
use org\camunda\php\sdk\service\TaskService;
use org\camunda\php\sdk\service\ExecutionService;
use org\camunda\php\sdk\service\MessageService;
use org\camunda\php\sdk\service\ProcessDefinitionService;
use org\camunda\php\sdk\service\ProcessInstanceService;
use org\camunda\php\sdk\helper\DiagramHelper;
use org\camunda\php\sdk\service\UserService;
use org\camunda\php\sdk\service\VariableInstanceService;


class Api {
  // SERVICES
  public $diagram;
  public $execution;
  public $group;
  public $job;
  public $message;
  public $processDefinition;
  public $processEngine;
  public $processInstance;
  public $task;
  public $user;
  public $variableInstance;
  public $authorization;
  public $history;
  public $identity;

  // CONFIG
  private $restApiUrl = 'http://localhost:8080/engine-rest/';

  public function __construct($restApiUrl = null, $userName = null, $password = null) {
    if($restApiUrl != null) {
      $this->restApiUrl = $restApiUrl;
    }

    $this->diagram            = new DiagramHelper($this->restApiUrl);
    $this->authorization      = new AuthorizationService($this->restApiUrl, $userName, $password);
    $this->execution          = new ExecutionService($this->restApiUrl, $userName, $password);
    $this->group              = new GroupService($this->restApiUrl, $userName, $password);
    $this->history            = new HistoryService($this->restApiUrl, $userName, $password);
    $this->identity           = new IdentityService($this->restApiUrl, $userName, $password);
    $this->job                = new JobService($this->restApiUrl, $userName, $password);
    $this->message            = new MessageService($this->restApiUrl, $userName, $password);
    $this->processDefinition  = new ProcessDefinitionService($this->restApiUrl, $userName, $password);
    $this->processEngine      = new ProcessEngineService($this->restApiUrl, $userName, $password);
    $this->processInstance    = new ProcessInstanceService($this->restApiUrl, $userName, $password);
    $this->task               = new TaskService($this->restApiUrl, $userName, $password);
    $this->user               = new UserService($this->restApiUrl, $userName, $password);
    $this->variableInstance   = new VariableInstanceService($this->restApiUrl, $userName, $password);
  }
}