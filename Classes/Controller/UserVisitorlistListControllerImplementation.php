<?php
require_once('ListController.php');

class UserVisitorlistListControllerImplementation extends Tx_UserVisitorlist_Controller_ListController {

  /**
   * controller
   * @var Tx_UserVisitorlist_Controller_ListController
   */
  private $controller = NULL;

  public function __construct( $interface ) {
    $this->controller = $interface;
  }

  public function listAction() {
    $users = $this->controller->frontendUserRepository->getRecentVisitors();
    //$this->controller->view->assign( "debug", $users->getFirst() );
    $this->controller->view->assign( "users", $users );
  }

  /**
   * Exports the list of visitors as Excel CSV
   */
  public function excelAction() {
    $users = $this->controller->frontendUserRepository->getRecentVisitors();

    $this->controller->view->assign( "users", $users );
    $result = $this->controller->view->render();

    $result = utf8_decode( html_entity_decode( $result ) );

    $cType    = 'text/csv';
    $fileName = "Recent Visitors Export " . date( "d.m.Y" ) . ".csv";
    $fileLen  = strlen( $result );
    $headers = array(
      'Pragma'                    => 'public',
      'Expires'                   => 0,
      'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
      'Cache-Control'             => 'public',
      'Content-Description'       => 'File Transfer',
      'Content-Type'              => $cType,
      'Content-Disposition'       => 'attachment; filename="'. $fileName .'"',
      'Content-Transfer-Encoding' => 'binary',
      'Content-Length'            => $fileLen
    );
    foreach( $headers as $header => $data ) {
      $this->controller->response->setHeader( $header, $data );
    }
    $this->controller->response->sendHeaders();

    echo $result;

    exit;
  }

  /**
   * renders the given Template file via fluid rendering engine.
   *
   * @param string $templateFile        absolute path to the template File
   * @param array $vars an array of all variables you want to assgin to the view f.e: array('blog'=> $blog, 'posts' => $posts)
   *
   * @return string of the rendered View.
   */
  protected function renderFileTemplate($templateFile, array $vars) {
    $templateParser = Tx_Fluid_Compatibility_TemplateParserBuilder::build();
    $objectManager = t3lib_div::makeInstance('Tx_Fluid_Compatibility_ObjectManager');

    $templateContent = file_get_contents($templateFile);
    if ($templateContent !== false) {
      $content = $templateParser->parse($templateContent);
      $variableContainer = $objectManager->create('Tx_Fluid_Core_ViewHelper_TemplateVariableContainer', $vars);
      $renderingContext = $objectManager->create('Tx_Fluid_Core_Rendering_RenderingContext');
      $renderingContext->setTemplateVariableContainer($variableContainer);
      $viewHelperVariableContainer = $objectManager->create('Tx_Fluid_Core_ViewHelper_ViewHelperVariableContainer');
      $renderingContext->setViewHelperVariableContainer($viewHelperVariableContainer);

      $data = $content->render($renderingContext);
      return $data;
    }
  }
}