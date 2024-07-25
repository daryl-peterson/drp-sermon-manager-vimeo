<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\App;
use DRPSMVimeo\Core\Exceptions\VimeoException;
use DRPSMVimeo\Notice;
use DRPSMVimeo\RequirementChecks;
use DRPSMVimeo\Requirements;

use const DRPSMVimeo\FILE;
use const DRPSMVimeo\PLUGIN_SM;

/**
 * Class description.
 *
 * @category
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @since       1.0.0
 */
class RequirementsTest extends BaseTest
{
    private RequirementChecks $obj;

    public function setup(): void
    {
        $this->obj = new RequirementChecks();
    }

    public function teardown(): void
    {
        $obj = App::getRequirementsInt();
        $obj->notice()->delete();
    }

    public function tester()
    {
        wp_set_current_user(1);

        $obj = App::getRequirementsInt();
        $result = $obj->isCompatible();
        $this->assertNull($result);

        deactivate_plugins(PLUGIN_SM);
        $obj->isCompatible();

        activate_plugin(PLUGIN_SM);
        activate_plugin(FILE);

        $obj = new Requirements(Notice::getInstance());
        $this->assertInstanceOf(Requirements::class, $obj);
    }

    public function testPHPVer()
    {
        $this->expectException(VimeoException::class);
        $this->obj->checkPHPVer('9.0');
    }

    public function testWPVer()
    {
        $this->expectException(VimeoException::class);
        $this->obj->checkWPVer('7.0');
    }

    public function testPlugin()
    {
        $this->expectException(VimeoException::class);
        $this->obj->checkPlugin('ba-ba-blacksheep.php');
    }
}
