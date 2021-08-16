<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ComputerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ComputerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ComputerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Computer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/computer');
        CRUD::setEntityNameStrings('computer', 'computers');
        // $this->crud->enableExportButtons();
        CRUD::enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
           
            [
                'name'  => 'uuid',
                'label' => "UUID",
                'type'  => 'text',
            ],
            [
                'name'  => 'district_id',
                'label' => "Prokuratura",
                'type'  => 'model_function',
                'function_name' => 'getOfficeFullAddress', // the method in your Model
            ],
            // [
            //     // 1-n relationship
            //     'label' => "Prokuratura", // Table column heading
            //     'type' => "select",
            //     'name' => 'district_id', // the column that contains the ID of that connected entity;
            //     'entity' => 'district', // the method that defines the relationship in your Model
            //     'attribute' => "name", // foreign key attribute that is shown to user
            //     'model' => "App\Models\District", // foreign key model
            // ],
            [
                'name'  => 'responsible_person',
                'label' => "Jogapkär Işgar",
                'type'  => 'text',
            ],
            [
                'name'  => 'responsible_position',
                'label' => "Wezipesi",
                'type'  => 'text',
            ],

            [
                'name'  => 'mac_address',
                'label' => "Mac Address",
                'type'  => 'text',
            ],
            [
                'name'  => 'ip_address',
                'label' => "IP Address",
                'type'  => 'text',
            ],

            [
                'name'  => 'cpu',
                'label' => "CPU",
                'type'  => 'text',
            ],
            [
                'name'  => 'ram',
                'label' => "RAM",
                'type'  => 'text',
            ],
            
            [
                'name'  => 'cabinet_number',
                'label' => "Kabinet Belgisi",
                'type'  => 'text',
            ],
           
          
        ]);
        // CRUD::setFromDb(); // columns
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ComputerRequest::class);

        // CRUD::setFromDb(); // fields

        $this->crud->addFields([
            [
                'name'  => 'uuid',
                'label' => "UUID",
                'type'  => 'text',
            ],
            [
                'name'  => 'responsible_person',
                'label' => "Jogapkar isgar",
                'type'  => 'text',
            ],
            [
                'name'  => 'responsible_position',
                'label' => "Wezipesi",
                'type'  => 'text',
            ],

            [
                'name'  => 'mac_address',
                'label' => "Mac Address",
                'type'  => 'text',
            ],
            [
                'name'  => 'ip_address',
                'label' => "IP Address",
                'type'  => 'text',
            ],

            [
                'name'  => 'cpu',
                'label' => "CPU",
                'type'  => 'text',
            ],
            [
                'name'  => 'ram',
                'label' => "RAM",
                'type'  => 'text',
            ],

            [
                'label'     => "Prokuratura",
                'type'      => 'select2_grouped',
                'name'      => 'district_id', 
                'entity'    => 'district', 
                'model'     => "App\Models\District", // related model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'group_by'  => 'province', // the relationship to entity you want to use for grouping
                'group_by_attribute' => 'name', // the attribute on related model, that you want shown
                'group_by_relationship_back' => 'districts', // relationship from related model back to this model'

                
            ],
            [
                'name'  => 'cabinet_number',
                'label' => "Kabinet belgisi",
                'type'  => 'text',
            ],
            
           
            // [   // select_from_array
            //     'name'        => 'rank',
            //     'label'       => "Wezipesi",
            //     'type'        => 'select2_from_array',
            //     'options'     => ['one' => 'OneT', 'two' => 'Two'],
            //     'allows_null' => true,
            //     // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            // ],
          
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
