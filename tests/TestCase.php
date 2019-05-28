<?php

namespace Tests;

use DB;
use App\Models\User;
use Tests\Traits\Accessor;
use Laravel\Passport\Passport;
use Tests\Traits\ResponseHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, ResponseHelper, Accessor;

    /**
     * HTTP response constants
     * @var integer
     */
    const RESPONSE_SUCCESS = 200;
    const RESPONSE_REDIRECTION = 302;
    const RESPONSE_CLIENT_ERROR = 422;
    const RESPONSE_UNAUTHORIZED = 401;
    const RESPONSE_FORBIDDEN = 403;
    const RESPONSE_INTERNAL_ERROR = 500;
    const RESPONSE_NOT_FOUND = 404;

    protected $user;

    /**
     * Fetch random data base on `table` data given
     *
     * @param  string $tableName
     * @return object
     */
    public function findRandomData($tableName, $where = [])
    {
        $query = DB::table($tableName);

        if (!empty($where)) {
            $query->where($where);
        }

        return $query->orderByRaw('RAND()')->first();
    }

    /**
     * Generate unique random data on table
     *
     * @author goper
     * @param  string $table - table name
     * @param  string $column - column name to be compared
     * @param  string $type - faker type data
     * @return string
     */
    public function getRandomUniqueData($table, $column, $type, $typeOptions = [])
    {
        do {
            $string = $this->faker->$type;

            if (!empty($typeOptions)) {
                $count = 0;
                foreach ($typeOptions as $key => $option) {

                    if ($count == 0) {
                        $opt1Key = $key;
                        $opt1Value = $option;
                    } elseif ($count == 1) {
                        $opt2Key = $key;
                        $opt2Value = $option;
                    }
                    $count++;
                }
                if ($count == 1) {
                    $string = $this->faker->$type($opt1Key = $opt1Value);
                } elseif ($count == 2) {
                    $string = $this->faker->$type($opt1Key = $opt1Value, $opt2Key = $opt2Value);
                }

            }

            $count = DB::table($table)->where($column, $string)->count();
        } while ($count > 0);

        return $string;
    }

    /**
     * Get uploadable file.
     *
     * @return UploadedFile
     */
    public function getUploadableFile($file)
    {
        $dummy = file_get_contents($file);
        file_put_contents(base_path("tests/storage/" . basename($file)), $dummy);
        $path = base_path("tests/storage/" . basename($file));
        $original_name = 'services.csv';
        $mime_type = 'text/csv';
        $size = 111;
        $error = null;
        $test = true;
        $file = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);
        return $file;
    }
}
