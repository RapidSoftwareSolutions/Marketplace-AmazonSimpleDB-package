<?php
use Aws\Common\Credentials\Credentials;

$app->post('/api/AmazonSimpleDB/listDomains', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region']);
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
    
    $body = [];
    if(!empty($post_data['args']['maxNumberOfDomains'])) {
        $body['MaxNumberOfDomains'] = $post_data['args']['maxNumberOfDomains'];
    }
    if(!empty($post_data['args']['nextToken'])) {
        $body['NextToken'] = $post_data['args']['nextToken'];
    }
    
    try {
        if(!empty($body)) {
            $res = $client->listDomains(
                $body
            )->getAll();
        } else {
            $res = $client->listDomains()->getAll();
        }
        
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = is_array($res) ? $res : json_decode($res);
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
