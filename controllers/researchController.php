
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/matrans-site"."/models/researchModel.php");
require($_SERVER['DOCUMENT_ROOT']."/matrans-site"."/vues/researchVue.php");
class researchController{
    public function research($d,$a){
        $m = new researchModel();
        $res = $m->research($d,$a);
        $v = new researchVue();
        $v->afficherPage($res);
    }
}
?>