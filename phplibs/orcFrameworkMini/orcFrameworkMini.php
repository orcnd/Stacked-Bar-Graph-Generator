<?php

class orcFrameworkMini_base
{
    function __construct()
    {
        @session_start();
        $this->controller_init();
    }

    function view($adr, $vars = [], $print = true)
    {
        extract($vars);

        ob_start();
        include 'views/' . $adr . '.php';
        $vr = ob_get_contents();
        ob_end_clean();
        if (!$print) {
            return $vr;
        } else {
            echo $vr;
            return true;
        }
    }
    private function c404()
    {
        header('HTTP/1.0 404 Not Found');
    }

    private function controller_init()
    {
        $uri = str_replace('/' . basepath . '/', '', $_SERVER['REQUEST_URI']);
        $uri = str_replace('_', '', $uri);
        if (trim($uri) == '') {
            $uri = '';
        }

        if (strpos($uri, '/') > -1) {
            $uri = explode('/', $uri);
        } else {
            if (strlen($uri) > 2) {
                $uri = [$uri];
            } else {
                $uri = ['ana'];
            }
        }

        $uri[0] = 'c_' . $uri[0];
        //foreach ($uri as $k=>$v) $uri[$k]='c_'.$v;
        //odump($uri); exit;
        if (method_exists($this, $uri[0])) {
            if (sizeof($uri) > 1) {
                $params = $uri;
                unset($params[0]);
                call_user_func_array([$this, $uri[0]], $params);
            } else {
                call_user_func([$this, $uri[0]]);
            }
        } else {
            $this->c404();
        }
    }
}

//helper functions

//dumping data with style
function odump($v)
{
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
}

//simple http rediret
function redirect($uri)
{
    $uri = str_replace('//', '/', $uri);
    $adr = burl(true) . '/' . $uri;
    header('location: ' . $adr);
}

//redirecting last page shortcut
function lastpage($redirectNow = true)
{
    @session_start();
    if ($redirectNow) {
        $url = burl(true);
        if (isset($_SESSION['lastpage'])) {
            $url = $_SESSION['lastpage'];
        }
        header('location: ' . $url);
    } else {
        $url = $actual_link =
            (isset($_SERVER['HTTPS']) ? 'https' : 'http') .
            '://' .
            $_SERVER[HTTP_HOST] .
            $_SERVER[REQUEST_URI];
        $_SESSION['lastpage'] = $url;
    }
}

//base url
function burl($return = false)
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol =
            $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
    } else {
        $protocol = 'http';
    }
    $dt = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . baseurl;
    if (substr($dt, -1) == '/') {
        $dt = substr($dt, 0, strlen($dt) - 1);
    }
    if ($return) {
        return $dt;
    } else {
        echo $dt;
    }
}
