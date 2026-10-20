<?php

use App\Enums\ApplicationStatus;

it('shows offers in green', function () {
    expect(ApplicationStatus::Offer->getColor())->toBe('success');
});

it('shows rejected in red', function () {
    expect(ApplicationStatus::Rejected->getColor())->toBe('danger');
});

it('shows ghosted in gray', function () {
    expect(ApplicationStatus::Ghosted->getColor())->toBe('gray');
});
