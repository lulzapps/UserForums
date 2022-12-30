<?php

namespace lulzapps\UserForums;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;
	
    public function installStep1()
    {
        $this->schemaManager()->alterTable('xf_forum', function(Alter $table)
        {
            $table->addColumn('lz_userforums_owner_id', 'int')->setDefault(0);
        });
	}

    public function installStep2()
    {
        $this->schemaManager()->createTable('lz_userforums_moderators', 
            function(Create $table)
            {
                $table->addColumn('moderator_id', 'int')->autoIncrement();
                $table->addColumn('node_id', 'int');
                $table->addColumn('user_id', 'int');
                $table->addColumn('role', 'tinyint')->setDefault(0);
                $table->addPrimaryKey('moderator_id');
            });
    }    
}