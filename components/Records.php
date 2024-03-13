<?php namespace Renick\AirTable\Components;

use Cms\Classes\ComponentBase;
use Exception;
use Renick\AirTable\Classes\AirTable\Record;
use Renick\AirTable\Classes\AirTable\RecordQueryParams;
use Renick\AirTable\Classes\AirTable\Table;
use Renick\AirTable\Plugin;

/**
 * Tables Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Records extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name' => 'renick.airtable::lang.components.records.title',
            'description' => 'renick.airtable::lang.components.records.description'
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
            'tableId' => [
                'title' => 'renick.airtable::lang.components.records.tableId.title',
                'description' => 'renick.airtable::lang.components.records.tableId.description',
                'type' => 'string'
            ],
            'cacheTll' => [
                'title' => 'renick.airtable::lang.components.tables.cacheTLL.title',
                'description' => 'renick.airtable::lang.components.tables.cacheTLL.description',
                'type' => 'string',
                'default' => '3600',
                'validation' => [
                    'integer' => [
                        'allowNegative' => false,
                    ]
                ]
            ],
            'limit' => [
                'title' => 'renick.airtable::lang.components.records.limit.title',
                'description' => 'renick.airtable::lang.components.records.limit.description',
                'type' => 'string',
                'default' => '-1',
                'validation' => [
                    'integer' => [
                        'allowNegative' => true,
                    ]
                ]
            ],
            'view' => [
                'title' => 'renick.airtable::lang.components.records.view.title',
                'description' => 'renick.airtable::lang.components.records.view.description',
                'type' => 'string'
            ],
            'sort' => [
                'title' => 'renick.airtable::lang.components.records.sort.title',
                'description' => 'renick.airtable::lang.components.records.sort.description',
                'type' => 'string'
            ],
        ];
    }

    /**
     * records becomes available on the page as {{ component.records }}
     * @throws Exception
     * @return \Renick\AirTable\Classes\AirTable\Records
     */
    public function records(): \Renick\AirTable\Classes\AirTable\Records
    {
        $airtable = Plugin::asyncInstance();
        $tll = intval($this->property('cacheTll'));
        $tableId = $this->property('tableId');
        $limit = $this->property('limit');
        $view = $this->property('view');

        $sort = $this->property('sort');
        if ($sort) {
            $sort = explode(',', $sort);
            $sort = array_map(function ($sort) {
                $sort = explode(' ', $sort);
                return [
                    'field' => $sort[0],
                    'direction' => $sort[1] ?? 'asc'
                ];
            }, $sort);
        }

        $options = new RecordQueryParams($tableId, $limit, null, $view, $sort);

        return $airtable->getRecords($options, $tll);
    }
}
