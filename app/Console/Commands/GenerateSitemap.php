<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use XMLWriter;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap.xml for public routes and active products.';

    public function handle(): int
    {
        $baseUrl = rtrim((string) config('app.url'), '/');

        if ($baseUrl === '') {
            $this->error('APP_URL is not configured. Please set APP_URL in your .env file.');
            return self::FAILURE;
        }

        $now = now();

        $staticUrls = [
            [
                'loc' => $baseUrl . '/',
                'lastmod' => $now,
            ],
            [
                'loc' => $baseUrl . '/checkout',
                'lastmod' => $now,
            ],
        ];

        $productUrls = Product::active()
            ->select(['slug', 'updated_at'])
            ->orderBy('id')
            ->get()
            ->map(function (Product $product) use ($baseUrl, $now): array {
                return [
                    'loc' => $baseUrl . '/product/' . ltrim($product->slug, '/'),
                    'lastmod' => $product->updated_at ?? $now,
                ];
            })
            ->all();

        $urls = array_merge($staticUrls, $productUrls);

        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->startElement('urlset');
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $item) {
            $lastmod = $item['lastmod'] instanceof Carbon
                ? $item['lastmod']
                : Carbon::parse($item['lastmod']);

            $writer->startElement('url');
            $writer->writeElement('loc', $item['loc']);
            $writer->writeElement('lastmod', $lastmod->toAtomString());
            $writer->endElement();
        }

        $writer->endElement();
        $writer->endDocument();

        $sitemapPath = public_path('sitemap.xml');
        File::put($sitemapPath, $writer->outputMemory());

        $this->info('Sitemap generated successfully.');
        $this->line('Path: ' . $sitemapPath);
        $this->line('Static URLs: ' . count($staticUrls));
        $this->line('Active product URLs: ' . count($productUrls));
        $this->line('Total URLs: ' . count($urls));

        return self::SUCCESS;
    }
}

