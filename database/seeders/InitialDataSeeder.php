<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

abstract class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        $items = Storage::json('imports/' . $this->getFileName() . '.json');
        foreach ($items as $item) {
            $this->processItem($item);
        }
    }

    abstract public function getFileName(): string;

    abstract public function processItem(array $item): void;
}
