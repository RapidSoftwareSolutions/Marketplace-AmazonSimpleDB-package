# AmazonSimpleDB Package
Amazon SimpleDB is a web service for running queries on structured data in real time. This service works in close conjunction with Amazon Simple Storage Service (Amazon S3) and Amazon Elastic Compute Cloud (Amazon EC2), collectively providing the ability to store, process and query data sets in the cloud. These services are designed to make web-scale computing easier and more cost-effective for developers.
* Domain: amazon.com
* Credentials: apiKey, apiSecret

## How to get credentials: 
0. Go to [Amazon Console](https://console.aws.amazon.com/console/home?region=us-east-1)
1. Log in or create new account
2. Create new group in Groups section at the left side with necessary polices:
 - AmazonElasticMapReduceReadOnlyAccess
 - AmazonElasticMapReduceRole 
 - AmazonElasticMapReduceforEC2Role
 - ReadOnlyAccess
 - AmazonElasticMapReduceFullAccess
 - SecurityAudit
 - ...
3. Create new user and assign to existing group
4. After creating user you will see credentials

#### region possible values
```
| Region | Region name
|--------|------------
| us-east-1 | US East (N. Virginia)
| us-west-1 | US West (N. California)
| us-west-2 | US West (Oregon)
| ap-southeast-1 | Asia Pacific (Singapore)
| ap-southeast-2 | Asia Pacific (Sydney)
| ap-northeast-1 | Asia Pacific (Tokyo)
| eu-west-1 | EU (Ireland)
| sa-east-1 | South America (São Paulo)
```


## AmazonSimpleDB.listDomains
This endpoint returns domain names up to the limit set by MaxNumberOfDomains. A NextToken is returned if there are more than MaxNumberOfDomains domains.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Required: API key obtained from Amazon.
| apiSecret         | credentials| Required: API secret obtained from Amazon.
| region            | String     | Required: The region for endpoint. See README for all possible values.
| maxNumberOfDomains| String     | Optional: The maximum number of domain names you want returned. The range is 1 to 100. The default setting is 100.
| nextToken         | String     | Optional: String that tells Amazon SimpleDB where to start the next list of domain names.


## AmazonSimpleDB.createDomain
This endpoint allows to creates a new domain. The domain name must be unique among the domains associated with the apiKey provided in the request. The CreateDomain operation might take 10 or more seconds to complete.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Required: API key obtained from Amazon.
| apiSecret | credentials| Required: API secret obtained from Amazon.
| region    | String     | Required: The region for endpoint. See README for all possible values.
| domainName| String     | Required: The name of the domain to create. The name can range between 3 and 255 characters and can contain the following characters: a-z, A-Z, 0-9, '_', '-', and '.'.


## AmazonSimpleDB.deleteDomain
This endpoint allows to deletes a domain. Any items (and their attributes) in the domain are deleted as well. The DeleteDomain operation might take 10 or more seconds to complete.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Required: API key obtained from Amazon.
| apiSecret | credentials| Required: API secret obtained from Amazon.
| region    | String     | Required: The region for endpoint. See README for all possible values.
| domainName| String     | Required: The name of the domain to delete.


## AmazonSimpleDB.getAttributes
Returns all of the attributes associated with the item. Optionally, the attributes returned can be limited to one or more specified attribute name parameters.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Required: API key obtained from Amazon.
| apiSecret     | credentials| Required: API secret obtained from Amazon.
| region        | String     | Required: The region for endpoint. See README for all possible values.
| itemName      | String     | Required: The name of the item.
| attributeName | String     | Optional: The name of the attribute.
| domainName    | String     | Required: The name of the domain in which to perform the operation.
| consistentRead| String     | Optional: When set to true, ensures that the most recent data is returned. Default: false.


## AmazonSimpleDB.putAttributes
This endpoint allows to creates or replaces attributes in an item.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Required: API key obtained from Amazon.
| apiSecret     | credentials| Required: API secret obtained from Amazon.
| region        | String     | Required: The region for endpoint. See README for all possible values.
| itemName      | String     | Required: The name of the item.
| domainName    | String     | Required: The name of the domain in which to perform the operation.
| attributes    | JSON       | Required: Array of objects. Attributes are uniquely identified in an item by their name/value combination. Attribute.X.Name and Attribute.X.Value are reuired. See README for more details.
| expectedName  | String     | Optional: Name of the attribute to check. Must be used with the expected value or expected exists parameter.
| expectedValue | String     | Optional: Value of the attribute to check. Must be used with the expected name parameter. Can be used with the expected exists parameter if that parameter is set to true.
| expectedExists| String     | Optional: Flag to test the existence of an attribute while performing conditional updates. Must be used with the expected name parameter. When set to true, this must be used with the expected value parameter. When set to false, this cannot be used with the expected value parameter.

#### attributes format
```json
[  
    {  
        "name":"Color",
        "value":"blue"
    },
    {  
        "name":"Size",
        "value":"big"
    }
]
```

## AmazonSimpleDB.deleteAttributes
This endpoint allows to deletes one or more attributes associated with the item. If all attributes of an item are deleted, the item is deleted.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Required: API key obtained from Amazon.
| apiSecret     | credentials| Required: API secret obtained from Amazon.
| region        | String     | Required: The region for endpoint. See README for all possible values.
| itemName      | String     | Required: The name of the item.
| domainName    | String     | Required: The name of the domain in which to perform the operation.
| attributes    | JSON       | Required: Array of objects. Attributes are uniquely identified in an item by their name/value combination. If you specify DeleteAttributes without attribute names or values, all the attributes for the item are deleted. See README for more details.
| expectedName  | String     | Optional: Name of the attribute to check. Must be used with the expected value or expected exists parameter.
| expectedValue | String     | Optional: Value of the attribute to check. Must be used with the expected name parameter. Can be used with the expected exists parameter if that parameter is set to true.
| expectedExists| String     | Optional: Flag to test the existence of an attribute while performing conditional updates. Must be used with the expected name parameter. When set to true, this must be used with the expected value parameter. When set to false, this cannot be used with the expected value parameter.

#### attributes format
```json
[  
    {  
        "name":"Color",
        "value":"blue"
    },
    {  
        "name":"Size",
        "value":"big"
    }
]
```

## AmazonSimpleDB.batchPutAttributes
With the BatchPutAttributes operation, you can perform multiple PutAttribute operations in a single call. This helps you yield savings in round trips and latencies, and enables Amazon SimpleDB to optimize requests, which generally yields better throughput.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Required: API key obtained from Amazon.
| apiSecret | credentials| Required: API secret obtained from Amazon.
| region    | String     | Required: The region for endpoint. See README for all possible values.
| domainName| String     | Required: The name of the domain in which to perform the operation.
| items     | JSON       | Required: Array of objects. Items of attributes are uniquely identified in an item by their name/value combination. See README for more details.

#### items format
```json
[  
    {  
        "Name":"Shirt1",
        "Attributes":[  
            {  
                "Name":"Size",
                "Value":"XL",
                "Replace":false
            },
            {  
                "Name":"Color",
                "Value":"red",
                "Replace":false
            }
        ]
    },
    {  
        "Name":"Shirt2",
        "Attributes":[  
            {  
                "Name":"Size",
                "Value":"L",
                "Replace":false
            },
            {  
                "Name":"Color",
                "Value":"green",
                "Replace":false
            }
        ]
    }
]
```

## AmazonSimpleDB.batchDeleteAttributes
Performs multiple DeleteAttributes operations in a single call, which reduces round trips and latencies. This enables Amazon SimpleDB to optimize requests, which generally yields better throughput.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Required: API key obtained from Amazon.
| apiSecret | credentials| Required: API secret obtained from Amazon.
| region    | String     | Required: The region for endpoint. See README for all possible values.
| domainName| String     | Required: The name of the domain in which to perform the operation.
| items     | JSON       | Required: Array of objects. Items to be deleted. See README for more details.

#### items format
```json
[  
    {  
        "Name":"Shirt1",
        "Attributes":[  
            {  
                "Name":"Size",
                "Value":"XL",
                "Replace":false
            },
            {  
                "Name":"Color",
                "Value":"red",
                "Replace":false
            }
        ]
    },
    {  
        "Name":"Shirt2",
        "Attributes":[  
            {  
                "Name":"Size",
                "Value":"L",
                "Replace":false
            },
            {  
                "Name":"Color",
                "Value":"green",
                "Replace":false
            }
        ]
    }
]
```

## AmazonSimpleDB.domainMetadata
Returns information about the domain, including when the domain was created, the number of items and attributes, and the size of attribute names and values.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Required: API key obtained from Amazon.
| apiSecret | credentials| Required: API secret obtained from Amazon.
| region    | String     | Required: The region for endpoint. See README for all possible values.
| domainName| String     | Required: The name of the domain for which to display metadata.


## AmazonSimpleDB.makeSelectExpression
The Select operation returns a set of Attributes for ItemNames that match the select expression. Select is similar to the standard SQL SELECT statement.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Required: API key obtained from Amazon.
| apiSecret       | credentials| Required: API secret obtained from Amazon.
| region          | String     | Required: The region for endpoint. See README for all possible values.
| selectExpression| String     | Required: The expression used to query the domain. For example: select Color from `MyDomain` where Color like '%Blue%'.
| consistentRead  | String     | Optional: true || false. When set to true, ensures that the most recent data is returned.
| nextToken       | String     | Optional: String that tells Amazon SimpleDB where to start the next list of ItemNames.

