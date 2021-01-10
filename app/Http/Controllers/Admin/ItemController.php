<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Cashbox\Models\Item::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item');
        CRUD::setEntityNameStrings(trans('custom.item_singular'), trans('custom.item_plural'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Заголовок',
        ]);
        $this->crud->addColumn([
            'name'  => 'options', // name of relationship method in the model
            'type'  => 'relationship',
            'label' => 'Виды', // Table column heading
            'wrapper'   => [
                // 'element' => 'a', // the element will default to "a" so you can skip it here
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('option/'.$related_key.'/edit');
                },
                // 'target' => '_blank',
                // 'class' => 'some-class',
            ],
        ]);
        $this->crud->addColumn([
            'name' => 'position',
            'type' => 'number',
            'label' => 'Порядок',
        ]);
        $this->crud->addColumn([
            'name' => 'stock',
            'type' => 'number',
            'label' => 'Остаток',
        ]);
        $this->crud->addColumn([
            'name'  => 'category', // name of relationship method in the model
            'type'  => 'relationship',
            'label' => 'Категория', // Table column heading
        ]);
        $this->crud->addColumn([
            'name' => 'is_active',
            'type' => 'check',
            'label' => 'Активно',
        ]);

        if (!$this->crud->getRequest()->has('order')) {
            $this->crud->orderBy('position');
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ItemRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'type'  => 'text',
            'label' => 'Заголовок',
        ]);
        $this->crud->addField([
            'name'  => 'description',
            'type'  => 'textarea',
            'label' => 'Описание',
        ]);
        $this->crud->addField([
            'label' => "Категория",
            'type'  => 'select2_nested',
            'name'  => 'category_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'category',

            // optional - manually specify the related model and attribute
            'model' => "App\Cashbox\Models\Category", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->where('is_active', true)->get();
            }), //  you can use this to filter the results show in the select
        ]);
        $this->crud->addField([
            'name'  => 'option_name',
            'type'  => 'text',
            'label' => 'Название опции',
        ]);
        $this->crud->addField([
            'name'  => 'price',
            'type'  => 'number',
            'label' => 'Цена',
        ]);
        $this->crud->addField([
            'label' => "Изображение",
            'name' => "image",
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'disk'  => 'public', // in case you need to show images from a different disk
//            'prefix'    => 'uploads/categories' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);
        $this->crud->addField([
            'name'  => 'position',
            'type'  => 'number',
            'label' => 'Порядок',
        ]);
        $this->crud->addField([
            'name'  => 'is_active',
            'type'  => 'checkbox',
            'label' => 'Активно',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

}
