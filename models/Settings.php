<?php namespace ImpulseTechnologies\BlogViews\Models;

use Winter\Storm\Database\Model;
use System\Classes\PluginManager;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'impulsetechnologies_blogviews_settings';
    public $settingsFields = 'fields.yaml';

}
