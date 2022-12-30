<?php

namespace lulzapps\UserForums\Pub\Controller;

class Manage extends \XF\Pub\Controller\AbstractController
{
    public function actionCreate()
    {
        $input = $this->filter([
            'forum_name' => 'str',
            'forum_title' => 'str',
            'forum_desc' => 'str',
            'forum_type' => 'str',
        ]);

        $msg = "$input[forum_name] $input[forum_title] $input[forum_desc] $input[forum_type]";

        throw $this->exception($this->error($msg));
		// $viewParams = [
		// ];
		// return $this->view('XF:Warning\Info', 'warning_info', $viewParams);
    }

    public function actionIndex()
    {
        $viewParams = 
        [
            'createUrl' => $this->buildLink('manage/create')
        ];

        return $this->view('lulzapps\UserForums:View', 'lz_userforums_manage_view', $viewParams);
    }
}