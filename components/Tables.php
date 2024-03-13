<?php namespace Renick\AirTable\Components;

use Cms\Classes\ComponentBase;
use Exception;
use Renick\AirTable\Classes\AirTable\Table;
use Renick\AirTable\Plugin;

/**
 * Tables Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Tables extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name' => 'renick.airtable::lang.components.tables.title',
            'description' => 'renick.airtable::lang.components.tables.description'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties(): array
    {
        return [
            'databaseId' => [
                'title' => 'renick.airtable::lang.components.tables.databaseId.title',
                'description' => 'renick.airtable::lang.components.tables.databaseId.description',
                'type' => 'string'
            ],
            'cacheTll' => [
                'title' => 'renick.airtable::lang.components.tables.cacheTLL.title',
                'description' => 'renick.airtable::lang.components.tables.cacheTLL.description',
                'type' => 'string',
                'default' => '3600',
                'validation' => [
                    'integer' => [
                        'allowNegative' => true,
                    ]
                ]
            ]
        ];
    }

    /**
     * tables becomes available on the page as {{ component.tables }}
     * @throws Exception
     * @return Table[]
     */
    public function tables(): array
    {
        $airtable = Plugin::asyncInstance();
        $tll = intval($this->property('cacheTll'));
        return $airtable->getTables($tll);
    }
}
