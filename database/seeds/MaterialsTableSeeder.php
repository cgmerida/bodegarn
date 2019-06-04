<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class MaterialsTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'materials';
        $this->filename = base_path() . '/database/seeds/csvs/bodega.csv';
        $this->csv_delimiter = ';';
        $this->timestamps = true;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
    }
}
