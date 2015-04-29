<?php

namespace monecle\adminlte\widgets;

use yii\helpers\Html;
use \yii\bootstrap\Widget;

/*
 *      InfoBox::widget([
 *          'iconBgColor' => 'bg-yellow',
 *          'icon'        => 'ion ion-ios-people-outline',
 *          'title'       => 'New Members',
 *          'text'        => '2,000'
 *      ]);
 *
 *      InfoBox::widget([
 *          'options'     => ['class' => 'bg-yellow'],
 *          'iconBgColor' => '',             
 *          'icon'        => 'ion ion-ios-pricetag-outline',
 *          'title'       => 'Inventory',
 *          'text'        => '5,200',
 *          'progressBar' => true,
 *          'progressValue' => 50,
 *          'progressText' => '50% Increase in 30 Days'
 *      ]);
 */

class InfoBox extends Widget
{

    public $iconBgColor = 'bg-gray';
    public $icon = '';
    public $title = '';
    public $text = '';
    public $progressBar = false;
    public $progressValue = 0;
    public $progressText = '';

    public function renderContent()
    {
        $boxText  = Html::tag('span', $this->title, ['class' => 'info-box-text']);
        $boxText .= (!$this->text ? '' : Html::tag('span', $this->text, ['class' => 'info-box-number']));
        $boxText .= ($this->progressBar ? $this->renderProgressBar() : '');
        return Html::tag('div', $boxText, ['class' => 'info-box-content']);
    }

    public function renderProgressBar()
    {
        $progressBar  = Html::tag('div', '', ['class' => 'progress-bar', 'style' => 'width:' . $this->progressValue . '%']);
        $progressDiv  = Html::tag('div', $progressBar, ['class' => 'progress']);
        $progressDiv .= (empty($this->progressText) ? '' : Html::tag('span', $this->progressText, ['class' => 'progress-description']));
        return $progressDiv;
    }

    public function init()
    {
        static::$autoIdPrefix = 'ibx_';
        parent::init();

        Html::addCssClass($this->options, 'info-box');

        $boxIcon     = Html::tag('span', Html::tag('i', '', ['class' => $this->icon]), ['class' => 'info-box-icon ' . $this->iconBgColor]);
        $boxContent  = $this->renderContent();
        $boxTemplate = Html::tag('div', $boxIcon . $boxContent, $this->options);

        echo $boxTemplate;
    }

}
