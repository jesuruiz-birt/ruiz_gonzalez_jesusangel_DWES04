<?php
class Router {
    protected $routes = [];
    protected $params = [];

    public function add($route, $params, $method = 'GET') {
        $route = ltrim($route, '/');
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?<\\1>[0-9]+)', $route);
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    public function match($url) {
        $url = preg_replace('/^.*\/public\//', '', $url);

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $this->params[$key] = $value;
                    }
                }
                $this->params['controller'] = $params['controller'];
                $this->params['action'] = $params['action'];
                return true;
            }
        }
        return false;
    }

    public function getParams() {
        return $this->params;
    }
}