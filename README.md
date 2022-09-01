# Works for Good
A simple homepage for the Works for Good organization (`worksforgood.io`) intended as an AWS ecosystem practice project. 

## Tech Stack
- Laravel 8
- Inertia.js
- Vue 3
- Tailwind
- Ziggy (routing)

## Hosting Infrastructure
- AWS ECR
- AWS IAM
- AWS EC2 + ECS
- Amazon CodeBuild (Build pipeline)

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
With the sail container running...
* Run `sail artisan key:generate` to generate your own encryption key.
* Run `sail npm install` to instal front-end dependencies.
* Run `sail npm run watch-poll` to build dev assets and enable live-reloading. 
* View the dev site at `localhost`.

## Production Deployment

Production build and deployment are handled by Amazon CodeBuild. When a changes is made to the main branch, CodeBuild will spin up a Docker container based on your `buildspec.yml` & `Dockerfile`, build your code & image, and provide them to your AWS ecosystem. 


## Useful resources

- [A very useful guide to deploying a boilerplate starter Laravel application to AWS with CodeBuild, ECR, ECS (EC2), and IAM](https://gbengaoni.com/blog/Deploy-a-Docker-ized-Laravel-Application-to-AWS-ECS-with-CodeBuild-4b0e388f4f53)

- [A guide to setting up Load Balancers (i.e. to provide a static IP and SSL support)](https://www.youtube.com/watch?v=o7s-eigrMAI)

- [Helpful for getting a handle on the AWS patterns & architecture we're working with](https://serverlessfirst.com/deploy-high-availability-web-app-to-aws-ecs/)

- [Setting up front-end Inertia with our front-end libraries (Tailwind, Vue, and Ziggy) in a new Laravel application](https://dev.to/geowrgetudor/setting-up-laravel-with-inertiajs-vuejs-tailwind-css-21pc)

- [Dealing with CodeBuild & front-end building with NPM](https://towardsaws.com/deploy-your-front-end-application-to-amazon-s3-using-codebuild-and-codepipeline-25c64572ffc6)

- [A resource with a good diagram of the system we're using](https://stackoverflow.com/questions/44403982/aws-load-balancer-ec2-health-check-request-timed-out-failure)

- [And a really good one for working with and implementing load balancers, especially with dynamic ports](https://www.youtube.com/watch?v=CRp354oWUJA)

- [This one's good for dealing with CodePipeline](https://medium.com/thelorry-product-tech-data/end-to-end-cd-pipeline-amazon-ecs-deployment-using-aws-codepipeline-332b19ca2a9)

<!-- 
### DEPRECATED local development setup

This simple Docker dev workflow has been replaced with Laravel Sail. 

Build the image initially and after every change you make to the Dockerfile

```
docker build -t works-for-good .
```

Run the following to serve the site locally at http://localhost:8001/
```
docker run -it -p 8001:80 works-for-good
```
 -->
