<?php
header("Content-type: text/html; charset=utf-8");

// Hacky but functional
define('IN_PRODUCTION', (bool) ($_SERVER['SERVER_NAME'] === 'foo.tl'));
if (!IN_PRODUCTION){
  error_reporting(-1);
  ini_set('display_errors', 'on');
  ini_set('html_errors', 'on');
}

// Markdown won't autoload at the moment; no namespaces etc
require __DIR__.'/Ftl/Html/Markdown.php';

spl_autoload_register(function($class){
  $class = str_replace('\\', '/', ltrim($class, '\\'));
  require __DIR__."/{$class}.php";
});

set_exception_handler(function($e){
  switch ($e->getCode()){
    case 404:
      header("HTTP/1.1 404 Not Found");
      break;
  }
  $r = new \Ftl\Html\Renderer();
  $r->render(__DIR__.'/assets/templates/main.php', array(
    'title'        => 'Oh noes! Waht you doen?!',
    'subpage'      => __DIR__.'/assets/templates/error.php',
    'subpageData'  => array(
      'exception' => $e
    ) 
  ));
});

/********/
/* Meat */
/********/

$renderer = new \Ftl\Html\Renderer();

$router = new \Ftl\Http\Router($_SERVER['REQUEST_URI']);
$router->addRoute(
  array(
    '/', 
    '/guide', 
    '/guide/:article'
  ), 
  function($article = 'index') use($renderer){
    $articleFile = __DIR__."/guide/{$article}/article.mkd";
    if (!file_exists($articleFile)){
      throw new \Exception("That is not an article I have written.", 404);
    }
    $articleContent = file_get_contents($articleFile);
    $lastModified = filemtime($articleFile);

    $manifestFile = __DIR__."/guide/{$article}/manifest.ini";
    $title = null;
    if (file_exists($manifestFile)){
      $manifest = parse_ini_file($manifestFile);
      $title = isSet($manifest['title'])? $manifest['title'] : null;
    }

    $renderer->render(__DIR__.'/assets/templates/main.php', array(
      'title'        => $title,
      'subpage'      => __DIR__.'/assets/templates/article.php',
      'lastModified' => $lastModified,
      'gaTracking'   => IN_PRODUCTION, //Only track in production
      'subpageData'  => array(
        'articleContent' => $articleContent
      ) 
    ));
  }
);

$router->dispatch();


