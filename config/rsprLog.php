<?php

return [
    'projectName' => env('LOG_PROJECT_NAME', ''),
    'traceCount' => env('LOG_TRACE_COUNT', 3),
    'forceAllTraceCount' => env('LOG_FORCE_TRACE_COUNT', null), // DAN (2023/08/21 17:36) - default = null (if null will follow "traceCount")
    'traceFilePathCharacterLimit' => null, // DAN (2023/08/21 18:21) - default = null (if null will be full path)
    'endLineUnderscoreCount' => 173,
    'slack' => [
        'channel' => 'slack',
        'enable' => env('LOG_SLACK_ENABLE', false),
        'webhookUrl' => env('LOG_SLACK_WEBHOOK_URL', ''),
        'traceFilePathCharacterLimit' => 65, // DAN (2023/08/21 18:21) - default = null (if null will follow rsprLog.traceFilePathCharacterLimit)
        'endLineUnderscoreCount' => 80,
    ]
];
