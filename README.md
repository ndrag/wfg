---
title: Works for Good
author: Nicholas Dragunow
---

# Works for Good
An incredibly over-engineered homepage for the 'Works for Good' group that serves as a learning tool & playground for the AWS ecosystem.

## Tech Stack
- Laravel 8 (AWS CodeBuild doesn't yet provide a PHP version compatible with Laravel 9)
- Postgres 14
- Inertia.js
- Vue 3
- Tailwind
- Ziggy (routing)
- Sentry (error logging)

## Hosting Infrastructure
- AWS ECR (Docker image/container registration)
- AWS Route 53 (registrar + DNS)
- AWS IAM (policies & certs)
- AWS ECS + EC2 (hosting)
- AWS Systems Manager (production ENV variable storage)
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

* Copy `.env.example` to `.env` and set config values as required.
* Run `sail up` to spin up the Docker environment. This will take some minutes on first run.
* Run `sail down` to safely spin down the container.

With the sail container running:
* Run `sail artisan key:generate` to generate your own encryption key.
* Run `sail npm install` to install front-end dependencies.
* Run `sail npm run watch-poll` to build dev assets & watch for changes.

From now on you can run two commands to spin up your dev environment with change monitoring:
* Run `sail up`
* Run `sail npm run watch-poll`
* View the dev site at `localhost`.

* You may run `sail down -v` to delete your local postgres development db. It will be recreated fresh the next time you run `sail up`, using up to date DB credentials from your `.env` file. 

**Note: Do not push directly to the main branch! Create a release branch from main, add your feature branches, and merge it to main - at which point it'll be automatically pushed to the live server.**

## Production Deployment

Production build and deployment are handled by Amazon CodeBuild. When a changes is made to the main branch, CodeBuild will spin up a Docker container based on your `buildspec.yml` & `Dockerfile`, build your code & image, and provide them to your AWS ecosystem. CodePipeline will then call the ECS prod deployment service. 

## SSH Access 

- The production site will be running on an EC2 instance. You can SSH into any EC2 instance that has an inbound rule within its security group that allows SSH traffic on port 22 (set at the cluster level). Note that you may be rejected with a `22` error if your IP address is not specified in that inbound rule.

- Ensure you have access to the appropriate private key and then find the DNS address of the EC2 instance you're interested in from  the EC2 management page. From a linux terminal, enter the following:

```
ssh -i PRIVATE_KEY.pem ec2-user@IPV6_DNS_ADDRESS_OF_EC2_INSTANCE
```

- e.g.

```
ssh -i aws_key.pem ec2-user@ec2-54-67-3-74.us-west-1.compute.amazonaws.com
```

## Environment variables

.env.example and your own .env file are only used in development. Production environment variables are stored in AWS Systems Manager and injected into the built app container during release by the ECS production release task (wfg-prod-deployment-env-vars-specified).

- To create or modify production environment variables, head to [AWS Systems Manager.](https://us-west-1.console.aws.amazon.com/systems-manager/parameters/?region=us-west-1&tab=Table)

- To include new variables in the production release task, [go to the task definitions page](https://us-west-1.console.aws.amazon.com/ecs/home?region=us-west-1#/taskDefinitions), find the deployment task, create a new revision, and add the new env variable as a key/value against the image container.

- You'll also need to update [the production deployment service](https://us-west-1.console.aws.amazon.com/ecs/home?region=us-west-1#/clusters/wfg-prod-cluster-two-ec2/services/wfg-prod-deployment-task/details) running on the production ECS cluster to use that new revision - otherwise it'll continue to use the older deployment task without your new or modified env variable imports.

## Useful resources

- [A very useful guide to deploying a boilerplate starter Laravel application to AWS with CodeBuild, ECR, ECS (EC2), and IAM](https://gbengaoni.com/blog/Deploy-a-Docker-ized-Laravel-Application-to-AWS-ECS-with-CodeBuild-4b0e388f4f53)

- [A guide to setting up Load Balancers (i.e. to provide a static IP and SSL support)](https://www.youtube.com/watch?v=o7s-eigrMAI)

- [Helpful for getting a handle on the AWS patterns & architecture we're working with](https://serverlessfirst.com/deploy-high-availability-web-app-to-aws-ecs/)

- [Setting up Inertia with our front-end libraries (Tailwind, Vue, and Ziggy) in a new Laravel application](https://dev.to/geowrgetudor/setting-up-laravel-with-inertiajs-vuejs-tailwind-css-21pc)

- [Dealing with CodeBuild & front-end building with NPM](https://towardsaws.com/deploy-your-front-end-application-to-amazon-s3-using-codebuild-and-codepipeline-25c64572ffc6)

- [A resource with a good diagram of the architectural pattern we're using](https://stackoverflow.com/questions/44403982/aws-load-balancer-ec2-health-check-request-timed-out-failure)

- [And a really good one for working with and implementing load balancers, especially with dynamic ports](https://www.youtube.com/watch?v=CRp354oWUJA)

- [This one's good for dealing with CodePipeline](https://medium.com/thelorry-product-tech-data/end-to-end-cd-pipeline-amazon-ecs-deployment-using-aws-codepipeline-332b19ca2a9)

- [This one runs us through adding an HTTPS listener to our load balancer & diverting HTTP traffic to HTTPS](https://www.youtube.com/watch?v=JQP96EjRM98)

- [A useful resource for setting up a CNAME to enable AWS SSL certificate validation](https://www.ssls.com/knowledgebase/how-can-i-complete-the-domain-control-validation-for-my-ssl-certificate/)

- [A resource for injecting secured .env variables into EC2 containers when the ECS task spins them up](https://www.youtube.com/watch?v=GZZpEJ3R0Lw)


- [Adding an inbound rule to your cluster's security group to allow SSH access](https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/authorizing-access-to-an-instance.html)

- [Connect to an EC2 instance via SSH](https://docs.aws.amazon.com/AmazonECS/latest/developerguide/instance-connect.html)

## Running the production Docker container locally (deprecated)

- Build the image initially (and on updating the Dockerfile): 

```
docker build -t works-for-good .
```

- And run the following to serve the site locally at http://localhost:8001/
```
docker run -it -p 8001:80 works-for-good
```