<?php
/**
 * 分类控制层
 */
class CategoriesController extends Controller
{
    public $defaultAction = 'Index';
    public $userid;
    public $username;
       
    public function __construct()
    {
        parent::__construct();
        if(Wave::app()->user->getState('userid')) {
            $this->userid = Wave::app()->user->getState('userid');
            $this->username = Wave::app()->user->getState('username');
        }else{
            $this->redirect(Wave::app()->homeUrl);
        }
    }

    /**
     * 分类页
     */
    public function actionIndex()
    {
        $Common = new Common();
        $Terms = new Terms();
        $list = $Terms->getTermsList($Common, 'category');

        $this->render('index', array('list'=>$list));
    }

    /**
     * 添加、修改
     */
    public function actionModify()
    {
        $Common = new Common();
        $Terms = new Terms();
        $cid = (int)$_POST['cid'];
        $data = $Common->getFilter($_POST);
        unset($data['cid']);
        if($cid > 0) {
            $Terms->modifyTerms($Common, $data, $cid, 'category');
            $msg = '修改成功！';
        }else{
            $Terms->addTerms($Common, $data, 'category');
            $msg = '添加成功！';
        }

        $this->jumpBox($msg, Wave::app()->homeUrl.'/categories', 2);
    }

    /**
     * 修改页面
     */
    public function actionEdit($id)
    {
        $id = (int)$id;
        if($id > 0){
            $Common = new Common();
            $Terms = new Terms();
            $list = $Terms->getTermsList($Common, 'category');
            $arr = $Terms->getOneTerms($Common, $id, 'category');
        }

        $this->render('edit', array('list'=>$list, 'arr'=>$arr));
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        if($id > 0){
            $Common = new Common();
            $Terms = new Terms();
            $res = $Terms->getDelete($Common, $id);
            if($res === 1) {
                $msg = '有子类，不能删除！';
            }elseif($res === 2){
                $msg = '有文章，不能删除！';
            }else{
                $msg = '删除成功！';
            }
        }else{
           $msg = '请选择要删除的分类！'; 
        }

        $this->jumpBox($msg, Wave::app()->homeUrl.'/categories', 2);
    }

}