<?php

class orcMiniFramework_base
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
        echo '<html><head><title>Sayfa Bulunamadı - 404</title></head><body>
    	<div style="margin:30px auto;width:40%; text-align:center;font-size:4vw; font-weight:bold;font-family:helvetica,arial"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 32 32"><path fill="#607d95" d="M7.5 18c-1.1 0-2-.9-2-2 0-.6.2-1.1.6-1.4.3-.4.8-.6 1.4-.6"/><path fill="#fff" d="M7.5 17c-.6 0-1-.4-1-1 0-.3.1-.5.3-.7.2-.2.4-.3.7-.3"/><path fill="#607d95" d="M5.5 16.5h-1c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h1c.3 0 .5.2.5.5s-.2.5-.5.5zM6.1 15.1c-.1 0-.3 0-.4-.1l-.7-.8c-.2-.2-.2-.5 0-.7s.5-.2.7 0l.7.7c.2.2.2.5 0 .7-.1.1-.2.2-.3.2zM5.4 18.6c-.1 0-.3 0-.4-.1-.2-.2-.2-.5 0-.7l.7-.7c.2-.2.5-.2.7 0s.2.5 0 .7l-.7.7c-.1.1-.2.1-.3.1z"/><path fill="#607d95" d="M7.5 18.5C6.1 18.5 5 17.4 5 16c0-.7.3-1.3.7-1.8.5-.5 1.1-.7 1.8-.7v1c-.4 0-.8.2-1.1.4-.2.3-.4.7-.4 1.1 0 .8.7 1.5 1.5 1.5v1z"/><path fill="#91ca60" d="M25.5 21h-17c-.6 0-1-.4-1-1V8c0-.6.4-1 1-1h17c.6 0 1 .4 1 1v12c0 .6-.4 1-1 1z"/><path fill="#607d95" d="M7.5 20c0 .6.4 1 1 1h17c.6 0 1-.4 1-1v-2h-19v2z"/><path fill="#4b6c85" d="M9.5 20v-2h-2v2c0 .6.4 1 1 1h2c-.6 0-1-.5-1-1z"/><path fill="#70bb57" d="M25.5 15.9h-11c-2.8 0-5-2.2-5-5V8c0-.6.4-1 1-1h-2c-.6 0-1 .4-1 1v9.9h19v-3c0 .6-.4 1-1 1z"/><path fill="#eef2fa" d="M14.5 21h5v4h-5z"/><path fill="#d5e5f2" d="M17 22.5h2.5V21h-5v4H16v-1.5c0-.6.4-1 1-1z"/><path fill="#607d95" d="M31.5 14.5v-2h-1.2c-.1-.2-.2-.4-.3-.7l.8-.8-1.4-1.4-.8.8c-.2-.1-.4-.2-.7-.3V9h-1.5v3.1c.3-.1.4-.1.6-.1.8 0 1.5.7 1.5 1.5S27.8 15 27 15c-.2 0-.3 0-.5-.1V18H28v-1.2c.2-.1.4-.2.7-.3l.8.8 1.4-1.4-.8-.8c.1-.2.2-.4.3-.7h1.1z"/><path fill="#004463" d="M13.5 15.5h-3c-.1 0-.3-.1-.4-.2s-.1-.2-.1-.4l.8-4c.1-.3.3-.5.6-.4.3.1.5.3.4.6l-.6 3.4h2.4c.3 0 .5.2.5.5s-.3.5-.6.5z"/><path fill="#004463" d="M12.5 16.5c-.3 0-.5-.2-.5-.5v-3c0-.3.2-.5.5-.5s.5.2.5.5v3c0 .3-.2.5-.5.5zM23.5 15.5h-3c-.1 0-.3-.1-.4-.2s-.1-.2-.1-.4l.8-4c.1-.3.3-.5.6-.4.3.1.5.3.4.6l-.6 3.4h2.4c.3 0 .5.2.5.5s-.3.5-.6.5z"/><path fill="#004463" d="M22.5 16.5c-.3 0-.5-.2-.5-.5v-3c0-.3.2-.5.5-.5s.5.2.5.5v3c0 .3-.2.5-.5.5z"/><path fill="#eef2fa" d="M23.5 25.5h-13c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h13c.3 0 .5.2.5.5s-.2.5-.5.5z"/><path fill="#607d95" d="M6.5 22.5h-1c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h1c.3 0 .5.2.5.5s-.2.5-.5.5zM1.5 22.5h-1c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h1c.3 0 .5.2.5.5s-.2.5-.5.5zM3.5 20.5c-.3 0-.5-.2-.5-.5v-1c0-.3.2-.5.5-.5s.5.2.5.5v1c0 .3-.2.5-.5.5zM3.5 25.5c-.3 0-.5-.2-.5-.5v-1c0-.3.2-.5.5-.5s.5.2.5.5v1c0 .3-.2.5-.5.5zM2.1 21.1c-.1 0-.3 0-.4-.1l-.7-.8c-.2-.2-.2-.5 0-.7s.5-.2.7 0l.7.7c.2.2.2.5 0 .7-.1.1-.2.2-.3.2zM5.6 24.6c-.1 0-.3 0-.4-.1l-.7-.7c-.2-.2-.2-.5 0-.7s.5-.2.7 0l.8.7c.2.2.2.5 0 .7-.1.1-.3.1-.4.1zM4.9 21.1c-.1 0-.3 0-.4-.1-.2-.2-.2-.5 0-.7l.7-.7c.2-.2.5-.2.7 0s.2.5 0 .7l-.7.7s-.2.1-.3.1zM1.4 24.6c-.1 0-.3 0-.4-.1-.2-.2-.2-.5 0-.7l.7-.7c.2-.2.5-.2.7 0s.2.5 0 .7l-.7.7c-.1.1-.2.1-.3.1z"/><path fill="#004463" d="M17.5 16.5h-1c-.8 0-1.5-.7-1.5-1.5v-3c0-.8.7-1.5 1.5-1.5h1c.8 0 1.5.7 1.5 1.5v3c0 .8-.7 1.5-1.5 1.5zm-1-5c-.3 0-.5.2-.5.5v3c0 .3.2.5.5.5h1c.3 0 .5-.2.5-.5v-3c0-.3-.2-.5-.5-.5h-1z"/><path fill="#607d95" d="M3.5 19.5c-.7 0-1.3.3-1.8.7-.4.5-.7 1.1-.7 1.8 0 1.4 1.1 2.5 2.5 2.5S6 23.4 6 22s-1.1-2.5-2.5-2.5zm0 3.5c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z"/></svg><br>Sayfa Bulunamadı</div></body></html>';
        exit();
        //header("HTTP/1.0 404 Not Found");
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

