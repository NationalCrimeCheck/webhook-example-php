<?php

function personId()
{
    return 5000000 + rand(0, 1000000);
}

function eventGuid()
{
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function eventType()
{
    return [
        'id-verify-applicant',
        'id-verify-qa',
        'id-verify-done',
        'service-delayed',
        'service-result',
    ][rand(0, 4)];
}


/**
 * Build a test payload and submit using cURL
 */
function runTest(): array
{
    $payload = [
        'person' => [
            'id' => personId(),
            'client_ref' => '',
        ],
        'event' => [
            'id' => eventGuid(),
            'type' => eventType(),
        ],
        'data' => [],
        'timestamp' => microtime(true),
    ];

    $payload = json_encode($payload, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8080');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [$httpcode, $output];
}


$result = runTest();
echo $result[0], ' ', $result[1], PHP_EOL;
