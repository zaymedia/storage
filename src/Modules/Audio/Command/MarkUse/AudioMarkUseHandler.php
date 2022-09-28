<?php

declare(strict_types=1);

namespace App\Modules\Audio\Command\MarkUse;

use App\Components\Flusher;
use App\Modules\Audio\Entity\AudioRepository;

final class AudioMarkUseHandler
{
    public function __construct(
        private readonly AudioRepository $audioRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(AudioMarkUseCommand $command): void
    {
        $photo = $this->audioRepository->getById($command->id);

        // todo

        $this->audioRepository->add($photo);
        $this->flusher->flush();
    }
}
