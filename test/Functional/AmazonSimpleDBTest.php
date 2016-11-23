<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');

class AmazonSimpleDBTest extends BaseTestCase {
    
    public function testListDomains() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/listDomains', $post_data);
       
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testCreateDomain() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/createDomain', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testGetAttributes() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz",
                        "itemName": "Shirt1"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/getAttributes', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testPutAttributes() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz",
                        "itemName": "Shirt1",
                        "attributes": [{"Name": "Color", "Value": "blue"},{"Name": "Size", "Value": "big"}]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/putAttributes', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testBatchPutAttributes() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz",
                        "items": [{"Name":"Shirt1","Attributes":[{"Name":"Size","Value":"XL","Replace":false},{"Name":"Color","Value":"red","Replace":false}]},{"Name":"Shirt2","Attributes":[{"Name":"Size","Value":"L","Replace":false},{"Name":"Color","Value":"green","Replace":false}]}]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/batchPutAttributes', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testBatchDeleteAttributes() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz",
                        "items": [{"Name":"Shirt1","Attributes":[{"Name":"Size","Value":"XL","Replace":false},{"Name":"Color","Value":"red","Replace":false}]},{"Name":"Shirt2","Attributes":[{"Name":"Size","Value":"L","Replace":false},{"Name":"Color","Value":"green","Replace":false}]}]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/batchDeleteAttributes', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDomainMetadata() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/domainMetadata', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testMakeSelectExpression() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "selectExpression": "select Color from `testDomain.com` where Color like \'%blue%\'"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/makeSelectExpression', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDeleteAttributes() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz",
                        "itemName": "Shirt1",
                        "attributes": [{"Name": "Color", "Value": "blue"},{"Name": "Size", "Value": "big"}]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/deleteAttributes', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testDeleteDomain() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AKIAJUL5NCN74YKRWRGA",
                        "apiSecret":"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",
                        "region": "eu-west-1",
                        "domainName": "test.xyz"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/AmazonSimpleDB/deleteDomain', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
}