class customDb
{
    private $dbAd, $data, $tablolar, $kayitModu, $kayitAdres;
    private $active_select = [];
    private $active_where = [];
    private $active_group = [];
    private $active_limit = [];
    private $active_order = [];

    function __construct($dbad, $kayitModu = 'session', $kayitAdres = '')
    {
        $this->dbAd = $dbad;
        $this->tablolar = [];
        $this->kayitModu = $kayitModu;
        $this->kayitAdres = $kayitAdres;
        if ($this->kayitModu == 'dosya') {
            if ($this->kayitAdres == '') {
                $this->kayitAdres = 'customDbFl.php';
            }
        }
        $this->dbYukle();
    }

    function dbKaydet()
    {
        if ($this->kayitModu == 'session') {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                @session_start();
            }
            if (!isset($_SESSION[$this->dbAd])) {
                $_SESSION[$this->dbAd] = [];
            }
            $_SESSION[$this->dbAd] = [$this->data, $this->tablolar];
        }

        if ($this->kayitModu == 'dosya') {
            $str = '<?php //' . json_encode([$this->data, $this->tablolar]);
            file_put_contents($this->kayitAdres, $str);
        }
    }

    function dbYukle()
    {
        if ($this->kayitModu == 'session') {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                @session_start();
            }
            if (!isset($_SESSION[$this->dbAd])) {
                $_SESSION[$this->dbAd] = [[], []];
            }
            $ta = $_SESSION[$this->dbAd];
            $this->data = $ta[0];
            $this->tablolar = $ta[1]; //information_scheme gibi tablolari falan tutuyor
        }
        if ($this->kayitModu == 'dosya') {
            if (!file_exists($this->kayitAdres)) {
                $str = '<?php //' . json_encode([[], []]);
                file_put_contents($this->kayitAdres, $str);
            }

            $str = file_get_contents($this->kayitAdres);
            if (substr($str, 0, 8) == '<?php //') {
                $d = json_decode(substr($str, 8));
                if (is_array($d)) {
                    $this->data = [];
                    foreach ($d[0] as $k => $v) {
                        //json encode herseyi obje yapiyor diye arraya geri veririyok
                        $this->data[$k] = $v;
                    }
                    $this->tablolar = [];
                    foreach ($d[1] as $k => $v) {
                        $this->tablolar[$k] = $v;
                    }
                } else {
                    exit('data read err 341');
                }
            }
        }
    }

    function createTable($tad, $cols)
    {
        if ($this->tableExists($tad)) {
            return false;
        }
        $this->tablolar[$tad] = $cols;
        $this->data[$tad] = [];
        $this->dbKaydet();
    }

    function dropTable($tad)
    {
        if ($this->tableExists($tad)) {
            unset($this->data[$tad]);
            unset($this->tablolar[$tad]);
            $this->dbKaydet();
        }
    }

    function tableExists($tad)
    {
        return isset($this->tablolar[$tad]);
    }

    private function getAutoIncrement($tad, $col)
    {
        $i = -1;
        foreach ($this->data[$tad] as $s) {
            if ((int) $s->$col > $i) {
                $i = (int) $s->$col;
            }
        }
        return $i + 1;
    }

    function insert($tad, $dt)
    {
        if (!$this->tableExists($tad)) {
            return false;
        }

        $t = (object) [];
        $pki = false;

        $typelist = [];

        foreach ($this->tablolar[$tad] as $k => $col) {
            $typelist[$k] = $col->type;
            if ($col->type == 'int') {
                $t->$k = 0;
            }

            if (strpos($col->type, 'varchar') == 0 || $col->type == 'text') {
                $t->$k = '';
            }

            if (isset($col->extra)) {
                if (
                    $col->type == 'int' &&
                    in_array('auto_increment', $col->extra)
                ) {
                    $t->$k = $this->getAutoIncrement($tad, $k);
                }
                if (
                    $col->type == 'int' &&
                    in_array('primary', $col->extra) &&
                    in_array('key', $col->extra)
                ) {
                    $pki = $t->$k;
                }
            }
        }

        foreach ($dt as $k => $v) {
            if ($typelist[$k] == 'int') {
                if (is_numeric($v)) {
                    $t->$k = $v;
                }
            } elseif (
                strpos($typelist[$k], 'varchar') == 0 ||
                $typelist[$k] == 'text'
            ) {
                if (is_string($v)) {
                    $t->$k = $v;
                } else {
                    $t->$k = (string) $v;
                }
            } else {
                $t->$k = $v;
            }
        }

        $this->data[$tad][] = $t;
        $this->dbKaydet();

        if ($pki !== false) {
            return $pki;
        }
        return true;
    }

    public function select($kr)
    {
        $this->active_select[] = $kr;
        return $this;
    }

    public function filter($col, $data, $cond = '=', $op = 'or')
    {
        $this->active_where[] = (object) [
            'col' => $col,
            'data' => $data,
            'cond' => $cond,
            'op' => $op,
        ];
        return $this;
    }

    function limit($start, $count = -1)
    {
        $start = (int) $start;
        $count = (int) $count;
        if ($count == -1) {
            $count = $start;
            $start = 0;
        }

        if ($count > 0 && $start >= 0) {
            $this->active_limit = ['start' => $start, 'count' => $count];
        }
        return $this;
    }

    function truncate($tad)
    {
        $this->data[$tad] = [];
        $this->dbKaydet();
    }

    function delete($tad)
    {
        $snc = [];

        foreach ($this->data[$tad] as $s) {
            if (!$this->filterControl($s)) {
                $snc[] = $s;
            }
        }

        $this->data[$tad] = $snc;
        $this->dbKaydet();
        $this->resetFilter();
        return true;
    }

    function update($tad, $dt)
    {
        $snc = [];

        foreach ($this->data[$tad] as $k => $s) {
            if ($this->filterControl($s)) {
                foreach ($dt as $dk => $dv) {
                    $s->$dk = $dv;
                }
                $this->data[$tad][$k] = $s;
            }
        }

        $this->dbKaydet();
        $this->resetFilter();
        return true;
    }

    private function filterControl($s)
    {
        $debug = false;

        $se = true;
        if (count($this->active_where) > 0) {
            $ilkcond = true;
            foreach ($this->active_where as $wh) {
                $cc = $wh->col;
                if (isset($s->$cc)) {
                    if ($debug) {
                        echo 'veri: ' . $s->$cc . PHP_EOL;
                    }
                    if ($debug) {
                        echo 'cond: ' . $wh->cond . PHP_EOL;
                    }
                    if ($debug) {
                        echo 'data: ' . $wh->data . PHP_EOL;
                    }

                    if ($wh->op == 'and' && $se === false) {
                        break;
                    }
                    $st = false;
                    $dt = $s->$cc; //veri
                    if (trim($wh->cond) == '=') {
                        $st = $dt == $wh->data;
                    }
                    if (trim($wh->cond) == '!=') {
                        $st = $dt != $wh->data;
                    }
                    if (trim($wh->cond) == '>') {
                        $st = $dt > $wh->data;
                    }
                    if (trim($wh->cond) == '>=') {
                        $st = $dt >= $wh->data;
                    }
                    if (trim($wh->cond) == '<') {
                        $st = $dt < $wh->data;
                    }
                    if (trim($wh->cond) == '<=') {
                        $st = $dt <= $wh->data;
                    }
                    if ($st !== true) {
                        $st = false;
                    }

                    if ($debug) {
                        echo 'st: ' . var_export($st, true) . PHP_EOL;
                    }

                    if (
                        $wh->op == 'or' &&
                        ($st === true || $se === true) &&
                        $ilkcond == false
                    ) {
                        $st = true;
                    }
                    $se = $st;
                    if ($debug) {
                        echo 'se: ' . var_export($se, true) . PHP_EOL;
                    }

                    if ($debug) {
                        echo '----' . PHP_EOL;
                    }

                    $ilkcond = false;
                }
            }

            $sonucaEkle = $se;
            if ($debug) {
                echo 'sonuc: ' . var_export($sonucaEkle, true) . PHP_EOL;
            }
        }
        return $se;
    }

    function get($tad)
    {
        $debug = true;
        $snc = [];

        foreach ($this->data[$tad] as $s) {
            if ($this->filterControl($s)) {
                $snc[] = $s;
            }
        }
        $snc = $this->sortData($snc, $tad);
        $snc = $this->limitData($snc);
        $snc = $this->selectData($snc);
        $this->resetFilter();
        return new customDb_database_result($snc);
    }

    private function selectData($dta)
    {
        if (sizeof($this->active_select) > 0) {
            $ta = [];
            foreach ($dta as $s) {
                $t = (object) [];
                foreach ($this->active_select as $sl) {
                    $t->$sl = $s->$sl;
                }
                $ta[] = $t;
            }
            $dta = $ta;
        }
        return $dta;
    }

    private function limitData($dta)
    {
        if (sizeof($this->active_limit) > 0) {
            $ct = $this->active_limit['count'];
            $st = $this->active_limit['start'];

            $t = [];
            $i = 0;
            $count = 0;
            foreach ($dta as $s) {
                if ($count >= $ct) {
                    break;
                }
                if ($i >= $st) {
                    $t[] = $s;
                    $count++;
                }
                $i++;
            }
            $dta = $t;
        }
        return $dta;
    }

    private function sortData($dta, $tad)
    {
        $tm = $dta;
        if (sizeof($this->active_order) > 0) {
            foreach ($this->active_order as $order) {
                $ta = [];
                foreach ($tm as $k => $s) {
                    $c = $order[0];
                    $ta[$k] = $s->$c;
                }

                asort($ta);
                if ($order[1] == 'desc') {
                    $ta = array_reverse($ta, true);
                }

                $nta = [];
                foreach ($ta as $k => $v) {
                    $nta[] = $tm[$k];
                }
                $tm = $nta;
            }
        }
        return $tm;
    }

    function group($col)
    {
        $this->active_group[] = $col;
        return $this;
    }

    function order($col, $dir = 'asc')
    {
        $this->active_order[] = [$col, $dir];
        return $this;
    }

    function resetFilter()
    {
        $this->active_select = [];
        $this->active_where = [];
        $this->active_limit = [];
        $this->active_order = [];
        $this->active_group = [];
    }
}

class customDb_database_result
{
    var $res;
    var $sr = 0;
    public function __construct($r)
    {
        $this->res = $r;
    }

    function result()
    {
        return $this->res;
    }

    function row()
    {
        $r = false;
        if (isset($this->res[$this->sr])) {
            $r = $this->res[$this->sr];
            $this->sr++;
        }
        return $r;
    }

    function num_rows()
    {
        return count($this->res);
    }
}

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

function odump($v)
{
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
}

function redirect($uri)
{
    $uri = str_replace('//', '/', $uri);
    $adr = burl(true) . '/' . $uri;
    header('location: ' . $adr);
}

function lastpage($git = true)
{
    @session_start();
    if ($git) {
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

new orcMiniFramework();
