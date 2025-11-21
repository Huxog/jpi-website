<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:docs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy exported files from dist to docs for GitHub Pages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $distPath = base_path('dist');
        $docsPath = base_path('docs');
        $baseUrl = 'https://huxog.github.io/jpi-website';

        if (!File::isDirectory($distPath)) {
            $this->error('dist directory does not exist. Run php artisan export first.');
            return 1;
        }

        $this->info('Cleaning docs directory...');
        if (File::isDirectory($docsPath)) {
            File::deleteDirectory($docsPath);
        }

        $this->info('Copying dist to docs...');
        File::copyDirectory($distPath, $docsPath);

        $this->info('Replacing URLs in HTML files...');
        $this->replaceUrls($docsPath, $baseUrl);

        $this->info('Export to docs completed successfully!');
        return 0;
    }

    /**
     * Replace URLs in all HTML files.
     */
    protected function replaceUrls(string $path, string $baseUrl): void
    {
        $files = File::allFiles($path);

        foreach ($files as $file) {
            if ($file->getExtension() !== 'html') {
                continue;
            }

            $content = File::get($file->getPathname());

            $content = str_replace([
                'https://huxog.github.io"',
                'https://huxog.github.io/',
                'http://localhost:8000"',
                'http://localhost:8000/',
            ], [
                $baseUrl . '"',
                $baseUrl . '/',
                $baseUrl . '"',
                $baseUrl . '/',
            ], $content);

            File::put($file->getPathname(), $content);
        }
    }
}
