中文翻译如下：

[![Build Status](https://travis-ci.org/americanexpress/hyperledger-fabric-sdk-php.svg?branch=master)](https://travis-ci.org/americanexpress/hyperledger-fabric-sdk-php)
[![Coverage Status](https://coveralls.io/repos/americanexpress/hyperledger-fabric-sdk-php/badge.svg?branch=master)](https://coveralls.io/r/americanexpress/hyperledger-fabric-sdk-php?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/americanexpress/hyperledger-fabric-sdk-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/americanexpress/hyperledger-fabric-sdk-php/?branch=master)

# Hyperledger Fabric Client SDK for PHP
- - - - - - - - 

欢迎使用PHP SDK for Hyperledger项目。此SDK的主要目标是促进客户端执行基本的链代码相关操作，例如：创建通道，安装和访问链代码等。

如果你是java程序员你可以看这个：[java fabric](http://www.hubwiz.com/course/5c9b89f54898e59b7b63430a)
Nodejs程序员可以看这个:[nodejs fabric](http://www.hubwiz.com/course/5c95f916a8d86b7067ffebb8)

注意，fabric-sdk-php是一个独立的客户端接口，用于通过运行的区块链网络访问网络信息和分类帐数据，它不能用作应用程序定义的通道数据的持久性介质。

## 安装
```
composer require americanexpress/hyperledger-fabric-sdk-php
```

## 用法

下面，您将找到高级和简洁的代码片段，演示如何与此SDK进行交互。

### Channel::queryByChaincode
查询第一个组织中的第一个节点（默认行为）：
```php
$config = new \AmericanExpress\HyperledgerFabricClient\Config\ClientConfig([
    // See `test/integration/config.php` for an example.
]);
$response = \AmericanExpress\HyperledgerFabricClient\Client\ClientFactory::fromConfig($config)
    ->getChannel('foo')
    ->getChaincode('example_cc')
    ->invoke('query', 'a');
```

查询指定组织:
```php
$config = new \AmericanExpress\HyperledgerFabricClient\Config\ClientConfig([
    // See `test/integration/config.php` for an example.
]);
$response = \AmericanExpress\HyperledgerFabricClient\Client\ClientFactory::fromConfig($config, 'peerOrg1')
    ->getChannel('foo')
    ->getChaincode('example_cc')
    ->invoke('query', 'a');
```

查询指定组织和节点:
```php
$config = new \AmericanExpress\HyperledgerFabricClient\Config\ClientConfig([
    // See `test/integration/config.php` for an example.
]);
$options = new \AmericanExpress\HyperledgerFabricClient\Transaction\TransactionOptions([
    'peer' => 'peer1',
]);
$response = \AmericanExpress\HyperledgerFabricClient\Client\ClientFactory::fromConfig($config, 'peerOrg1')
    ->getChannel('foo')
    ->getChaincode('example_cc')
    ->invoke('query', 'a', $options);
```

查询链码路径和版本:
```php
$config = new \AmericanExpress\HyperledgerFabricClient\Config\ClientConfig([
    // See `test/integration/config.php` for an example.
]);
$response = \AmericanExpress\HyperledgerFabricClient\Client\ClientFactory::fromConfig($config)
    ->getChannel('foo')
    ->getChaincode(['name' => 'example_cc', 'version' => '1', 'path' => 'github.com/example_cc'])
    ->invoke('query', 'a');
```

## 阶段1

* 对于阶段1，我们为基本的链代码操作提供客户端访问，例如通过链代码查询。
* 假设我们有一个正在运行的区块链网络，具有预定义的通道和已安装的链码。
* 提供[预定义脚本](test/fixture/sdkintegration/docker-compose.yaml)以根据测试用例启动测试网络。

## 第2阶段（即将发布）

* 在下一个版本中，我们的目标是添加更多链代码操作，如创建通道，调用和安装等

## Fabric和Fabric-ca v1.1.0的最新版本

Hyperledger Fabric v1.1.0目前正在积极开发中。

您可以转到[Hyperledger存储库](https://gerrit.hyperledger.org/r/#/admin/projects/)来克隆这些项目。

 -   -   -   -   -   -   - 

### 先决条件 ###

#### [Docker version ^17.0](https://docs.docker.com/engine/installation)
检查Docker的版本：
```bash
docker --version
```

#### [PHP version ^7.1](http://php.net/manual/en/install.php)
检查php版本:
```bash
php --version
```

#### [PHP GMP extension](http://php.net/manual/en/gmp.installation.php)
检查 PHP-GMP 安装文件 php.ini

#### [Composer tool](https://getcomposer.org/doc/00-intro.md)
检查 composer 版本 (应该是 1.5 or 以上)
```bash
composer --version
```

### 为开发安装 SDK

```bash
git clone https://github.com/americanexpress/hyperledger-fabric-sdk-php && cd $_
composer update
```

### 生成 SDK API 文档

```php
composer docs
```

```bash
open build/docs/index.html
```

### 运行End2End测试用例

在运行测试之前，我们需要调出结构网络和fixture(s):
```bash
composer fixture:up
```

目前，我们正在提供查询链码的示例测试用例，可以按如下方式运行：
```bash
composer test:integration
```

运行测试后，随时关闭网络：
```bash
composer fixture:down
```

更多内容可以看[Docker Compose](https://docs.docker.com/compose/overview/)

## 从 `.proto` 文件重新生成 PHP 类文件

```bash
composer protoc
```

更多内容请阅读[compiling PHP code from proto files](docs/compile-hyperledger-fabric-proto-files.md).

## 特约

我们欢迎您对Github上的美国运通开源社区感兴趣。任何开源的贡献者由American Express Open Source Community的项目必须接受并签署一份表示同意的协议以下条款。本协议授予美国运通和软件接收者的权利除外由American Express分发，您保留您的贡献中的所有权利，所有权和利益（如果有）。请[填写协议](https://cla-assistant.io/americanexpress/hyperledger-fabric-sdk-php)。

请随意打开pull请求，并查看`CONTRIBUTING.md`以了解提交格式详细信息。

## 执照

根据此项目所做的任何贡献将受[Apache License 2.0](LICENSE.txt)的约束。

## 行为守则

该项目遵守[American Express Community Guidelines](CODE_OF_CONDUCT.md)。通过参与，你将兑现这些准则。
