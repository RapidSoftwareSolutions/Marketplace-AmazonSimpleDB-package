<?php
$routes = [
    'listDomains',
    'createDomain',
    'deleteDomain',
    'getAttributes',
    'putAttributes',
    'deleteAttributes',
    'batchPutAttributes',
    'batchDeleteAttributes',
    'domainMetadata',
    'makeSelectExpression',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

