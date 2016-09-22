<?php
/*
################################################################################
#                              J! Template Creator                            #
################################################################################
# Class Name: JTemplateCreator                                                #
# File-Release-Date:  2015/09/04                                               #
#==============================================================================#
# Author: Max Stemplevski                                                      #
# Site:                                                                        #
# Twitter: @stemax                                                             #
# Copyright 2014+ - All Rights Reserved.                                        #
################################################################################
*/

/* Licence
 * #############################################################################
 * | This program is free software; you can redistribute it and/or             |
 * | modify it under the terms of the GNU General var License                  |
 * | as published by the Free Software Foundation; either version 2            |
 * | of the License, or (at your option) any later version.                    |
 * |                                                                           |
 * | This program is distributed in the hope that it will be useful,           |
 * | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
 * | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the              |
 * | GNU General var License for more details.                                 |
 * |                                                                           |
 * +---------------------------------------------------------------------------+
 */

class JTemplateCreator
{

    public $tname = null;
    public $name = null;
    public $creationdate = null;
    public $version = null;
    public $descr = null;
    public $author = null;
    public $authoremail = null;
    public $authorurl = null;
    public $copyright = null;
    public $license = null;
    public $zipfiles = array();

    function __construct()
    {
        $this->tname = isset($_POST['tname']) ? $_POST['tname'] : '';
        $this->name = isset($_POST['name']) ? $_POST['name'] : '';
        $this->creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : '';
        $this->version = isset($_POST['version']) ? $_POST['version'] : '';
        $this->descr = isset($_POST['descr']) ? $_POST['descr'] : '';
        $this->author = isset($_POST['author']) ? $_POST['author'] : '';
        $this->authoremail = isset($_POST['authoremail']) ? $_POST['authoremail'] : '';
        $this->authorurl = isset($_POST['authorurl']) ? $_POST['authorurl'] : '';
        $this->copyright = isset($_POST['copyright']) ? $_POST['copyright'] : '';
        $this->license = isset($_POST['license']) ? $_POST['license'] : '';
    }

