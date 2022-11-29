<?php

namespace App\Console\Commands\Helper;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

class MakeRepositoryCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * @var string
     */
    protected $description = 'Make repository class';

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
    public function handle(): void
    {
        $path = $this->getSourceFilePath();
        $this->makeDirectory(dirname($path));
        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("Repository : {$path} created");
        } else {
            $this->info("Repository : {$path} already exits");
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
        return __DIR__ . '/../../../../stubs/repository.stub';
    }

    /**
     * @return array
     */
    public function getStubVariables(): array
    {
        return [
            'MODEL' => $this->getSingularClassName($this->argument('name')),
            'MODEL_PARAM' => lcfirst($this->argument('name')),
            'INTERFACE_NAME' => $this->getSingularClassName($this->argument('name')),
            'NAMESPACE' => 'App\\Repositories',
            'CLASS_NAME' => $this->getSingularClassName($this->argument('name')),
        ];
    }

    /**
     * @return string|array|bool
     */
    public function getSourceFile(): string|array|bool
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * @param $stub
     * @param array $stubVariables
     * @return array|false|string|string[]
     */
    public function getStubContents($stub , array $stubVariables = []): array|bool|string
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
        return base_path('app/Repositories') .'/' .$this->getSingularClassName($this->argument('name')) . 'Repository.php';
    }

    /**
     * @param $path
     * @return mixed
     */
    protected function makeDirectory($path): mixed
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
