<?php
/**
 * Library
 * JoeyBlankendaal/Core/Bootstrap
 * 
 * Initializes the applications and loads up pages through controllers.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Bootstrap
{
    public function __construct()
    {
        $viewController = new View();
        
        if ($viewController->getRenderTemplate() === true)
        {
            $template = $viewController->getTemplate();
            $path = 'applications/' . APPLICATION . '/Templates/' . $template . '/';
            
            if (file_exists($path))
            {
                require($path . 'Header.php');
            }
            else
            {
                throw new Exception('While rendering header: Template ' . $template . ' not found.');
            }
        }

        if (isset($_GET['url']))
        {
            $request = explode('/', $_GET['url']);
        }
        else
        {
            $request = array('Index');
        }
        
        if ($request == array('Index'))
        {
            require('applications/' . APPLICATION . '/Views/Index/Index.php');
        }
        else if (file_exists('applications/' . APPLICATION . '/Controllers/' . str_replace('/', '', ucfirst($request[0])) . '.php'))
        {
            require('applications/' . APPLICATION . '/Controllers/' . str_replace('/', '', ucfirst($request[0])) . '.php');
            
            $controller = new $request[0];
            
            if (isset($request[3]) && isset($request[2]) && isset($request[1]))
            {
                $controller->{$request[1]}($request[2], $request[3]);
            }
            else if (isset($request[2]) && isset($request[1]))
            {
                $controller->{$request[1]}($request[2]);
            }
            else if (isset($request[1]))
            {
                if (method_exists($controller, $request[1]))
                {
                    $controller->{$request[1]}();
                }
                else
                {
                    throw new Exception('Method not found!');
                }
            }
            else
            {
                if (method_exists($controller, 'index'))
                {
                    $controller->index();
                }
            }
        }
        else
        {
            echo '        <h1>404 - Page not found</h1>
        <p>Unfortunately the page that you\'re trying to find does not exist.</p>';
        }
        
        if ($viewController->getRenderTemplate() === true)
        {
            $template = $viewController->getTemplate();
            $path = 'applications/' . APPLICATION . '/Templates/' . $template . '/';
            
            if (file_exists($path))
            {
                require($path . 'Footer.php');
            }
            else
            {
                throw new Exception('While rendering footer: Template ' . $template . ' not found.');
            }
        }
    }
}