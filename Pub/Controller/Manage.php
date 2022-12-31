<?php

namespace lulzapps\UserForums\Pub\Controller;

class Manage extends \XF\Pub\Controller\AbstractController
{
    const FORUM_NAME_MAX_LENGTH = 25;
    const FORUM_NAME_REGEX = '#^[a-zA-z0-9_]{3,' . self::FORUM_NAME_MAX_LENGTH . '}$#';

    const FORUM_TITLE_MAX_LENGTH = 50;
    const FORUM_TITLE_REGEX = '#^.{3,' . self::FORUM_TITLE_MAX_LENGTH . '}$#';

    const FORUM_DESC_MAX_LENGTH = 255;

    public function actionCreate()
    {
        $input = $this->filter([
            'forum_name' => 'str',
            'forum_title' => 'str',
            'forum_desc' => 'str',
            'forum_type' => 'str',
        ]);

        if (preg_match(self::FORUM_NAME_REGEX, $input['forum_name']) != 1)
        {
            return $this->error('TODO: create phrase for invalid forum name error');
        }

        if (preg_match(self::FORUM_TITLE_REGEX, $input['forum_title']) != 1)
        {
            return $this->error('TODO: create phrase for invalid forum title error');
        }

        if (strlen($input['forum_desc']) > self::FORUM_DESC_MAX_LENGTH)
        {
            return $this->error('TODO: create phrase for invalid forum description error');
        }

        if ($input['forum_type'] != 'public' && $input['forum_type'] != 'private' && $input['forum_type'] != 'restricted')
        {
            return $this->error('TODO: create phrase for invalid forum type error');
        }

        $msg = "$input[forum_name] $input[forum_title] $input[forum_desc] $input[forum_type]";
        return $this->error($msg);
    }

    public function actionIndex()
    {
        $viewParams = 
        [   
            'name_max_length' => self::FORUM_NAME_MAX_LENGTH,
            'title_max_length' => self::FORUM_TITLE_MAX_LENGTH,
            'desc_max_length' => self::FORUM_DESC_MAX_LENGTH,
            'createUrl' => $this->buildLink('userforums/create')
        ];

        return $this->view('lulzapps\UserForums:View', 'lz_userforums_manage_view', $viewParams);
    }
}