<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function cleanUpTags(array $tagsNames): array
    {
        return array_map(function ($el) {
            return trim(str_replace("\n", '', $el));
        }, array_filter($tagsNames, function ($el) {
            return !empty($el);
        }));
    }

    public function makeTagsIfMissing(array $tagsNames)
    {
        foreach ($tagsNames as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }

    public function getTagsIds(array $tagsNames): array
    {
        return Tag::query()
            ->whereIn('name', $tagsNames)
            ->pluck('id')
            ->toArray();
    }

    public function populateTags(array $tagsNames): array
    {
        $tagsNamesCleanedUp = $this->cleanUpTags($tagsNames);
        $this->makeTagsIfMissing($tagsNamesCleanedUp);

        return $this->getTagsIds($tagsNamesCleanedUp);
    }
}
