<?php


class Route {

    public static $routes = [
        'post' => [],
        'get' => [],
        'put' => [],
        'delete' => []
    ];

    private $server;

    function __construct( $server )
    {
        $this->server = $server;
    }

    public static function put( $url, $classMethodStr ) {
        if ( !isset( self::$routes['put'] ) ) {
            self::$routes['put'] = [];
        }
        self::$routes['put'][ $url ] = $classMethodStr;
    }

    public static function delete( $url, $classMethodStr ) {
        if ( !isset( self::$routes['delete'] ) ) {
            self::$routes['delete'] = [];
        }
        self::$routes['delete'][ $url ] = $classMethodStr;
    }

    public static function get( $url, $classMethodStr ) {
        if ( !isset( self::$routes['get'] ) ) {
            self::$routes['get'] = [];
        }
        self::$routes['get'][ $url ] = $classMethodStr;
    }


    public static function post( $url, $classMethodStr ) {
        if ( !isset( self::$routes['post'] ) ) {
            self::$routes['post'] = [];
        }
        self::$routes['post'][ $url ] = $classMethodStr;
    }
    function getRoutes() {
        return self::$routes;
    }
    function execute() {

        $retArr = $this->parseClassAndMethod();
        list( $class, $method ) = $retArr;
        $newClass =  new $class();
        if ( !empty( $retArr[2] ) ) {
            return $newClass->$method( $retArr[2] );
        }
        return $newClass->$method();
    }
    private function parseClassAndMethod() {    

        $method = $this->server['REQUEST_METHOD'];
        $base = str_replace('/index.php', '',$this->server['PHP_SELF']);
        $uri = ltrim(str_replace($base,'', $this->server['REQUEST_URI']), '/');
        $routesArr = self::$routes[ strtolower( $method )  ];
        if ( !empty( $routesArr[$uri] )) {
            return explode('@', $routesArr[$uri] );

        }
        $uriArr = explode('/', $uri );
        $buildUriStr = '';
        $param = '';
        foreach( $uriArr as $u ) {
            if ( !empty( $u ) ) {
                if ( is_numeric( $u ) ) {
                    $buildUriStr .= "/{num}";
                    $param = $u;
                } else {
                    $buildUriStr .=  "/". $u;
                }
            }
        }
        $buildUriStr = ltrim($buildUriStr, '/');
        $retArr = explode('@', $routesArr[$buildUriStr] );
        $retArr[] = $param;
        return $retArr;
    }
}