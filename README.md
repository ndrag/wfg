A simple Laravel application to be deployed as part of a first test of AWS ECR, ECS, and CodeBuild.

[Based off the following guide](https://gbengaoni.com/blog/Deploy-a-Docker-ized-Laravel-Application-to-AWS-ECS-with-CodeBuild-4b0e388f4f53), but with modifications (e.g. PHP 8.1, not 7.3).
## Local Development

* If you have Composer installed, run `composer install`.
* If not, run the following, which will download a Docker image with Composer and run the same command in that environment.

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs --no-cache
```

Create an alias to shortcut `./vendor/bin/sail up` to `sail`. 

* Copy `.env.example` to `.env` and set the config values accordingly.
* Run `sail up` (or `./vendor/bin/sail up` if you haven't set an alias) to spin up the Docker environment. This will take some minutes on first run. 
* Run `sail down` to safely spin down the environment as required. 
* With sail running, run `sail artisan key:generate` to generate your own encryption key.
<!-- * Run `sail yarn` to install all client-side dependencies.
* Use `sail npm run watch-poll` to enable live-recompilation. Note that this setup does not currently work with Browsersync.  -->

### Production Deployment

Production build and deployment are handled by Amazon CodeBuild. When you push to the main branch, CodeBuild will spin up a Docker container based on your `buildspec.yml` & `Dockerfile`, build your code & image, and provide them to your AWS ecosystem. 

### DEPRECATED local development setup

Build the image initially and after every change you make to the Dockerfile
```
docker build -t works-for-good .
```

Run the following to serve the site locally at http://localhost:8001/
```
docker run -it -p 8001:80 works-for-good
```