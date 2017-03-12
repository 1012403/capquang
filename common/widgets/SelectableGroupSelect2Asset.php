<?php
namespace common\widgets;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectableGroupSelect2Asset
 *
 * @author Than
 */
class SelectableGroupSelect2Asset extends \kartik\base\AssetBundle
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('js', ['js/jquery-ui.min', 'js/jquery.multiselect.filter', 'js/jquery.multiselect']);
        $this->setupAssets('css', ['css/jquery-ui', 'css/jquery.multiselect.filter', 'css/jquery.multiselect']);
        parent::init();
    }
}