FileRepositoryBundle
====================

[![Build Status](https://travis-ci.org/Wolnosciowiec/FileRepositoryBundle.svg?branch=master)](https://travis-ci.org/Wolnosciowiec/FileRepositoryBundle)
[![Coverage Status](https://coveralls.io/repos/github/Wolnosciowiec/FileRepositoryBundle/badge.svg?branch=master)](https://coveralls.io/github/Wolnosciowiec/FileRepositoryBundle?branch=master)

A Symfony bundle that provides a files repository interface with error handling.
Files repository allows to store static files on a cheapest storage (e.g. from $1/mo).
The file repository responsibility is to redistribute the files, handle recognition and validation, de-duplication,
so the main application could take only the minimum of sending files, and removing them if necessary.

### Requirements:

- Symfony

Setup
=====

1. Register the bundle

```
new Wolnosciowiec\FileRepositoryBundle\FileRepositoryBundle(),
```

2. In configuration step you need to put your server address, secret token and cache class name

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
```
