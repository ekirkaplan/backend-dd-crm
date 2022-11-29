<?php

namespace App\Console\Commands\Helper;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;

class MakeInterfaceCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * @var string
     */
    protected $description = 'Make interface class';

    /**
     * @var Filesystem
     */
    protected Filesystem $files;

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("Interface : {$path} created");
        } else {
            $this->info("Interface : {$path} already exits");
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function getSingularClassName($name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * @return string
     */
    public function getStubPath(): string
    {
        return __DIR__ . '/../../../../stubs/interface.stub';
    }

    /**
     * @return array
     */
    public function getStubVariables(): array
    {
        return [
            'NAMESPACE' => 'App\\Interfaces',
            'CLASS_NAME' => $this->getSingularClassName($this->argument('name')),
        ];
    }

    /**
     * @return mixed
     */
    public function getSourceFile(): mixed
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * @param $stub
     * @param $stubVariables
     * @return mixed
     */
    public function getStubContents($stub , $stubVariables = []): mixed
    {
        $contents = file_get_contents($stub);
        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('$'.$search.'$' , $replace, $contents);
        }
        return $contents;
    }

    /**
     * @return string
     */
    public function getSourceFilePath(): string
    {
        return base_path('app/Interfaces') .'/' .$this->getSingularClassName($this->argument('name')) . 'Interface.php';
    }

    /**
     * @param $path
     * @return mixed
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
