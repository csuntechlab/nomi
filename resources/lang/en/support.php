<?php

declare(strict_types=1);

return [
    // errors
    'errors.feedback.invalid_sender' => 'There is no valid sender address for the feedback message',
    'errors.support.invalid_sender' => 'There is no valid sender address for the support request message',
    'errors.feedback.model_not_found' => 'The configured feedback model (:model) could not be resolved.',
    'errors.support.model_not_found' => 'The configured support model (:model) could not be resolved.',

    // validation errors (feedback)
    'errors.v.feedback.content.required' => 'Please add a message to your feedback submission',

    // validation errors (support)
    'errors.v.support.impact.required' => 'Please select an impact for your request',
    'errors.v.support.impact.in' => 'Please select a valid impact for your request',
    'errors.v.support.content.required' => 'Please add a message to your request',

    // success messages
    'success.feedback' => 'You have successfully submitted your feedback!',
    'success.support' => 'You have successfully submitted your support request!',
];
