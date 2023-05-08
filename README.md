# OpenAI API PHP Client
This is a simple and lightweight PHP client for interacting with the OpenAI API. The client enables you to use 
OpenAI's GPT models, such as GPT-4, for various tasks like natural language understanding, text generation, and more.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Examples](#examples)
- [Contributing](#contributing)
- [License](#license)

## Installation

To install the OpenAI API PHP client, simply run the following command in your project directory:
```bash
$ composer require rumus-bin/open_ai_api_client
```

This will add the package to your project's dependencies and make it available for use.

## Usage

First, import the necessary classes:

```php
use RumusBin\OpenAiApiClient\OpenAiApiClient;
use RumusBin\OpenAiApiClient\Http\ClientConfig;
```
Then, create a new instance of the ClientConfig class, passing in your OpenAI API key as a parameter:

```php
$config = new ClientConfig('your-api-key');
```
Next, create a new instance of the Client class, passing in the Config object:

```php
$client = new OpenAiApiClient($config);
```
Now, you can start using the API to perform various tasks like text generation, natural language understanding, etc.

## Examples
### List Models
To list all available engine models, use the `listModels()` method:

```php
$engineModels = $client->listModels();
```

This method will return an `EngineModelCollection` object, which contains a list of `EngineModel` objects. Each `EngineModel` object has the following properties:
```php
private string $id;
private string $object;
private string $created;
private string $ownedBy;
```

### Get specific model by ID
To get a specific engine model by name, use the `getModelByName()` method:

```php
$engineModel = $client->getModelByName('davinci');
```
### Create Completion
In order to get an answer to your question or complete some phrase, you must use the client's `createCompletion()` method. 
This method can accept either a normal text string for which you want to get a response, or an object 
like `RumusBin\OpenAiApiClient\DTO\Completion\CompletionDto` in which you can set additional parameters for your request.

```php
$completion = $client->createCompletion(
    'In a shocking finding, scientist discovered a '
);
```

### Other Examples
Refer to the official OpenAI API documentation for more information on the various API endpoints and their parameters.

## Contributing
Contributions are always welcome! If you have any ideas, suggestions, or bug reports, feel free to submit an issue or 
create a pull request on the [GitHub repository](https://github.com/rumus-bin/open_ai_api_client).

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.


