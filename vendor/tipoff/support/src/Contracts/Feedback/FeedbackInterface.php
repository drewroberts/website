<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Feedback;

use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Waivers\SignatureInterface;

interface FeedbackInterface extends BaseModelInterface
{
    /**
     * Ensure feedback exists for signature/participant.
     *
     * @param SignatureInterface $signature
     * @return mixed
     */
    public static function createFromSignature(SignatureInterface $signature): self;
}
