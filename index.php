<?php
require_once 'phplibs/autoloader.php';
define('basepath', 'stackedbargraph');
define('baseurl', 'stackedbargraph');

class app extends orcFrameworkMini_base
{
    public function __construct()
    {
        parent::__construct();
        $this->db = new orcDatabase('datafile.php', true, false);
    }
    public function c_ana()
    {
        $this->view('homepage');
    }
}

$app = new app();
