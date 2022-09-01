---
title: Works for Good
author: Nicholas Dragunow
---

# Works for Good
A simple homepage for the Works for Good organization (worksforgood.info) intended as an AWS ecosystem practice project. 

## Tech Stack
- Laravel 8
- Inertia.js
- Vue 3
- Tailwind
- Ziggy (routing)

## Hosting Infrastructure
- AWS ECR (Docker image/container registration)
- AWS Route 53 (registrar + DNS)
- AWS IAM (certs)
- AWS ECS + EC2 (hosting)
- AWS Application Load Balancer (front-facing endpoint + load balancing + forcing HTTP traffic to use HTTPS)

## Repo & CI/CD
- GitHub
- AWS CodeBuild
- AWS CodePipeline

## Local Development

* *All commands should be run from the project's root.*
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

Optionally, create an alias to shortcut `./vendor/bin/sail up` to `sail`. Otherwise, continue to use `./vendor/bin/sail $COMMAND` in the steps below.

* Copy `.env.example` to `.env` and set the config values accordingly.
* Run `sail up` (or `./vendor/bin/sail up` if you haven't set an alias) to spin up the Docker environment. This will take some minutes on first run.
* Run `sail down` to safely spin down the environment as required.

With the sail container running:
* Run `sail artisan key:generate` to generate your own encryption key.
* Run `sail npm install` to install front-end dependencies.
* Run `sail npm run watch-poll` to build dev assets & watch for changes.

From now on you can run two commands to spin up your dev environment with change monitoring:
* Run `sail up`
* Run `sail npm run watch-poll`
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

- [This one runs us through adding an HTTPS listener to our load balancer & diverting HTTP traffic to HTTPS](https://www.youtube.com/watch?v=JQP96EjRM98)

- [A useful resource for setting up a CNAME to enable AWS SLL certificate validation](https://www.ssls.com/knowledgebase/how-can-i-complete-the-domain-control-validation-for-my-ssl-certificate/)

- [A resource for injecting secured .env variables into EC2 buckets when the ECS task spins them up](https://www.youtube.com/watch?v=GZZpEJ3R0Lw)

## Running the production Docker container locally

- Build the image initially (and on updating the Dockerfile): 

```
docker build -t works-for-good .
```

- And run the following to serve the site locally at http://localhost:8001/
```
docker run -it -p 8001:80 works-for-good
```