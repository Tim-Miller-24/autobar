<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\OptionRequest;

class OptionController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    // notice InlineCreateOperation is used AFTER CreateOperation
    // that's required in order for InlineCreate to re-use whatever
    // CreateOperation has already setup

    // OPTIONAL
    // only if you want to make the InlineCreateOperation behave differently
    // from the CreateOperation, otherwise you can just skip the setup method entirely
    //
    // protected function setupInlineCreateOperation()
    // {
    // $this->crud->setValidation(StoreRequest::class);
    // $this->crud->addField($field_definition_array);
    // }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Cashbox\Models\Option::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/option');
        CRUD::setEntityNameStrings(trans('custom.option_singular'), trans('custom.option_plural'));
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
            'name'  => 'item', // name of relationship method in the model
            'type'  => 'relationship',
            'label' => 'Товар', // Table column heading
        ]);
        $this->crud->addColumn([
            'name' => 'note',
            'type' => 'text',
            'label' => 'Заметка',
        ]);
        $this->crud->addColumn([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Цена',
        ]);
        $this->crud->addColumn([
            'name' => 'is_active',
            'type' => 'check',
            'label' => 'Активно',
        ]);

        if (!$this->crud->getRequest()->has('order')) {
            $this->crud->orderBy('item_id')->orderBy('position', 'ASC');
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
        CRUD::setValidation(OptionRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'type'  => 'text',
            'label' => 'Заголовок',
        ]);
        $this->crud->addField([
            'name'  => 'note',
            'type'  => 'text',
            'label' => 'Заметка',
            'hint' => 'Данная заметка для администратора'
        ]);
        $this->crud->addField([
            'label' => "Товар",
            'type'  => 'select',
            'name'  => 'item_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'item',

            // optional - manually specify the related model and attribute
            'model' => "App\Cashbox\Models\Item", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->where('is_active', true)->get();
            }), //  you can use this to filter the results show in the select
        ]);
        $this->crud->addField([
            'name'  => 'price',
            'type'  => 'number',
            'label' => 'Цена',
            'hint' => 'Данная цена имеет приоритет над основной'
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