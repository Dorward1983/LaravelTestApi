<?php

namespace App\Traits;

trait RandomClassesTrait
{

    /**
     * Returns a list of classes that implement the App\Contracts\RandomModelInterface.
     *
     * @return array
     */
    private function getImplementingRandomClasses()
    {
        $interfaceName = 'App\Contracts\RandomModelInterface';

        $classes = \File::allFiles(base_path() . '/app/Models');
        foreach ($classes as $class) {
            $class->classname = '\\' . str_replace(
                [app_path(), '/', '.php'],
                ['App', '\\', ''],
                $class->getRealPath()
            );
        }

        return array_filter(
            array_map(function($class){
                return $class->classname;
            }, $classes),
            function( $className ) use ( $interfaceName ) {
                return in_array( $interfaceName, class_implements( $className ) );
            }
        );
    }

    /**
     * Returns a random instance of the class implementing the App\Contracts\RandomModelInterface.
     *
     * @return App\Contracts\RandomModelInterface
     */
    private function getRandomObject()
    {
        $arRandonClass = $this->getImplementingRandomClasses();
        return call_user_func_array([$arRandonClass[rand(0, count($arRandonClass) - 1)], 'getRandom'], []);
    }

    /**
     * Generates a response with the data of the App\Contracts\RandomModelInterface instance.
     *
     * @return array
     */
    private function getRandomResult()
    {
        $data = $this->getRandomObject();

        if (empty($data)) {
            return [
                'status' => 'error',
                'message' => 'Nothing was found'
            ];
        }

        $resultStr = '';
        if (!empty($data['data_type'])) {
            $resultStr .= "{$data['data_type']}:";
            unset($data['data_type']);
        }

        $cnt = 0;
        foreach ($data as $key => $value) {

            if ($key != 'image') {
                $resultStr .= $key . '{' . $value . '}';
            } else {
                $resultStr .= $this->getImageData($value);
            }

            if ($cnt < (count($data) - 1)) {
                $resultStr .= '||';
            }

            $cnt++;
        }
        return $resultStr;
    }

    private  function getImageData(string $path)
    {
        $path = storage_path($path);
        $contents = file_get_contents($path);

        if ($contents !== false){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $path);
            finfo_close($finfo);
            $mime = str_replace('/', '\\base64;', $mime);
            return $mime . '{'.base64_encode($contents) . '}';
        }
    }
}
