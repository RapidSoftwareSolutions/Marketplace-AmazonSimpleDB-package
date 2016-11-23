<?php
use Aws\Common\Credentials\Credentials;

$app->post('/api/AmazonSimpleDB/batchDeleteAttributes', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','region','domainName','items']);
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
    
    $body['DomainName'] = $post_data['args']['domainName'];
    $body['Items'] = $post_data['args']['items'];
    
    try {
        if(!empty($body)) {
            $res = $client->batchDeleteAttributes(
                $body
            )->getAll();
        } else {
            $res = $client->batchDeleteAttributes()->getAll();
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
