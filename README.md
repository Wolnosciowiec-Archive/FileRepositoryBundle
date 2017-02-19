FileRepositoryBundle
====================

[![Build Status](https://travis-ci.org/Wolnosciowiec/FileRepositoryBundle.svg?branch=master)](https://travis-ci.org/Wolnosciowiec/FileRepositoryBundle)
[![Coverage Status](https://coveralls.io/repos/github/Wolnosciowiec/FileRepositoryBundle/badge.svg?branch=master)](https://coveralls.io/github/Wolnosciowiec/FileRepositoryBundle?branch=master)

A Symfony bundle that provides a files repository interface with error handling.
Files repository allows to store static files on a cheapest storage (e.g. from $1/mo).
The file repository responsibility is to redistribute the files, handle recognition and validation, de-duplication,
so the main application could take only the minimum of sending files, and removing them if necessary.

Bundle also includes a local registry that was created to mark hotlinked resources as not available anymore
so it could be served from the repository only when expired on remote server.

### Requirements:

- Symfony
- JMS Serializer

Setup
=====

1. Register the bundle

```
new Wolnosciowiec\FileRepositoryBundle\FileRepositoryBundle(),
```

2. Add this to the `config.yml` or `config.xml` or `config.php` under `doctrine.orm.mappings`:

```
FileRepositoryBundle:
    type: yml
    prefix: Wolnosciowiec\FileRepositoryBundle
    dir: Resources/config/doctrine
    alias: FileRepositoryBundle
```

3. Add the initial migration

```
php bin/console doctrine:migrations:generate
```

Open the generated migration and put this to the up() method:

```
(new CachedResource_001_Migration())->up($schema);
```

And for the down() method:

```
(new CachedResource_001_Migration())->down($schema);
```

4. In configuration step you need to put your server address, secret token and cache class name

Configuration
=============

```
    file_repository:
        cache_class: "Doctrine\\Common\\Cache\\VoidCache"
        url: "https://image-repository-test.herokuapp.com"
        token: "api-key-here-for-external-remote-control"
```

Example usage
=============

```
// upload an image to the file repository
// the repository handles itself de-duplication, so we don't need to take care of it
// in the application
$this->uploader->uploadFromUrl($event->getBackgroundImage());

// add resource if it was not added before
// if it already exists, then nothing will be duplicated, old entry will be used
// preserving "active" state of the previous entry
$this->registry->addResource($event->getBackgroundImage());
```