<?php

declare(strict_types=1);

namespace Tests\Providers;

trait KernelProviderTrait
{
    /**
     * @return array<int, array{
     *     command: string,
     *     depth: int,
     *     return: array<int, string>
     * }>
     */
    public static function executeProvider(): array
    {
        /** @phpstan-ignore-next-line */
        return [
            [
                'command' => 'cd ./storage/ && ls',
                'depth' => 0,
                'return' => [
                    'files',
                    'image.png',
                ],
            ],
            [
                'command' => 'ls',
                'depth' => 1,
                'return' => [
                    /** @phpstan-ignore-next-line */
                    FOLDER_PATH,
                ],
            ],
        ];
    }
}
