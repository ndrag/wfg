A simple Laravel application to be deployed as part of a first test of AWS ECR, ECS, and CodeBuild.

[Based off the following guide](https://gbengaoni.com/blog/Deploy-a-Docker-ized-Laravel-Application-to-AWS-ECS-with-CodeBuild-4b0e388f4f53), but with modifications (e.g. PHP 8.1, not 7.3).
## Local Development

Build the image initially and after every change you make to the Dockerfile
```
docker build -t works-for-good .
```

Run the following to serve the site locally at http://localhost:8001/
```
docker run -it -p 8001:80 works-for-good
```