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
                'path' => './storage/',
                'command' => 'cd ./storage/ && ls',
                'depth' => 0,
                'return' => [
                    'image.png',
                ],
            ],
            [
                'path' => './storage/files/',
                'command' => 'cd ./storage/files && ls',
                'depth' => 0,
                'return' => [
                    'image.png',
                ],
            ],
        ];
    }
}
