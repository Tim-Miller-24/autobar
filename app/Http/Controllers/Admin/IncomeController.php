<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IncomeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class IncomeController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Cashbox\Models\Income::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/income');
        CRUD::setEntityNameStrings(trans('custom.income_singular'), trans('custom.income_plural'));
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
            'name' => 'quantity',
            'type' => 'number',
            'label' => 'Количество',
        ]);
        $this->crud->addColumn([
            'name'  => 'item', // name of relationship method in the model
            'type'  => 'model_function',
            'function_name' => 'getAdvancedTitle',
            'label' => 'Товар', // Table column heading
        ]);
        $this->crud->addColumn([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Цена (1 шт)',
        ]);
        $this->crud->addColumn([
            'name'  => 'created_at', // name of relationship method in the model
            'type'  => 'datetime',
            'label' => 'Дата', // Table column heading
        ]);


        if (!$this->crud->getRequest()->has('order')) {
            $this->crud->orderBy('created_at', 'desc');
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
        CRUD::setValidation(IncomeRequest::class);

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

        $this->crud->addField([ // select2_from_ajax: 1-n relationship
            'label'                => "Вид товара", // Table column heading
            'type'                 => 'select2_from_ajax',
            'name'                 => 'option_id', // the column that contains the ID of that connected entity;
            'entity'               => 'option', // the method that defines the relationship in your Model
            'attribute'            => 'name', // foreign key attribute that is shown to user
            'data_source'          => url('api/option'), // url to controller search function (with /{id} should return model)
            'placeholder'          => 'Выберите тип', // placeholder for the select
            'include_all_form_fields' => true, //sends the other form fields along with the request so it can be filtered.
            'minimum_input_length' => 0, // minimum characters to type before querying results
            'dependencies'         => ['item_id'], // when a dependency changes, this select2 is reset to null
            'method'                    => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
        ]);

        $this->crud->addField([
            'name'  => 'quantity',
            'type'  => 'number',
            'label' => 'Количество',
        ]);

        $this->crud->addField([
            'name'  => 'price',
            'type'  => 'number',
            'label' => 'Цена за единицу товара',
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