    function generateIndexFile()
    {
        $php_content = array();
        $php_content [] = "<?php";
        $php_content [] = "defined('_JEXEC') or die;";
        $php_content [] = '';
        $php_content [] = '$app         = JFactory::getApplication();';
        $php_content [] = '$doc         = JFactory::getDocument();';
        $php_content [] = '$user            = JFactory::getUser();';
        $php_content [] = '$this->language  = $doc->language;';
        $php_content [] = '$this->direction = $doc->direction;';
        $php_content [] = '';
        $php_content [] = '$doc->setHtml5(true);';
        $php_content [] = '// Getting params from template';
        $php_content [] = '$params = $app->getTemplate(true)->params;';
        $php_content [] = '// Detecting Active Variables';
        $php_content [] = '$option   = $app->input->getCmd(\'option\', \'\');';
        $php_content [] = '$view     = $app->input->getCmd(\'view\', \'\');';
        $php_content [] = '$layout   = $app->input->getCmd(\'layout\', \'\');';
        $php_content [] = '$task     = $app->input->getCmd(\'task\', \'\');';
        $php_content [] = '$itemid   = $app->input->getCmd(\'Itemid\', \'\');';
        $php_content [] = '$sitename = $app->get(\'sitename\');';
        $php_content [] = '';
        $php_content [] = '// Add JavaScript Frameworks';
        $php_content [] = "JHtml::_('bootstrap.framework');";
        $php_content [] = '$doc->addScriptVersion($this->baseurl . \'/templates/\' . $this->template . \'/js/template.js\');';
        $php_content [] = '// Add Stylesheets';
        $php_content [] = '$doc->addStyleSheetVersion($this->baseurl . \'/templates/\' . $this->template . \'/css/template.css\');';
        $php_content [] = '';
        $php_content [] = 'if ($this->params->get(\'logoFile\'))';
        $php_content [] = '{
    $logo = \'<img src="\' . JUri::root() . $this->params->get(\'logoFile\') . \'" alt="\' . $sitename . \'" />\';
}';
        $php_content [] = '';
        $php_content [] = '?>';
        $php_content [] = '<!DOCTYPE html>';
        $php_content [] = '<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">';
        $php_content [] = '<head>';
        $php_content [] = '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
        $php_content [] = '<jdoc:include type="head" />';
        $php_content [] = '<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->';
        $php_content [] = '</head>';
        $php_content [] = '<body class="site <?php echo $option
        . \' view-\' . $view
        . ($layout ? \' layout-\' . $layout : \' no-layout\')
        . ($task ? \' task-\' . $task : \' no-task\')
        . ($itemid ? \' itemid-\' . $itemid : \'\')
        . ($params->get(\'fluidContainer\') ? \' fluid\' : \'\');
	echo ($this->direction == \'rtl\' ? \' rtl\' : \'\');
?>">';
        $php_content [] = '<div class="body">';
        $php_content [] = '<div class="container">';
        $php_content [] = '<header class="header" role="banner">
                            <div class="header-inner clearfix">
                                <a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
                                    <?php echo $logo; ?>
                                </a>
                                <div class="header-search pull-right">
                                    <jdoc:include type="modules" name="position-0" style="none" />
                                </div>
                            </div>
                        </header>';
        $php_content [] = '<?php if ($this->countModules(\'position-1\')) : ?>
                            <nav class="navigation" role="navigation">
                                <div class="navbar pull-left">
                                    <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </a>
                                </div>
                                <div class="nav-collapse">
                                    <jdoc:include type="modules" name="position-1" style="none" />
                                </div>
                            </nav>
                        <?php endif; ?>';
        $php_content [] = '	<main id="content" role="main" class="span-12">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-2" style="none" />
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<!-- End Content -->
				</main>';
        $php_content [] = '<footer class="footer" role="contentinfo">
                    <div class="container">
                        <hr />
                        <jdoc:include type="modules" name="footer" style="none" />
                        <p>
                            &copy; <?php echo date(\'Y\'); ?> <?php echo $sitename; ?>
                        </p>
                    </div>
                </footer>';
        $php_content [] = '<jdoc:include type="modules" name="debug" style="none" />';
        $php_content [] = '</body>';
        $php_content [] = '</html>';

        $php_str = implode("\r\n", $php_content);
        return $php_str;
    }

    function generateErrorFile()
    {
        $php_content = array();
        $php_content [] = "<?php";
        $php_content [] = "defined('_JEXEC') or die;";
        $php_content [] = '';
        $php_content [] = '$app         = JFactory::getApplication();';
        $php_content [] = '$doc         = JFactory::getDocument();';
        $php_content [] = '$user            = JFactory::getUser();';
        $php_content [] = '$this->language  = $doc->language;';
        $php_content [] = '$this->direction = $doc->direction;';
        $php_content [] = '';
        $php_content [] = '$doc->setHtml5(true);';
        $php_content [] = '// Getting params from template';
        $php_content [] = '$params = $app->getTemplate(true)->params;';
        $php_content [] = '// Detecting Active Variables';
        $php_content [] = '$option   = $app->input->getCmd(\'option\', \'\');';
        $php_content [] = '$view     = $app->input->getCmd(\'view\', \'\');';
        $php_content [] = '$layout   = $app->input->getCmd(\'layout\', \'\');';
        $php_content [] = '$task     = $app->input->getCmd(\'task\', \'\');';
        $php_content [] = '$itemid   = $app->input->getCmd(\'Itemid\', \'\');';
        $php_content [] = '$sitename = $app->get(\'sitename\');';
        $php_content [] = '';
        $php_content [] = '// Add JavaScript Frameworks';
        $php_content [] = "JHtml::_('bootstrap.framework');";
        $php_content [] = '$doc->addScriptVersion($this->baseurl . \'/templates/\' . $this->template . \'/js/template.js\');';
        $php_content [] = '// Add Stylesheets';
        $php_content [] = '$doc->addStyleSheetVersion($this->baseurl . \'/templates/\' . $this->template . \'/css/template.css\');';
        $php_content [] = '';
        $php_content [] = '?>';
        $php_content [] = '<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body class="contentpane modal">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>';

        $php_str = implode("\r\n", $php_content);
        return $php_str;
    }

    function generateOfflineFile()
    {
        $php_content = array();
        $php_content [] = "<?php";
        $php_content [] = "defined('_JEXEC') or die;";
        $php_content [] = '';
        $php_content [] = '$app         = JFactory::getApplication();';
        $php_content [] = '$doc         = JFactory::getDocument();';
        $php_content [] = '$user            = JFactory::getUser();';
        $php_content [] = '$this->language  = $doc->language;';
        $php_content [] = '$this->direction = $doc->direction;';
        $php_content [] = '';
        $php_content [] = '$doc->setHtml5(true);';
        $php_content [] = '// Getting params from template';
        $php_content [] = '$params = $app->getTemplate(true)->params;';
        $php_content [] = '// Detecting Active Variables';
        $php_content [] = '$option   = $app->input->getCmd(\'option\', \'\');';
        $php_content [] = '$view     = $app->input->getCmd(\'view\', \'\');';
        $php_content [] = '$layout   = $app->input->getCmd(\'layout\', \'\');';
        $php_content [] = '$task     = $app->input->getCmd(\'task\', \'\');';
        $php_content [] = '$itemid   = $app->input->getCmd(\'Itemid\', \'\');';
        $php_content [] = '$sitename = $app->get(\'sitename\');';
        $php_content [] = '';
        $php_content [] = '// Add JavaScript Frameworks';
        $php_content [] = "JHtml::_('bootstrap.framework');";
        $php_content [] = '$doc->addScriptVersion($this->baseurl . \'/templates/\' . $this->template . \'/js/template.js\');';
        $php_content [] = '// Add Stylesheets';
        $php_content [] = '$doc->addStyleSheetVersion($this->baseurl . \'/templates/\' . $this->template . \'/css/template.css\');';
        $php_content [] = '';
        $php_content [] = '?>';
        $php_content [] = '<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body class="contentpane modal">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>';

        $php_str = implode("\r\n", $php_content);
        return $php_str;
    }

    function generateComponentFile()
    {
        $php_content = array();
        $php_content [] = "<?php";
        $php_content [] = "defined('_JEXEC') or die;";
        $php_content [] = '';
        $php_content [] = '$app         = JFactory::getApplication();';
        $php_content [] = '$doc         = JFactory::getDocument();';
        $php_content [] = '$user            = JFactory::getUser();';
        $php_content [] = '$this->language  = $doc->language;';
        $php_content [] = '$this->direction = $doc->direction;';
        $php_content [] = '';
        $php_content [] = '$doc->setHtml5(true);';
        $php_content [] = '// Getting params from template';
        $php_content [] = '$params = $app->getTemplate(true)->params;';
        $php_content [] = '// Detecting Active Variables';
        $php_content [] = '$option   = $app->input->getCmd(\'option\', \'\');';
        $php_content [] = '$view     = $app->input->getCmd(\'view\', \'\');';
        $php_content [] = '$layout   = $app->input->getCmd(\'layout\', \'\');';
        $php_content [] = '$task     = $app->input->getCmd(\'task\', \'\');';
        $php_content [] = '$itemid   = $app->input->getCmd(\'Itemid\', \'\');';
        $php_content [] = '$sitename = $app->get(\'sitename\');';
        $php_content [] = '';
        $php_content [] = '// Add JavaScript Frameworks';
        $php_content [] = "JHtml::_('bootstrap.framework');";
        $php_content [] = '$doc->addScriptVersion($this->baseurl . \'/templates/\' . $this->template . \'/js/template.js\');';
        $php_content [] = '// Add Stylesheets';
        $php_content [] = '$doc->addStyleSheetVersion($this->baseurl . \'/templates/\' . $this->template . \'/css/template.css\');';
        $php_content [] = '';
        $php_content [] = '?>';
        $php_content [] = '<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body class="contentpane modal">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>';

        $php_str = implode("\r\n", $php_content);
        return $php_str;
    }

    function generateTemplateDetailsXml()
    {
        $xml_content = array();
        $xml_content [] = '<?xml version="1.0" encoding="utf-8"?>';
        $xml_content [] = '<!DOCTYPE install PUBLIC "-//Joomla! 2.5//DTD template 1.0//EN" "https://www.joomla.org/xml/dtd/2.5/template-install.dtd">';
        $xml_content [] = '<extension version="3.1" type="template" client="site">';

        $xml_content [] = '<name>' . $this->tname . '</name>';
        $xml_content [] = '<version>' . $this->version . '</version>';
        $xml_content [] = '<creationDate>' . $this->creationdate . '</creationDate>';
        $xml_content [] = '<author>' . $this->author . '</author>';
        $xml_content [] = '<authorEmail>' . $this->authoremail . '</authorEmail>';
        $xml_content [] = '<authorUrl>' . $this->authorurl . '</authorUrl>';
        $xml_content [] = '<copyright>' . $this->copyright . ' [Generated by SMT JGenerator]</copyright>';
        $xml_content [] = '<license>' . $this->license . '</license>';
        $xml_content [] = '<description>' . $this->descr . '</description>';

        $xml_content [] = '<files>';
        $xml_content [] = '<filename>index.php</filename>';
        $xml_content [] = '<filename>component.php</filename>';
        $xml_content [] = '<filename>error.php</filename>';
        $xml_content [] = '<filename>offline.php</filename>';
        $xml_content [] = '<filename>favicon.ico</filename>';
        $xml_content [] = '<filename>index.php</filename>';
        $xml_content [] = '<filename>templateDetails.xml</filename>';
        $xml_content [] = '<folder>css</folder>';
        $xml_content [] = '<folder>html</folder>';
        $xml_content [] = '<folder>images</folder>';
        $xml_content [] = '<folder>js</folder>';
        $xml_content [] = '<folder>languages</folder>';
        $xml_content [] = '</files>';


        $xml_content [] = '<positions>';
        $xml_content [] = '<position>header</position>';
        $xml_content [] = '<position>position-0</position>';
        $xml_content [] = '<position>position-1</position>';
        $xml_content [] = '<position>position-2</position>';
        $xml_content [] = '<position>position-3</position>';
        $xml_content [] = '<position>position-4</position>';
        $xml_content [] = '<position>position-5</position>';
        $xml_content [] = '<position>position-6</position>';
        $xml_content [] = '<position>position-7</position>';
        $xml_content [] = '<position>position-8</position>';
        $xml_content [] = '<position>position-9</position>';
        $xml_content [] = '<position>position-10</position>';
        $xml_content [] = '<position>position-11</position>';
        $xml_content [] = '<position>position-12</position>';
        $xml_content [] = '<position>position-13</position>';
        $xml_content [] = '<position>position-14</position>';
        $xml_content [] = '<position>position-15</position>';
        $xml_content [] = '<position>position-16</position>';
        $xml_content [] = '<position>position-17</position>';
        $xml_content [] = '<position>position-18</position>';
        $xml_content [] = '<position>position-19</position>';
        $xml_content [] = '<position>position-20</position>';
        $xml_content [] = '<position>footer</position>';
        $xml_content [] = '<position>debug</position>';
        $xml_content [] = '<positions>';

        $xml_content [] = '<languages folder="language"></languages>';
        $xml_content [] = '<language tag="en-GB">languages/en-GB.' . $this->sname . '.ini</language>';
        $xml_content [] = '<language tag="en-GB">languages/en-GB.' . $this->sname . '.sys.ini</language>';
        $xml_content [] = '</languages>';

        $xml_content [] = '<config>';
        $xml_content [] = '<fields name="params">';
        $xml_content [] = '<fieldset name="advanced">';
        $xml_content [] = '<field name="logo" class="" type="media" default="" label="LOGO"  description="Site logo" />';
        $xml_content [] = '<field name="site_title"  type="text" default=""   label="JGLOBAL_TITLE"   description="JFIELD_ALT_PAGE_TITLE_LABEL"  filter="string" />';
        $xml_content [] = '<field name="sitedescription"  type="text" default=""   label="JGLOBAL_DESCRIPTION"   description="JGLOBAL_SUBHEADING_DESC"  filter="string" />';
        $xml_content [] = '</fieldset>';
        $xml_content [] = '</fields>';
        $xml_content [] = '</config>';

        $xml_content [] = '</extension>';
        $xml_str = implode("\r\n", $xml_content);
        return $xml_str;
    }

    function createFile($filename = '', $content = '')
    {
        $fp = fopen($filename, "w");
        $wresult = fwrite($fp, $content);
        fclose($fp);
        return $filename;
    }

    function addToZip($filename = '')
    {
        $this->zipfiles[] = $filename;
    }

    function createAndSaveZip()
    {
        if (extension_loaded('zip')) {
            $zip = new ZipArchive();
            $zip_name = $this->sname . ".zip";
            if ($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE) {
                return false;
            }
            if (sizeof($this->zipfiles))
                foreach ($this->zipfiles as $zfile) {
                    $zip->addFile($zfile);
                }
            $zip->close();
            if (file_exists($zip_name)) {
                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="' . $zip_name . '"');
                readfile($zip_name);
                unlink($zip_name);

                if (sizeof($this->zipfiles))
                    foreach ($this->zipfiles as $zfile) {
                        unlink($zfile);
                    }
            }
        } else
            return false;
    }

    function getEmptyHtml()
    {
        return '<html><body></body></html>';
    }

    function deleteTmpFolders()
    {
        if (file_exists("languages")) rmdir("languages");
    }

    function run()
    {
        if (isset($_POST['tname']) && $_POST['name']) {
            $this->addToZip($this->createFile('templateDetails.xml', $this->generateTemplateDetailsXml()));
            $this->addToZip($this->createFile('index.php', $this->generateIndexFile()));
            $this->addToZip($this->createFile('component.php', $this->generateComponentFile()));
            $this->addToZip($this->createFile('error.php', $this->generateErrorFile()));
            $this->addToZip($this->createFile('offline.php', $this->generateOfflineFile()));

            $this->createAndSaveZip();
            $this->deleteTmpFolders();
        } else {
            $this->showform();
        }
    }

    function showForm()
    {
        ?>
        <html>
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
            <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
            <style>
                .header_3d {
                    color: #fffffc;
                    text-shadow: 0 1px 0 #999, 0 2px 0 #888, 0 3px 0 #777, 0 4px 0 #666, 0 5px 0 #555, 0 6px 0 #444, 0 7px 0 #333, 0 8px 7px #001135;
                }
            </style>
            <title>J! Template Creator</title>
        </head>
        <body>
        <form method="post" action="index.php" name="subform" class="form"/>
        <div class="jumbotron navbar-form">

            <div class="container">
                <div class="page-header header_3d"><h1>J! Template Creator:</h1></div>
                <table width="50%" class="table table-striped table-hover">
                    <tr>
                        <td>System name of template:</td>
                        <td><input class="form-control required" type="text" value="com_" name="tname" size="45"/></td>
                    </tr>
                    <tr>
                        <td>Title(Name) of template:</td>
                        <td><input class="form-control required" type="text" value="" name="name" size="45"/></td>
                    </tr>
                    <tr>
                        <td>CreationDate:</td>
                        <td><input class="form-control" type="text" value="<?php echo date('F Y'); ?>"
                                   name="creationdate"
                                   size="45"/></td>
                    </tr>
                    <tr>
                        <td>Version:</td>
                        <td><input class="form-control" type="text" value="1.0.0" name="version" size="45"/></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea class="form-control" name="descr"></textarea></td>
                    </tr>
                    <tr>
                        <td>Author:</td>
                        <td><input class="form-control" type="text" value="" name="author" size="45"/></td>
                    </tr>
                    <tr>
                        <td>AuthorEmail:</td>
                        <td><input class="form-control" type="text" value="" name="authoremail" size="45"/></td>
                    </tr>
                    <tr>
                        <td>AuthorUrl:</td>
                        <td><input class="form-control" type="text" value="" name="authorurl" size="45"/></td>
                    </tr>
                    <tr>
                        <td>Copyright:</td>
                        <td><input class="form-control" type="text"
                                   value="Copyright 2010 - <?php echo date('Y');?>. All rights reserved"
                                   name="copyright"
                                   size="45"/></td>
                    </tr>
                    <tr>
                        <td>License:</td>
                        <td><input class="form-control" type="text" value="GNU" name="license" size="45"/></td>
                    </tr>
                </table>
                <button class="btn btn-primary btn-lg" type="submit">Generate new template</button>
            </div>
        </div>
        </form>
        <div class="btn btn-primary btn-xs pull-right " disabled="true">Created by SMT</div>
        </body>
        </html>
    <?php
    }
}
?>