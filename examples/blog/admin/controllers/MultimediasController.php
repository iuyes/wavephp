<?php
/**
 * 多媒体控制层
 */
class MultimediasController extends Controller
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
     * 文章页
     */
    public function actionIndex()
    {
        $Common = new Common();
        $Options = new Options();
        $Multimedias = new Multimedias();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagesize = 10;
        $data = array();
        $data['start'] = ($page-1)*$pagesize;
        $data['limit'] = $pagesize;
        $list = $Multimedias->getMultimediasList($Common, $data);
        $baseurl = $Options->getSiteurl($Common).Wave::app()->request->baseUrl;
        foreach ($list as $key => $value) {
            if($value['file_type'] == 'images')
                $list[$key]['file_abso'] = $baseurl.'/uploadfile/'.$value['file_type']
                                    .'/small/'.$value['save_name'];
        }
        $count = $Multimedias->getMultimediaCount($Common);
        $url = Wave::app()->homeUrl.'/multimedias';
        $pagebar = $Common->getAdminPageBar($url, $count, $pagesize, $page);

        $this->render('index', array('list'=>$list,'page'=>$page,'pagebar'=>$pagebar));
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if($id > 0){
            $Common = new Common();
            $Multimedias = new Multimedias();
            $projectPath = Wave::app()->projectPath;
            $uploadPath = $projectPath.'uploadfile/';
            $res = $Multimedias->deleteMultimedias($Common, $id, $uploadPath);
            $msg = $res === true ? '删除媒体成功！' : '删除媒体失败！';
        }else{
            $msg = '请选择要删除的媒体！';
        }

        $this->jumpBox($msg, 
        Wave::app()->homeUrl.'/multimedias/?page='.$page, 1);
    }

}