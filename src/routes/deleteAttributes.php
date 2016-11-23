<?php
use Aws\Common\Credentials\Credentials;

$app->post('/api/AmazonSimpleDB/deleteAttributes', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','itemName','domainName','attributes']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    
    $credentials = new Credentials($post_data['args']['apiKey'], $post_data['args']['apiSecret']);

    $client = Aws\SimpleDb\SimpleDbClient::factory(array(
        'region'      => $post_data['args']['region'],
        'credentials' => $credentials
    ));
    
    $body['ItemName'] = $post_data['args']['itemName'];
    $body['DomainName'] = $post_data['args']['domainName'];
    $body['Attributes'] = $post_data['args']['attributes'];
    if(!empty($post_data['args']['expectedName'])) {
        $body['Expected']['Name'] = $post_data['args']['expectedName'];
    }
    if(!empty($post_data['args']['expectedValue'])) {
        $body['Expected']['Value'] = $post_data['args']['expectedValue'];
    }
    if(!empty($post_data['args']['expectedExists'])) {
        $body['Expected']['Exists'] = $post_data['args']['expectedExists'];
    }
    
    try {
        if(!empty($body)) {
            $res = $client->deleteAttributes(
                $body
            )->getAll();
        } else {
            $res = $client->deleteAttributes()->getAll();
        }
        
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = "successfully deleted";
        if(empty($result['contextWrites']['to'])) {
            $result['contextWrites']['to']['status_msg'] = "Api return no results";
        }
    } catch (S3Exception $e) {
        // Catch an S3 specific exception.
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    } catch (Aws\CloudWatch\Exception\CloudWatchException $e) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    } catch (\Exception $e) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $e->getMessage();
    }
    
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    
});
