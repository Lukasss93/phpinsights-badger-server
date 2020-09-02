<?php

namespace App\Http\Controllers;

use App\Badge;
use Exception;
use Illuminate\Http\Request;
use RuntimeException;

class BadgerController extends Controller
{
    public function index(): string
    {
        return 'PhpInsights Badger ' . config('insights.version');
    }

    public function save(Request $request): void
    {
        //repo name
        $author = $request->input('author');
        $repo = $request->input('repo');

        //phpinsights
        $phpinsights = $request->input('file.summary');

        //percentages
        $code = $phpinsights['code'];
        $complexity = $phpinsights['complexity'];
        $architecture = $phpinsights['architecture'];
        $style = $phpinsights['style'];
        $security_issues = $phpinsights['security issues'];

        //save percentages
        Badge::query()->updateOrCreate([
            'author' => $author,
            'repo' => $repo
        ], [
            'code' => $code,
            'complexity' => $complexity,
            'architecture' => $architecture,
            'style' => $style,
            'security_issues' => $security_issues
        ]);
    }

    public function badge(Request $request, $author, $repo, $type)
    {
        $query = $request->query();
        $query = count($query) > 0 ? '?' . http_build_query($query) : '';

        try {
            $item = Badge::query()
                ->where('author', $author)
                ->where('repo', $repo)
                ->firstOrFail();

            $label = self::getLabel($type);
            $value = $item->{$type} . ($type !== 'security_issues' ? '%25' : '');
            $color = self::getColor($value, $type);

            $badge = "https://img.shields.io/badge/PHPInsights%20%7C%20$label%20-$value-$color.svg" . $query;
            return response(file_get_contents($badge), 200, [
                'Content-type' => 'image/svg+xml'
            ]);
        } catch (Exception $e) {
            $badge = "https://img.shields.io/badge/Badge-Invalid%20-inactive" . $query;
            return response(file_get_contents($badge), 200, [
                'Content-type' => 'image/svg+xml'
            ]);
        }
    }

    private static function getColor($value, $type): string
    {
        if ($type !== 'security_issues') {
            if ($value >= 80) {
                return 'success';
            }

            if ($value >= 50 && $value < 80) {
                return 'yellow';
            }

            return 'red';
        }

        if ($value <= 0) {
            return 'success';
        }

        if ($value >= 1 && $value < 4) {
            return 'yellow';
        }

        if ($value >= 4) {
            return 'red';
        }

        return 'red';
    }

    private static function getLabel($type): string
    {
        switch ($type) {
            case 'code':
                return 'Code';
            case 'complexity':
                return 'Complexity';
            case 'architecture':
                return 'Architecture';
            case 'style':
                return 'Style';
            case 'security_issues':
                return 'Security Issues';
            default:
                throw new RuntimeException('type invalid');
        }
    }
}
