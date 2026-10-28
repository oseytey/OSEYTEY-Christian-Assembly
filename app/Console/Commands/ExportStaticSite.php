<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

#[Signature('export:static {--output=dist : Output directory relative to project root}')]
#[Description('Export frontend Blade routes and public assets to a static HTML directory for Cloudflare Pages')]
class ExportStaticSite extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(Kernel $kernel): int
    {
        config([
            'session.driver' => 'array',
            'cache.default' => 'array',
            'app.url' => 'http://localhost',
        ]);

        $appUrl = 'http://localhost';
        URL::forceRootUrl($appUrl);

        $outputDir = base_path((string) $this->option('output'));

        if (File::isDirectory($outputDir)) {
            File::deleteDirectory($outputDir);
        }

        File::makeDirectory($outputDir, 0755, true);

        $this->copyPublicAssets($outputDir);

        foreach (Route::getRoutes() as $route) {
            if (! in_array('GET', $route->methods(), true)) {
                continue;
            }

            $uri = '/'.ltrim($route->uri(), '/');

            if (str_starts_with($uri, '/up') || str_starts_with($uri, '/_') || str_contains($uri, '{')) {
                continue;
            }

            $request = Request::create($uri, 'GET');
            $response = $kernel->handle($request);
            $kernel->terminate($request, $response);

            if ($response->getStatusCode() !== 200) {
                $this->warn("Skipping {$uri} (HTTP {$response->getStatusCode()})");

                continue;
            }

            $html = (string) $response->getContent();
            $html = str_replace(
                [$appUrl.'/', $appUrl.'"', $appUrl."'"],
                ['/', '/"', "/'"],
                $html
            );

            $targetFile = $uri === '/'
                ? $outputDir.DIRECTORY_SEPARATOR.'index.html'
                : $outputDir.DIRECTORY_SEPARATOR.trim($uri, '/').DIRECTORY_SEPARATOR.'index.html';

            File::ensureDirectoryExists(dirname($targetFile));
            File::put($targetFile, $html);

            $this->info("Exported {$uri} -> ".str_replace(base_path().DIRECTORY_SEPARATOR, '', $targetFile));
        }

        $this->info('Static site export completed successfully.');

        return self::SUCCESS;
    }

    /**
     * Copy static assets from the public directory to the output directory.
     */
    private function copyPublicAssets(string $outputDir): void
    {
        $publicDir = public_path();
        $excludedFiles = ['index.php', '.htaccess', 'hot'];

        foreach (File::directories($publicDir) as $directory) {
            $dirName = basename($directory);
            File::copyDirectory($directory, $outputDir.DIRECTORY_SEPARATOR.$dirName);
        }

        foreach (File::files($publicDir) as $file) {
            if (in_array($file->getFilename(), $excludedFiles, true)) {
                continue;
            }

            File::copy($file->getPathname(), $outputDir.DIRECTORY_SEPARATOR.$file->getFilename());
        }
    }
}

