<?php

namespace App\Commands;

use Webpatser\Countries\MigrationCommand;

class CountriesCommand extends MigrationCommand {
    /**
     * Create the migration
     *
     * @param  string $name
     * @return bool
     */
    protected function createMigration()
    {
        //Create the migration
        $app = app();
        $migrationFiles = [
            $this->laravel->path."/../database/migrations/*_setup_countries_table.php" => 'countries::generators.migration',
            $this->laravel->path."/../database/migrations/*_charify_countries_table.php" => 'countries::generators.char_migration',
        ];

        $seconds = 0;

        foreach ($migrationFiles as $migrationFile => $outputFile) {
            if (sizeof(glob($migrationFile)) == 0) {
                $migrationFile = str_replace('*', date('Y_m_d_His', strtotime('+' . $seconds . ' seconds')), $migrationFile);

                $fs = fopen($migrationFile, 'x');
                if ($fs) {
                    $output = "<?php\n\n" .$app['view']->make($outputFile)->with('table', 'countries')->render();

                    fwrite($fs, $output);
                    fclose($fs);
                } else {
                    return false;
                }

                $seconds++;
            }
        }

        //Create the seeder
        $seeder_file = $this->laravel->path."/../database/seeders/CountriesSeeder.php";
        $output = "<?php\n\n" .$app['view']->make('countries::generators.seeder')->render();

        if (!file_exists( $seeder_file )) {
            $fs = fopen($seeder_file, 'x');
            if ($fs) {
                fwrite($fs, $output);
                fclose($fs);
            } else {
                return false;
            }
        }

        return true;
    }
}
